<?php
//include_once '_libs/dbConnect.php';
require_once (__DIR__.'/../_libs/dbConnect.php');
$newsifyObj = new  dbConnect();
if(!$newsifyObj->isLoggedIN()){
    $newsifyObj->redirectMe($newsifyObj->base_url.'/login.php');
}
$baseUrl = $newsifyObj->base_url;
$notice = '';
$objDB   = $newsifyObj;
$logged_in_user = $_SESSION['user']['u_id'];
$sql = "SELECT btc_add, ibm, is_root, wallet_number,user_email,wallet_email,wallet_xpub
		FROM  `members` 
		WHERE  `u_id` =  '$logged_in_user' Limit 1";
$query   = $objDB->db_select($sql);
$result    = mysqli_fetch_assoc($query);
$user_email = $result['user_email'];
$wallet_email = $result['wallet_email'];
$wallet_xpub = $result['wallet_xpub'];
if($result['is_root'] == 'false'){
    if(empty($result['wallet_number'])) {
        $notice = 'You do not have a bitcoin wallet address. In order to send and receive payments, <a href="https://blockchain.info/wallet/#/signup" target="_blank">
        <span style="color:white;font-weight:bold" title="https://blockchain.info/wallet/#/signup">REGISTER</span></a> for one ASAP to ensure that you receive payments.';
    } else {
        $sql = 'SELECT max(`level`) AS `level` FROM `subscribed_levels` WHERE `sender_ibm` = "'.$result['ibm'].'" ';
        $query   = $objDB->db_select($sql);
        $result    = mysqli_fetch_assoc($query);
        if ($result['level'] < 8) {
            $next_level = $result['level']+1;
            $sql = "SELECT level_name
            FROM  `system_levels` 
            WHERE  `id` =  '$next_level' Limit 1";
            $query   = $objDB->db_select($sql);
            $result    = mysqli_fetch_assoc($query);
            $notice = 'You need to upgrade to '.$result['level_name']. ' Level';
        }
    }
}
if(isset($_POST['logOutME'])) {
    $newsifyObj->logOutMe();
} ?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Member Panel </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <!-- Place favicon.ico in the root directory -->
    <link rel="stylesheet" href="../../css/vendor.css">
     <link rel="stylesheet" href="../../css/jquery-ui.css">
    <link rel="stylesheet" href="../../css/app-green.css">
	<link rel="stylesheet" href="../../css/jquery.datetimepicker.css">
	<link rel="stylesheet" href="../../css/custom-style.css">
	<link rel="stylesheet" href="../../css/corner-popup.min.css">
	<link href="../../css/dropify.min.css" type="text/css" rel="stylesheet">
	
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<link href="../../css/tagsinput.css" rel="stylesheet">

	<!--https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css-->
		<link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script type='text/javascript' src='//platform-api.sharethis.com/js/sharethis.js#property=5b44f4c932e60f0011a5d686&product=sticky-share-buttons' async='async'></script>
</head>

