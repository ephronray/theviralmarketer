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
       
$response = $obj->verifiyActivation($data);
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
            $obj->send_welcome_email($name , $email , $ibm);
            /* $template  = $obj->db_select("SELECT `template_content` FROM `tbl_email_templates` WHERE `id` = 18");
            while($row = $template->fetch_assoc()) 
            {
            
                $content      = str_replace('{#first_name#}', $name, $row['template_content']);
                $content       = str_replace('{#email#}', $email, $content);
                $content       = str_replace('{#ibm#}', $ibm, $content);
                $headers = 'MIME-Version: 1.0'."\r\n";
                $headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
                $headers .= "From: info@viralmarketer.biz"; 
                mail($email, 'Welcome To The Viral Marketer ', $content, $headers); 
            }  */
   
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
}
?>

<!doctype html>
<html class="no-js" lang="en">

    <head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="assets/favicon.ico">
	<link rel="stylesheet" href= "https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.0/css/ionicons.min.css">
  <link rel="stylesheet" href= "https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
    <title>The Viral Marketer| LOGIN </title>
  
	<!-- Bootstrap 4.0-->
	<link rel="stylesheet" href="assets/vendor_components/bootstrap/dist/css/bootstrap.min.css">
	
	<!-- Bootstrap extend-->
	<link rel="stylesheet" href="css/css/bootstrap-extend.css">
	
	<!-- Theme style -->
	<link rel="stylesheet" href="css/css/master_style.css">

	<!-- Crypto_Admin skins -->
	<link rel="stylesheet" href="css/css/skins/_all-skins.css">	

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b><?=(isset($_GET['ref']))?'CONNECT WITH US': '<img src="assets/logo_black.png" >'?>  </b></a>
  </div>
        <div class="auth">
            <div class="auth-container">
                <div class="card">
                         <div class="auth-content">
                <div class="login-box-body">
					<div class="col-12 text-center">  
<h1>		<?=(isset($_GET['ref']))?'CONNECT WITH US': $head; ?>  </h1>
					<div class="auth-content">
                        <?php if($message != '') { ?>
                            <p class="text-xs-center error "><b><?php echo $message; ?></b></p>
                        <?php  }?>
                        <a href="http://www.theviralmarketer.biz/" class="btn btn-block btn-primary">Click to login</a>
                    </div>
                 </div>
    <!-- /.social-auth-links -->
  
  </div>
                           
                        
                    </div>
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