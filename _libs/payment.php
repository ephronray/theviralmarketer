<?php

/*
 *Author: raza
 *Date  : MARCH - 01 - 2018
 *Type  : therViralMarkter
 *
*/

require_once(__DIR__ . '/../_libs/dbConnect.php');
require_once(__DIR__ . '/../_libs/bitcoinSetting.php');
require_once(__DIR__ . '/../_libs/stripe/init.php');

class payment
{
	private $db;
	private $bitcoinSetting;
	private $stripeService;
	private $stripeApiKey = "sk_test_LShLoPoVL0tBN3qLjYhtL0nY"; //stripe secret key
	public function __construct()
	{
		$this->db = new dbConnect();
		$this->bitcoinSetting = new bitcoinSetting();
		$this->stripeService = new \Stripe\Stripe();
        $this->stripeService->setVerifySslCerts(false);
        $this->stripeService->setApiKey($this->stripeApiKey);
	}
	const SATOSHI = 100000000;
	public function api($url, $payload)
	{

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		# Setup request to send json via POST.
		curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

		$headers = [
			"Cache-Control: no-cache",
			"Content-Type: application/json",
			"Postman-Token: d7d6ee39-c095-470f-8644-2abc274c88bf",
			"api-key: 1N1stZHASThiaVHVJ3RTwMdkFidonotdelete",
			"content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW",
			"secret-key: 13u4GKaWPYmVFoXRqbTNdHtqmVdonotdelete"
		];

		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		# Return response instead of printing.
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		# Send request.
		$result = curl_exec($ch);
		curl_close($ch);
		$res = json_decode($result, true);
		return $res;
	}
	# after transection send by sender . insert Sender information here
	public function insertTransectionHistory($data, $tx_id, $level_description, $status, $miner_fee, $tvm_fee)
	{
		$date = date('d-m-Y');
		$tvm_discription = 'TVM Fee By ' . $data['sender_ibm'];
		$query = "INSERT INTO `transaction_history` 
		(
		`description`,
		`transaction_id`,
		`sender_Ibm`,
		`receiver_Ibm`,
		`amount`,
		`sender_wallet_address`,
		`receiver_wallet_address`,
		`status`,
		`miner_fee`,
		`tvm_fee`,
		`admin_trans`
		) VALUES (
		'" . $level_description . "',
		'" . $tx_id . "',
		'" . $data['sender_ibm'] . "',
		'" . $data['receiver_ibm'] . "',
		'" . $data['level_amount'] . "',
		'" . $data['sender_address'] . "', 
		'" . $data['receiver_address'] . "',
		'" . $status . "',
		'" . $miner_fee . "',
		'" . $tvm_fee . "',
		'0'
	)";

		if ($this->db->dbCon->query($query) && $this->db->dbCon->affected_rows == 1) {
			$tvmQuery = "INSERT INTO `transaction_history` 
		(
		`description`,
		`transaction_id`,
		`sender_Ibm`, 
		`receiver_Ibm`,
		`amount`,
		`sender_wallet_address`,
		`receiver_wallet_address`,
		`status`,
		`miner_fee`,
		`tvm_fee`,
		`admin_trans`
		) VALUES (
		'" . $tvm_discription . "',
		'" . $tx_id . "',
		'" . $data['sender_ibm'] . "',
		'" . $data['receiver_ibm'] . "',
		'" . $data['level_amount'] . "',
		'" . $data['sender_address'] . "', 
		'" . $data['receiver_address'] . "',
		'" . $status . "',
		'" . $miner_fee . "',
		'" . $tvm_fee . "',
		'1'
	)";
			if ($this->db->dbCon->query($tvmQuery) && $this->db->dbCon->affected_rows == 1) {

				return $response = array(
					"success" => true,
					"error" => false
				);
			} else {
				return $response = array(
					'success' => false,
					'error' =>  'There is something wrong In Transaction'
				);
			}
		} else {
			return $response = array(
				'success' => false,
				'error' =>  'There is something wrong In Transaction'
			);
		}
		//return false;
	}

