<!-- BEGIN PAGE HEAD-->
                            <div class="page-head">
                                <div class="container">
                                    <!-- BEGIN PAGE TITLE -->
                                    <div class="page-title">
                                        <h1>Frequently asked questions</h1>
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
                                                            <span class="caption-subject font-dark bold uppercase">Frequently asked questions</span>
                                                        </div>
                                                    </div>
                                                    <div class="portlet-body">
														<div class="row">
														<?php
														$query = $db->query("SELECT * FROM btc_faq ORDER BY id");
														if($query->num_rows>0) {
															while($row = $query->fetch_assoc()) {
																?>
																<div class="col-md-12">
																	<h4>Q? <?php echo $row['question']; ?></h4>
																	<h5>A: <?php echo $row['answer']; ?></h5>
																</div>
																<?php
															}
														} else {
															echo info("No data for display.");
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