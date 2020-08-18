<?php 
require_once (__DIR__.'/../_libs/stripe/init.php');

use \Stripe\Stripe;
use \Stripe\Customer;
use \Stripe\ApiOperations\Create;
use \Stripe\Charge;

class StripePayment
{

    private $apiKey;

    private $stripeService;

    public function __construct()
    {
        $this->apiKey = 'sk_test_LShLoPoVL0tBN3qLjYhtL0nY';
        $this->stripeService = new \Stripe\Stripe();
        $this->stripeService->setVerifySslCerts(false);
        $this->stripeService->setApiKey($this->apiKey);
    }

    public function addCustomer($customerDetailsAry)
    {
        
        $customer = new Customer();
        
        $customerDetails = $customer->create($customerDetailsAry);
        
        return $customerDetails;
    }

    public function chargeAmountFromCard($cardDetails)
    {
        $customerDetailsAry = array(
            'email' => $cardDetails['email'],
            'source' => $cardDetails['token']
        );
        $customerResult = $this->addCustomer($customerDetailsAry);
        $charge = new Charge();
        $cardDetailsAry = array(
            'customer' => $customerResult->id,
            'amount' => $cardDetails['amount']*100 ,
            'currency' => $cardDetails['currency_code'],
            'description' => nl2br($cardDetails['first_name'].'  purchased BTC of $'.$cardDetails['amount']. ' | and sender IBM is'.$cardDetails['ibm'].'  , | sender email is'.$cardDetails['email'].' ,  | sender wallet is'.$cardDetails['wallet_number'] ),
            'metadata' => array(
                'ibm' => $cardDetails['ibm']
            )
        );
        $result = $charge->create($cardDetailsAry);

        return $result->jsonSerialize();
    }
}
