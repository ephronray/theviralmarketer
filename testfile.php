<?php
require_once (__DIR__.'/_libs/phpMailer.php');
   $mail = new phpMailer();

//$mail->sendEmail('saadraza.official@gmail.com',"Test","Hi i am Saad","info@theviralmarketer.biz");

	$mail->display();

?>