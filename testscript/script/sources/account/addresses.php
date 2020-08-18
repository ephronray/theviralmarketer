<!-- BEGIN PAGE HEAD-->
                            <div class="page-head">
                                <div class="container">
                                    <!-- BEGIN PAGE TITLE -->
                                    <div class="page-title">
                                        <h1>Addresses</h1>
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
																	$query = $db->query("SELECT * FROM btc_users_addresses WHERE uid='$_SESSION[btc_uid]' ORDER BY id");
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
																				<?php if($row['archived'] == "1") { ?>
																				<a class="btn btn-circle btn-sm btn-icon btn-default" href="javascript:void(0);" onclick="btc_unarchive_address('<?php echo $row['id']; ?>');">
																					<i class="fa fa-archive"></i> Unarchive
																				</a>
																				<?php } else { ?>
																				<a class="btn btn-circle btn-sm btn-icon btn-default" href="javascript:void(0);" onclick="btc_archive_address('<?php echo $row['id']; ?>');">
																					<i class="fa fa-archive"></i> Archive
																				</a>
																				<?php } ?>
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
											
                                        </div>
                                    </div>
								</div>
							</div>
							
							<div id="btc_modals"></div>