	function checkExternalOrInternalWallet($welletAdress)
	{
	}
	private function currentBtcRate($usd)
	{
		$data = $this->api('https://blockchain.info/tobtc?currency=usd&value=' . $usd . '', null);
		$respond = json_decode($data, true);
		return $respond;
	}

	public function transaction_payment($email, $level_amount, $memberWallet, $fee, $sender_wellet, $sender_wellet_xpub, $sender_ibm, $receiver_ibm)
	{
		$checkBalance = $this->bitcoinSetting->getWalletBalnce($sender_wellet_xpub);

		$getSenderSingleAccountDetail = $this->bitcoinSetting->getSingleAccount($sender_wellet_xpub);

		$senderIndex = $getSenderSingleAccountDetail['index'];

		if ($checkBalance[3] > 0) {

			$data = array(
				'sender_ibm' => $sender_ibm,
				'sender_address' => $sender_wellet,
				'sender_index' => $senderIndex,
				'wallet_xpub' => $sender_wellet_xpub,
				'receiver_address' => $memberWallet,
				'level_amount' => $level_amount,
				'receiver_ibm' => $receiver_ibm
			);

			$payLoads 	= array(
				'email'	 => $email, //which gonna pay
				'wallet_address' => $memberWallet, //receiver wallet addrees
				'amount'	=> $level_amount,
				'fee' => $fee

			);
			$balance = $checkBalance[3];  // Balance in satoshi
			$getAmountInSatoshi =  $this->currentBtcRate($level_amount) * self::SATOSHI; // conver level_amount in satoshi
	$feeInSatoshi =  $this->currentBtcRate($fee) * self::SATOSHI; // conver fee in satoshi
			if ($balance >= $level_amount) // check if balance is enough to upgrade to this pack
			{

				$makePayment = $this->bitcoinSetting->sendFromOneWalletToOnether($memberWallet, $getAmountInSatoshi, $senderIndex, $feeInSatoshi);
				if ($makePayment['success'] == true) {

					//Insert all record for transection history 
					$level_description = "Bitcoin Transfer from sender " . $sender_ibm;
					$status = "Successfull";
					$miner_fee = ($fee / 2) + 0.5;
					$tvm_fee = $fee / 2;
					$transection_id = $makePayment['tx'];
					$response = $this->insertTransectionHistory($data, $transection_id, $level_description, $status, $miner_fee, $tvm_fee);

					if ($response['success'] == true) {
						return	array(
							'success' => true,
							'message' => $makePayment['message'],
							'error' => false
						);
					} else {
						return	array(
							'success' => false,
							'message' => $response['error'],
							'error' => true
						);
					}
				} else {
					return	array(
						'success' => FALSE,
						'error' => true,
						'message' => 'Transaction Unsuccessfull! Please Try Again.'

					);
				}
			} else {
				return	array(
					'success' => FALSE,
					'error' => 'You must have ' . $level_amount . ' USD in your wallet to upgrade level.',
					'satoshi' => $getAmountInSatoshi
				);
			}
		} else {
			return	array(
				'success' => false,
				'message' => 'No, Wallet Found!!',
				'error' => true
			);
		}
	}



	public function check_wallet_balance($memberWalletXPublic, $level_amount)
	{
		$checkBalance = $this->bitcoinSetting->getWalletBalnce($memberWalletXPublic);
		
		if (!empty($checkBalance)) {

			$balance =  $checkBalance[3];   // Balance in satoshi
			$getSatoshi =  $this->currentBtcRate($level_amount) * self::SATOSHI;
			
			if ($balance >= $level_amount) // check if balance is enough to upgrade to this pack
			{
				return	array(
					'success' => true,
					'message' => 'OK',
					'satoshi' => $getSatoshi
				);
			} else {
				return	array(
					'success' => FALSE,
					'error' => 'You must have ' . $level_amount . ' USD in your wallet to upgrade level.',
					'satoshi' => $getSatoshi
				);
			}
		} else {
			return	array(
				'success' => false,
				'error' => 'No, Wallet Found!!'
			);
		}
	}
	
	
	public function getSatoshiFromUSD($level_amount) {
		return $this->currentBtcRate($level_amount) * self::SATOSHI;
	}
	
}
