<?php
include_once '_libs/dbConnect.php';
$objDB = new  dbConnect();
$errMsg = '';
$successMsg = '';
if(isset($_POST['recover'])) {
    $error = false; 
    $email = $_POST['email']; 
    unset($_POST['email']);
    if(empty($email)){

        $errMsg = 'E-mail is required!!';
        $error = true;
    
    } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){

         $errMsg = 'E-mail is not valid!!';
         $error = true;
    }

    // if no errors were found,
    if(!$error) {
        $result =  $objDB->recoverPassword($email);
        if($result['success']){
            $successMsg = $result['message'];
        }else {
            $errMsg = $result['message'];
        } 
    }
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
    <link rel="icon" href="http://crypto-admin-templates.multipurposethemes.com/images/favicon.ico">
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
    <a href="/index-2.html"><b>The Viral Marketer </b></a>
  </div>
  <div class="login-box-body pb-20">
    <p class="login-box-msg text-uppercase">Recover password</p>

    <form id="login-form" action="" method="POST" novalidate="">
      <div class="form-group has-feedback">
        <input type="email" class="form-control underlined"  id="email" placeholder="Your email address" name="email">
        <span class="ion ion-email form-control-feedback"></span>
      </div>      
      <div class="row">
        <!-- /.col -->
        <div class="col-12 text-center">
          <button type="submit" class="btn btn-info btn-block text-uppercase">Reset</button>
          <a href="login.php" class="pull-right danger">Login?</a>
        </div>
        <!-- /.col -->
      </div>
     
    </form>

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