<?php 
require_once (__DIR__.'/../_libs/dbConnect.php');
require_once (__DIR__.'/../_libs/payment.php');
require_once (__DIR__.'/../_libs/uplineMembers.php');
require_once(__DIR__ . '/../_libs/bitcoinSetting.php');



if(isset($_POST['amount']) && isset($_POST['profileid']))
{

	echo "Working";
	die();

    $db 	 = new dbConnect();
	$payment = new payment();
    $bitcoinSetting = new bitcoinSetting();
    
    $walletAddress = updateWallet($bitcoinSetting, $db, $_SESSION['user']['wallet_number'], $_SESSION['user']['wallet_xpub'], true);
	$fee = 0;
     $tvmminer = 0;
	$stripeRequest = array(
		'profileid'=>$_POST['profileid'],
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
        if($mainWalletBalnce['balance'] > $amountInSatoshi) {
        $stripeResponse = $stripePayment->chargeAmountFromCard($stripeRequest);
            if($stripeResponse['status'] == "succeeded") {
                $userAmountInSatoshi = $payment->getSatoshiFromUSD($_POST['user_amount']); //amount in satoshi
                $makePayment = $bitcoinSetting->sendFromOneWalletToOnether($walletAddress, $userAmountInSatoshi, $mainWalletBalnce['index']);
                if ($makePayment['success'] == true) {
    
                    $miner_fee = $db->getFee($_POST['user_amount'])/2;
                    $tvm_fee = $db->getFee($_POST['user_amount'])/2;
                    $historyData = array(
                     'description'=> 'Wallet Funded by Credit Card',
                     'transaction_id' =>  $makePayment['tx'],
                     'receiver_wallet_address' => $walletAddress,
                     'receiver_ibm' => $stripeRequest['ibm'],
                     'amount' => $_POST['user_amount'],
                     'status' =>  'Successfull',
                     'miner_fee' => $miner_fee,
                     'tvm_fee' => $tvm_fee
                   );
                    
                    $responses =  $db->transectionHistoryforBuyBitcoin($historyData);
                     $response = array(
                        'success' => true,
                        'message' => $makePayment['message'],
                        'error' => false
                      );
                      echo json_encode($response);
                      return;
    
                } else {
                     $response = array(
                        'success' => false,
                        'message' => $makePayment['error'],
                        'error' => true
                      );
                      echo json_encode($response);
                      return;
                }
    
            } else {
                echo json_encode(array('success'=>false, 'message'=> 'There is something issue. Please try again!'));
                return;
            }
        }
        else {
        echo json_encode(array('success'=>false, 'message'=> 'There is something issue with transaction, you have to contact with admin.'));
        return;
        }
    


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