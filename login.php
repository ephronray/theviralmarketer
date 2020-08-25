<?php
//recover password conformation
$recover_password = "" ; 
if(isset($_GET['recover_password']))
{
    $recover_password = $_GET['recover_password'];
}
include_once '_libs/dbConnect.php';
if(isset($_SESSION["register_new_user"]))
{
unset($_SESSION["register_new_user"]);    
}

$newsifyObj = new  dbConnect();

$newsifyObj->loggedINStatus();
$errMsg = '';
if(isset($_POST['logIn'])) {
    $errors = [];
    $map    = array(
        'email'=>'E-Mail',
        'password'=>'Password',
    );
    $post = $_POST;
    if(count($post) > 0) {
        foreach($map as $key => $value) {
			$post[$key] = $newsifyObj->cleanPOST($value);
            if(empty($post[$key])) {
                $errors[$key] =  $map[$key] . " is required!";
                break;
            }
        }
    }
    // if no errors were found,
    
    
    
    if( empty ($errors)) {
           
         $result =  $newsifyObj->loginUser($_POST);
     if($result['success']== true)
     {
         $newsifyObj->redirectMe('index.php');
     }
     else
     {
         $errMsg = 'There Is Something Went Wrong To Login.<br>Wrong Email/Password OR Email Is Not Verified Yet!';
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
                    <header class="auth-header">
                        <?php if($recover_password != '')
                        { ?>
						<div class="alert alert-success" style="text-align:center"> Your Password has been changed. </div>
                        <?php }  ?>
                      
                            
                    </header>
                    <div class="auth-content">
                        <?php if($errMsg != '') { ?>
						<div class="alert alert-danger" style="text-align: center;">
						<?php echo $errMsg; ?>
 </div>

                        <?php  }?>
                     <?php if(!isset($_GET['ref'])): ?>
                <div class="login-box-body">
                <p class="login-box-msg">LOGIN TO CONTINUE</p>

                 <form method="POST" class="form-element" novalidate="" action="">
                <div class="form-group has-feedback">
                <input type="email" class="form-control" id="username" name="email" placeholder="Email">
                <span class="ion ion-email form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                <input type="password" class="form-control" id= "password" name="password" placeholder="Password">
                <span class="ion ion-locked form-control-feedback"></span>
                </div>
              
        <!-- /.col -->
        <div class="col-12">
         <div class="fog-pwd">
          	<a href="forget-password.php"><i class="ion ion-locked"></i> Forgot pwd?</a><br>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-12 text-center">
          <button type="submit" name ="logIn" class="btn btn-info btn-block margin-top-10">SIGN IN</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
    <!-- /.social-auth-links -->
  
  </div>
                            <?php else: ?>
                            <span id="response_mesg"></span>
                            <div class="form-group" style="margin-top: 64px;" id="loginRef"> 
                                <button type="button" id="letmein" name="mylogIn" class="btn btn-block btn-primary">Let Me In</button> 
                            </div>
                        <?php endif; ?>
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