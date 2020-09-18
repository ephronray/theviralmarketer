<?php
require_once (__DIR__.'/_libs/dbConnect.php');
$obj = new dbConnect();
$email = '';
$hash = '';
$message = '';
$on_success = '';
$first_name = '';
$base_url = '';

$response = '';

if(isset( $_SESSION['message_of_user']))
{
 $message .=  $_SESSION['message_of_user']['message'];
}
if(isset($_SESSION['register_new_user']))
{
     $email .= $_SESSION['register_new_user']['email'];
     $hash  .=  $_SESSION['register_new_user']['hash'];
     $message .= 'Please check your inbox for a verification link send to <b>'.$_SESSION['register_new_user']['email'].'</b>
Click the link in the email to verify your email address and gain access to our system. 
Please give 5 minutes for this action to complete.';
$on_success .= 'Account Successfully Created!';

  $first_name .= $_SESSION['register_new_user']['first_name'];
  $base_url .= $_SESSION['register_new_user']['base_url'];
    
    
}

else

{
     $message .= '"We regret to inform that due to some technical issues, your registration was not successful. Please try again later. If this continues to happen, please raise a support ticket"';
    $on_succes .= 'Error Occur! Something Wrong';
    
}

if(isset($_POST['resend_email']))
{
            $mytemplate  = file_get_contents('email-templates/signup_verification_email.php');
            $message  = str_replace('{{$name}}', $first_name , $mytemplate);
            $message   = str_replace('{{$email}}', $email , $message);
            $message   = str_replace('{{$hash}}', $hash , $message);
            $message   = str_replace('{{$support_url}}', $base_url , $message);
            $headers = 'MIME-Version: 1.0'."\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
          //  $headers .= "From: info@theviralmarketer.biz";
	   $headers .= "From: viral Marketer"; 
	//$email;
            if(mail($email , 'The Viral Marketer Signup | Email Verification', 'message ', $headers)) {
            $_SESSION['message_of_user'] = array(
               'message' => $message
               
               );
               $message .= 'Please check your inbox for a verification link send to <b>'.$_SESSION['register_new_user']['email'].'</b>
Click the link in the email to verify your email address and gain access to our system. 
Please give 5 minutes for this action to complete.';
               $response .= "Email Sent Successfully!";
           
             
            }
            
    
}



/*if(isset($_GET['email'] , $_GET['hash']))
{
    // Verify data
    $email = $_GET['email']; // Set email variable
    $hash = $_GET['hash']; // Set hash variable
    $data = array(
        'email' => $email,
        'hash' => $hash
        );
       
$response = $obj->verifiyActivation($data);
echo $response['success'];
if($response['success'] == true)
{
    $message = $response['message'];
    $head = "You're Verified!";
     $ibm = null;
    $name= null;
    $query = "SELECT `first_name` ,`ibm`
      FROM   `members`
      WHERE  `user_email` = '" . $email . "' Limit 1";
    $result = $obj->db_select($query);
     while($row = $result->fetch_assoc()) 
         {
             $ibm = $row['ibm'];
             $name = $row['first_name'];
         }
            
            $template  = $obj->db_select("SELECT `template_content` FROM `tbl_email_templates` WHERE `id` = 18");
            while($row = $template->fetch_assoc()) 
            {
            
                $content      = str_replace('{#first_name#}', $name, $row['template_content']);
                $content       = str_replace('{#email#}', $email, $content);
                $content       = str_replace('{#ibm#}', $ibm, $content);
                $headers = 'MIME-Version: 1.0'."\r\n";
                $headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
                $headers .= "From: info@viralmarketer.com"; 
                mail($email, 'Welcome To The Viral Marketer ', $content, $headers); 
            }
   
}
else
{
    
    $message = $response['message'];
    $head = "You're Not Verified!";

}
    
}
else
{
    $obj->redirectMe('error404.php');
}*/
?>

