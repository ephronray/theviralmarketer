<?php 
include_once '_libs/dbConnect.php';
include_once 'includes/main_header.php';
$newsifyObj = new  dbConnect();
if(!$newsifyObj->isLoggedIN()){
    $newsifyObj->redirectMe($newsifyObj->base_url.'/login.php');
}
?>
<aside class="main-sidebar">
    <!-- sidebar -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
		 <div class="ulogo">
			 <a href="index-2.html">
			  <!-- logo for regular state and mobile devices -->
			  <span><b>Crypto </b>Admin</span>
			</a>
		</div>
        <div class="image">
          <img src="images/user2-160x160.jpg" class="rounded-circle" alt="User Image">
        </div>
        <div class="info">
          <p>Admin Template</p>
			<a href="#" class="link" data-toggle="tooltip" title="" data-original-title="Settings"><i class="ion ion-gear-b"></i></a>
            <a href="#" class="link" data-toggle="tooltip" title="" data-original-title="Email"><i class="ion ion-android-mail"></i></a>
            <a href="#" class="link" data-toggle="tooltip" title="" data-original-title="Logout"><i class="ion ion-power"></i></a>
        </div>
      </div>
      <!-- sidebar menu -->
      <ul class="sidebar-menu" data-widget="tree">
		<li class="nav-devider"></li>
       
        <li <?php if(!isset($menu)){ echo "active"; } ?>>
          <a href="<?=$newsifyObj->base_url; ?>/">
            <i class="icon-home"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
        </li>

        <li <?php if(isset($menu) && $menu['tab'] == 5){ echo 'class="active"'; }?>>
        <a href="transaction.php">
            <i class="icon-home"></i> <span>Transactions</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
        </li>
       
        <li  <?php if(isset($menu) && $menu['tab'] == 6){ echo 'class="active"'; } ?>>
        <a href="buy-bitcoins.php"> 
            <i class="icon-refresh"></i> <span>Buy History</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
        </li>
       
        <li  <?php if(isset($menu) && $menu['tab'] == 6){ echo 'class="active"'; } ?>>
        <a href="transaction_history.php"> 
            <i class="icon-refresh"></i> <span>Transaction History</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
        </li>
       
        <li class="treeview <?php if(isset($menu) && $menu['tab'] == 2){ echo 'class="active"'; } ?> ">
          <a href="">
            <i class="icon-equalizer"></i>
            <span>Referral Links</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu <?php if(isset($menu) && $menu['tab'] == 2) { echo 'collapse  in'; } ?>">
            <li <?php if(isset($menu) && $menu['option'] == 'get_referral_link'){ echo 'class="active"'; } ?>><a href="get_referral_link.php">Referral Link</a></li>
            <li <?php if(isset($menu) && $menu['option'] == 'my_referrals'){ echo 'class="active"'; } ?>><a href="my_referrals.php">My Referrals</a></li>
            <li <?php if(isset($menu) && $menu['option'] == 'my_referrals_pass_up'){ echo 'class="active"'; } ?>><a href="my_referrals_pass_up.php">My Email List</a></li>
            <li <?php if(isset($menu) && $menu['option'] == '4x4'){ echo 'class="active"'; } ?>><a href="4x4_matrix.php"> Income Table</a></li>         
           </ul>
        </li>
        <li <?php if(isset($menu) && $menu['tab'] == 3){ echo 'class="active"'; } ?>>
        <a href="level_system.php"> 
            <i class="icon-wallet"></i>
            <span>Upgrades</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
        </li>

        <li class="treeview <?php if(isset($menu) && $menu['tab'] == 2){ echo 'class="active"'; } ?> ">
          <a href="">
            <i class="icon-equalizer"></i>
            <span> Marketing</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu <?php if(isset($menu) && $menu['tab'] == 2) { echo 'collapse  in'; } ?>">
            <li <?php if(isset($menu) && $menu['option'] == 'marketing_pages'){ echo 'class="active"'; } ?>><a href="marketing_pages.php">Landing Pages</a></li>
            <li <?php if(isset($menu) && $menu['option'] == 'twitter-marketing'){ echo 'class="active"'; } ?>><a href="twitter-marketing.php">Twitter Marketing</a></li>
            <li <?php if(isset($menu) && $menu['option'] == 'advertise-banners'){ echo 'class="active"'; } ?>><a href="member_advertise.php">Advertize Banners</a></li>
           </ul>
        </li>
    
       
        <li><form  action="" method="POST" >
                                    <button type="submit" name="logOutME" class="dropdown-item btn btn-success"><i class="fa fa-power-off icon"></i>&nbsp;&nbsp;LOGOUT</button>
                            </form>
                        </li>
	    </ul>
    </section>
  </aside>
  