<body>
<div class="loader"></div>
<div class="main-wrapper">
    <div class="app" id="app">
        <header class="header">
            <div class="header-block header-block-collapse hidden-lg-up">
                <button class="collapse-btn" id="sidebar-collapse-btn">
                    <i class="fa fa-bars"></i>
                </button>
            </div>
            <div class="header-block header-block-search hidden-sm-down" style="margin-top: 15px;">  
                <?php  if($notice != '') {
                echo $objDB->alertMessage('primary', $notice);    
            }  ?>  
            </div>

            <!-- <div class="balance_check">
                <strong>
                    Balance:
                    <br/>
                    Amount:
                </strong>
                
                <span>
                    <?php 
                       
                       /* 
                       
                       $balance = $objDB->checkbalance($wallet_email);
                    	if ($balance > -1)
    		
                        {
    		            
                            echo  number_format((float)$balance[0], 5, '.', '')."  BTC";   
                        
    	                }            
                    ?>

                    <br/>
                    <span>
                        <?php  echo number_format((float)$balance[1], 2, '.', ''); if ($balance[2] === "USD"){echo " USD";} 
                        
                        
                        */ 
                        
                        ?>
                    </span>
	
                </span>
            

            </div> -->
            <div class="header-block header-block-nav">
                
                <ul class="nav-profile">
                    <li class="profile dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                           aria-haspopup="true" aria-expanded="false">
                            <div class="img"><img src="images/user.jpg"></div>
                            <span class="name">
                                
    			      <?php  if (!empty($_SESSION['user']['first_name'])){
                                echo $_SESSION['user']['first_name'];
                      }else{
    			          echo 'Welcome';
                      } ?>
                      
                      <?php  if (!empty($_SESSION['user']['last_name'])){
                                echo $_SESSION['user']['last_name'];
                      }else{
    			          echo '';
                      } ?>
    			    </span> </a>
                        <div class="dropdown-menu profile-dropdown-menu" aria-labelledby="dropdownMenu1">
                            <a class="dropdown-item" href="profile.php"> <i class="fa fa-user icon"></i> Profile </a>
                            <div class="dropdown-divider"></div>
                            <form  action="" method="POST" >
                                <button type="submit" name="logOutME" class="dropdown-item"><i class="fa fa-power-off icon"></i>&nbsp;&nbsp;LOGOUT</button>
                            </form>
                        </div>
                    </li>
                </ul>
            </div>

        </header>
        <aside class="sidebar">
            <div class="sidebar-container">
                <div class="sidebar-header">
                    <div class="brand">
                        <div class="logo"><span class="l l1"></span> <span class="l l2"></span> <span
                                class="l l3"></span> <span class="l l4"></span> <span class="l l5"></span></div>
                        Member Panel
                    </div>
                </div>
                <nav class="menu">
                    <ul class="nav metismenu" id="sidebar-menu">
                        <li class="<?php if(!isset($menu)){ echo "active"; } ?>">
                            <a href="<?=$newsifyObj->base_url; ?>/"> <i class="fa fa-home"></i> Dashboard </a>
                        </li>
                         <li <?php if(isset($menu) && $menu['tab'] == 5){ echo 'class="active"'; } ?>>
                            <a href="<?=$newsifyObj->base_url; ?>/transaction.php"> 
							<i class="fa  fa-money fa_change"></i>Transaction</a>
						</li>
					<li <?php if(isset($menu) && $menu['tab'] == 6){ echo 'class="active"'; } ?>>
                            <a href="buy-bitcoins.php"> 
							<i class="fa  fa-bitcoin fa_change"></i>Buy Bitcoins</a>
						</li>
						<li <?php if(isset($menu) && $menu['tab'] == 7){ echo 'class="active"'; } ?>>
                            <a href="<?=$newsifyObj->base_url; ?>/transaction_history.php"> 
							<i class="fa  fa-history fa_change"></i>Transaction History</a>
						</li>
                        <li <?php if(isset($menu) && $menu['tab'] == 2){ echo 'class="active"'; } ?>>
                            <a href=""> <i class="fa fa-plus fa_change"></i>Referral Links<i class="fa arrow"></i> </a>
                            <ul class="sub-menu <?php if(isset($menu) && $menu['tab'] == 2) { echo 'collapse  in'; } ?>">
                                <li <?php if(isset($menu) && $menu['option'] == 'get_referral_link'){ echo 'class="active"'; } ?> ><a href="<?=$newsifyObj->base_url; ?>/get_referral_link.php">Referral Link</a></li>
                                <li <?php if(isset($menu) && $menu['option'] == 'my_referrals'){ echo 'class="active"'; } ?>><a href="<?=$newsifyObj->base_url; ?>/my_referrals.php">My Referrals</a></li>
                                <li <?php if(isset($menu) && $menu['option'] == 'my_referrals_pass_up'){ echo 'class="active"'; } ?>><a href="<?=$newsifyObj->base_url; ?>/my_referrals_pass_up.php">My Email List</a></li>
								 <li <?php if(isset($menu) && $menu['option'] == '4x4'){ echo 'class="active"'; } ?>><a href="<?=$newsifyObj->base_url; ?>/4x4_matrix.php">
                                 Income Table
								 </a></li>
                            </ul>
                        </li>
						<li <?php if(isset($menu) && $menu['tab'] == 3){ echo 'class="active"'; } ?>>
                            <a href="<?=$newsifyObj->base_url; ?>/level_system.php"> 
							<i class="fa fa-plus fa_change"></i>Upgrades</a>
						</li>
						<li <?php if(isset($menu) && $menu['tab'] == 4){ echo 'class="active"'; } ?>>
                            <a href="#"><i class="far fa-chart-bar fa_change"></i>Marketing
							<i class="fa arrow"></i> </a>
                            <ul class="sub-menu <?php if(isset($menu) && $menu['tab'] == 4) { echo 'collapse  in'; } ?>">

                                <li <?php if(isset($menu) && $menu['option'] == 'marketing_pages'){ echo 'class="active"'; } ?> >
                                    <a href="<?=$newsifyObj->base_url; ?>/marketing_pages.php">Landing Pages</a>
                                </li>
                                <li <?php if(isset($menu) && $menu['option'] == 'viral-tweet'){ echo 'class="active"'; } ?> >
                                    <a href="<?=$newsifyObj->base_url; ?>/viral-tweets/viral-tweet.php">ViralTweet</a>
                                </li>
                                
                                
                                <li <?php if(isset($menu) && $menu['option'] == 'twitter-marketing'){ echo 'class="active"'; } ?> >
                                    <a href="<?=$newsifyObj->base_url; ?>/twitter-marketing.php">Twitter Marketing</a>
                                </li>
                                
                                <!-- <li <?php if(isset($menu) && $menu['option'] == 'advertise-banners'){ echo 'class="active"'; } ?> >    <a href="<?=$newsifyObj->base_url; ?>/member_advertise.php">Advertize Banners</a>
                                </li> -->

                            </ul>
                        </li>
                       
                        
                        <li><form  action="" method="POST" >
                                    <button type="submit" name="logOutME" class="dropdown-item btn btn-success"><i class="fa fa-power-off icon"></i>&nbsp;&nbsp;LOGOUT</button>
                            </form>
                        </li>

                    </ul>
                </nav>
            </div>
        </aside>
        <div class="sidebar-overlay" id="sidebar-overlay"></div>