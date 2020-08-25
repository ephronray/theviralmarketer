  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
		 <div class="ulogo">
			 <a href="#">
			  <!-- logo for regular state and mobile devices -->
			  <span><img src="<?=$newsifyObj->base_url; ?>/assets/logo_white.png" style="width: 85%;"/></span>
			</a>
		</div>
        <div class="image">
          <img src="<?=$newsifyObj->base_url; ?>/images/user.png" class="rounded-circle" alt="User Image">
        </div>
        <div class="info">
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
                      } ?></p>
			<a href="<?=$newsifyObj->base_url; ?>/profile.php" class="link" data-toggle="tooltip" title="" data-original-title="Settings"><i class="ion ion-gear-b"></i></a>
        <a class="link" data-toggle="tooltip" title="" data-original-title="Logout">
            <form  action="" method="POST" >
                                    <button type="submit" name="logOutME" class="logout-menu-icon link"><i class="ion ion-power"></i></button>
        </form>
        </a>
        </div>
      </div>
      
      <!-- sidebar menu -->
      <ul class="sidebar-menu" data-widget="tree">
		<li class="nav-devider"></li>
        <li class="header nav-small-cap">Member</li>
        <li class="<?php if(!isset($menu)){ echo "active"; } ?>" >
          <a href="<?=$newsifyObj->base_url; ?>/">
            <i class="icon-home"></i> <span>Dashboard</span>
          </a>
        </li>

        <li class="<?php if(isset($menu) && $menu['tab'] == 5){ echo 'active'; }?>">
        <a href="<?=$newsifyObj->base_url; ?>/transaction.php">
            <i class="icon-wallet"></i> <span>Transactions</span>
            
          </a>
        </li>
       
        <li  class="<?php if(isset($menu) && $menu['tab'] == 6){ echo 'active'; } ?>">
        <a href="<?=$newsifyObj->base_url; ?>/buy-bitcoins.php"> 
            <i class="fa fa-btc"></i> <span>Buy Bitcoins</span>
          </a>
        </li>
       
        <li  class="<?php if(isset($menu) && $menu['tab'] == 7){ echo 'active'; } ?>">
        <a href="<?=$newsifyObj->base_url; ?>/transaction_history.php"> 
            <i class="icon-refresh"></i> <span>Transaction History</span>
          </a>
        </li>
       
        <li class="treeview <?php if(isset($menu) && $menu['tab'] == 2){ echo 'active'; } ?>">
          <a href="">
            <i class="fa fa-users"></i>
            <span>Referral Links</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu <?php if(isset($menu) && $menu['tab'] == 2) { echo 'collapse  in'; } ?>">
            <li class="<?php if(isset($menu) && $menu['option'] == 'get_referral_link'){ echo 'active'; } ?>" ><a href="<?=$newsifyObj->base_url; ?>/get_referral_link.php">Referral Link</a></li>
            <li class="<?php if(isset($menu) && $menu['option'] == 'my_referrals'){ echo 'active'; } ?>" ><a href="<?=$newsifyObj->base_url; ?>/my_referrals.php">My Referrals</a></li>
            <li class="<?php if(isset($menu) && $menu['option'] == 'my_referrals_pass_up'){ echo 'active'; } ?>" ><a href="<?=$newsifyObj->base_url; ?>/my_referrals_pass_up.php">My Email List</a></li>
            <li class="<?php if(isset($menu) && $menu['option'] == '4x4'){ echo 'active'; } ?>" ><a href="<?=$newsifyObj->base_url; ?>/4x4_matrix.php"> Income Table</a></li>         
           </ul>
        </li>
        <li class="<?php if(isset($menu) && $menu['tab'] == 3){ echo 'active'; } ?>" >
        <a href="<?=$newsifyObj->base_url; ?>/level_system.php"> 
            <i class="fa fa-level-up"></i>
            <span>Upgrades</span>
          </a>
        </li>

        <li class="treeview <?php if(isset($menu) && $menu['tab'] == 2){ echo 'active'; } ?> ">
          <a href="">
            <i class="icon-equalizer"></i>
            <span> Marketing</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu <?php if(isset($menu) && $menu['tab'] == 2) { echo 'collapse  in'; } ?>">
            <li class="<?php if(isset($menu) && $menu['option'] == 'marketing_pages'){ echo 'active'; } ?>" ><a href="<?=$newsifyObj->base_url; ?>/marketing_pages.php">Landing Pages</a></li>
                        <li class="<?php if(isset($menu) && $menu['option'] == 'viral-tweet'){ echo 'active'; } ?>" ><a href="<?=$newsifyObj->base_url; ?>/viral-tweets/viral-tweet.php">ViralTweet</a></li>
            <li class="<?php if(isset($menu) && $menu['option'] == 'twitter-marketing'){ echo 'active'; } ?>" ><a href="<?=$newsifyObj->base_url; ?>/twitter-marketing.php">Twitter Marketing</a></li>
            
            
            <!--<li class="<?php if(isset($menu) && $menu['option'] == 'advertise-banners'){ echo 'active'; } ?>" ><a href="member_advertise.php">Advertize Banners</a></li>-->
           </ul>
        </li>
          
        
      </ul>
    </section>
  </aside>