<!-- BEGIN PAGE HEAD-->
                            <div class="page-head">
                                <div class="container">
                                    <!-- BEGIN PAGE TITLE -->
                                    <div class="page-title">
                                        <h1>Transactions</h1>
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
                                            
											<div class="col-md-12 col-sm-12">
                                                <div class="portlet light ">
                                                    <div class="portlet-title">
                                                        <div class="caption">
                                                            <span class="caption-subject bold uppercase font-dark">Transactions <small><?php if(isset($_GET['address'])) { echo 'by '.$_GET[address]; } if(isset($_POST['qry'])) { echo 'results for '.$_POST[qry]; }  ?></small></span>
                                                        </div>
                                                         <div class="inputs">
															<form action="<?php echo $settings['url']; ?>account/transactions" method="POST">
                                                            <div class="portlet-input input-inline input-small ">
                                                                <div class="input-icon right">
                                                                    <i class="icon-magnifier"></i>
                                                                    <input type="text" class="form-control form-control-solid input-circle" name="qry" placeholder="search..."> 
																</div>
                                                            </div>
															</form>
                                                        </div>
                                                    </div>
                                                    <div class="portlet-body">
                                                        <div class="timeline">
															<?php
															$page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
															$limit = 5;
															$startpoint = ($page * $limit) - $limit;
															if($page == 1) {
																$i = 1;
															} else {
																$i = $page * $limit;
															}
															$address = protect($_GET['address']);
															if(!empty($address)) {
																$query = $db->query("SELECT * FROM btc_users_transactions WHERE uid='$_SESSION[btc_uid]' and sender='$address' or uid='$_SESSION[btc_uid]' and recipient='$address' ORDER BY id DESC");
															} elseif(isset($_POST['qry'])) {
																$qry = protect($_POST['qry']);
																$query = $db->query("SELECT * FROM btc_users_transactions WHERE uid='$_SESSION[btc_uid]' and txid LIKE '%$qry%' or uid='$_SESSION[btc_uid]' and sender LIKE '%$qry%' or uid='$_SESSION[btc_uid]' and recipient LIKE '%$qry%' or uid='$_SESSION[btc_uid]' and amount LIKE '%$qry%' ORDER BY id DESC");
															} else {
																$statement = "btc_users_transactions WHERE uid='$_SESSION[btc_uid]'";
																$query = $db->query("SELECT * FROM {$statement} ORDER BY id DESC LIMIT {$startpoint} , {$limit}");
															}
															if($query->num_rows>0) {
																	while($row = $query->fetch_assoc()) {
																		?>
																	 <!-- TIMELINE ITEM -->
																	<div class="timeline-item">
																		<div class="timeline-badge">
																			<?php if($row['type'] == "sent") { ?>
																			<div style="margin-left:20px;margin-top:35px;font-size:16px;" class="text text-danger"><i class="fa fa-arrow-circle-o-up fa-3x"></i></div>
																			<?php } elseif($row['type'] == "received") { ?>
																			<div style="margin-left:20px;margin-top:35px;font-size:16px;" class="text text-success"><i class="fa fa-arrow-circle-o-down fa-3x"></i></div>
																			<?php } else { } ?>
																		</div>
																		<div class="timeline-body">
																			<div class="timeline-body-arrow"> </div>
																			<div class="timeline-body-head">
																				<div class="timeline-body-head-caption">
																					<a href="javascript:void(0);" class="timeline-body-title font-blue-madison"><?php if($row['type'] == "sent") { echo 'Sent'; } elseif($row['type'] == "received") { echo 'Received'; } else { } ?> <?php echo $row['amount']; ?> BTC</a>
																				</div>
																			</div>
																			<div class="timeline-body-content">
																				<span class="font-grey-cascade"> 
																					Transaction ID: <b><a href="https://chain.so/tx/BTC/<?php echo $row['txid']; ?>"><?php echo $row['txid']; ?></a></b><br/>
																					Sender: <b><?php echo $row['sender']; ?></b><br/>
																					Recipient: <b><?php echo $row['recipient']; ?></b><br/>
																					Confirmations: <b><?php echo $row['confirmations']; ?></b><br/>
																					Time: <b><?php echo date("d/m/Y H:i",$row['time']); ?></b>
																				</span>
																			</div>
																		</div>
																	</div>
																	<!-- END TIMELINE ITEM -->
																	<?php
																	}
															} else {
																if(isset($_POST['qry'])) {
																	echo info("No found results for <b>$qry</b>.");
																} else {
																	echo info("Still no have transactions");
																}
															}
															?>
														
															<?php
															$ver = $settings['url']."account/transactions";
															if(web_pagination($statement,$ver,$limit,$page)) {
																echo '<br><br><br>';
																echo web_pagination($statement,$ver,$limit,$page);
															}
															?>
														</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
								</div>
							</div>
							
							<div id="btc_modals"></div>