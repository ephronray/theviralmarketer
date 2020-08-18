<!DOCTYPE html>
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>Forgot Password? - <?php echo $settings['name']; ?></title>
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
                        <h1>Forgot Password?</h1>
                        <p>Use your email address to recover your password. Enter it in form below and will receive email with link to change your password.</p>
                        <form action="" class="login-form" method="post">
							<?php
							if(isset($_POST['btc_reset'])) {
								$email = protect($_POST['email']);
								$check = $db->query("SELECT * FROM btc_users WHERE email='$email'");
								if(empty($email)) { echo error("Please enter your email address."); }
								elseif($check->num_rows==0) { echo error("No such user with this email address."); }
								else {
									$row = $check->fetch_assoc();
									$hash = randomHash(20);
									$update = $db->query("UPDATE btc_users SET email_hash='$hash' WHERE id='$row[id]'");
									$msubject = '['.$settings[name].'] Reset password request';
									$mreceiver = $email;
									$message = 'Hello, '.$row[username].'
									
You use form to reset password in our website. To change it click on link below.
'.$settings[url].'password/change/'.$row[email_hash].'

If this email was not requested by you, please ignore it.
								
If you have some problems please feel free to contact with us on '.$settings[supportemail];
									$headers = 'From: '.$settings[infoemail].'' . "\r\n" .
												'Reply-To: '.$settings[infoemail].'' . "\r\n" .
												'X-Mailer: PHP/' . phpversion();
									$mail = mail($mreceiver, $msubject, $message, $headers);
									if($mail) {
										echo success("Link for password change was sent. Check your inbox or spam folder.");
									} else {
										echo error("Error email sent. Please contact with website admin <b>$settings[supportemail]</b>.");
									}
								}
							}
							?>
                            <div class="row">
                                <div class="col-xs-12">
                                    <input class="form-control form-control-solid placeholder-no-fix form-group" type="text" placeholder="Email address" name="email" required/> </div>
                               </div>
                            <div class="row">
                                <div class="col-sm-4">
                                   
                                </div>
                                <div class="col-sm-8 text-right">
                                    <button class="btn blue" name="btc_reset" type="submit">Reset</button>
                                </div>
								<div class="col-sm-12">
									Already have an account? <a href="<?php echo $settings['url']; ?>">Login from here</a>.<br/>
									Still you do not have an account? <a href="<?php echo $settings['url']; ?>register">Create new</a> here, it's free!
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
                                    <p>Copyright &copy; BitcoinWallet PHP Script v1.0</p>
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