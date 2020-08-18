<?php 
require_once (__DIR__.'/../_libs/dbConnect.php');
require_once (__DIR__.'/../_libs/payment.php');
require_once (__DIR__.'/../_libs/uplineMembers.php');
require_once(__DIR__ . '/../_libs/bitcoinSetting.php');
require_once (__DIR__.'/../_libs/paypalSetting.php');

use \Stripe\Stripe;
use \Stripe\Customer;
use \Stripe\ApiOperations\Create;
use \Stripe\Charge;

if(isset($_POST['user_amount']) && isset($_POST['amount']))
{	
	$db 	 = new dbConnect();
	$payment = new payment();
	$bitcoinSetting = new bitcoinSetting();
	 $paypalPayment = new Paypal();
	$paypalClient = new Paypal([
    'cmd' => '_xclick',
    'no_note' => '1',
    'lc' => 'ZAF',
    'currency_code' => 'USD',
    'bn' => 'PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest',
    'first_name' => $_SESSION['user']['first_name'],
    'email' => $_SESSION['user']['email'],
    'ibm' => $_SESSION['user']['ibm'],
    'amount' => $_POST['amount'],
    'item_name' => 'Funded for bitcoin',
    'item_number' => $_SESSION['user']['ibm']
]);
	//echo $_POST['amount'];
$walletAddress = updateWallet($bitcoinSetting, $db, $_SESSION['user']['wallet_number'], $_SESSION['user']['wallet_xpub'], true);
	$fee = $db->getTransactionFeeCraditCard($_POST['amount']);
     $tvmminer = $db->getFee($_POST['amount']);
	$stripeRequest = array(
		//'token'=>$_POST['token'],
		'amount'=>$_POST['amount'],
		'first_name'=> $_SESSION['user']['first_name'],
		'email'=> $_SESSION['user']['email'],
		'ibm'=> $_SESSION['user']['ibm'],
		'wallet_number'=> $walletAddress,
		'wallet_xpub' =>$_SESSION['user']['wallet_xpub'],
		'currency_code'=> 'USD',
		'fee' => $fee,
		'tvmminer' => $tvmminer
						  
		);

	$mainWalletBalnce = $bitcoinSetting->getSingleMainAccount();
	$amountInSatoshi = $payment->getSatoshiFromUSD($_POST['amount']); //amount in satoshi
	//if($mainWalletBalnce['balance'] > $amountInSatoshi) {
	if(true) {
		try {
    $paypalClient->buildQuery();
    $paypalClient->initTransaction($_POST['user_amount'], $_POST['amount']);
  	echo json_encode(array('success'=>true,'url'=>$paypalClient->redirect()));
} catch (Exception $e) {
    echo json_encode(array('success'=>false,'message'=>$e->getMessage()));		
}
	}
	else {
	echo json_encode(array('success'=>false, 'message'=> 'There is something issue with transaction, you have to contact with admin'));
	}
	// echo json_encode($mainWalletBalnce);
	
}

function updateWallet($bitcoinSetting, $db, $memberWallet, $memberWalletXPublic, $is_session)
{
	$walletAccountDetail = $bitcoinSetting->getSingleAccount($memberWalletXPublic);
	if ($walletAccountDetail['receiveAddress'] != $memberWallet) {
		$response = $db->updateWalletAddress($walletAccountDetail['receiveAddress'], $memberWalletXPublic);
		if ($response['success'] == true) {
			if ($is_session) {
				$_SESSION['user']['wallet_number'] = $walletAccountDetail['receiveAddress'];
				return $walletAccountDetail['receiveAddress'];
			} else {
				return $walletAccountDetail['receiveAddress'];
			}
		} else {
			return $walletAccountDetail['receiveAddress'];
		}
	} else {
		return $memberWallet;
	}
}


?>