<!doctype html>
<html class="no-js" lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>The Viral Marketer| New User </title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
       <link rel="icon" href="assets/icon.ico">
        <!-- Place favicon.ico in the root directory -->
        <link rel="stylesheet" href="css/vendor.css">
		<link rel="stylesheet" href="https://anandchowdhary.github.io/ionicons-3-cdn/icons.css" integrity="sha384-+iqgM+tGle5wS+uPwXzIjZS5v6VkqCUV7YQ/e/clzRHAxYbzpUJ+nldylmtBWCP0" crossorigin="anonymous">
        <!-- Theme initialization -->
        <style>
        .email-body
        {
            display: none !Important; 
        }
         /* FONTS */
    @import url('https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i');

/* CLIENT-SPECIFIC STYLES */
body, table, td, a { -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }
table, td { mso-table-lspace: 0pt; mso-table-rspace: 0pt; }
img { -ms-interpolation-mode: bicubic; }

/* RESET STYLES */
img { border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none; }
table { border-collapse: collapse !important; }
body { height: 100% !important; margin: 0 !important; padding: 0 !important; width: 100% !important; }

/* iOS BLUE LINKS */
a[x-apple-data-detectors] {
    color: inherit !important;
    text-decoration: none !important;
    font-size: inherit !important;
    font-family: inherit !important;
    font-weight: inherit !important;
    line-height: inherit !important;
}

/* MOBILE STYLES */
@media screen and (max-width:600px){
    h1 {
        font-size: 32px !important;
        line-height: 32px !important;
    }
}
        </style>
  
    </head>

    <body style="background-color: #f3f5f7; margin: 0 !important; padding: 0 !important;">
    <div style="display: none; font-size: 1px; color: #fefefe; line-height: 1px; font-family: 'Poppins', sans-serif; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;">
    We're thrilled to have you here! Get ready to dive into your new account.
