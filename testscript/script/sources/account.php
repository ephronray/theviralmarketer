<?php 
if(checkSession()) {
	$b = protect($_GET['b']);
	if($b == "wallet") { include("account/wallet.php"); }
	elseif($b == "addresses") { include("account/addresses.php"); }
	elseif($b == "transactions") { include("account/transactions.php"); }
	elseif($b == "transactions_by_address") { include("account/transactions_by_address.php"); }
	elseif($b == "security") { include("account/security.php"); }
	else {
		$redirect = $settings['url']."account/wallet";
		header("Location: $redirect");
	}
} 
?>