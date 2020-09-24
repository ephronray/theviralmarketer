<?php

if(isset($_POST))
{
    require_once (__DIR__.'/../_libs/TransferWise/includes/class_TransferWise.php');
  
    
   
    
    ?>
    <?php
    
    include('includes/class_TransferWise.php');
    
    //Set profileId
    //echo 'TransferWise Server: ';
   // if(isset($_GET['SANDBOX'])){
      //  echo 'Sandbox';
        $profileName = 'SANDBOX_ID_' ;
    //} else {
      //  echo 'Production';
        // $profileName = '2';
     // }
    
    
   // if(isset($_GET['UNKNOWN']) ){
     //   $profileSuffix = 'UNKNOWN';
    //} elseif(isset($_GET['BUSINESS']) ) {
       $profileSuffix = 'BUSINESS';
    //} else {
       // $profileSuffix = 'PERSONAL';
    //}
    
    //echo "<br>Profile: $profileSuffix<br>";
    $profileName .= $profileSuffix;
    
    $profileId = (defined($profileName))?constant($profileName):$profileName;
    
    //Create Read Only instance
    $tw = new TransferWise($profileId);
    
    if(strstr($profileId,'_UNKNOWN') !== false) {
        //Phase 1 - IDs unknown
        $profiles=json_decode($tw->getProfiles());
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
    $accountBalance = json_decode($tw->getAccountBalance($currency));
    //echo print_r($accountBalance,1);
    //echo '</pre>';
    //echo '</details>';
    
    //if(!isset($_GET['SANDBOX'])){       //Cannot get statement in Sandbox
      //echo "<hr>get Statement $currency<br>";
      //echo '<details><summary>See result</summary>';
      //echo '<pre>';
      echo print_r(json_decode($tw->getStatement($currency,'json',gmdate("Y-m-d\TH:i:s\Z", strtotime('-1 month')))),1);
      //echo '</pre>';
      //echo '</details>';
    }
    
   // echo "<hr>Get Exch Rate<br>";
    //echo '<details><summary>See result</summary>';
    //echo '<pre>';
    //echo print_r(json_decode($tw->getExchangeRate('USD','EUR')),1);
    //echo '</pre>';
    //echo '</details>';
    // unset ($tw);
    
    //Create Full Access instance
    $tw = new TransferWise($profileId, false);
    
//echo "<hr>Create an Address<br>";
  //  echo '<details>';
    //echo '<summary>See result</summary>';
  //  echo '<pre>';
    echo print_r(json_decode($tw->postCreateAddress($_POST['country'], $_POST['address'], $_POST['postalCode'], $_POST['city'], '')),1);
   // echo '</pre>';
   // echo '</details>';
    
    
    // echo "<hr>Create email Recipient<br>";
    $details = new stdClass();
    $details->email = $_POST['email'];
    $name = $_POST['firstName']." ". $_POST['secondName'];
   // echo '<details>';
    // echo '<summary>See result</summary>';
    // echo '<pre>';
    echo print_r(json_decode($tw->postCreateAccount($name, 'USD', 'email', $details)),1);
    //echo '</pre>';
    // echo '</details>';
    
    // Create payment recipients
    //  Each currency has different requirements for creating a payment recipient.
    //  See https://api-docs.transferwise.com/#recipient-accounts-create-xxx-recipient
    //   where xxx = 3 character currency (e.g. USD, GBP, ...)
    
    // $url = 'https://api-docs.transferwise.com/#recipient-accounts-create-gbp-recipient';
    // //echo "<hr>Create GBP (sort_code) Recipient<br>";
    // //echo "See: <a href=\"$url\">$url</a><br>";
    // $details = new stdClass();
    // $details->legalType     = 'PRIVATE';
    // $details->sortCode      = '40-30-20';
    // $details->accountNumber = $_POST['accountNumber'];
    // echo '<details>';
    // echo '<summary>See result</summary>';
    // echo '<pre>';
    // echo print_r(json_decode($tw->postCreateAccount('Jean Bloggs', 'GBP', 'sort_code', $details)),1);
    // echo '</pre>';
    // echo '</details>';
    
    // $url = 'https://api-docs.transferwise.com/#recipient-accounts-create-gbp-recipient';
    // echo "<hr>Create GBP (IBAN) Recipient<br>";
    // echo "See: <a href=\"$url\">$url</a><br>";
    // $details = new stdClass();
    // $details->legalType = 'PRIVATE';
    // $details->IBAN      = 'GB33BUKB20201555555555';
    // echo '<details>';
    // echo '<summary>See result</summary>';
    // echo '<pre>';
    // echo print_r(json_decode($tw->postCreateAccount('Jean Bloggs', 'GBP', 'iban', $details)),1);
    // echo '</pre>';
    // echo '</details>';
    
    $url = 'https://api-docs.transferwise.com/#recipient-accounts-create-usd-recipient';
    //echo "<hr>Create USD Recipient<br>";
    //echo "See: <a href=\"$url\">$url</a><br>";
    $details = new stdClass();
    $details->legalType     = 'PRIVATE';
    $details->abartn        = $_POST['abartn'];
    $details->accountNumber = $_POST['accountNumber'];
    $details->accountType   = 'CHECKING';
    $details->address       = new stdClass();
    $details->address->country   = $_POST['country'] ;
    $details->address->city      = $_POST['city'];
    $details->address->postCode  = $_POST['postalCode'];
    $details->address->firstLine = $_POST['address'];
    $name = $_POST['firstName']." ". $_POST['secondName'];
   
    // echo '<details><summary>See result</summary>';
    // echo '<pre>';
    echo print_r(json_decode($tw->postCreateAccount($name, 'USD', 'aba', $details)),1);
   // echo '</pre>';
    //echo '</details>';
    // Check DELETE works
    //  1. Create an account
    //  2. Delete same
    
    $details = new stdClass();
    $details->legalType     = 'PRIVATE';
    $details->abartn        = $_POST['abartn'];
    $details->accountNumber = $_POST['accountNumber'];
    $details->accountType   = 'CHECKING';
    $details->address       = new stdClass();
    $details->address->country   =  $_POST['country'];
    $details->address->city      =  $_POST['city'];
    // $details->address->state      = 'TX';
    $details->address->postCode  =$_POST['postalCode'];
    $details->address->firstLine = $_POST['address'];
    
    //echo "<hr>Transfer Funds: Step 1 - Create Quote<br>";
    //echo '<details>';
    //echo '<summary>See result</summary>';
    //echo '<pre>';
    $Quote=json_decode($tw->postCreateQuote('BALANCE_PAYOUT','USD','USD',$_POST['amount'] ));
    //echo print_r($Quote,1);
    //echo '</pre>';
    //echo '</details>';
    
    //echo "<hr>Transfer Funds: Step 2 - Create Recipient<br>";
    //echo '<details>';
    //echo '<summary>See result</summary>';
    //echo '<pre>';
    $recipientAcct   = json_decode($tw->postCreateAccount($name, 'USD', 'aba', $details));
    $recipientAcctId = $recipientAcct->id;
    //echo print_r($recipientAcct,1);
    // echo '</pre>';
    // echo '</details>';
    
    // echo "<hr>Transfer Funds: Step 3 - Create Transfer<br>";
    // echo '<details>';
    // echo '<summary>See result</summary>';
    // echo '<pre>';
    $Transfer = json_decode($tw->postCreateTransfer($recipientAcctId,$Quote->id,'Viral Marketer','verification.transfers.purpose.upgrade.levels','verification.source.of.funds.other'));
    $TransferId = $Transfer->id;
    echo print_r($Transfer,1);
    // echo '</pre>';
    // echo '</details>';
    
    // echo "<hr>Transfer Funds: Step 4 - Fund Transfer<br>";
    // echo '<details>';
    // echo '<summary>See result</summary>';
    // echo '<pre>';
  //  echo print_r(json_decode($tw->postFundTransfer($TransferId)),1);
    // echo '</pre>';
    // echo '</details>';
    
    // echo "<hr>Deleting account with id = $recipientAcctId ......<br>";
    // echo '<details><summary>See result</summary>';
    // echo '<pre>';
    echo print_r(json_decode($tw->deleteAccount($recipientAcctId)),1);
    // echo '</pre>';
    // echo '</details>';
    
    ?>
  

}

?>