</div>

        <!---end of old -->
        <table border="0" cellpadding="0" cellspacing="0" width="100%"
               style="
                background: url(../../images/login-register.jpg) center center no-repeat rgba(0, 0, 0, 0.7);
                height: 100%;
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;">
    <!-- LOGO -->
    <tr>
        <td align="center">
            <!--[if (gte mso 9)|(IE)]>
            <table align="center" border="0" cellspacing="0" cellpadding="0" width="600">
            <tr>
            <td align="center" valign="top" width="600">
            <![endif]-->
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px; overflow: hidden;">
                <tr>
                    <td align="center" valign="top" style="padding: 0px 10px 0px 10px;">
                    <div class="logo">
                    <img src="assets/logo.png"  style="width:20%" />
                  
                        </div>

                        
                    </td>
                </tr>
            </table>
            <!--[if (gte mso 9)|(IE)]>
            </td>
            </tr>
            </table>
            <![endif]-->
        </td>
    </tr>
    <!-- HERO -->
    <tr>
        <td align="center" style="padding: 0px 10px 0px 10px;">
            <!--[if (gte mso 9)|(IE)]>
            <table align="center" border="0" cellspacing="0" cellpadding="0" width="600">
            <tr>
            <td align="center" valign="top" width="600">
            <![endif]-->
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                <tr>
                    <td background-color="#ffffff" align="center" valign="top" style="padding: 0 20px 15px 20px; border-radius: 4px 4px 0px 0px; color: #ffffff; font-family: 'Poppins', sans-serif; font-size: 48px; font-weight: 400; letter-spacing: 2px; line-height: 48px;">
                    </td>
                </tr>
            </table>
            <!--[if (gte mso 9)|(IE)]>
            </td>
            </tr>
            </table>
            <![endif]-->
        </td>
    </tr>
    <!-- COPY BLOCK -->
    <tr>
        <td align="center" style="padding: 0px 10px 0px 10px;">
            <!--[if (gte mso 9)|(IE)]>
            <table align="center" border="0" cellspacing="0" cellpadding="0" width="600">
            <tr>
            <td align="center" valign="top" width="600">
            <![endif]-->
            <div style="margin: 10px;max-width: 600px;border-radius: 8px;padding: 15px;background: #e7e7e7; opacity: 0.95">
                <div style="max-width: 100%; box-shadow: -2px 2px 10px black; opacity: 1">
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
              <!-- COPY -->
              <tr>
                <td bgcolor="#ffffff" align="left" style="padding: 0px 30px 20px 30px; color: #666666; font-family: 'Poppins', sans-serif; font-size: 16px; font-weight: 400; line-height: 25px;">
                  <p style="margin: 0;">
                </p>
                </td>
              </tr>
              <!-- BULLETPROOF BUTTON -->
              <tr>
                <td bgcolor="#ffffff" align="left">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td bgcolor="#ffffff" align="center" style="padding: 20px 30px 10px 30px;">
                        <table border="0" cellspacing="0" cellpadding="0">
                          <tr>
                              <td align="center" style="border-radius: 3px;" ><?php if($message != '') { ?>
                            <p class="text-justify error " style=" color: #666666; font-family: 'Poppins', sans-serif; font-size: 16px; font-weight: 400; line-height: 25px;"><?php echo $message; ?></p>
                        <?php  }?>
                              </td>
                              </tr>
                        </table>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>

                <?php if(isset($_SESSION['register_new_user'])): ?>
                <tr>
                    <td bgcolor="#ffffff" align="left">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td bgcolor="#ffffff" align="center" style="10px 29px 20px 30px">
                                    <table border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td align="center" style="border-radius: 3px;" >
                                                <form action="" method="post">
                                                <button name="resend_email" class= "btn btn-warning btn-block btn-lg margin-top-10" >Resend verification link</button>
                                                </form>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <?php else: ?>
                    <tr ><td bgcolor="#ffffff" style="padding-bottom: 60px;"></td></tr>


                <?php endif; ?>
              <!-- COPY -->
              <tr>
                <td bgcolor="#ffffff" align="left" style="padding: 0px 30px 20px 30px; color: #666666; font-family: 'Poppins', sans-serif; font-size: 16px; font-weight: 400; line-height: 25px;">
                  <p style="margin: 0;">
                      If you have any questions, just reply to this email—we're always happy to help out.

                      <br><br>
                      Cheers,<br>Viralmarketer
                  </p>
                </td>
              </tr>
              <!-- COPY -->
              <tr>
                <td bgcolor="#ffffff" align="left" style="padding: 0px 30px 40px 30px; border-radius: 0px 0px 0px 0px; color: #666666; font-family: 'Poppins', sans-serif; font-size: 14px; font-weight: 400; line-height: 25px;">
                 
                  
                  <a class= "btn btn-info btn-block margin-top-10" href="http://www.theviralmarketer.biz/" target="_blank" style="font-size: 18px; font-family: Helvetica, Arial, sans-serif; text-decoration: none; padding: 12px 50px; border-radius: 2px; border: 1px solid #57c7d4; display: inline-block; ">Click to Login</a>
                </td>
                
              </tr>
            </table>
                </div>
            </div>
            <!--[if (gte mso 9)|(IE)]>
            </td>
            </tr>
            </table>
            <![endif]-->
        </td>
    </tr>
    <!-- SUPPORT CALLOUT -->
    <!-- FOOTER -->
    <tr>
        <td align="center" style="padding: 10px 10px 50px 10px;">
            <!--[if (gte mso 9)|(IE)]>
            <table align="center" border="0" cellspacing="0" cellpadding="0" width="600">
            <tr>
            <td align="center" valign="top" width="600">
            <![endif]-->
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
    
		      <!-- COPYRIGHT -->
              <tr>
                <td align="center" style="padding: 30px 30px 5px 30px; color: #ffffff; font-family: 'Poppins', sans-serif; font-size: 12px; font-weight: 400; line-height: 18px;">
                  <p style="margin: 0; font-size: 16px;">Copyright © 2020 Theviralmarkter. All rights reserved.</p>
                </td>
              </tr>
            </table>
            <!--[if (gte mso 9)|(IE)]>
            </td>
            </tr>
            </table>
            <![endif]-->
        </td>
    </tr>
</table>

        <!-- Reference block for JS -->
        <div class="ref" id="ref">
            <div class="color-primary"></div>
            <div class="chart">
                <div class="color-primary"></div>
                <div class="color-secondary"></div>
            </div>
        </div>

        <script src="js/vendor.js"></script>
        <script src="js/app.js"></script>
        <script src="js/facebook.js"></script>
    </body>

</html>