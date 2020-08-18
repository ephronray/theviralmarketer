<!DOCTYPE html>
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>Create account - <?php echo $settings['name']; ?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="<?php echo $settings['description']; ?>" name="description" />
		<meta content="<?php echo $settings['keywords']; ?>" name="keywords" />
        <meta content="me4onkof" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="<?php echo $settings['url']; ?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $settings['url']; ?>assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $settings['url']; ?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $settings['url']; ?>assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="<?php echo $settings['url']; ?>assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $settings['url']; ?>assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="<?php echo $settings['url']; ?>assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="<?php echo $settings['url']; ?>assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        <link href="<?php echo $settings['url']; ?>assets/pages/css/login-5.min.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="favicon.ico" /> </head>
    <!-- END HEAD -->

    <body class=" login">
        <!-- BEGIN : LOGIN PAGE 5-2 -->
        <div class="user-login-5">
            <div class="row bs-reset">
                <div class="col-md-6 login-container bs-reset">
                    <img class="login-logo login-6" src="<?php echo $settings['url']; ?>assets/login/login-invert.png" />
                    <div class="login-content">
                        <h1>Create account</h1>
                        <form action="" class="login-form" method="post">
							<?php
							if(isset($_POST['btc_register'])) {
								$username = protect($_POST['username']);
								$email = protect($_POST['email']);
								$password = protect($_POST['password']);
								$cpassword = protect($_POST['cpassword']);
								$check_u = $db->query("SELECT * FROM btc_users WHERE username='$username'");
								$check_e = $db->query("SELECT * FROM btc_users WHERE email='$email'");
								if(empty($username) or empty($email) or empty($password) or empty($cpassword)) { echo error("All fields are required."); }
								elseif(!isValidUsername($username)) { echo error("Please enter valid username."); }
								elseif(!isValidEmail($email)) { echo error("Please enter valid email address."); }
								elseif($check_u->num_rows>0) { echo error("This username is already used. Please choose another."); }
								elseif($check_e->num_rows>0) { echo error("This email address is already used. Please choose another."); }
								elseif(strlen($password)<8) { echo error("Password must be more than 8 characters."); }
								elseif($password !== $cpassword) { echo error("Passwords does not match."); }
								else {
									$email_hash = md5($email);
									$password_hash = md5($password);
									$time_signup = time();
									$ip = $_SERVER['REMTOE_ADDR'];
									$insert = $db->query("INSERT btc_users (username,email,password,status,email_hash,time_signup,ip) VALUES ('$username','$email','$password_hash','1','$email_hash','$time_signup','$ip')");
									btc_generate_address($username,"default");
									echo success("Your account was created.");
									echo '<meta http-equiv="refresh" content="3;url='.$settings[url].'">';
								}
							}
							?>
                            <div class="row">
                                <div class="col-xs-6">
                                    <input class="form-control form-control-solid placeholder-no-fix form-group" type="text" placeholder="Username" name="username" required/> </div>
								<div class="col-xs-6">
                                    <input class="form-control form-control-solid placeholder-no-fix form-group" type="text" placeholder="Email address" name="email" required/> </div>
                                <div class="col-xs-6">
                                    <input class="form-control form-control-solid placeholder-no-fix form-group" type="password" placeholder="Password" name="password" required/> </div>
								<div class="col-xs-6">
                                    <input class="form-control form-control-solid placeholder-no-fix form-group" type="password" placeholder="Confirm password" name="cpassword" required/> </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    
                                </div>
                                <div class="col-sm-8 text-right">
                                    <div class="forgot-password">
                                        <a href="<?php echo $settings['url']; ?>forgot-password" class="forget-password">Forgot Password?</a>
                                    </div>
                                    <button class="btn blue" name="btc_register" type="submit">Create account</button>
                                </div>
								<div class="col-sm-12">
									Already have an account? <a href="<?php echo $settings['url']; ?>">Login from here</a>.
								</div>
                            </div>
                        </form>
                    </div>
                    <div class="login-footer">
                        <div class="row bs-reset">
                            <div class="col-xs-5 bs-reset">
                                <ul class="login-social">
                                    <li>
                                        <a href="<?php echo $settings['fb_link']; ?>" target="_blank">
                                            <i class="icon-social-facebook"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo $settings['tw_link']; ?>" target="_blank">
                                            <i class="icon-social-twitter"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-xs-7 bs-reset">
                                <div class="login-copyright text-right">
                                    <p>Copyright &copy; <a href="http://me4onkof.info">BitcoinWallet PHP Script v1.0</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 bs-reset">
                    <div class="login-bg" style="position: relative; z-index: 0; background: none;"> 
						
							</div>
                </div>
            </div>
        </div>
        <!-- END : LOGIN PAGE 5-2 -->

        <script src="<?php echo $settings['url']; ?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="<?php echo $settings['url']; ?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?php echo $settings['url']; ?>assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="<?php echo $settings['url']; ?>assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="<?php echo $settings['url']; ?>assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="<?php echo $settings['url']; ?>assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="<?php echo $settings['url']; ?>assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
        <script src="<?php echo $settings['url']; ?>assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
        <script src="<?php echo $settings['url']; ?>assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
        <script src="<?php echo $settings['url']; ?>assets/global/plugins/backstretch/jquery.backstretch.min.js" type="text/javascript"></script>
        <script src="<?php echo $settings['url']; ?>assets/js/login-5.min.js" type="text/javascript"></script>
    </body>

</html>