<!-- BEGIN PAGE HEAD-->
                            <div class="page-head">
                                <div class="container">
                                    <!-- BEGIN PAGE TITLE -->
                                    <div class="page-title">
                                        <h1>Security</h1>
                                    </div>
                                    <!-- END PAGE TITLE -->
                                    
                                </div>
                            </div>
                            <!-- END PAGE HEAD-->
                            <!-- BEGIN PAGE CONTENT BODY -->
                            <div class="page-content">
                                <div class="container">
                                    
                                    <!-- BEGIN PAGE CONTENT INNER -->
                                    <div class="page-content-inner">
                                        
                                        <div class="row">
                                            <div class="col-md-6 col-sm-6">
                                                <div class="portlet light ">
                                                    <div class="portlet-title">
                                                        <div class="caption ">
                                                            <span class="caption-subject font-dark bold uppercase">Password</span>
                                                        </div>
                                                    </div>
                                                    <div class="portlet-body">
														<p>Here you can change account password.</p>
														<?php
														if(isset($_POST['btc_change_password'])) {
															$cpass = protect($_POST['cpass']);
															$npass = protect($_POST['npass']);
															$cnpass = protect($_POST['cnpass']);
															if(empty($cpass) or empty($npass) or empty($cnpass)) { echo error("All fields are required."); }
															elseif(idinfo($_SESSION['btc_uid'],"password") !== md5($cpass)) { echo error("Current password does not match."); }
															elseif(strlen($npass)<8) { echo error("New password must be more than 8 characters."); }
															elseif($npass !== $cnpass) { echo error("New password does not match with password for confirmation."); }
															else {
																$pass = md5($npass);
																$update = $db->query("UPDATE btc_users SET password='$pass' WHERE id='$_SESSION[btc_uid]'");
																echo success("Your password was changed successfully.");
															}
														}
														?>
														<form action="" method="POST">
															<div class="form-group">
																<label>Currenct password</label>
																<input type="password" class="form-control" name="cpass">
															</div>
															<div class="form-group">
																<label>New password</label>
																<input type="password" class="form-control" name="npass">
															</div>
															<div class="form-group">
																<label>Confirm new password</label>
																<input type="password" class="form-control" name="cnpass">
															</div>
															<button type="submit" class="btn btn-primary" name="btc_change_password">Change password</button>
														</form>
                                                    </div>
                                                </div>
                                            </div>
											
											<div class="col-md-6 col-sm-6">
                                                <div class="portlet light ">
                                                    <div class="portlet-title">
                                                        <div class="caption ">
                                                            <span class="caption-subject font-dark bold uppercase">Secret PIN</span>
                                                        </div>
                                                    </div>
                                                    <div class="portlet-body">
														<p>Here you can enter your second password to protect your wallet as possible.</p>
														<?php
														$hide_form=0;
														if(idinfo($_SESSION['btc_uid'],"secret_pin")) {
														if(isset($_POST['btc_change_pin'])) {
															$cpin = protect($_POST['cpin']);
															$npin = protect($_POST['npin']);
															$cnpin = protect($_POST['cnpin']);
															if(empty($cpin) or empty($npin) or empty($cnpin)) { echo error("All fields are required."); }
															elseif(idinfo($_SESSION['btc_uid'],"secret_pin") !== md5($cpin)) { echo error("Current Secret PIN does not match."); }
															elseif(strlen($npin)<6) { echo error("New Secret PIN must be more than 6 characters."); }
															elseif($npin !== $cnpin) { echo error("New Secret PIN does not match with Secret PIN for confirmation."); }
															else {
																$pin = md5($cpin);
																$update = $db->query("UPDATE btc_users SET secret_pin='$pin' WHERE id='$_SESSION[btc_uid]'");
																echo success("Your Secret PIN was changed successfully.");
															}
														}
														if(isset($_POST['btc_remove_pin'])) {
															$cpin = protect($_POST['cpin']);
															if(empty($cpin)) { echo error("Please enter your currenct Secret PIN."); }
															elseif(idinfo($_SESSION['btc_uid'],"secret_pin") !== md5($cpin)) { echo error("Current Secret PIN does not match."); }
															else {
																$update = $db->query("UPDATE btc_users SET secret_pin='' WHERE id='$_SESSION[btc_uid]'");
																echo success("Your Secret PIN was removed.");
																$hide_form=1;
															}
														}
														if($hide_form !== "1") {
														?>
														<form action="" method="POST">
															<div class="form-group">
																<label>Currenct Secret PIN</label>
																<input type="password" class="form-control" name="cpin">
															</div>
															<div class="form-group">
																<label>New Secret PIN</label>
																<input type="password" class="form-control" name="npin">
															</div>
															<div class="form-group">
																<label>Confirm new Secret PIN</label>
																<input type="password" class="form-control" name="cnpin">
															</div>
															<button type="submit" class="btn btn-primary" name="btc_change_pin">Change PIN</button> 
															<button type="submit" class="btn btn-danger" name="btc_remove_pin">Remove PIN</button>
														</form>
														<?php
														}
														} else { 
														if(isset($_POST['btn_setup_secret_pin'])) {
															$secret_pin = protect($_POST['secret_pin']);
															if(empty($secret_pin)) { echo error("Please enter your Secret PIN."); }
															elseif(strlen($secret_pin)<6) { echo error("Your Secret PIN must be more than 6 characters."); }
															else {
																$pin = md5($secret_pin);
																$update = $db->query("UPDATE btc_users SET secret_pin='$pin' WHERE id='$_SESSION[btc_uid]'");
																echo success("You setup Secret PIN successfully.");
																$hide_form=1;
															}
														}
														if($hide_form !== "1") {
														?>
														<form action="" method="POST">
															<div class="form-group">
																<label>Setup Secret PIN</label>
																<input type="password" class="form-control" name="secret_pin">
															</div>
															<button type="submit" class="btn btn-primary" name="btn_setup_secret_pin">Setup PIN</button>
														</form>
														<?php
														}
														}
														?>
                                                    </div>
                                                </div>
                                            </div>
											
                                        </div>
                                    </div>
								</div>
							</div>
							
							<div id="btc_modals"></div>