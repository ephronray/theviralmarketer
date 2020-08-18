<?php 
     include_once 'includes/main-header.php';
     
     
     
?>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!--<section class="content-header">-->
    <!--  <h1>-->
    <!--    Blank page-->
    <!--  </h1>-->
    <!--  <ol class="breadcrumb">-->
    <!--    <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>-->
    <!--    <li class="breadcrumb-item"><a href="#">Examples</a></li>-->
    <!--    <li class="breadcrumb-item active">Blank page</li>-->
    <!--  </ol>-->
    <!--</section>-->

    <!-- Main content -->
    <section class="content">
    
    <!--above boxes--->
    <div class="row">
					<div class="col-md-4 col-12">
					    <a href="my_referrals.php" >
						<div class="box box-body pull-up bg-warning bg-deathstar-white">
						  <div class="flexbox">
							<span class="fa fa-users font-size-40"></span>
							<span class="font-weight-200 font-size-26"><?php echo $newsifyObj->countReferrals(); ?></span>
						  </div>
						  <div class="text-right">My Referrals</div>
						</div>
						</a>
					</div>
					<div class="col-md-4 col-12">
					    <a href="viral-tweets/viral-tweet.php" >
						<div class="box box-body pull-up bg-danger bg-deathstar-white">
						  <div class="flexbox">
							<span class="fa fa-twitter font-size-40"></span>
							<span class="font-weight-200 font-size-26"><?php echo $newsifyObj->countTwitterAccount(); ?></span>
						  </div>
						  <div class="text-right">My Twitters</div>
						</div>
						</a>
					</div>
					<div class="col-md-4 col-12">
						<div class="box box-body pull-up bg-success bg-deathstar-white">
						  <div class="flexbox">
							<span class="fa fa-money font-size-40"></span>
							<span class="font-weight-200 font-size-26">
							    
<?php 
							    					    $balance = $newsifyObj->checkbalance($wallet_xpub);
							    					echo (isset($balance) && is_array($balance)) ? number_format((float)$balance[0], 5, '.', '')."  BTC (~ $".number_format((float)$balance[1], 2, '.', '') .")" : "0.0000 BTC (~ $0)";
							    				
							    					        
