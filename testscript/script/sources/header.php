<!DOCTYPE html>

<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>
		<?php
		$b = protect($_GET['b']);
		if($b == "wallet") { echo 'Wallet - '; }
		elseif($b == "addresses") { echo 'Addresses - '; } 
		elseif($b == "transactions") { echo 'Transactions - '; } 
		elseif($b == "security") { echo 'Security - '; }
		else { }
		?> <?php echo $settings['name']; ?>
		</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="<?php echo $settings['url']; ?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $settings['url']; ?>assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $settings['url']; ?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $settings['url']; ?>assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="<?php echo $settings['url']; ?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $settings['url']; ?>assets/global/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $settings['url']; ?>assets/global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $settings['url']; ?>assets/global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="<?php echo $settings['url']; ?>assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="<?php echo $settings['url']; ?>assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="<?php echo $settings['url']; ?>assets/layouts/layout3/css/layout.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $settings['url']; ?>assets/layouts/layout3/css/themes/default.min.css" rel="stylesheet" type="text/css" id="style_color" />
        <link href="<?php echo $settings['url']; ?>assets/layouts/layout3/css/custom.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME LAYOUT STYLES -->
		 <script src="<?php echo $settings['url']; ?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="<?php echo $settings['url']; ?>assets/js/bootstrap.min.js" type="text/javascript"></script>
		<script type="text/javascript" src="<?php echo $settings['url']; ?>assets/js/bootstrap-notify.min.js"></script>
        <script src="<?php echo $settings['url']; ?>assets/js/functions.js" type="text/javascript"></script>
        <link rel="shortcut icon" href="favicon.ico" /> </head>
    <!-- END HEAD -->

    <body class="page-container-bg-solid">
        <div class="page-wrapper">
            <div class="page-wrapper-row">
                <div class="page-wrapper-top">
                    <!-- BEGIN HEADER -->
                    <div class="page-header">
                        <!-- BEGIN HEADER TOP -->
                        <div class="page-header-top">
                            <div class="container">
                                <!-- BEGIN LOGO -->
                                <div class="page-logo">
                                    <a href="<?php echo $settings['url']; ?>">
                                        <img src="<?php echo $settings['url']; ?>assets/layouts/layout3/img/logo-default.jpg" alt="logo" class="logo-default">
                                    </a>
                                </div>
                                <!-- END LOGO -->
                                <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                                <a href="javascript:;" class="menu-toggler"></a>
                                <!-- END RESPONSIVE MENU TOGGLER -->
                                <div class="top-menu">
                                    <ul class="nav navbar-nav pull-right">
                                        <!-- BEGIN USER LOGIN DROPDOWN -->
                                        <li class="dropdown dropdown-user dropdown-dark">
                                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
												<i class="fa fa-user"></i> 
                                                <span class="username username-hide-mobile"><?php echo idinfo($_SESSION['btc_uid'],"username"); ?></span>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-default">
                                                <li>
                                                    <a href="<?php echo $settings['url']."account/security"; ?>">
                                                        <i class="icon-lock"></i> Security </a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo $settings['url']; ?>logout">
                                                        <i class="icon-key"></i> Logout</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <!-- END USER LOGIN DROPDOWN -->
                                        
                                    </ul>
                                </div>
                                <!-- END TOP NAVIGATION MENU -->
                            </div>
                        </div>
                        <!-- END HEADER TOP -->
                        <!-- BEGIN HEADER MENU -->
                        <div class="page-header-menu">
                            <div class="container">
                                <!-- BEGIN HEADER SEARCH BOX -->
                                <form class="search-form" action="<?php echo $settings['url']; ?>account/transactions" method="POST">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search transactions..." name="qry">
                                        <span class="input-group-btn">
                                            <a href="javascript:;" class="btn submit">
                                                <i class="icon-magnifier"></i>
                                            </a>
                                        </span>
                                    </div>
                                </form>
                                <!-- END HEADER SEARCH BOX -->
                                <!-- BEGIN MEGA MENU -->
                                <!-- DOC: Apply "hor-menu-light" class after the "hor-menu" class below to have a horizontal menu with white background -->
                                <!-- DOC: Remove data-hover="dropdown" and data-close-others="true" attributes below to disable the dropdown opening on mouse hover -->
                                <div class="hor-menu  ">
                                    <ul class="nav navbar-nav">
                                        <li class="menu-dropdown <?php if($b == "wallet") { ?>active<?php } ?>">
                                            <a href="<?php echo $settings['url']; ?>account/wallet"> Wallet</a>
                                        </li>
                                        <li class="menu-dropdown <?php if($b == "addresses") { ?>active<?php } ?>">
                                            <a href="<?php echo $settings['url']; ?>account/addresses"> Addresses</a>
                                        </li>
                                        <li class="menu-dropdown <?php if($b == "transactions") { ?>active<?php } ?>">
                                            <a href="<?php echo $settings['url']; ?>account/transactions"> Transactions</a>
                                        </li>
                                        <li class="menu-dropdown <?php if($b == "security") { ?>active<?php } ?>">
                                            <a href="<?php echo $settings['url']; ?>account/security"> Security</a>
                                        </li>
										<li class="menu-dropdown">
                                            <a href="<?php echo $settings['url']; ?>faq"> FAQ</a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- END MEGA MENU -->
                            </div>
                        </div>
                        <!-- END HEADER MENU -->
                    </div>
                    <!-- END HEADER -->
                </div>
            </div>
            <div class="page-wrapper-row full-height">
                <div class="page-wrapper-middle">
                    <!-- BEGIN CONTAINER -->
                    <div class="page-container">
                        <!-- BEGIN CONTENT -->
                        <div class="page-content-wrapper">
                            <!-- BEGIN CONTENT BODY -->