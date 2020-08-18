<?php
if(!session_id()) session_start();
require_once (__DIR__.'/../_libs/dbConnect.php');
/**
 * Created by PhpStorm.
 * User: Faisal Alam
 * Date: 26-02-2018
 * Time: 21:19
 */

// namespace Paypal;

// use Toolani\Payment\Paypal\IpnVerifier;

class Paypal
{
    const MERCHANT_EMAIL = 'theviralmarketer2015@gmail.com';
    const PAYMENT_SUCCESS_URL = "http://www.theviralmarketer.biz/paypal_success.php";
    const PAYMENT_FAILURE_URL = "http://www.theviralmarketer.biz/paypal_success.php";
    const PAYMENT_NOTIFY_URL = "";
    const SANDBOX_ENDPOINT = "https://www.sandbox.paypal.com";
    const LIVE_ENDPOINT = "https://www.paypal.com";
    const ENV = "production";
    private $data;
	private $db;
    private $queryString = '';
    private $token;
    private $response = array();

    /**
     * Paypal constructor.
     * @param array $data
     */
    function __construct(array $data = array())
    {
        $this->data = $data;
		$this->db = new dbConnect();
    }

    /**
     * Build URL query parameters.
     */
    public function buildQuery()
    {
        // TODO: Catch exception if all the parameter are not passed in the constructor.

        $this->token = $this->generateTrackingCode();
        $_SESSION['paypal']['data'] = $this->data;

        $this->queryString .= '?business=' . urlencode(self::MERCHANT_EMAIL) . '&';

        foreach ($this->data as $key => $value) {
            $value = urlencode(stripslashes($value));
            $this->queryString .= "$key=$value&";
        }

        $this->queryString .= 'return=' . urlencode(self::PAYMENT_SUCCESS_URL . "?token=" . $this->token) . '&';
        $this->queryString .= 'cancel_return=' . urlencode(self::PAYMENT_FAILURE_URL . "?token=" . $this->token) . '&';
       // $this->queryString .= 'notify_url=' . urlencode(self::PAYMENT_NOTIFY_URL) . '&';

        $this->queryString .= 'custom=' . urlencode($this->token);
    }

    /**
     * Redirect to the Paypal server for payment.
     */
    public function redirect() {
        $url = self::ENV === 'development' ? self::SANDBOX_ENDPOINT : self::LIVE_ENDPOINT;
		return "{$url}/cgi-bin/webscr" . $this->queryString;
       
    }

    /**
     * Logs unique transaction identifier in the database.
     *
     * @throws \Exception
     */
    public function initTransaction($amount , $amountWithTax) {
       	$data = array('amount'=>$amount,'amount_with_tax'=>$amountWithTax,'status'=>0,'token'=>$this->token);
		$this->db->savePayPalTransaction($data);
	}

    /**
     * Read the response received from the Paypal IPN.
     */
    public function readIPNResponse() {
        foreach($_POST as $key => $val) {
            $this->response[$key] = $val;
        }
    }

    /**
     * Validate if payment was successful or not.
     *
     * @return bool
     * @throws \Exception
     */
    // public function validatePayment() {
    //     $verifier = new IpnVerifier($useSandbox = SELF::ENV === 'development' ? TRUE : FALSE);
    //     try {
    //         $verified = $verifier->verify($this->response);
    //     } catch(\Exception $e) {
    //         throw new \Exception('Verification failure: ' . $e->getMessage());
    //     }

    //     if ($verified) {
    //         return TRUE;
    //     }

    //     return FALSE;
    // }

    /**
     * Update payment status in database on successful payment.
     *
     * @throws \Exception
     */
    public function updatePaymentStatus() {
        // $driver = new \mysqli_driver();
        // $default_driver = $driver->report_mode; // Get the default error reporting mode.
        // $driver->report_mode = MYSQLI_REPORT_STRICT; // Throw exception instead of returning warning.

        // $db = \Database::connect();
        // $query = "UPDATE payments SET paypal_txn_id = ?,
        //           payment_amount = ?, 
        //           payment_currency = ?, 
        //           payment_status = ?, 
        //           payer_email = ?, 
        //           item_name = ?, 
        //           item_number = ?
        //           WHERE tracking_id = ?";

        // try {
        //     $stmt = $db->prepare($query);
        //     $stmt->bind_param("ssssssss",
        //         $this->response['txn_id'],
        //         $this->response['mc_gross'],
        //         $this->response['mc_currency'],
        //         $this->response['payment_status'],
        //         $this->response['payer_email'],
        //         $this->response['item_name'],
        //         $this->response['item_number'],
        //         $this->response['custom']
        //     );
        //     $stmt->execute();
        // } catch (\mysqli_sql_exception $e) {
        //     throw new \Exception($e->getMessage());
        // }
        // $driver->report_mode = $default_driver; // Restore the default error reporting mode.
        // \Database::disconnect();
    }

    /**
     * Generates unique tracking code.
     *
     * @return string
     */
    private function generateTrackingCode() {
        $token = $this->uniqueToken();
        $_SESSION['paypal']['token'] = $token;

        return $token;
    }

    /**
     * Unset all paypal session data.
     */
    public function unsetSessionVars() {
        unset($_SESSION['paypal']);
    }

    public static function uniqueToken() {
        $secretKey = "3W7ed3v9m21nQGYoNI9I"; // Any random string
        $sessionId = session_id();
        $randomKey = bin2hex(openssl_random_pseudo_bytes(10));

        return hash('sha512', $secretKey . $sessionId . $randomKey);
    }
}