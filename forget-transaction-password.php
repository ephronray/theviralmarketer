<?php
include_once '_libs/dbConnect.php';
$objDB = new  dbConnect();
$errMsg = '';
$successMsg = '';

function randomPassword() {
    
}

echo randomPassword();

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
        $result =  $objDB->recoverTransactionPassword($email);
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
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>The Viral Marketer| Forget Password </title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <!-- Place favicon.ico in the root directory -->
        <link rel="stylesheet" href="css/vendor.css">
		  <link rel="stylesheet" href="css/app-green.css">
        <!-- Theme initialization -->
        <style>
        .error{
            color: white;
            font-size: 13px;
            padding-top: 5px;
            display: block !important;
            background-color: #FF4444;
            padding: 7px;
        }
        .success {
            color: white;
            font-size: 13px;
            padding-top: 5px;
            display: block !important;
            background-color: #85ce36;
            padding: 7px;
        }
        </style>
  
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
                            </div>
                        </h1>
                    </header>
                    <div class="auth-content">
                        <?php if($errMsg != '') { ?>
                            <p class="text-xs-center error "><b><?php echo $errMsg; ?></b></p>
                        <?php  } 
                        if($successMsg != '') { ?>
                            <p class="text-xs-center success "><b><?php echo $successMsg; ?></b></p>
                      <?php  }  ?>
                        <p class="text-xs-center">Recover Your Password</p>
                        <form id="login-form" action="" method="POST" novalidate="">
                            <div class="form-group"> 
                                <label for="email">Email</label> 
                                <input type="email" class="form-control underlined"  id="email" placeholder="Your email address" name="email">
                                
                            </div>
                            <div class="form-group"> 
                                <button type="submit" name="recover" class="btn btn-block btn-primary">Recover Password</button> 
                                <a href="login.php" class="pull-right danger">Login?</a>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>

        <script src="js/vendor.js"></script>
        <script src="js/app.js"></script>
        <script src="js/facebook.js"></script>
    </body>

</html>