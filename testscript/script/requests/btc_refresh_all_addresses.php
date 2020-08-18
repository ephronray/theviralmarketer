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
$query = $db->query("SELECT * FROM btc_users_addresses WHERE uid='$_SESSION[btc_uid]' ORDER BY id");
																	if($query->num_rows>0) { 
																		$i=1;
																		while($row = $query->fetch_assoc()) {
																		?>
																		<tr id="btc_address_<?php echo $row['id']; ?>">
																			<td> <?php echo $i++; ?> </td>
																			<td> <?php $expl = explode("_",$row['label']); echo $expl[2]; ?> </td>																			</td>
																			<td> <?php echo $row['address']; ?> </td>
																			<td> <?php echo $row['available_balance']; ?> BTC </td>
																			<td>
																				 <a class="btn btn-circle btn-sm btn-icon btn-default" href="javascript:;" onclick="btc_send_from_address('<?php echo $row['id']; ?>');">
																					<i class="fa fa-arrow-circle-o-up"></i> Send
																				</a>
																				<a class="btn btn-circle btn-sm btn-icon btn-default" href="javascript:;" onclick="btc_receive_to_address('<?php echo $row['id']; ?>');">
																					<i class="fa fa-arrow-circle-o-down"></i> Receive
																				</a> 
																				<?php if($row['archived'] == "1") { ?>
																				<a class="btn btn-circle btn-sm btn-icon btn-default" href="javascript:void(0);" onclick="btc_unarchive_address('<?php echo $row['id']; ?>');">
																					<i class="fa fa-archive"></i> Unarchive
																				</a>
																				<?php } else { ?>
																				<a class="btn btn-circle btn-sm btn-icon btn-default" href="javascript:void(0);" onclick="btc_archive_address('<?php echo $row['id']; ?>');">
																					<i class="fa fa-archive"></i> Archive
																				</a>
																				<?php } ?>
																				<a class="btn btn-circle btn-sm btn-icon btn-default" href="<?php echo $settings['url']; ?>account/transactions_by_address/<?php echo $row['address']; ?>">
																					<i class="fa fa-bars"></i> Transactions
																				</a> 
																			</td>
																		</tr>
																		<?php
																		}
																	} else {
																		echo info("Still no have addresses."); 
																	}
}
?>