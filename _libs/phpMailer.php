<?php
require_once (__DIR__.'/../_libs/PHPMailer/src/Exception.php');
require_once (__DIR__.'/../_libs/PHPMailer/src/PHPMailer.php');
require_once (__DIR__.'/../_libs/PHPMailer/src/SMTP.php');
use PHPMailer\PHPMailer\PHPMailer;
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require 'PHPMailer/PHPMailer.php';
$mail = new PHPMailer;
var_dump($mail);
if(!session_id()) session_start();
 
// Instantiation and passing `true` enables exceptions
//$mail = new PHPMailer(true);

class phpMailer{

	private	$Host =  'smtp.mraza.xyz';
	private	$Username = 'info@mraza.xyz';
	private	$Password = 'Pakistan@12';
	private	$SMTPSecure ='tls';
	private	$Port = 465;
	
	public function __construct()
 {
//$mail = new PHPMailer();
	/*	$mail->isSMTP();
$mail->Host = $this->Host;
$mail->SMTPAuth = true;
$mail->Username = $this->Username; 
$mail->Password = $this->Password; 
$mail->SMTPSecure = $this->SMTPSecure;
$mail->Port = $this->Port;	*/
}
	 public function sendEmail($to , $subject ,$body , $from)
     {
	/*	 $mail->setFrom($from , "Viral Marketer" );
$mail->addReplyTo($from , "Viral Marketer" );
$mail->addAddress($to);
$mail->Subject = $subject;
 //$mail->isHTML(true);
 $mailcontent = '<h2>Heelo I am saad</h2>' ;
	$mail->Body = $body;	 
		if($mail->send()){
    echo 'Message has been sent';
}else{
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} 

		*/
	 }
	public function display(){
		//$mail = new PHPMailer();
		echo "Hy Saad";
	}
}
?>
