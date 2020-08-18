<?php 
include_once 'includes/main-header.php';
require_once (__DIR__.'/_libs/dbConnect.php');
    $objDB = new  dbConnect();

$logged_in_user = $_SESSION['user']['u_id'];
 
$sql = "SELECT 
		  * 
		  FROM  `members` 
		  WHERE  `u_id` =  '$logged_in_user' Limit 1";
$query   = $newsifyObj->db_select($sql);
$objDB   = $newsifyObj;
$result    = mysqli_fetch_assoc($query);
$error = false;
$errMsg = '';
$successMsg = '';

$passphrase = $objDB->getpassphrase($result['wallet_email'] );


if(isset($_POST['update-profile'])) {
if(empty($_POST['first_name'])){

    $errMsg = 'First name is required ';
    $error = true;

} else if(empty($_POST['last_name'])){

    $errMsg = 'Last name is required ';
    $error = true;
    
} else if( $_POST['password'] != $_POST['confirm_password'] ){

    $errMsg = 'Both password mismatch!!';
    $error = true;

} else if(empty($_POST['btc_add'])){

    $errMsg = 'Bitcoin wallet address is required ';
    $error = true;
}

if (empty($_POST['password'])) {
    $_POST['password'] = $result['user_password'];
}
    // if no errors were found,
    if(!$error) {
        $res =  $objDB->updateProfile($logged_in_user, $_POST);
        if($res['success']){
            
           $objDB->redirectMe('profile.php?update='.$res['message']);
           $successMsg = $res['message'];
        }else {
            $errMsg = $res['message'];
        } 
    }
}


