<?php

 include_once '_libs/dbConnect.php';
 
 $obj = new dbConnect();
 
  	$template_sender  = $obj->db_select("SELECT `template_content` FROM `tbl_email_templates` WHERE `id` = 2");
                        if(mysqli_num_rows($template_sender) >= 0) 
                        {
                            $content      = str_replace('{#first_name#}', $memberName , $row_sender['template_content']);
                            $content     = str_replace('{#level#}', $levelName, $content);
                            $headers = 'MIME-Version: 1.0'."\r\n";
                            $headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
                            $headers .= "From: info@theviralmarketer.biz"; 
                            mail($memberEmail, 'You Have Just Upgraded | The Viral Marketer', $content, $headers); 
                        } 
                        
if(isset($_POST['submit'])){
   
   	echo $res = $obj->send_email_for_sender('Gold');
   //	 $obj->send_email_for_receiver('mraza804@gmail.com');
  // 	print_r($template_sender);
 echo 'raza';      
    
}                        
                        
                        
?>


<form method="post">
    <input type="submit" name="submit" value="submit">
</form>