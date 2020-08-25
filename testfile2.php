<?php

require_once (__DIR__.'/_libs/PHPMailer/phpmail.php');
$mail = new phpmail();
$mail->sendEmail('saadraza.official@gmail.com','Demo','Hi i am Saad Raza','info@theviralmarketer.biz');
//if(mail('saadraza.official@gmail.com',"Test","Hi i am Saad Raza","info@theviralmarketer.biz")){
//echo "Working"; 	
//}else{
//echo "Danger";
//}

?>