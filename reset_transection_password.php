<?php  
include_once '_libs/dbConnect.php';
$newsifyObj = new  dbConnect();


 $email = $_SESSION['user']['email'];
 if($email = '' || $email = null)
 {
    $newsifyObj->redirectMe('http://www.theviralmarketer.biz/login.php'); 
 }
$errMsg = '';
if(isset($_POST['recover_password'])) {

if($email !='')
{
$data = array(
    'email' => $email,
    'old_password' => $_POST['old_password'],
    'password' => $_POST['new_password'],
    'conform_password' => $_POST['conform_password']
    );    
}
$response = $newsifyObj->generateNewTransectionPassword($data);
if($response['success'] == true)
{
 $newsifyObj->redirectMe('http://www.theviralmarketer.biz/profile.php?recover_password=recovered_password');
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
                            </div><?=(isset($_GET['ref']))?'CONNECT WITH US': 'Reset Transaction Password'?>  </h1>
                    </header>
                    <div class="auth-content">
                        <?php if($errMsg != '') { ?>
                            <p class="text-xs-center error "><b><?php echo $errMsg; ?></b></p>
                        <?php  }?>
                        <p class="text-xs-center">Enter New transaction Password</p>
                        <form id="login-form" action="" method="POST" novalidate="">
                            <div class="row"><div class="col-xs-11 col-md-11">
                                
                              <div class="form-group"> <label for="old_password">Old Password</label> <input type="password" class="form-control underlined" name="old_password" id="old_password" placeholder="Enter Old Password" required maxlength="8"></div>
                          
                            </div>
                            <div class="col-xs-1 col-md-1"><span id="old_password_check"></span></div>
                            </div>
                            <div class="row"><div class="col-xs-11 col-md-11">
                                
                            <div class="form-group"> <label for="new_password">New Password</label> <input type="password" class="form-control underlined" name="new_password" id="new_password" placeholder="Enter New Password" required maxlength="8"> </div>
                            
                            </div>
                            <div class="col-xs-1 col-md-1"><span id="new_password_check"></span></div>
                            </div>
                            <div class="row"><div class="col-xs-11 col-md-11">
                                
                            <div class="form-group"> <label for="conform_password">Re-type New Password</label> <input type="password" class="form-control underlined" name="conform_password" id="conform_password" placeholder="Re-type password" required maxlength="8"> </div>
                            
                            </div>
                            <div class="col-xs-1 col-md-1"><span id="conform_password_check"></span></div>
                            </div>
                            
                            <div class="form-group"> 
                                <button type="submit" id="reset_submit" name="recover_password" class="btn btn-block btn-primary">Submit</button> 
                                    </div>
                        </form>
                        <a href="forget-transaction-password.php" class="pull-right danger">Forget Transection password?</a>
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
        <script>
      var old_password =    $("#old_password").val();
        var new_password = $("#new_password").val();
        var conform_password = $("#conform_password").val();
        $("#old_password").keypress(function() {
    if($(this).val().length >= 7) {
        $("#old_password_check").html('<i style="margin-top: 29px;" class="fa fa-check fa_change fa-2x "></i>');
        
       
    } else {
        $("#old_password_check").html('');
        $("#reset_submit").attr("disabled", true);
         // Disable submit button
    }
});
$("#new_password").keypress(function() {
    if($(this).val().length >= 7) {
        $("#new_password_check").html('<i style="margin-top: 29px;" class="fa fa-check fa_change fa-2x "></i>');
        
       // alert("ok");
         // Enable submit button
    } else {
        $("#reset_submit").attr("disabled", true);
         // Disable submit button
    }
});
$("#conform_password").keypress(function() {
    if($(this).val().length >= 7) {
        $("#conform_password_check").html('<i style="margin-top: 29px;" class="fa fa-check fa_change fa-2x "></i>');
        $("#reset_submit").attr("disabled", false);
       // alert("ok");
         // Enable submit button
    } else {
        $("#reset_submit").attr("disabled", true);
         // Disable submit button
    }
});
$(document).ready(function(){
    $("#reset_submit").attr("disabled", true);
})
            
        </script>
    </body>

</html>