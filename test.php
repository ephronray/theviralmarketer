<?php 
require_once (__DIR__.'/_libs/bitcoinSetting.php');
$bitcoinSetting = new bitcoinSetting();
//test bitcoin setting working fine (after test remove this line)
//echo $bitcoinSetting->testBitCoinSettingWorking();

// test bitcoin setting working fine



//$response =  $bitcoinSetting->createWallet('test3@gmail.com443');
$response =  $bitcoinSetting->getAllAccounts();
 
//

//$response =  $bitcoinSetting->sendFromOneWalletToOnether('15MtVNYXXyzYHzrLCNsWbupgemJ8CH5F2X' , '10449' , '0' , '1');
echo "<pre>";
print_r($response);
echo "</pre>";
?>