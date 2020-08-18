<?php
require_once (__DIR__.'/_libs/dbConnect.php');
$obj = new dbConnect();
$head = '';
$message = '';
if(isset($_GET['email'] , $_GET['hash']))
{
    // Verify data
    $email = $_GET['email']; // Set email variable
    $hash = $_GET['hash']; // Set hash variable
    $data = array(
        'email' => $email,
        'hash' => $hash
        );
       
$response = $obj-> unsubscribe($data);
if($response['success'] == true)
{
    $message = $response['message'];
    $head = "Unsubscribed Successfully!";
    /* $ibm = null;
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
            
            $template  = $obj->db_select("SELECT `template_content` FROM `tbl_email_templates` WHERE `id` = 16");
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
       */
}
else
{
    
    $message = $response['message'];
    $head = "You're Already Unsubscribed!";

}
    
}
else
{
    $obj->redirectMe('error404.php');
}
?>

<!doctype html>
<html class="no-js" lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>The Viral Marketer| Unsubscribe </title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <!-- Place favicon.ico in the root directory -->
        <link rel="stylesheet" href="css/vendor.css">
		  <link rel="stylesheet" href="css/app-green.css">
        <!-- Theme initialization -->
  
    </head>

    <body>
        <div class="auth">
            <div class="auth-container">
                <div class="card">
                    <header class="auth-header">
                        
                        <h1 class="auth-title">
                            <div class="logo">
                                <span class="l l1"></span> <span class="l l2"></span> <span class="l l3"></span>
                                <span class="l l4"></span> <span class="l l5"></span>
                            </div><?=(isset($_GET['ref']))?'CONNECT WITH US': $head; ?>  </h1>
                            
                    </header>
                    <div class="auth-content">
                        <?php if($message != '') { ?>
                            <p class="text-xs-center error "><b><?php echo $message; ?></b></p>
                        <?php  }?>
                        <a href="http://www.theviralmarketer.biz/" class="btn btn-block btn-primary">Click to login</a>
                    </div>
                </div>

            </div>
        </div>
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