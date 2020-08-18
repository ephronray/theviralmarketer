<?php
    include_once '_libs/dbConnect.php';
	
	if(!isset($_GET['ref']) && !filter_var($_GET['ref'], FILTER_VALIDATE_INT) ) {
		header('Location:login.php');
	}
    $newsifyObj = new  dbConnect();
    $status = '';
    if(isset($_POST['newAccount'])) {
        $errors = [];
        $map    = array(
                    'firstname'=>'First Name',
                    'ibm'=>'Referral\'s IBM',
                    'lastname'=>'Last Name',
                    'email'=>'E-Mail',
                    'password'=>'Password',
                    'retype_password'=>'Conform Password',
                    'email_valid' => 'E-mail already exists in the Database'
                   
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
			
			if($_POST['password'] != $_POST['retype_password']){
				 $errors['password'] =  "Login Passwords MissMatch!!";
			}
			$checkEmail = $newsifyObj->checkEmail($_POST['email']);
			if($checkEmail)
			{
			    $errors['email_valid'] = $map['email_valid'];
			}
		
        }
        // if no errors were found,
        if( empty ($errors)) {
			
		
			$passad_up_to = null;
			$refered_by = $_POST['ibm'];
			$get_4x4_matrix = $refered_by;
			$query = 'SELECT u_id,ibm,user_email FROM members WHERE refer_ibm = "'.$refered_by.'"';
			$referred = $newsifyObj->db_select($query, false, false);
			$total_referred = mysqli_num_rows($referred);
			if( $total_referred %2 == 0 && !$newsifyObj->isRoot($refered_by)) {
				//new data will be odd one so it will be passad up! get referred passed up...
				$passad_up_to = $newsifyObj->getPassedUp($refered_by);
			}
			
			$query_matrix = 'SELECT u_id,ibm,user_email FROM members WHERE 4_by_4 = "'.$refered_by.'"';
			$matrix = $newsifyObj->db_select($query_matrix, false, false);
			if( mysqli_num_rows($matrix) >= 4 ) 
			{
				$get_4x4_matrix = $newsifyObj->getMatrixPosition(array($refered_by));
			}
			//echo $get_4x4_matrix;
			//die;
			$_POST['passad_up_to'] = $passad_up_to;
			$_POST['my_ibm'] = $newsifyObj->getLatestIbm();
			$_POST['4_by_4'] = $get_4x4_matrix;
		
            $result = $newsifyObj->registerNewUser($_POST);
        
           // $status = ($result) ?  'success': 'error';
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
	    <link rel="icon" href="assets/icon.ico">
    <link rel="stylesheet" href= "https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.0/css/ionicons.min.css">
  <link rel="stylesheet" href= "https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
    <title>REFERRAL SIGNUP | THE VIRAL MARKETER</title>
  
	<!-- Bootstrap 4.0-->
	<link rel="stylesheet" href="assets/vendor_components/bootstrap/dist/css/bootstrap.min.css">
	
	<!-- Bootstrap extend-->
	<link rel="stylesheet" href="css/css/bootstrap-extend.css">

	<!-- Theme style -->
	<link rel="stylesheet" href="css/css/master_style.css">

	<!-- Crypto_Admin skins -->
	<link rel="stylesheet" href="css/css/skins/_all-skins.css">	
    <link rel="stylesheet" href="css/vendor.css">
        <!-- Theme initialization -->
		
     
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>
<body class="hold-transition register-page">
<div class="register-box">

  <div class="register-box-body">
       
            <div class="">
                <div class="">
                <header class="auth-header">
                        <h3 class="auth-title">
                            <div class="logo" style="text-align:center"> 
                            <img src="assets/logo.png"  style="width:25%" />  
                          </div>  </h3>

                          <p class="login-box-msg">Signup to get instant access</p>
                    </header>
              <div class="auth-content">
                        <?php //if($status == 'success') { ?>
                            <!--<p class="text-xs-center"style="color: #05ae05;">Verification email has been sent you. Please Verify your email first to gain access to your account.If the email is not showing in your Inbox, please check your Spam/Junk Folder</p>
                       --><?php  //}?>
                        
  
    <form id="signup-form" action="" method="POST" class="form-element">
        <div class="form-group has-feedback">
        <input type="text" class="form-control underlined" name="ibm" id="ibm" value="<?php echo $_GET['ref']; ?>" readonly >
        <?php if(isset($errors['ibm']))  echo $errors['ibm']; ?>
      </div>
        <div class="form-group has-feedback">
        <input type="text" class="form-control" name="firstname" id="firstname" placeholder="First name">
        <?php if(isset($errors['firstname']))  echo $errors['firstname']; ?>
        <span class="ion ion-person form-control-feedback "></span>
      </div>
      <div class="form-group has-feedback">
        <input type="text" class="form-control"  name="lastname" id="lastname" placeholder="Last name">
        <?php if(isset($errors['lastname']))  echo $errors['lastname']; ?>
        <span class="ion ion-person form-control-feedback "></span>
      </div>
      <div class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="Email" name="email" id = "email">
        <?php if(isset($errors['email']))  echo $errors['email']; ?>
                                 <?php if(isset($errors['email_valid']))  echo $errors['email_valid']; ?>

        <span class="ion ion-email form-control-feedback "></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="password" id="password" placeholder="Password">
        <?php if(isset($errors['password']))  echo $errors['password']; ?>
        <span class="ion ion-locked form-control-feedback "></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="retype_password" id="retype_password" placeholder="Retype password">
        <?php if(isset($errors['retype_password']))  echo $errors['retype_password']; ?>
        <span class="ion ion-log-in form-control-feedback "></span>
      </div>
      <div class="form-group"> 
            <div class="g-recaptcha" data-sitekey="6LfismAUAAAAALF21o0VZ1uYXty4Bljvg3bbA5k7"></div>
            </div>
        <div class="form-groupr">
          <button type="submit" name="newAccount" class="btn btn-info btn-block margin-top-10">SIGN UP</button>
       
        <!-- /.col -->
      </div>
    </form>
    
     <div class="margin-top-20 text-center">
    	<p>Already have an account?<a href="login.php" class="text-info m-l-5"> Sign In</a></p>
     </div>
    
  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->
</div>
                </div>
            </div>
        </div>

	<!-- jQuery 3 -->
	<script src="assets/vendor_components/jquery/dist/jquery.min.js"></script>
	
	<!-- popper -->
	<script src="assets/vendor_components/popper/dist/popper.min.js"></script>
	
	<!-- Bootstrap 4.0-->
	<script src="assets/vendor_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script src="js/vendor.js"></script>
    <script src="js/app.js"></script>
	
</body>
</html>