<?php 
require_once (__DIR__.'/../_libs/dbConnect.php');
require_once (__DIR__.'/../_libs/payment.php');
require_once (__DIR__.'/../_libs/uplineMembers.php');
require_once (__DIR__ . '/../_libs/bitcoinSetting.php');
require_once (__DIR__ . '/../_libs/TransferWise/includes/class_TransferWise.php');
require_once (__DIR__ . '/../_libs/TransferWise/includes/configure.php');


if(isset($_POST['amount']) && isset($_POST['profileid']))
{



    $db 	 = new dbConnect();
	$payment = new payment();
	$bitcoinSetting = new bitcoinSetting();
	
	
	$profile_id =  $_POST['profileid'];
	$profile_id = substr($profile_id,1);
	define('SANDBOX_ID_PERSONAL', $profile_id);
	$profileName = 'SANDBOX_ID_' ;
	$profileSuffix = 'PERSONAL';
	$profileName .= $profileSuffix;
    $profileId = (defined($profileName))?constant($profileName):$profileName;
	$transferwise = new TransferWise($profileId);
	if(strstr($profileId,'_UNKNOWN') !== false) {
        //Phase 1 - IDs unknown
        $profiles=json_decode($transferwise->getProfiles());
    //    echo '<hr>get Profiles <br>';
      //  echo '<details><summary>See result</summary>';
        //echo '<pre>'.print_r($profiles,1).'</pre>';
        //echo '</details>';
         $profilePrefix = strtok($profileId,'_');
        //echo "Please edit includes/configure.php to include these lines\n\n"; 
        //echo '<pre>';
        foreach($profiles as $profile){
          echo "define('$profilePrefix".'_ID_'.strtoupper($profile->type)."','$profile->id');\n"; 
        }
      //  echo '</pre>';
        exit;
    }
	$currency='USD';
	// "<hr>get Acct Balance $currency<br>";
	// echo '<details><summary>See result</summary>';
	//echo '<pre>';
	$accountBalance = json_decode($transferwise->getAccountBalance($currency));
  if(isset($accountBalance)){
    echo "workimg";
echo $accountBalance;
  }
  //echo  $accountBalance ;
	//echo print_r($accountBalance,1);
	//echo '</pre>';
	$transferwise->getStatement($currency,'json',gmdate("Y-m-d\TH:i:s\Z", strtotime('-1 month')));
	 
	$transferwise = new TransferWise($profileId, false);
	$transferwise->postCreateAddress('South Africa', 'First Line Address' , 123233 ,  'city' , '');

	$details = new stdClass();
	$details->email = 'ermaralack@gmail.com';
	  $transferwise->postCreateAccount("Ephron Maralack", 'USD', 'email', $details);
	
	


    $walletAddress = updateWallet($bitcoinSetting, $db, $_SESSION['user']['wallet_number'], $_SESSION['user']['wallet_xpub'], true);
	$fee = 0;
     $tvmminer = 0;
	$transferwiseRequest = array(
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

			$Quote = json_decode($transferwise->postCreateQuote('BALANCE_PAYOUT','USD','USD',$_POST['amount'] ));
			$recipientAcct   = json_decode($transferwise->postCreateAccount('Ephron Maralack', 'USD', 'aba', $details));
			$recipientAcctId = $recipientAcct->id;
			$Transfer = json_decode($transferwise->postCreateTransfer($recipientAcctId,$Quote->id,'Viral Marketer','verification.transfers.purpose.upgrade.levels','verification.source.of.funds.other'));
			$TransferId = $Transfer->id;
		//	echo print_r($Transfer,1);
			$transferwise->deleteAccount($recipientAcctId);
       // $stripeResponse = $transferwise->chargeAmountFromCard($transferwiseRequest);
	if(isset($TransferId)){		
	   //if($stripeResponse['status'] == "succeeded") {
                $userAmountInSatoshi = $payment->getSatoshiFromUSD($_POST['user_amount']); //amount in satoshi
                $makePayment = $bitcoinSetting->sendFromOneWalletToOnether($walletAddress, $userAmountInSatoshi, $mainWalletBalnce['index']);
                if ($makePayment['success'] == true) {
					$miner_fee = 0 ;
					$tvm_fee = 0 ;
                  //  $miner_fee = $db->getFee($_POST['user_amount'])/2;
                    //$tvm_fee = $db->getFee($_POST['user_amount'])/2;
                    $historyData = array(
                     'description'=> 'Wallet Funded by Credit Card',
                     'transaction_id' =>  $makePayment['tx'],
                     'receiver_wallet_address' => $walletAddress,
                     'receiver_ibm' => $transferwiseRequest['ibm'],
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