?>
							</span>
						  </div>
						  <div class="text-right">Balance</div>
						</div>
					</div>
				
				</div>
    <!---above boxes--->
    
    <!----levels--->
    <div class="row">
        <div class="col-lg-4 col-12">
            <div class="box box-solid bg-black">
					<div class="box-header with-border">
						<h4 class="box-title"><i class="fa fa-level-up"> </i>Levels</h4>
						<ul class="box-controls pull-right">
						  <li><a class="box-btn-close" href="#"></a></li>
						  <li><a class="box-btn-slide" href="#"></a></li>	
						  <li><a class="box-btn-fullscreen" href="#"></a></li>
						</ul>
					</div>
					<div class="box-body dashboard-boxes p-0">
					  <div class="media-list media-list-hover media-list-divided">
					      <?php 
					      
					      $userLevel = $newsifyObj->getUserLevel();
					      $levels = $newsifyObj->getLevelSystems();
					      foreach($levels as $key=>$level) {
					          
						      if($userLevel == 0 && $key == 0 ) { 
						          $urlLevelSystem = 'level_system.php';
						      }
						      
						  if($level['id'] >  $userLevel  &&  $key != 0 )  { 
						         $urlLevelSystem = '#';
						       }
						       
						      if($level['id'] <=  $userLevel &&  $key != 0 )  {
						          
						          $urlLevelSystem = '#';
						      }
						      
					      ?>
						<a class="media media-single p-10" href="<?= $urlLevelSystem; ?>">
						  <span class="avatar avatar-sm " style="background-color: #3a8bf7 !important;"><?= $level['id']; ?></span>
						  <span class="title"><?= $level['level_name']; ?></span>
						  <span class="pull-right">
						  
						      <?php 

						      if($userLevel == 0 && $key == 0 ) { ?>
						          <i class="fa fa-unlock" ></i>
						          
						  <?php    } 
						  if($level['id'] >  $userLevel  &&  $key != 0 )  { ?>
						         <i class="fa fa-lock" ></i>
						      <?php }
						      if($level['id'] <=  $userLevel &&  $key != 0 )  {
						          
						          echo "Promoted";
						      }
						      ?>
						      </span>
						</a>

                    <?php } ?>

					  </div>
				  </div>
				</div>
        </div>
                <div class="col-lg-4 col-12">
            <div class="box box-solid bg-black">
					<div class="box-header with-border">
						<h4 class="box-title"><i class="fa fa-twitter"></i> Viral Tweet Service</h4>
						<ul class="box-controls pull-right">
						  <li><a class="box-btn-close" href="#"></a></li>
						  <li><a class="box-btn-slide" href="#"></a></li>	
						  <li><a class="box-btn-fullscreen" href="#"></a></li>
						</ul>
					</div>
					<div class="box-body dashboard-boxes p-0">
					  <div class="media-list media-list-hover media-list-divided">
						<a class="media media-single p-10" href="<?=$newsifyObj->base_url; ?>/viral-tweets/viral-tweet.php">
						  <span class="avatar avatar-sm rounded-circle bg-primary"><i class="fa fa-user-plus"></i></span>
						  <span class="title">Add Followers</span>
						</a>

                        <a class="media media-single p-10" href="<?=$newsifyObj->base_url; ?>/viral-tweets/viral-tweet.php">
						  <span class="avatar avatar-sm rounded-circle bg-danger"><i class="fa fa-user-times"></i></span>
						  <span class="title">Unfollow</span>
						</a>

						<a class="media media-single p-10" href="<?=$newsifyObj->base_url; ?>/viral-tweets/viral-tweet.php">
						  <span class="avatar avatar-sm rounded-circle bg-success"><i class="fa fa-search"></i></span>
						  <span class="title">Search Tweets</span>
						</a>



						<a class="media media-single p-10" href="<?=$newsifyObj->base_url; ?>/viral-tweets/viral-tweet.php">
						  <span class="avatar avatar-sm rounded-circle bg-warning"><i class="fa fa-twitter"></i></span>
						  <span class="title">Add Tweets</span>
						</a>
					  </div>
				  </div>
				</div>
        </div>
        
        
                <div class="col-lg-4 col-12">
            <div class="box box-solid bg-black">
					<div class="box-header with-border">
						<h4 class="box-title"><i class="fa fa-info"></i> Information </h4>
						<ul class="box-controls pull-right">
						  <li><a class="box-btn-close" href="#"></a></li>
						  <li><a class="box-btn-slide" href="#"></a></li>	
						  <li><a class="box-btn-fullscreen" href="#"></a></li>
						</ul>
					</div>
					<div class="box-body dashboard-boxes p-0">
					  <div class="media-list media-list-hover media-list-divided">
					      <div>
					      <h4 style="text-align: center;margin-top: 13px;"> The Viral Marketer Overview</h4>
					      <p style="text-align:center">Watch this very IMPORTANT Video</p>
					      </div>
					      <iframe id="overview-iframe" width="100%" height="220" src="https://www.youtube.com/embed/EPJ2O9xL5g8?rel=0&amp;showinfo=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen=""></iframe>
					      
					      <div class="box-controls overview-button-video" >
					          <a class="btn btn-primary box-btn-fullscreen" href="#" ><span id="video-button-text" ><i class="fa fa-video-camera"></i>Full Screen</span></a>
					      </div>
					  </div>
				  </div>
				</div>
        </div>
    </div>
    
    <div class="page-bottom-space">
        
    </div>
    <!--levels-->
    
    
    
      <!-- Default box -->
      <!--<div class="box">-->
      <!--  <div class="box-header with-border">-->
      <!--    <h3 class="box-title">Title</h3>-->

      <!--    <div class="box-tools pull-right">-->
      <!--      <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"-->
      <!--              title="Collapse">-->
      <!--        <i class="fa fa-minus"></i></button>-->
      <!--      <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">-->
      <!--        <i class="fa fa-times"></i></button>-->
      <!--    </div>-->
      <!--  </div>-->
      <!--  <div class="box-body">-->
      <!--    This is some text within a card block.-->
      <!--  </div>-->
        <!-- /.box-body -->
      <!--  <div class="box-footer">-->
      <!--    Footer-->
      <!--  </div>-->
        <!-- /.box-footer-->
      <!--</div>-->
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 


<?php 
     include_once 'includes/main_footer.php';
?>

<script>
    var mainvideo = 0;
    
    $('#video-button-text').click(function(){
    if(mainvideo == 0 ) {
         $('#overview-iframe').attr('height', '450px');
         $('#overview-iframe').css('height', '450px !important');
         mainvideo = 1;
     } 
     
     else if(mainvideo == 1) {
                  $('#overview-iframe').attr('height', '220');
                  $('#overview-iframe').css('height', '220px !important');
                  mainvideo = 0
         
     }
    });

    
</script>

<script  type="text/javascript">(function () {
var options = {
//facebook: "Web Hostech", // Facebook page ID
//facebook: "993314740879356",
whatsapp: "+27769000410", // WhatsApp number
email: "info@theviralmarketer.biz", // Email
// call: "+92300 4409625", // Call phone number
company_logo_url: "http://itestquiez.mraza.xyz/assets/logo.svg", // URL of company logo (png, jpg, gif)
greeting_message: "Whatsapp Us Now!  \n +27 76 900 0410 \n", // Text of greeting message
call_to_action: "Whatsapp Us Now!", // Call to action
button_color: "#fbae1c", // Color of button
position: "right", // Position may be 'right' or 'left'
order: "facebook,whatsapp,email,call", // Order of buttons
};
var proto = document.location.protocol, host = "whatshelp.io", url = proto + "//static." + host;
var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = url + '/widget-send-button/js/init.js';
s.onload = function () { WhWidgetSendButton.init(host, proto, options); };
var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(s, x);
})();</script>
	
	
