<!-- BEGIN PAGE HEAD-->
                            <div class="page-head">
                                <div class="container">
                                    <!-- BEGIN PAGE TITLE -->
                                    <div class="page-title">
                                        <h1>Wallet</h1>
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
                                        <div class="row widget-row">
                                            <div class="col-md-4">
                                                <!-- BEGIN WIDGET THUMB -->
                                                <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 ">
                                                    <h4 class="widget-thumb-heading">Current Balance</h4>
                                                    <div class="widget-thumb-wrap">
                                                        <i class="widget-thumb-icon bg-green fa fa-bitcoin"></i>
                                                        <div class="widget-thumb-body">
                                                            <span class="widget-thumb-subtitle">BTC</span>
                                                            <span class="widget-thumb-body-stat" data-counter="counterup"><?php echo get_user_balance_btc($_SESSION['btc_uid']); ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- END WIDGET THUMB -->
                                            </div>
                                            <div class="col-md-4">
                                                <!-- BEGIN WIDGET THUMB -->
                                                <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 ">
                                                    <h4 class="widget-thumb-heading">Current Balance</h4>
                                                    <div class="widget-thumb-wrap">
                                                        <i class="widget-thumb-icon bg-red fa fa-dollar"></i>
                                                        <div class="widget-thumb-body">
                                                            <span class="widget-thumb-subtitle">USD</span>
                                                            <span class="widget-thumb-body-stat" data-counter="counterup"><?php echo get_user_balance_usd($_SESSION['btc_uid']); ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- END WIDGET THUMB -->
                                            </div>
                                            <div class="col-md-4">
                                                <!-- BEGIN WIDGET THUMB -->
                                                <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 ">
                                                    <h4 class="widget-thumb-heading">Pending Balance</h4>
                                                    <div class="widget-thumb-wrap">
                                                        <i class="widget-thumb-icon bg-purple fa fa-clock-o"></i>
                                                        <div class="widget-thumb-body">
                                                            <span class="widget-thumb-subtitle">BTC</span>
                                                            <span class="widget-thumb-body-stat" data-counter="counterup"><?php echo get_user_pending_balance_btc($_SESSION['btc_uid']); ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- END WIDGET THUMB -->
                                            </div>
                                            
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12">
                                                <div class="portlet light ">
                                                    <div class="portlet-title">
                                                        <div class="caption ">
                                                            <span class="caption-subject font-dark bold uppercase">Addresses</span>
                                                        </div>
                                                        <div class="actions">
															<a class="btn btn-circle btn-icon btn-default" href="javascript:void(0);" onclick="btc_new_address();">
                                                                <i class="fa fa-plus"></i> New address
                                                            </a>
															<a class="btn btn-circle btn-icon-only btn-default fullscreen" href="#"> </a>
                                                        </div>
                                                    </div>
                                                    <div class="portlet-body">
														<div class="table-scrollable">
                                                            <table class="table table-hover table-light">
                                                                <thead>
                                                                    <tr>
                                                                        <th> # </th>
                                                                        <th width="10%"> Label </th>
                                                                        <th width="35%"> Address </th>
                                                                        <th width="15%"> Balance </th>
                                                                        <th width="35%"> Action </th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="btc_addresses">
																	<?php
																	$query = $db->query("SELECT * FROM btc_users_addresses WHERE uid='$_SESSION[btc_uid]' and archived='0' ORDER BY id");
																	if($query->num_rows>0) { 
																		$i=1;
																		while($row = $query->fetch_assoc()) {
																		?>
																		<tr id="btc_address_<?php echo $row['id']; ?>">
																			<td> <?php echo $i++; ?> </td>
																			<td> <?php $expl = explode("_",$row['label']); echo $expl[2]; ?> </td>																			</td>
																			<td> <?php echo $row['address']; ?> </td>
																			<td> <?php echo $row['available_balance']; ?> BTC </td>
																			<td>
																				 <a class="btn btn-circle btn-sm btn-icon btn-default" href="javascript:void(0);" onclick="btc_send_from_address('<?php echo $row['id']; ?>');">
																					<i class="fa fa-arrow-circle-o-up"></i> Send
																				</a>
																				<a class="btn btn-circle btn-sm btn-icon btn-default" href="javascript:void(0);" onclick="btc_receive_to_address('<?php echo $row['id']; ?>');">
																					<i class="fa fa-arrow-circle-o-down"></i> Receive
																				</a> 
																				<a class="btn btn-circle btn-sm btn-icon btn-default" href="javascript:void(0);" onclick="btc_archive_address('<?php echo $row['id']; ?>');">
																					<i class="fa fa-archive"></i> Archive
																				</a>
																				<a class="btn btn-circle btn-sm btn-icon btn-default" href="<?php echo $settings['url']; ?>account/transactions_by_address/<?php echo $row['address']; ?>">
																					<i class="fa fa-bars"></i> Transactions
																				</a> 
																			</td>
																		</tr>
																		<?php
																		}
																	} else {
																		echo info("Still no have addresses."); 
																	}
																	?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
											<div class="col-md-12 col-sm-12">
                                                <div class="portlet light ">
                                                    <div class="portlet-title">
                                                        <div class="caption">
                                                            <span class="caption-subject bold uppercase font-dark">Latest transactions</span>
                                                        </div>
                                                        <div class="actions">
                                                            <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="#"> </a>
                                                        </div>
                                                    </div>
                                                    <div class="portlet-body">
                                                        <div class="timeline">
															<?php
															$query = $db->query("SELECT * FROM btc_users_transactions WHERE uid='$_SESSION[btc_uid]' ORDER BY id DESC LIMIT 5");
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
																echo info("Still no have transactions.");
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