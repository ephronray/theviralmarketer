<?php
ob_start();
session_start();
error_reporting(0);
if(file_exists("./install.php")) {
	header("Location: ./install.php");
} 
include("includes/config.php");
$db = new mysqli($CONF['host'], $CONF['user'], $CONF['pass'], $CONF['name']);
if ($db->connect_errno) {
    echo "Failed to connect to MySQL: (" . $db->connect_errno . ") " . $db->connect_error;
}
$db->set_charset("utf8");
$settingsQuery = $db->query("SELECT * FROM btc_settings ORDER BY id DESC LIMIT 1");
$settings = $settingsQuery->fetch_assoc();
include("includes/block_io.php");
include("includes/functions.php");
//include(getLanguage($settings['url'],null,null));

if(checkSession()) {	
	update_activity($_SESSION['btc_uid']);
	btc_delete_fee_transactions($_SESSION['btc_uid']);
}

if(checkSession()) {
include("sources/header.php");
	$a = protect($_GET['a']);
	switch($a) {
		case "account": include("sources/account.php"); break;
		case "faq": include("sources/faq.php"); break;
		case "logout": 
			unset($_SESSION['btc_uid']);
			unset($_COOKIE['bitcoinwallet_uid']);
			setcookie("bitcoinwallet_uid", "", time() - (86400 * 30), '/'); // 86400 = 1 day
			session_unset();
			session_destroy();
			header("Location: $settings[url]");
		break;
		default: include("sources/wallet.php");
	}
	include("sources/footer.php");
} else {
	$a = protect($_GET['a']);
	switch($a) {
		case "register": include("sources/register.php"); break;
		case "forgot-password": include("sources/forgot-password.php"); break;
		case "password-change": include("sources/password-change.php"); break;
		default: include("sources/login.php");
	}
}
mysqli_close($db);
?>