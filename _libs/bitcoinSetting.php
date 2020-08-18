<?php
//require_once ( __DIR__.'/../_libs/dbConnect.php' );

class bitcoinSetting  {

    private $blockchain;
    //private $apiCode = '0c2b010c-a5ea-4699-9aa1-70f2794d8e9f';
    //private $serviceUrl = 'http://localhost:3000/';
    //private $mainGuid = 'ea9be4db-ae89-4769-abbd-3ec916ff57cc';
    //private $mainWalletPassword = 'Passw0rd@0271';
    private $apiCode = '0c2b010c-a5ea-4699-9aa1-70f2794d8e9f';
    private $serviceUrl = 'http://localhost:3000/';
    private $mainGuid = '0f7aecf8-f9a6-46ea-af2d-c686ea850a6f';
    private $mainWalletPassword = 'Presto@1969';
    private $db;

    public function __construct()
    {

        //$this->db = new dbConnect();
    }

    public function enbaleHd() {
        //This will upgrade a wallet to an HD ( Hierarchical Deterministic ) Wallet, which allows the use of accounts. See BIP32 for more information on HD 		wallets and accounts.
        return $this->call( 'enableHD', '', true );
    }

    public function createWallet( $label ) {

        $param = '&label='.$label;
        $createNewWallet = $this->call( 'accounts/create', $param, true );
        if ( isset( $createNewWallet['xpub'] ) ) {
            $accountDetail = $this->getSingleAccount( $createNewWallet['xpub'] );
            return array( 'code'=>200, 'status'=>true, 'wallet_address' => array( 'user_wallet_address'=>$accountDetail['receiveAddress'], 'wallet_xpub'=>$accountDetail['extendedPublicKey'] ) );
        } else {
            return array( 'code'=>400, 'status'=>false, 'there is something issue, Please try again' );
        }
    }

    public function getSingleAccount( $xpub ) {
        return $this->call( 'accounts/'.$xpub, '', true );
    }
	
	 public function getSingleMainAccount( ) {
        return $this->call( 'accounts/0', '', true );
    }

    public function getAllAccounts() {
        return $this->call( 'accounts/', '', true );
    }

    public function getWalletBalnce( $xpub ) {
        $response = $this->call( 'accounts/'.$xpub.'/balance', '', true );
        if ( isset( $response['balance'] ) ) {

            $totalBalance = $response['balance'];
            $btcOfOneUsd = $this->getBitcoinValueOfoneUsd();

            $balance = [];

            //	user_balance_in_btc
            $balance[0] =  $this->satoshiToBTC( $totalBalance );
            //	btc to usd
            $balance[1] = round( $balance[0]/$btcOfOneUsd, 2 );

            //user_currency
            $balance[2] = 'USD';

            //balance in satoshi
            $balance[3] = $totalBalance;

            return $balance;

        }
    }

    public function getBalance() {
        return $this->call( 'balance', '', true );
    }

    public function sendFromOneWalletToOnether( $to_address, $amount, $from_address, $fee = null) {
	  if(is_null($fee)) {
        $param =  '&amount='.$amount.'&to='.$to_address.'&from='.$from_address;
	  } else {
	  $param =  '&amount='.$amount.'&to='.$to_address.'&from='.$from_address.'&fee='.$fee;	
}
        $response = $this->call( 'payment', $param, true );

        if(isset( $response['tx_hash'] ) ) {
            return array( 'success'=>true, 'tx'=>$response['tx_hash'], 'message'=> 'Your Transaction was successful. Your Transaction ID is'.$response['tx_hash'] );
        } else {
            return $response;
        }

    }

    public function testBitCoinSettingWorking() {
        return 'I am in bitcoin';
    }

    public function testBitCoinSettingWorkingWithArrayReturn() {
        return array( 'uid'=>21312313, 'email'=>'test@gmail.com' );
    }

    public function call( $endpoint, $params, $isMerchant = false ) {

        $url = $this->serviceUrl;
        $url .= $isMerchant ?'merchant/':'/';

        $url .= $this->mainGuid.'/'.$endpoint;
        $url .= '?password='.urlencode( $this->mainWalletPassword ).'&api_code='.$this->apiCode.$params;
        $ch = curl_init();
        curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch, CURLOPT_URL, $url );
        $ccc = curl_exec( $ch );
        //return json_decode( $ccc, true );
        $err = curl_error( $ch );
        curl_close( $ch );

        if ( $err ) {
            return 'cURL Error #:' . $err;
        } else {
            return json_decode( $ccc, true );
        }

    }

    public function getBitcoinValueOfoneUsd() {
        $url = 'https://blockchain.info/tobtc?currency=USD&value=1';
        $ch = curl_init();
        curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch, CURLOPT_URL, $url );
        $response = curl_exec( $ch );
        return $response;

    }

    /*convert from satoshi to BTC */

    private function satoshiToBTC( $valueInSatoshi ) {
        return $this->formatBTC( $this->convertToBTCFromSatoshi( $valueInSatoshi ) );

    }

    private function convertToBTCFromSatoshi( $value ) {
        $BTC = $value / 100000000 ;
        return $BTC;
    }

    private function formatBTC( $value ) {
        $value = sprintf( '%.8F', $value );
        $value = rtrim( $value, '0' );
        return $value;
    }
}

?>