$email = $_SESSION['user']['email'];
if(isset($_POST['recover_password'])) {


$data = array(
    'email' => $email,
    'old_password' => $_POST['old_password'],
    'password' => $_POST['new_password'],
    'conform_password' => $_POST['conform_password']
    );    

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
if(isset($_POST['reset_password']))
{
 
    $email = $email; 
    $result =  $objDB->recoverTransactionPassword($email);
        if($result['success']){
            
            $successMsg = $result['message'];
        }else {
            $errMsg = $result['message'];
        } 

    
}

?>
<div style="min-height: 709.5px; height: 1000px; overflow: hidden;" class="content-wrapper">
<section class="content-header">
     <h1 >Edit Profile</h1>
        <p class="title-description">Edit your personal info!!</p>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="breadcrumb-item active">Profile</li>
      </ol>
    </section>
<article class="content grid-page">
  
    <?php
               if(isset($_GET['recover_password'])) {
                echo $objDB->alertMessage('success', 'Successfully Changed Transaction Password');    
            }  ?>
             <?php if($errMsg != '') { 
                echo $objDB->alertMessage('danger', $errMsg);
             } 
            if($successMsg != '') {
                echo $objDB->alertMessage('success', $successMsg);    
            }  
            if(isset($_GET['update'])) {
                echo $objDB->alertMessage('success', 'Profile Successfully Updated');    
            }
            ?>
    <section class="section">
        <div class="row sameheight-container">
            <div class="col-xs-12 col-sm-12 col-md-6">
               
           <div class="box">
             <div class="box-header with-border">
          <h3 class="box-title">Edit Profile</h3>
          
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        
        <div class="box-body">
              <form role="form" method="POST" action="">
                        <div class="form-group"> 
                            <label for="first_name">First Name</label>
                            <input class="form-control" type="text" placeholder="First name" name="first_name" id="first_name" 
                                value="<?php echo $result['first_name'] ?>">
                        </div>
                        <div class="form-group"> 
                            <label for="last_name">Last Name</label>
                            <input class="form-control" type="text" placeholder="Last name" name="last_name" id="last_name"
                            value="<?php echo $result['last_name'] ?>">
                        </div>
                        <div class="form-group"> 
                            <label for="user_email">E-mail</label>
                            <input class="form-control" type="text" readonly
                            value="<?php echo $result['user_email'] ?>">
                        </div>
                        <div class="form-group"> 
                            <label for="btc_add">Bitcoin Wallet Address &nbsp; <i class="fa fa-info-circle"
                            title="If you delete your Bitcoin Wallet Address and do not replace it with a different one,then the current one will remain as default.Your Bitcoin Wallet Address is a long array of of numbers and letters, make sure that it displays correctly in order to send and receive payments.The Viral Marketer admin does take any responsibility for any incorrect numbers."></i></label>
                            <input class="form-control" type="text" placeholder="Bitcoin Wallet Address" name="btc_add" id="btc_add" readonly
                            value="<?php echo $result['wallet_number'] ?>">
                        </div>
                        <div class="form-group"> 
                            <label for="btc_add">Bitcoin Wallet Passphrase &nbsp; <i class="fa fa-info-circle"
                            title="If you want to sift your wallet to another website's wallet than use this Passphrase."></i></label>
                            <textarea rows="3" cols="10" class="form-control"  placeholder="Bitcoin Wallet Passphrase" name="pass" id="pass" readonly><?php echo $passphrase?> </textarea>
                        </div>
                        <div class="form-group"> 
                            <label for="password">Password</label>
                            <input class="form-control" id="password" name="password" placeholder="Password" type="password"> 
                        </div>
                        <div class="form-group"> 
                            <label for="confirm_password">Confirm password</label>
                            <input class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password" type="password"> 
                        </div>
                        <div class="form-group"> 
                            <button type="submit" name="update-profile" class="btn btn-primary pull-right">Save changes</button> 
                        </div>
                    </form>
        </div>
           </div>
           
                <!--<div class="card card-block sameheight-item" style="height: 309px;">-->
                  
                <!--</div>-->
            </div>
            <!---->
            
       <div class="col-xs-12 col-md-6 sameheight-container">
           
                      <div class="box">
             <div class="box-header with-border">
          <h3 class="box-title"></h3>
          
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        
        <div class="box-body">
            <div class="row">
                            <div class="container">
                            
                            <form method="post">
                                <div class="form-group"> 
                                <button style="display:none" type="submit" id="reset_password" name="reset_password" class="btn btn-block btn-primary">Register/Reset Transaction Password</button> 
                                    </div>
                                </form>
                                <button type="submit"  class="btn btn-block btn-primary" onclick="conformReset()">Register/Reset Transaction Password</button>
                                </div>
                                <h2 class="separator"><span>OR</span></h2>
                        </div>
                        
                        
                        <label style="width: 100%;text-align: center;">Change Transaction Password</label>
                            <label style="width: 100%;text-align: center; font-size:11px; color:red;">Trsanction Password must be of 8 characters</label>
                            <form id="login-form" action="" method="POST" novalidate="">
                            <div class="row"><div class="col-xs-11 col-md-11">
                                <div class="form-group"> <label for="old_password">Old Transaction Password</label> <input type="password" class="form-control " name="old_password" id="old_password" oninput = "checkOldPasswordLength()" placeholder="Enter Old Password"  minlength="8" maxlength="8" pattern=".{8,8}" required title="Must Be 8 characters"></div>
                            </div>
                            <div class="col-xs-1 col-md-1"><span id="old_password_check" class="fa fa-check fa_change fa-2x" style="margin-top:350%; float: right;"></span></div>
                            </div>
                            <div class="row"><div class="col-xs-11 col-md-11">
                                <div class="form-group"> <label for="new_password">New Transaction Password</label> <input type="password" class="form-control " name="new_password" id="new_password" oninput = "checkNewPasswordLength()" placeholder="Enter New Password"  minlength="8" maxlength="8"  pattern=".{8,8}" required title="Must Be 8 characters"> </div>
                            </div>
                            <div class="col-xs-1 col-md-1"><span id="new_password_check" class="fa fa-check fa_change fa-2x" style="margin-top:350%; float: right;"></span></div>
                            </div>
                            <div class="row"><div class="col-xs-11 col-md-11">
                                
                            <div class="form-group"> <label for="conform_password">Re-type New Transaction Password</label> <input type="password" class="form-control " name="conform_password" id="confirm_retype_password" oninput = "checkConfirmPasswordLength()" placeholder="Re-type password"  minlength="8" maxlength="8" pattern=".{8,8}" required title="Must Be 8 characters"> </div>
                            
                            </div>
                            <div class="col-xs-1 col-md-1"><span id="confirm_password_check" class="fa fa-check fa_change fa-2x" style="margin-top:350%; float: right;"></span></div>
                            </div>
                            
                            <div class="form-group"> 
                                <button type="submit" id="reset_submit" name="recover_password" class="btn btn-block btn-primary">Change Transaction Password</button> 
                                    </div>
                        </form>
                        
            
            
            
            </div>
            </div>
        <!--<div class="card card-block sameheight-item">-->
             
            
                            
                       
        <!--                </div>-->
        </div>
            </div>
    </section>
</article>
</div>
<?php 
     include_once 'includes/main_footer.php';
?>
<script>

    setTimeout(function(){
      $(".alert-danger").slideUp("slow");
    }, 2500);



    function checkOldPasswordLength() {
      document.getElementById("old_password_check").style.display = "none";
        if(document.getElementById("old_password").value.length > 7){ 
          document.getElementById("old_password_check").style.display = "block";
          if(document.getElementById("new_password").value.length > 7 && document.getElementById("confirm_retype_password").value.length > 7){
            document.getElementById("reset_submit").disabled = false;
          }
          return false;
        }
        else {
          document.getElementById("old_password_check").style.display = "none";
          document.getElementById("old_password_check").innerHTML = '';
          document.getElementById("reset_submit").disabled = true;
         }
   }
   
   function checkNewPasswordLength() {
      document.getElementById("new_password_check").style.display = "none";
        if(document.getElementById("new_password").value.length > 7){ 
          document.getElementById("new_password_check").style.display = "block";
          if(document.getElementById("old_password").value.length > 7 && document.getElementById("confirm_retype_password").value.length > 7){
            document.getElementById("reset_submit").disabled = false;
          }
          return false;
        }
        else {
          document.getElementById("new_password_check").style.display = "none";
          document.getElementById("reset_submit").disabled = true;
         }
   }

   function checkConfirmPasswordLength() {
      document.getElementById("confirm_password_check").style.display = "none";
        if(document.getElementById("confirm_retype_password").value.length > 7){ 
          document.getElementById("confirm_password_check").style.display = "block";
          if(document.getElementById("old_password").value.length > 7 && document.getElementById("new_password").value.length > 7){
            document.getElementById("reset_submit").disabled = false;
          }
          return false;
        }
        else {
          document.getElementById("confirm_password_check").style.display = "none";
          document.getElementById("reset_submit").disabled = true;
          
         }
   }

$(document).ready(function(){
    $("#old_password_check").hide();
    $("#new_password_check").hide();
    $("#confirm_password_check").hide();
    $("#reset_submit").attr("disabled", true);
})
    function conformReset() {
        
    if(confirm("Are you sure you want to reset your transaction password ?")){
            $('#reset_password').trigger('click');
    }
    else{
        return false;
    }
}

</script>