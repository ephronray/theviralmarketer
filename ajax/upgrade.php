<?php
require_once (__DIR__.'/../_libs/dbConnect.php');
require_once (__DIR__.'/../_libs/payment.php');
require_once (__DIR__.'/../_libs/uplineMembers.php');
require_once(__DIR__ . '/../_libs/bitcoinSetting.php');
if(isset($_POST['level']))
{	
	$db 	 = new dbConnect();
	$payment = new payment();
	$bitcoinSetting = new bitcoinSetting();
	

	if($db->isLoggedIN())
	{
		$memberID 	= $_SESSION['user']['u_id'];
		$levelNo 	= $_POST['level'];
		$memberInfo = $db->get_memeber_by_id($memberID);
		$levelInfo  = $db->get_level_info($levelNo);
		$memberEmail= $memberInfo['email'];
		$memberName = $memberInfo['name'];
		$memberWalletEmail= $memberInfo['wallet_email'];
		$memberWallet= $memberInfo['wallet_number'];
		$memberWalletXPublic = $memberInfo['wallet_xpub'];
		
		$memberWalletAsASenderAccountDetail =  $bitcoinSetting->getSingleAccount($memberWalletXPublic);
		$senderMemberIndex = $memberWalletAsASenderAccountDetail['index'];
		
		$levelAmount= $levelInfo['level_amount'];
		$levelName= $levelInfo['level_name'];
		$transactionFee = $db->getTrasactionFee($levelInfo['level_amount']);
		$BalanceCheck = $levelAmount + $transactionFee + 0.5;
		if(!empty($memberWalletEmail) && !filter_var($memberWalletEmail, FILTER_VALIDATE_EMAIL))
		{
			echo $db->sendResponse(array(
			'success' => false,
			'error' => 'There is a issue with your E-mail!!'
			));
		} else if (empty($levelAmount))
		{
			echo $db->sendResponse(array(
			'success' => false,
			'error' => 'There is a issue with this level.Please Contact Support!!'
			));
		} else  //check user balance
		{
			$uplineMember = new uplineMember($memberID, $memberInfo['ibm'], $levelNo);
			$uplineInfo = $uplineMember->getUpMember();
			$reciverWalletAddrress = updateWallet($bitcoinSetting, $db, $uplineInfo['memberInfo']['wallet_number'], $uplineInfo['memberInfo']['wallet_xpub'], false);
				
			if (!$uplineInfo['success']) 
			{
				echo $db->sendResponse($uplineInfo);
			}  else 
			{
				
			$accountInfo =	$payment->check_wallet_balance($memberWalletXPublic, $BalanceCheck);
			
		   
			if(isset($accountInfo['error'])) //check false
			{
				//error no wallet or less balance
				echo $db->sendResponse(array(
				'success' => false,
				'error' => $accountInfo['error']
				));
			} else 
			{
			    
				$satoshiToPay = $accountInfo['satoshi'];
				$payLoads 	= array(
				'to'	 => $reciverWalletAddrress, //which gonna pay
				'from' => $senderMemberIndex, 
				'amount'	=> 	$payment->getSatoshiFromUSD($levelAmount),
				'fee'     => 	$payment->getSatoshiFromUSD($transactionFee)
				);
				$makePayment = $bitcoinSetting->sendFromOneWalletToOnether($payLoads['to'], $payLoads['amount'], $payLoads['from'], $payLoads['fee']);
								
				$makePayment['success'] = true;				
				if($makePayment['success']) //check if payment done 
				{
				    
        	
				   	$transection_id = $makePayment['tx'];
					$paymentInfo = array(
					'sender_ibm'	=> 	$memberInfo['ibm'],	
					'receiver_ibm'	=> 	$uplineInfo['uplineIbm'],
					'level_amount'	=>	$levelAmount,
					'level'			=>	$levelNo,
					'sender_address'=>	$memberInfo['wallet_number'],
					'receiver_address'	=>$uplineInfo['memberInfo']['wallet_number'],
					'payment_status'	=>'1'
					);
					$level_description = $db->get_level_description($paymentInfo['level']);
					
					// Sedder of payment for level upgrade	    
            		$db->send_email_for_sender($levelInfo['level_name']);
                        
						//send email for reciever
					//$db->send_email_for_receiver($uplineInfo['memberInfo']['user_email']);
					$db->send_email_for_receiver($uplineInfo['memberInfo']['user_email'] ,  $uplineInfo['memberInfo']['first_name'] , $levelInfo['level_name'] , $levelAmount);
							
            			
				    
				    
				    
			
        	/*send email for receiver
        	
			$mytemplate  = file_get_contents($db->base_url.'/email-templates/upgrade_email_receiver.php');
            $message  = str_replace('{{$name}}', $uplineInfo['memberInfo']['first_name'] , $mytemplate);
            $message  = str_replace('{{ $level_name }}', $levelName , $message);
            $message  = str_replace('{{ $sender_name }}', $memberName , $message);
            $message  = str_replace('{{ $amount }}', $levelAmount , $message);
            $message   = str_replace('{{$support_url}}', $db->base_url , $message);
            $headers = 'MIME-Version: 1.0'."\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
            $headers .= "From: info@theviralmarketer.biz"; 
            mail($uplineInfo['memberInfo']['user_email'], 'Payment Notification', $message, $headers);
            */
        	//send email for receiver
					
					
					$res = $uplineMember->insertTrnxInfo($paymentInfo );
					
					if ($res ) 
					{
					     $status = 'Successfull';
				         $miner_fee =  ($transactionFee/2)+0.5;
				         $tvm_fee =  $transactionFee/2;
				         $transction = $uplineMember->insertTransectionHistory($paymentInfo , $transection_id , $level_description , $status, $miner_fee , $tvm_fee);
						// Insertion goes here
						
        	
						
						
						echo $db->sendResponse([
						    
						'success' => true,
						'message' => 'Your Transaction Has Been Completed. Enjoy Benefits Of Level '.$levelName,
						'limit'   => $uplineMember->memberLimit()
						]);
					} else {
					}
					
					
					
					
					
					
					
				} else 
				{
				    //$status = 'Failed';
				    //$miner_fee =  $transactionFee/2;
				    //$tvm_fee =  $transactionFee/2;
				    //$transction = $uplineMember->insertTransectionHistory($paymentInfo , $transection_id , $level_description , $status, $miner_fee , $tvm_fee);
					echo $db->sendResponse(array(
					'success' => false,
					'error' => 'Payment Transfer Failed!!'
					));
				}
			}
			}
		}

	} else 
	{
		echo $db->sendResponse(array(
		'success' => false,
		'error' => 'Please login to your account!!'
		));
	}
}else {
	echo $db->sendResponse(array(
	'success' => false,
	'error' => 'Access Not Allowed!!'
	));
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