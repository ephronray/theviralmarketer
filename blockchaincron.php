<?php

require_once(__DIR__ . '/_libs/dbConnect.php');
require_once(__DIR__ . '/_libs/bitcoinSetting.php');
$bitcoinSetting = new bitcoinSetting();

$db = new dbConnect();
   $allmembers = $db->showallmembers();

foreach($allmembers as $singlemember){
	$walletAccountDetail = $bitcoinSetting->getSingleAccount($singlemember['wallet_xpub']);
if ($walletAccountDetail['receiveAddress'] != $singlemember['wallet_number']) {
  $response = $db->updateWalletAddress($walletAccountDetail['receiveAddress'],$singlemember['wallet_xpub']);
}
	return $response;
}

