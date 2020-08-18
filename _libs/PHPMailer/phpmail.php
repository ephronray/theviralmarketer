<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'src/Exception.php';
require 'src/PHPMailer.php';
 require 'src/SMTP.php';

class phpmail{

	private	$Host =  'mail.theviralmarketer.biz';
	private	$Username = 'info@theviralmarketer.biz';
	private	$Password = 'Pak786@123@';
	private	$SMTPSecure ='tls';
	private	$Port = 465;
	
	
	 public function sendEmail($to , $subject ,$body , $from)
     {

$mail = new PHPMailer();
		$mail->Host = $this->Host;
		$mail->SMTPAuth = true;
		$mail->Username = $this->Username; 
		$mail->Password = $this->Password; 
		$mail->SMTPSecure = $this->SMTPSecure;
		$mail->Port = $this->Port;
		 $mail->setFrom($from , 'theviralmarketer.biz' );
$mail->addReplyTo($from , 'Viral Marketer' );
$mail->addAddress($to , 'Saad Raza');
$mail->Subject = $subject;
$mail->isHTML(true);
 $mailcontent = '<h2>Heelo I am saad</h2>' ;
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