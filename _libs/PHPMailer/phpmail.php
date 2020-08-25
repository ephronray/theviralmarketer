<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'src/Exception.php';
require 'src/PHPMailer.php';
 require 'src/SMTP.php';

class phpmail{

	
	private	$Host =  'mail.mraza.xyz';
	private	$Username = 'info@mraza.xyz';
	private	$Password = 'Pakistan@12';
	private	$SMTPSecure ='ssl';
	private	$Port = 465;
	
	
	 public function sendEmail($to , $subject ,$body , $from)
     {

$mail = new PHPMailer(true);;	
	$mail->SMTPOptions = array(
'ssl' => array(
'verify_peer' => false,
'verify_peer_name' => false,
'allow_self_signed' => true
)
);
		 $mail->isSMTP();
	 $mail->SMTPDebug = 2;
		$mail->Host = $this->Host;
		 $mail->SMTPAuth = true;
		$mail->Username = $this->Username; 
		$mail->Password = $this->Password; 
		$mail->SMTPSecure = $this->SMTPSecure;
		$mail->Port = $this->Port;
		 $mail->setFrom($from , 'theviralmarketer.biz' );
 $mail->addReplyTo($from , 'Viral Marketer' );
$mail->addAddress($to , 'Saad Raza');
 $mail->isHTML(true);
 $mail->Subject = $subject;
		 $mailcontent = '<html><head><title>Mail</title></head><body><h2>Heelo I am saad</h2></body></html>' ;
	$mail->Body = $mailcontent;	 
		if($mail->send()){
    echo 'Message has been sent';
}else{
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} 
	 }

	
	
	
	
	
	public function display(){
		
		echo "Hy Saad";
	}
};


?>