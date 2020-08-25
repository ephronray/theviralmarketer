<?php
//include_once '_libs/dbConnect.php';
require_once (__DIR__.'/../_libs/dbConnect.php');

$newsifyObj = new  dbConnect();
if(!$newsifyObj->isLoggedIN()){
	header("Location: ".$newsifyObj->base_url."/login.php");
	die();
	//$newsifyObj->redirectMe();
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

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?= $baseUrl; ?>assets/favicon.ico">

    <title>The ViralMarketer</title>
  
  
  	<!-- Bootstrap 4.0-->
	<link rel="stylesheet" href="<?= $baseUrl; ?>/assets/vendor_components/bootstrap/dist/css/bootstrap.css">
	
	<!-- Bootstrap-extend -->
	<link rel="stylesheet" href="<?= $baseUrl; ?>css/css/bootstrap-extend.css">
  <link rel="stylesheet" href= "https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.0/css/ionicons.min.css">
  <link rel="stylesheet" href= "https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
	<!-- theme style -->
	<link rel="stylesheet" href="<?= $baseUrl; ?>css/css/master_style.css">
		<!--tags-->
		<link href="../../css/tagsinput.css" rel="stylesheet">
	<link rel="stylesheet" href="<?= $baseUrl; ?>css/custom.css">
<link rel="stylesheet" href="//cdn.materialdesignicons.com/5.3.45/css/materialdesignicons.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.0/css/simple-line-icons.min.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" >	
	<link rel="stylesheet" href="<?= $baseUrl; ?>css/css/skins/_all-skins.css">
	


</head>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="/index.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
	  <b class="logo-mini">
		  <span class="light-logo"><img src="<?= $baseUrl; ?>assets/logo_white.png" style="width: 75%;" alt="logo"></span>
		  <span class="dark-logo"><img src="<?= $baseUrl; ?>assets/logo_black.png" style="width: 75%;" alt="logo"></span>
	  </b>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">
		  <img src="<?= $baseUrl; ?>assets/logo_white.png" alt="logo" style="width: 75%;" class="light-logo">
	  	  <img src="<?= $baseUrl; ?>assets/logo_black.png" alt="logo" style="width: 75%;" class="dark-logo">
	  </span>
    </a>
    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
		  
		 <!-- <li class="search-box">-->
   <!--         <a class="nav-link hidden-sm-down" href="javascript:void(0)"><i class="mdi mdi-magnify"></i></a>-->
   <!--         <form class="app-search" style="display: none;">-->
   <!--             <input type="text" class="form-control" placeholder="Search &amp; enter"> <a class="srh-btn"><i class="ti-close"></i></a>-->
			<!--</form>-->
   <!--       </li>			-->
		  

		  <!-- User Account -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?= $baseUrl; ?>images/user.png" class="user-image rounded-circle" alt="User Image"> 
            </a>
            <ul class="dropdown-menu scale-up">
              <!-- User image -->
              <li class="user-header">
                <!--<img src="../../../images/user5-128x128.jpg" class="float-left rounded-circle" alt="User Image">-->

                <p>
                        
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
                      
                  <small class="mb-5">
                       <?php  if (!empty($_SESSION['user']['email'])){
                                echo $_SESSION['user']['email'];
                      } ?>
                      
                      </small>
                  <a href="profile.php" class="btn btn-danger btn-sm btn-rounded">View Profile</a>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row no-gutters">
                  <div class="col-12 text-left">
                    <a href="profile.php"><i class="ion ion-person"></i> My Profile</a>
                  </div>
                <div role="separator" class="divider col-12"></div>
				  <div class="col-12 text-left">
				      <form  action="" method="POST" >
                                <button  style="cursor: pointer;" type="submit" name="logOutME" class="dropdown-item"><i class="fa fa-power-off"></i>&nbsp;&nbsp;LOGOUT</button>
                            </form>
                    <!--<a href="#"><i class="fa fa-power-off"></i> Logout</a>-->
                  </div>				
                </div>
                <!-- /.row -->
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <!--<li>-->
          <!--  <a href="#" data-toggle="control-sidebar"><i class="fa fa-cog fa-spin"></i></a>-->
          <!--</li>-->
        </ul>
      </div>
    </nav>
  </header>


  <?php 
     include_once 'main-sidebar.php';
?>
  

