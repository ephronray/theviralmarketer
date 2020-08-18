<?php
ob_start();
session_start();
error_reporting(0);
include("../includes/config.php");
$db = new mysqli($CONF['host'], $CONF['user'], $CONF['pass'], $CONF['name']);
if ($db->connect_errno) {
    echo "Failed to connect to MySQL: (" . $db->connect_errno . ") " . $db->connect_error;
}
$db->set_charset("utf8");
$settingsQuery = $db->query("SELECT * FROM btc_settings ORDER BY id DESC LIMIT 1");
$settings = $settingsQuery->fetch_assoc();
include("../includes/block_io.php");
include("../includes/functions.php");
//include(getLanguage($settings['url'],null,2));
if(checkSession()) {
$type = protect($_GET['type']);
if($type == "receive") {

} elseif($type == "new_address") {
	$nums = $db->query("SELECT * FROM btc_users_addresses WHERE uid='$_SESSION[btc_uid]'");
	if($nums->num_rows > $settings['max_addresses_per_account']) {
		$data['status'] = 'error';
		$data['msg'] = error("You've reached the limit of wallet addresses. Max: $settings[max_addresses_per_account]");
	} else {
	$label = protect($_POST['label']);
	if(!empty($label) && !isValidUsername($label)) { $data['status'] = 'error'; $data['msg'] = error("Please enter valid label. Use only characters and symbols - and _."); }
	else {
		if(empty($label)) { $label = randomHash(7); }
		$username = idinfo($_SESSION['btc_uid'],"username");
		$generate_address = btc_generate_address($username,$label);
		if($generate_address) {
			$data['status'] = 'success';
			$data['msg'] = success("Your new address is <b>$generate_address</b>.");
		} else {
			$data['status'] = 'error';
			$data['msg'] = error("Error with creating address. Please try again.");
		}
	}
	}
	echo json_encode($data);
} elseif($type == "send_bitcoins") {
	$address = protect($_GET['from_address']);
	$to_address = protect($_POST['to_address']);
	$amount = protect($_POST['amount']);
	$secret_pin = protect($_POST['secret_pin']);
	$secret_pin = md5($secret_pin);
	$check = $db->query("SELECT * FROM btc_users_addresses WHERE uid='$_SESSION[btc_uid]' and address='$address'");
	if($check->num_rows==0) { 
		$data['status'] = 'error';
		$data['msg'] = error("This wallet address is not yours!");
	} elseif(empty($address) or empty($to_address) or empty($amount)) { 
		$data['status'] = 'error';
		$data['msg'] = error("All fields are required."); 
	} elseif(!is_numeric($amount)) {
		$data['status'] = 'error';
		$data['msg'] = error("Please enter Bitcoin amount with numbers. Format: 0.000000");
	} elseif(idinfo($_SESSION['btc_uid'],"secret_pin") && idinfo($_SESSION['btc_uid'],"secret_pin") !== $secret_pin) {
		$data['status'] = 'error';
		$data['msg'] = error("Wrong Secret PIN!");
	} else {
		$row = $check->fetch_assoc();
		$total = $row['available_balance'];
		$total = $total - 0.0008;
		$total = $total - $settings['withdrawal_comission'];
		if($total < 0) { $total = '0.0000'; }
		if($amount > $total) { 
			$data['status'] = 'error'; 
			$data['msg'] = error("Total available minus fees <b>$total</b> BTC."); 
		} else {
			$newamount = $row['available_balance']-$amount;
			$newamount = $newamount - 0.0008 - $settings['withdrawal_comission'];
			$license_query = $db->query("SELECT * FROM btc_blockio_licenses WHERE id='$row[lid]' ORDER BY id");
			$license = $license_query->fetch_assoc();
			$apiKey = $license['license'];
			$pin = $license['secret_pin'];
			$version = 2; // the API version
			$block_io = new BlockIo($apiKey, $pin, $version);
			$withdrawal = $block_io->withdraw_from_addresses(array('amounts' => $amount, 'from_addresses' => $address, 'to_addresses' => $to_address));
			$withdrawal = $block_io->withdraw_from_addresses(array('amounts' => $settings[withdrawal_comission], 'from_addresses' => $address, 'to_addresses' => $license[address]));
			$data['status'] = 'success';				
			$data['msg'] = success("You sent <b>$amount</b> BTC to <b>$to_address</b> successfully.");
			$data['btc_total'] = $newamount;
		}
	}
	echo json_encode($data);
} elseif($type == "receive_to_address") {

} elseif($type == "archive_address") {
	$address_id = protect($_GET['address_id']);
	$query = $db->query("SELECT * FROM btc_users_addresses WHERE uid='$_SESSION[btc_uid]' and id='$address_id'");
	if($query->num_rows>0) {
		$row = $query->fetch_assoc();
		if($row['archived'] == "1") {
			echo 'Your wallet address <b>'.$row[address].'</b> is already archived.';
		} else {
			$update = $db->query("UPDATE btc_users_addresses SET archived='1' WHERE id='$row[id]'");
			echo 'Your wallet address <b>'.$row[address].'</b> was archived.';
		}
	} else {
		echo 'This wallet address is not yours!';
	}
} elseif($type == "unarchive_address") {
	$address_id = protect($_GET['address_id']);
	$query = $db->query("SELECT * FROM btc_users_addresses WHERE uid='$_SESSION[btc_uid]' and id='$address_id'");
	if($query->num_rows>0) {
		$row = $query->fetch_assoc();
		if($row['archived'] == "0") {
			echo 'Your wallet address <b>'.$row[address].'</b> is already unarchived.';
		} else {
			$update = $db->query("UPDATE btc_users_addresses SET archived='0' WHERE id='$row[id]'");
			echo 'Your wallet address <b>'.$row[address].'</b> was unarchived.';
		}
	} else {
		echo 'This wallet address is not yours!';
	}
} else { }
}
?>