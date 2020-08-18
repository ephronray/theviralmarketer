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
                    'transaction_password' => 'Transaction Password',
                    'transaction_retype_password' => 'Transaction Conform Password'
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
				 $errors['password'] =  "Passwords MissMatch!!";
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
            $status = ($result) ?  'success': 'error';
        }
    }

?>

<!doctype html>
<html class="no-js" lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>REFERRAL SIGNUP | THE VIRAL MARKETER </title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <!-- Place favicon.ico in the root directory -->
        <link rel="stylesheet" href="css/vendor.css">
        <!-- Theme initialization -->
			<link rel="stylesheet" href="css/app-green.css">
     
    </head>

    <body>
        <div class="auth">
            <div class="auth-container">
                <div class="card">
                    <header class="auth-header">
                        <h1 class="auth-title">
                            <div class="logo"> <span class="l l1"></span> <span class="l l2"></span> <span class="l l3"></span> <span class="l l4"></span> <span class="l l5"></span> </div> THE VIRAL MARKETER | CREATE ACCOUNT </h1>
                    </header>
                    <div class="auth-content">
                        <?php if($status == 'success') { ?>
                            <p class="text-xs-center"style="color: #05ae05;">Your Account Has Been Created Successfully.</p>
                       <?php  }?>
                        <p class="text-xs-center">SIGNUP TO GET INSTANT ACCESS</p>
                        <form id="signup-form" action="" method="POST" >
							 <div class="form-group"> <label for="ibm">Referral's IBM</label>
                                <div class="row">
                                    <div class="col-sm-12"> 
									<input type="text" class="form-control underlined" name="ibm" id="ibm" value="<?php echo $_GET['ref']; ?>" readonly >
                                    <?php if(isset($errors['ibm']))  echo $errors['ibm']; ?>
                                    </div>
                                </div>
                            </div>
							
                            <div class="form-group"> <label for="firstname">Name</label>
                                <div class="row">
                                    <div class="col-sm-6"> <input type="text" class="form-control underlined" name="firstname" id="firstname" placeholder="Enter firstname" >
                                    <?php if(isset($errors['firstname']))  echo $errors['firstname']; ?>
                                    </div>
                                    <div class="col-sm-6"> <input type="text" class="form-control underlined" name="lastname" id="lastname" placeholder="Enter lastname" required="">
                                        <?php if(isset($errors['lastname']))  echo $errors['lastname']; ?>

                                    </div>
                                </div>
                            </div>
                            <div class="form-group"> <label for="email">Email</label> <input type="email" class="form-control underlined" name="email" id="email" placeholder="Enter email address" required="">
                                <?php if(isset($errors['email']))  echo $errors['email']; ?>

                            </div>
                            <div class="form-group"> <label for="password">Password</label>
                                <div class="row">
                                    <div class="col-sm-6"> <input type="password" class="form-control underlined" name="password" id="password" placeholder="Enter password" required="">
                                        <?php if(isset($errors['password']))  echo $errors['password']; ?>

                                    </div>
                                    <div class="col-sm-6"> <input type="password" class="form-control underlined" name="retype_password" id="retype_password" placeholder="Re-type password" required="">
                                        <?php if(isset($errors['retype_password']))  echo $errors['retype_password']; ?>

                                    </div>
                                </div>
                            </div>
                            
                              <div class="form-group"> <label for="password">Transaction Password</label>
                                <div class="row">
                                    <div class="col-sm-6"> <input type="password" class="form-control underlined" name="transaction_password" id="transaction_password" pattern=".{8,8}" required title="Must Be 8 characters" placeholder="Enter Transaction Password" >
                                        <?php if(isset($errors['password']))  echo $errors['password']; ?>

                                    </div>
                                    <div class="col-sm-6"> <input type="password" class="form-control underlined" name="transaction_retype_password" pattern=".{8,8}" required title="Must Be 8 characters" id="transaction_retype_password" placeholder="Re-type Transaction Password" >
                                        <?php if(isset($errors['retype_password']))  echo $errors['retype_password']; ?>

                                    </div>
                                </div>
                            </div>
                             <div class="form-group">
                                <div class="g-recaptcha" data-sitekey="6LfismAUAAAAALF21o0VZ1uYXty4Bljvg3bbA5k7"></div>
                            </div>
                          
                            
                            <div class="form-group">
                                <button type="submit" name="newAccount" class="btn btn-block btn-primary">Sign Up</button>
                            </div>
                            <div class="form-group">
                                <p class="text-muted text-xs-center">Already have an account? <a href="login.php">Login!</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

   
        <script src="js/vendor.js"></script>
        <script src="js/app.js"></script>
        <script src='https://www.google.com/recaptcha/api.js'></script>
    </body>

</html>