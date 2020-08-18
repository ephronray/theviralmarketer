<?php  
include_once '_libs/dbConnect.php';
$newsifyObj = new  dbConnect();

if(!isset($_GET['recoveryEmailofUser']))
{
    $newsifyObj->redirectMe('error404.php');
    ?>
<?php
}

$errMsg = '';
if(isset($_POST['recover_password'])) {
$email = $_GET['recoveryEmailofUser'];
if($email !='')
{
$data = array(
    'email' => $email,
    'password' => $_POST['new_password'],
    'conform_password' => $_POST['conform_password']
    );    
}
$response = $newsifyObj->generateNewPassword($data);
if($response['success'] == true)
{
   $newsifyObj->redirectMe('http://www.theviralmarketer.biz/login.php?recover_password=recovered_password');
}
else
{
 $errMsg =   $response['message'];
}

    
}

?>

<!doctype html>
<html class="no-js" lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>The Viral Marketer| Recovery Password </title>
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
                            </div><?=(isset($_GET['ref']))?'CONNECT WITH US': 'Recover Password'?>  </h1>
                    </header>
                    <div class="auth-content">
                        <?php if($errMsg != '') { ?>
                            <p class="text-xs-center error "><b><?php echo $errMsg; ?></b></p>
                        <?php  }?>
                        <p class="text-xs-center">Enter New Password</p>
                        <form id="login-form" action="" method="POST" novalidate="">
                            <div class="form-group"> <label for="new_password">New Password</label> <input type="password" class="form-control underlined" name="new_password" id="new_password" placeholder="Enter New Password" required> </div>
                            <div class="form-group"> <label for="conform_password">Re-type New Password</label> <input type="password" class="form-control underlined" name="conform_password" id="conform_password" placeholder="Re-type password" required> </div>
                            <div class="form-group"> 
                                <button type="submit" name="recover_password" class="btn btn-block btn-primary">Submit</button> 
                                    </div>
                        </form>
                        
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