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

//$newsifyObj->loggedINStatus();
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




<!DOCTYPE html>
<html>

    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <head>
        <meta charset="utf-8">
        <title>The Viral Markter|LOGIN</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta content="" name="description" />
        <meta content="themes-lab" name="author" />
        <link rel="shortcut icon" href="assets/global/images/favicon.png">
        <link href="assets/global/css/style.css" rel="stylesheet">
        <link href="assets/global/css/ui.css" rel="stylesheet">
        <link href="assets/global/plugins/bootstrap-loading/lada.min.css" rel="stylesheet">
        <link rel="stylesheet" href="login.css">
    </head>
    <body >

    <div class="wrapper fadeInDown">
        <div id="formContent">
            <!-- Tabs Titles -->

            <!-- Icon -->
            <div class="fadeIn first" style="vertical-align: middle">
            <b><?=(isset($_GET['ref']))?'CONNECT WITH US': '<img src="assets/logo_black.png" >'?>
            </div>

            

            <!-- Login Form -->
            <div class="fadeIn first" style="margin: 20px 20px">
                <?php if($errMsg != '') { ?>
                    <div class="alert alert-danger" style="text-align: center;">
                        <?php echo $errMsg; ?>
                    </div>
                <?php  }?>
                <form role="form" method="POST" class="form-element" novalidate="" action="">
                    <div class="form-group" style="padding: 10px">
                        <label for="exampleInputEmail1">Username or Email</label>
                        <input type="email" class="form-control" name="email" id="exampleInputEmail1" placeholder="Enter email">
                    </div>
                    <div class="form-group" style="padding: 10px">
                        <label for="exampleInputPassword1">Password <a href="forget-password.php">(forgot password)</a></label>
                        <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password">
                    </div>
                    <div class="form-group" style="margin-left: 30%">
                        <button type="submit" name="logIn" class="btn btn-lg btn-primary" style="">Sign in</button>
                    </div>

                </form>
            </div>

            <!-- Link Password -->
            <div id="formFooter">
                <a class="underlineHover" target="_blank" href="login_faq.php" style="padding-right: 2px" >FAQ</a>

                <a class="underlineHover" target="_blank" href="login_terms-and-conditions.php" style="padding-right: 2px">Terms & Condition</a>

                <a class="underlineHover" target="_blank" href="login_privacy-policy.php" style="padding-right: 2px">Privacy policy</a>

                <a class="underlineHover" target="_blank" href="login_income-disclaimer.php" style="padding-right: 2px">Income Disclaimer</a>

                <a class="underlineHover" target="_blank" href="login_refund-policy.php" style="padding-right: 2px">Refund Policy</a>
            </div>

        </div>
    </div>
    <script src="assets/global/plugins/jquery/jquery-3.1.0.min.js"></script>
    <script src="assets/global/plugins/jquery/jquery-migrate-3.0.0.min.js"></script>
    <script src="assets/global/plugins/gsap/main-gsap.min.js"></script>
    <script src="assets/global/plugins/tether/js/tether.min.js"></script>
    <script src="assets/global/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/global/plugins/backstretch/backstretch.min.js"></script>
    <script src="assets/global/plugins/bootstrap-loading/lada.min.js"></script>
    <!-- <script src="assets/global/js/pages/login-v2.js"></script> -->
    </body>


</html>
