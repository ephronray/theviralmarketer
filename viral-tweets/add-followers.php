<?php 
session_start();
$menu = array('tab'=>4, 'option' => 'viral-tweet');
$currentpage = "follow";
include_once './../includes/main-header.php'; 
require_once (__DIR__.'/../_libs/twitterSetting.php');
require_once (__DIR__.'/../_libs/commonHelper.php');
require_once (__DIR__.'/../_libs/dbConnect.php');
$db = new dbConnect();
$twitter = new TwitterSetting();
$common = new CommonHepler();
// add tweeter account
 if(isset($_SESSION["twitter_oauth_token"]) && isset($_SESSION["twitter_oauth_token_secret"])){ 

	 $twitter->saveNewTwitterAccount();
} ?>
<style>
.table-pagination-text {
    min-width: 250px;
    border: 1px solid #04a9f3 ;
    padding: 5px;
    text-align: center;
    margin-right: 3px;
}
	.table-pagination-arrows {
    width: 30px;
    border: 1px solid #04a9f3 ;
    padding: 5px;
    margin-right: 3px;
}
	.loader-table{
	border:none;
	}
#follow-tags-table_length select.form-control:not([size]):not([multiple]) {
    height: calc(2.5rem + 2px);
}
	table input {
	width:auto;
	}
.followBackFollowpage
{
    display:none;
}
td
{
    text-align:center;
}
 th {
    padding: 0.9rem;
}    

    @media only screen and (max-width: 600px) {
        .blnc_res {
            width: 60%;
            margin-bottom: 40px;
        }
        .btn_ref{
            margin-right: 37%;
        }
    }

    @media only screen and (max-width: 320px) {
        .blnc_res {
            width: 80%;
            margin-left: 5%;
            margin-bottom: 40px;
        }
        .btn_ref{
            margin-right: 37%;
        }
    }
    .nav-links{
        cursor:pointer;
    }
</style>


<?php
$data = array('accountId'=>$_GET['id']);
$twitterLogs = $db->showTwitterLogs($data);
function twitterActivity($user_id , $twitterLogs) {
$status = '';
foreach($twitterLogs as $arrayitem ) {
    if($arrayitem['twitter_user_id'] == $user_id ) {
   // $status = $arrayitem['status']. ' on '. dateFormatChageForLastAction($arrayitem['date']);
    $status = $arrayitem['status']. ' on '. dateFormatChageForLastAction($arrayitem['date']);
    }
}
return $status;
}

function dateFormatChageForLastAction($valueDate) {
    $date1 = date("Y-m-d", strtotime($valueDate));
    $date2 = date("Y-m-d");
  if($date1 == $date2) {
        return "Today";
    }
 $diff = abs(strtotime($date2) - strtotime($date1));

$years = floor($diff / (365*60*60*24));
$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

$changeyears = $years != 0? (int)$years > 1? $years.' years': $years.' year':"";
$monthschange = $months != 0? $months > 1 ? $months.' month':$months.' months':"" ;
$dayChange = $days != 0? $days > 1 ? $days.' days':$days.' day':"" ;

return $changeyears.($changeyears != ""?" / ":"").$monthschange.($monthschange != ""?" / ":"").$dayChange. ($dayChange != "" ? " ago ": "Today");

 }
// add tweeter account

//get all tweeter Accounts

$alltwitterAccountDetail = $twitter->getAccountDetails();

//get all tweeter accounts

//get single tweeter account 
if(isset($_GET['id'])) {
  $twitterSingleDetail =  $twitter->getSingleAccountDetail($_GET['id']);
 
}

//get single tweeter account
 
 //search followers
 
 function dateFormatChange($valueDate) {
      if($valueDate) {
     $date1 = date("Y-m-d", strtotime($valueDate));
    $date2 = date("Y-m-d");
     if($date1 == $date2) {
        return "Today";
    }
 $diff = abs(strtotime($date2) - strtotime($date1));

$years = floor($diff / (365*60*60*24));
$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

$changeyears = $years != 0? (int)$years > 1? $years.' years': $years.' year':"";
$monthschange = $months != 0? $months > 1 ? $months.' month':$months.' months':"" ;
$dayChange = $days != 0? $days > 1 ? $days.' days':$days.' day':"" ;

return $changeyears.($changeyears != ""?" / ":"").$monthschange.($monthschange != ""?" / ":"").$dayChange. ($dayChange != "" ? " ago ": "Never Tweeted");
}
}

 //search followers

?>
    <div class="content-wrapper">
<section class="content-header">
      <h1>
       Add Followers
      </h1>
       <p class="title-description">Find the targeted users and then follow them. </p>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/index.php"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="breadcrumb-item "><a href="viral-tweet.php?id=<?= $_GET['id'] ?>">Viral Tweets</a></li>
         <li class="breadcrumb-item "><a href="viral-tweet-services.php?id=<?= $_GET['id'] ?>">Viral Tweets Services</a></li>
         <li class="breadcrumb-item active">Add Followers</li>
      </ol>
    </section>
    <article class="content grid-page">

 

        <section  aria-live="polite" aria-atomic="true" style="position: relative;" class="section">
            
         <?php require_once (__DIR__.'/../viral-tweets/single-twitter-account.php'); ?>

        
        <div class="row">
            <!--card Start-->
            <!-- Card -->
<div class="box box box-solid bg-black">
	<div class="box-header with-border">
	     	      <h3 class="box-title">Select what you want to do:</h3>
	     	       <div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
						title="Collapse">
				  <i class="fa fa-minus"></i></button>
				<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
				  <i class="fa fa-times"></i></button>
			  </div>
	     	    </div>
  <!-- Card content -->
  <div class="box-body pb-3">
    
    <!--Tab-stat-->
<div class="container">
    
<ul class="nav nav-tabs followers-tabs " role="tablist">
  <li onClick="changeTab(this)" tab="hashtag" class="nav-item "> <span class="nav-link  <?= (isset($_GET['type']) && $_GET['type'] == 'hashtag')?'active' :( (isset($_GET['type']) && $_GET['type']=='username')?'':'active') ?>"> #Hashtag </span></li>
  <li onClick="changeTab(this)" class="nav-item " tab="username"> <span class="nav-link  <?= (isset($_GET['type']) && $_GET['type']=='username')?'active':'' ?> "> User Name</span></li>
</ul>
<!--hashag form-->
<div class="row">
    <div class="col-md-12">
<br/>
<form action="" method="GET">
 <input type="hidden"  name="id" value="<?= $_GET['id'] ?>" />
  <input type="hidden"  name="type" id="follower-search-type" value="hashtag" />

  
  <div class="form-group" id="hashtag-follower-search"  >
                <!--<label>Keywords (returns a collection of relevant Tweets matching a specified query.</label>-->
                <div  class="input-group">
                <input style="    width: 0;flex: none;" type="text" value="<?php  if($_GET['type'] =='hashtag'){echo  $_GET['tags'];} ?>" class="form-control" name="tags" data-role="tagsinput" placeholder ="eg: #happybirthday"/>
                  <span class="input-group-btn" style="font-size: 20px;">
                      <button class="btn btn-primary btnActionTwitterSearch" type="submit" name="submit" >
                        <i class="fa fa-search"></i>
                     </button>
                  </span>
                </div>
              </div>
  
  
  
  <!--user name search-->
    <div class="form-group" id="username-follower-search" <?= (isset($_GET['type']) && $_GET['type']=='username')?'':(isset($_GET['type']) && $_GET['type']=='hashtag')?'style="display:none;"':'style="display:none;"'; ?>  >

                <div class="input-group">
                <input  style="    width: 0;
    flex: none;" type="text" class="form-control" name="usernames" data-role="tagsinput" placeholder ="eg: @barackobama"/>
                  <span class="input-group-btn" style="font-size: 20px;">
                      <button class="btn btn-primary btnActionTwitterSearch" type="submit" name="submit" >
                        <i class="fa fa-search"></i>
                     </button>
                  </span>
                </div>
              </div>
  <!--user name search end-->
        </form>
    </div>
</div>
<!--hashag form-->



</div>
<!--tab end-->


  </div>

</div>


<!-- Card -->
<!--card end-->            
<!--search of follow users -->
<?php 

$cursor = isset($_GET['cursor']) ? $_GET['cursor'] :-1;
$page = isset($_GET['page'])?$_GET['page']:1;
$followusers = [];
$currentActiveUser = '';
$currentActiveUserFollowers;
$previousCursor = 0;
$nextCursor = 0;
$activeFollowUsersFollowersList = [];
$tagsUsers =  [];
if(isset($_GET['type'])) {
     
    $data = array('type'=>$_GET['type'], 'tags'=>$_GET['tags'], 'usernames'=>$_GET['usernames'] ,'accountId'=>$_GET['id'],'cursor'=>$cursor );
   $response =  $twitter->getFollowersByUsersOrTags($data);
   
   if($_GET['type'] == 'username') {
   
   $followusers = $response['users'];
   $currentActiveUser = $response['users'][0]->id;
   $currentActiveUserFollowers = $response['users'][0]->followers_count;
    $followUsersFollowersList = $response['followersList'];
  $activeFollowUsersFollowersList = $followUsersFollowersList[$currentActiveUser]->users;
  $encodeFollowedList = json_encode($activeFollowUsersFollowersList);
  $nextCursor =  $followUsersFollowersList[$currentActiveUser]->next_cursor;
  $previousCursor =  $followUsersFollowersList[$currentActiveUser]->previous_cursor;
 }
 
 
// echo "<pre>";
//  print_r($followUsersFollowersList);
//  "</pre>";
 
 if($_GET['type']    == 'hashtag') {
     $tagsUsers = $response;
   
 }
 }



?>
<?php
if($followusers) {
foreach($followusers as $user) { ?>
			<div class="col-md-6">
	
			<div class="info-box pull-up">
            <span class="info-box-icon bg-info"><img src="<?= $user->profile_image_url; ?>" class="tweeter-avatar" /></span>

            <div class="info-box-content">
				<span class="info-box-number"><b>@<?= $user->screen_name; ?></b></span>
              <span class="info-box-text"><?= $user->description; ?></span>
            </div>
				 <div class="row">
                <div class="col-sm-6 border-right">
                  <div class="description-block">
                    <h5 class="description-header"><?= $user->followers_count; ?></h5>
                    <span class="description-text">FOLLOWERS</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-6 border-right">
                  <div class="description-block">
                    <h5 class="description-header"><?= $user->friends_count; ?> </h5>
                    <span class="description-text">Friends</span>
                  </div>
                  <!-- /.description-block -->
                </div>
              </div>
            <!-- /.info-box-content -->
          </div>
			</div>
			<br/>

<?php } } ?>
<!--search offollow users end-->

			</div>
         <br/>
         
       <?php
        if(count($activeFollowUsersFollowersList) > 0  || count($tagsUsers) > 0) { 
   require_once (__DIR__.'/../viral-tweets/search-critaria.php'); 
     }
   ?>
<div class="box box-solid bg-black memberlist" style="<?= (isset($_GET['type'])?'':'display:none') ?>">
	<div class="box-header with-border">
	     	      <h3 class="box-title">Members List:</h3>
	     	       <div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
						title="Collapse">
				  <i class="fa fa-minus"></i></button>
				<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
				  <i class="fa fa-times"></i></button>
			  </div>
	     	    </div>
      <div class="box-body pb-3">
		  <div class="table-responsive loader-table" style="display:none;">
            <table class="table table-striped  twitter-account-table twitter-follower-table" style="width: 100%;">
          <thead>
              <tr>
                <th>@User </th>
                <th>Bio</th>
                <th>Location</th>
                <th>Last Tweeted</th>
                <th>Last Activity</th>
                <th>Followers</th>
                <th>Followings</th>
                <th>Tweet Count</th>
                
                <th>Varified?</th>
                <th>Member since</th>
              </tr>
          </thead>
          <tbody class="twitter-account-table-body">
            <tr>
                <td> </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
              <tr style="height: 300px;" >
                  <td> </td>
                <td></td>
                <td></td>
                
                <td></td>
                <td> </td>
				  <td class="loader-img"  style="padding:100px 0px"><img  style="width:80px;" src="../../images/loader.gif" style="width:80px"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                  
                     
                  
              </tr>
          </tbody>
          </table>
        </div>
        
            <?php if(count($followusers) > 0) { ?>
        <div id="follow-user-table-container" class="table-responsive table-filter username">
        
            
        <table id="follow-user-table" class="table table-striped table-bordered twitter-account-table twitter-follower-table " style="width: 100%;">
          <thead>
              <tr>
                <th>@User </th>
                <th>Bio</th>
                <th>Location</th>
                <th>Last Tweeted</th>
                <th>Last Activity</th>
                <th>Followers</th>
                <th>Followings</th>
                <th>Tweet Count</th>
                <th>Varified?</th>
                <th>Member since</th>
              </tr>
          </thead>


          <tbody class="twitter-account-table-body-username">
<!--// created_at-->
<!--  <div class="loader-img" style="display:none;" >-->
<!--    <img  style="width:80px;" src="../../images/loader.gif" style="width:80px">-->
<!--</div>-->
<?php foreach($activeFollowUsersFollowersList as $user) { ?>
              <tr id="user-<?= $user->id; ?>">
                  <td>
                      
                <div style="display:flex;" >
                    <div >
                       <img src="<?= $user->profile_image_url; ?>" style="min-width: 67px;border-radius: 50%;margin-right: 10px;" class="tweeter-avatar"> 
                    </div>
                    <div  style="    text-align: left !important;" class="follower-user-name">
                        
                        <b style=" font-size: 15px; ">@<?= $user->screen_name; ?></b> <span style="color:#a4a4a4"> <?= $user->name; ?><img class="loader-img-<?= $user->id; ?>" style="display:none;width:28px"; src="../../images/loader.gif" style="width:28px"></span>
                        <div style="display:flex">
                            
                            <button style="margin-right:2px" onClick="addFollowAction(this)" list-id="<?= $twitterSingleDetail['followed_list_data']->id; ?>" list-url=<?= $twitterSingleDetail['followed_list_data']->uri; ?> slug="<?= $twitterSingleDetail['followed_list_data']->slug; ?>"   user-name="<?= $user->name; ?>" user-id="<?= $user->id; ?>" screen-name="<?= $user->screen_name; ?>" account-id="<?= $_GET['id']; ?>" class="btn btn-primary btn-sm">
                                <i class="fa fa-plus"></i> 
                                Follow 
                                </button>
                            <button onCLick="addFollowList(this)" list-id="<?= $twitterSingleDetail['list_data']->id; ?>" slug="<?= $twitterSingleDetail['list_data']->slug; ?>"  list-url=<?= $twitterSingleDetail['list_data']->uri; ?>  user-name="<?= $user->name; ?>" user-id="<?= $user->id; ?>" screen-name="<?= $user->screen_name; ?>" account-id="<?= $_GET['id']; ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Follow List</button>
                        </div>
                    </div>
                </div>
                </td>
                  <td><?= $user->description; ?></td>
                  <td><?= $user->location; ?></td>
                  <?php $status = $user->status; ?>
                  <td>
                    <?php echo  ($status  && $status->created_at) ?dateFormatChange($status->created_at):"Never Tweeted"; ?>
                  </td>
                  <td><?php echo twitterActivity($user->id , $twitterLogs); ?></td>
                  <td><?= $user->followers_count; ?></td>
                  <td><?= $user->friends_count; ?></td>
                  <td><?= $user->statuses_count;?></td>
                 
                <td><?= ($user->verified == true)?"Yes":"No"; ?></td>
                  <td><?= date("Y", strtotime($user->created_at)); ?> </td>
              </tr>
              <?php } ?>
              </tbody>
              </table>
              
              </div>
              <?php } ?>
              
              
              <!--hashtag table-->
                <?php if($tagsUsers && count($tagsUsers) > 0) {  ?>
                    
                    <div id="follow-tags-table-container" class="table-responsive table-filter hashtag" >
        <table id="follow-tags-table" class="table table-striped table-bordered twitter-account-table twitter-follower-table" style="width: 100%;">
          <thead>
              <tr>
                <th>@User </th>
                <th>Bio</th>
                <th>Location</th>
                <th>Last Tweeted</th>
                <th>Last Activity</th>
                <th>Followers</th>
                <th>Followings</th>
                <th>Tweet Count</th>
                <th>Varified?</th>
                <th>Member since</th>
              </tr>
          </thead>

          <tbody class="twitter-account-table-body-hashtag">

<!--// created_at-->
<?php foreach($tagsUsers as $user) { ?>
              <tr id="user-<?= $user->id; ?>">
                  <td>
                      
                <div style="display:flex;" >
                    <div >
                       <img src="<?= $user->profile_image_url; ?>" style="min-width: 67px;border-radius: 50%;margin-right: 10px;"  class="tweeter-avatar"> 
                    </div>
					
                    <div style=" text-align:left;" class="follower-user-name">
                        
                        <b style=" font-size: 15px; ">
						   @<?= $user->screen_name; ?></b> <span style="color:#a4a4a4"> <?= $user->name; ?><img class="loader-img-<?= $user->id; ?>" style="display:none;width:28px"; src="../../images/loader.gif" style="width:28px"></span>
                        <div style="display:flex">
                        <button style="margin-right:2px" onClick="addFollowAction(this)" list-id="<?= $twitterSingleDetail['followed_list_data']->id; ?>" list-url=<?= $twitterSingleDetail['followed_list_data']->uri; ?> slug="<?= $twitterSingleDetail['followed_list_data']->slug; ?>"   user-name="<?= $user->name; ?>" user-id="<?= $user->id; ?>" screen-name="<?= $user->screen_name; ?>" account-id="<?= $_GET['id']; ?>" class="btn btn-primary btn-sm">
                                <i class="fa fa-plus"></i> 
                                Follow 
                                </button>
                            <button onCLick="addFollowList(this)" list-id="<?= $twitterSingleDetail['list_data']->id; ?>" slug="<?= $twitterSingleDetail['list_data']->slug; ?>"  list-url=<?= $twitterSingleDetail['list_data']->uri; ?>  user-name="<?= $user->name; ?>" user-id="<?= $user->id; ?>" screen-name="<?= $user->screen_name; ?>" account-id="<?= $_GET['id']; ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Follow List</button>
                        </div>
                    </div>
                </div>
                </td>
                  <td><?= $user->description; ?></td>
                  <td><?= $user->location; ?></td>
                  <?php $status = $user->status; ?>
                  <td>
                    <?php echo dateFormatChange($user->publihed_last_tweet); ?>
                  </td>
                  <td><?php echo twitterActivity($user->id , $twitterLogs); ?></td>
                  <td><?= $user->followers_count; ?></td>
                  <td><?= $user->friends_count; ?></td>
                   <td><?= $user->statuses_count; ?></td>
                 
                  <td><?= ($user->verified == true)?"Yes":"No"; ?></td>
                  <td><?= date("Y", strtotime($user->created_at)); ?> </td>
              </tr>
              <?php } ?>
              </tbody>
              </table>
              </div>
              <?php } ?>
  
             <!--hashtag table end-->              
              




              </div>
</div>
<?php 
if(count($activeFollowUsersFollowersList) > 0) { ?>
<div class="row">
    <div style="display: flex;margin: 10px 363px;" class="tweeter-follower-table-pagination">
        <?php 
       $previouspage = $page-1;
       $nextpage = $page+1;
        ?>
        <div class="table-pagination-arrows">
             <?php if($previousCursor != 0) { ?>
            <a href="<?php echo $common->getUrl($common->getUrl($_SERVER['REQUEST_URI'], 'cursor' , $previousCursor , '') , 'page', $previouspage ); ?>" >
                <i class="fa fa-backward"></i>
                </a>
                <?php } else { ?>
                <i class="fa fa-backward" style="color:#d4d4d4" data-toggle="tooltip" data-placement="top" title="No Previous Page"></i>
                  <?php } ?>
                </div>
        <div class="table-pagination-text">Page <?= $page; ?> - <?= $page % count($activeFollowUsersFollowersList); ?></div>
        
        <div class="table-pagination-arrows">
            <?php if($nextCursor != 0) { ?>
            <a href="<?php echo $common->getUrl($common->getUrl($_SERVER['REQUEST_URI'], 'cursor' , $nextCursor , ''), 'page' , $nextpage ); ?>"><i class="fa fa-forward "></i></a>
            <?php } else { ?>
            <i class="fa fa-forward " style="color:#d4d4d4" data-toggle="tooltip" data-placement="top" title="No Next Page"></i>
            <?php } ?>
            </div>
    </div>
</div>
<?php } ?>



 

        </section>
        

    </article>
   </div>
   

<script>
 var  last_tweet_response = '';
    function changeTab(attrubute) {
        $('.followers-tabs li  span').removeClass('active');
        $('#follower-search-type').val($(attrubute).attr('tab'))
        if($(attrubute).attr('tab') == 'hashtag') {
            $('#hashtag-follower-search').css('display', 'block');
            $('#username-follower-search').css('display', 'none');
            
        } else if ($(attrubute).attr('tab') == 'username') {
            $('#hashtag-follower-search').css('display', 'none');
            $('#username-follower-search').css('display', 'block');
        }
        $(attrubute).children('span').addClass("active");
        

    }
  
   
</script>


<script>
    function addFollowAction(attr) {
        var $this = attr;
        var userId = $(attr).attr('user-id');
        var accountId = $(attr).attr('account-id');
        var settings = {
  "async": true,
  "crossDomain": true,
  "url": "action/followUserProcess.php?user-id="+userId+"&account-id="+accountId,
  "method": "GET",
  "headers": {
    "cache-control": "no-cache",
    "postman-token": "8ba15e51-4987-fa06-634c-be9119623adf"
  }
}
$('.loader-img-'+userId).html('<img  style="width:80px;" src="../../images/loader.gif" style="width:80px">'); 

$.ajax(settings).done(function (response) {
    var resp = JSON.parse(response);
    if(resp.success == true) {
        //$(attr).parent().closest('tr').css('display', 'none');
        addFollowList($this , "followed")
    } else {
        alert('There is issue.  please try agian');
    }

});
    }
    
    function addFollowList(attr , type="Added") {
 

          var listId =  $(attr).attr('list-id');
     var slug = $(attr).attr('slug');
     var userId = $(attr).attr('user-id');
     var userName = $(attr).attr('user-name');
     var screenName = $(attr).attr('screen-name');
     var accountId = $(attr).attr('account-id');
     var listUrl = $(attr).attr('list-url');
            $('.loader-img-'+userId).html('<img  style="width:80px;" src="../../images/loader.gif" style="width:80px">'); 
            $('.loader-img-'+userId).css('width', '28px'); 
    var settings = {
  "async": true,
  "crossDomain": true,
  "url": "action/addMamberInlistProcess.php?account-id="+accountId+"&list-id="+listId+"&slug="+slug+"&user-id="+userId+"&screen-name="+screenName,
  "method": "GET",
  "headers": {
    "cache-control": "no-cache",
    "postman-token": "e07095b9-ad0a-050c-397b-7dcbaf25defd"
  }
}
    $.ajax(settings).done(function (response) {
     var resp = JSON.parse(response);
     $('#twitter-member-user').append(resp.member_count);
     
     $('#user-'+userId).hide('slow');
    $('.loader-img-'+userId).html('<strong>Not Found</strong>');    
     $('body').cornerpopup({
    'variant': 9,
    shadow: 1,
    timeout: 5000000000,
    delay: 10,
    colors:"#85ce36",
    header: userName+ " has been "+type,
    button3:"View list on twitter",
     // link for other popups
    link2:"https://twitter.com"+listUrl+"/members",

    
    text2:'Added '+resp.member_count+'  @users to Twitter list',


});
setTimeout(function(){ $('.corner-btn-close').attr('target','_blank'); }, 0);
    });
     
 }
   
   function onClose() {
    $('#follow-list-text').css('display' , 'none');  
 }

    var url = '';
    $("select.select-follow-user").change(function(){
        var screen_name = $(this).children("option:selected").val();
        url = new URL(window.location.href);
        url.searchParams.set('usernames',screen_name);
        $(location).attr('href',url.href);

    });




//search criter

$(document).ready(function() {
    
    // Setup - add a text input to each footer cell
    $('#follow-user-table thead tr').clone(true).appendTo( '#follow-user-table thead' );
    $('#follow-user-table thead tr:eq(1) th').each( function (i) {
        var title = $(this).text();
        $(this).html( '<input class="form-control datatable-input" type="text" placeholder="Search '+title+'" />' );
 
        $( 'input', this ).on( 'keyup change', function () {
            if ( table.column(i).search() !== this.value ) {
                table
                    .column(i)
                    .search( this.value )
                    .draw();
            }
        } );
    } );
 
    var table = $('#follow-user-table').DataTable( {
        orderCellsTop: true,
        fixedHeader: true,
         "lengthMenu": [ 5, 10, 25, 50, 75, 100 ]
    } );

 $('#follow-user-table_filter').css('display', 'none');
} );
    $(document).ready(function() {
        
         $('#follow-tags-table thead tr').clone(true).appendTo( '#follow-tags-table thead' );
    $('#follow-tags-table thead tr:eq(1) th').each( function (i) {
        var title = $(this).text();
        $(this).html( '<input class="form-control datatable-input" type="text" placeholder="Search '+title+'" />' );
 
        $( 'input', this ).on( 'keyup change', function () {
            if ( table.column(i).search() !== this.value ) {
                table
                    .column(i)
                    .search( this.value )
                    .draw();
            }
        } );
    } );
 
    var table = $('#follow-tags-table').DataTable( {
        orderCellsTop: true,
        fixedHeader: true,
         "lengthMenu": [ 5, 10, 25, 50, 75, 100 ]
    } );
    $('#follow-tags-table_filter').css('display', 'none');
} );

    
//search criter
function filterCriteriaAction(filterArray) {
$('.table-filter').css('display','none');
$('.loader-table').css('display','block');
$('.memberlist').css('display','block');

		
$('.loader-img').html('<img  style="width:80px;" src="../../images/loader.gif" style="width:80px">');
$('#follow-user-table_length').css('display','none');
$('#follow-tags-table_length').css('display','none');

var filterListingArray = JSON.stringify(filterArray);
var type = "<?= $_GET['type']; ?>";
if(type == "username") {
var activeFollowUsersFollowersList = <?php echo json_encode($activeFollowUsersFollowersList); ?>;
activeFollowUsersFollowersList = JSON.stringify(activeFollowUsersFollowersList);

    
}
if(type == "hashtag") {
var activeFollowUsersFollowersList = <?php echo json_encode($tagsUsers); ?>;
activeFollowUsersFollowersList = JSON.stringify(activeFollowUsersFollowersList);
}

var twitterLogs = <?php echo json_encode($twitterLogs); ?>;
console.log(twitterLogs);
twitterLogs = JSON.stringify(twitterLogs);

var settings = {
  "async": true,
  "crossDomain": true,
  "url": "action/filterCriteriaProcess.php",
  "method": "POST",
  "headers": {
    "cache-control": "no-cache",
    "postman-token": "8ba15e51-4987-fa06-634c-be9119623adf"
  },
  "data": {
    "filterArray": filterListingArray,
    "activeFollowUsersFollowersList": activeFollowUsersFollowersList,
    "twitterLogs" : twitterLogs,
    "type":type
  }
}
$.ajax(settings).done(function (response) {
   var resp = JSON.parse(response);
     if(resp && resp.length > 0) {

    var html = '';
		 html += "<div class='table-responsive'>";
        if(type == "username") {
			
        html += "<table id='follow-user-table' class='table table-striped table-bordered twitter-account-table twitter-follower-table' >";
        }
        if(type == "hashtag") {
        html += "<table id='follow-tags-table' class='table table-striped table-bordered twitter-account-table twitter-follower-table' >";
        }
        html += "<thead>";
        html += "<tr>";
        html += "<th>@User </th>";
        html += "<th>Bio</th>";
        html += "<th>Location</th>";
        html += "<th>Last Tweeted</th>";
        html += "<th>Last Activity</th>";
        html += "<th>Followers</th>";
        html += "<th>Followings</th>";
        html += "<th>Tweet Count</th>";
       
        html += "<th>Varified?</th>";
        html += "<th>Member since</th>";
        html += "</tr>";
        html += "</thead>";
        html += "<tbody class='twitter-account-table-body-username'>";
        
   $.each( resp, function( index, user ) {
       html += "<tr id='user-"+user.id +"'>";
       html += "<td><div style='display:flex;' ><div ><img src="+user.profile_image_url+" style='min-width: 67px;border-radius: 50%;margin-right: 10px;' class='tweeter-avatar'> </div> <div style='text-align:left;' class='follower-user-name'><b style='font-size: 15px;'>@"+user.screen_name+"</b> <span style='color:#a4a4a4'>"+user.name+" <img class='loader-img-"+user.id +"' style='display:none;width:28px;' src='../../images/loader.gif' style='width:28px;'></span><div style='display:flex'><button style='margin-right:2px' onClick='addFollowAction(this)' list-id='<?= $twitterSingleDetail['followed_list_data']->id; ?>' list-url='<?= $twitterSingleDetail['followed_list_data']->uri; ?>' slug='<?= $twitterSingleDetail['followed_list_data']->slug; ?>'   user-name="+user.name+" user-id="+user.id+" screen-name="+user.screen_name+" account-id='<?= $_GET['id']; ?>' class='btn btn-primary btn-sm'><i class='fa fa-plus'></i> Follow </button><button onCLick='addFollowList(this)' list-id='<?= $twitterSingleDetail['list_data']->id; ?>' slug='<?= $twitterSingleDetail['list_data']->slug; ?>'  list-url='<?= $twitterSingleDetail['list_data']->uri; ?>'  user-name="+user.name+" user-id="+user.id+" screen-name="+user.screen_name+" account-id='<?= $_GET['id']; ?>' class='btn btn-primary btn-sm'><i class='fa fa-plus'></i> Follow List</button></div></div></div></td>";
       html += "<td>"+user.description+"</td>";
       html += "<td>"+user.location+"</td>";
        var status = user.status;
        html += "<td>";
        if(type == "hashtag") {
		var hashsettings = {
  "async": false,
  "crossDomain": true,
  "url": "action/dateFormatChange.php",
  "method": "POST",
  "data": {
    "dateFormatChange": user.publihed_last_tweet
    }
}
$.ajax(hashsettings).done(function (response) {
   last_tweet_response = response ;

});
 html += last_tweet_response ;
	   }
	   else if (type == "username"){
        var status = user.status;
	   if(status) {
        html += status.created_at; 
        } else {
            html += 'Never Tweeted'; 
        }
	   }
        
        html += "</td>";
        html +="<td>"+user.last_activity+"</td>";
        html += "<td>"+user.followers_count+"</td>";
        html += "<td>"+user.friends_count+"</td>";
        html += "<td>"+user.statuses_count+"</td>";
        
        if(user.verified) {
        html += "<td>Yes</td>";
        } else {
             html += "<td>No</td>";
        }
        html += "<td> "+user.created_at+"</td>";
       
       html += "</tr>";
 
});
html += "</tbody>";
html += "</table>";
html += "</div>";		 
if(type == "username") {

     $('#follow-user-table-container').html("");
    $('#follow-user-table-container').html(html);
    $('#follow-user-table thead tr').clone(true).appendTo( '#follow-user-table thead' );
    $('#follow-user-table thead tr:eq(1) th').each( function (i) {
        var title = $(this).text();
        $(this).html( '<input class="form-control datatable-input" type="text" placeholder="Search '+title+'" />' );
 
        $( 'input', this ).on( 'keyup change', function () {
            if ( table.column(i).search() !== this.value ) {
                table
                    .column(i)
                    .search( this.value )
                    .draw();
            }
        } );
    } );
 
    var table = $('#follow-user-table').DataTable( {
        orderCellsTop: true,
        fixedHeader: true,
         "lengthMenu": [ 5, 10, 25, 50, 75, 100 ]
    } );

    $('#follow-user-table_filter').css('display', 'none');
    $('.loader-table').css('display','none');
$('#follow-user-table_length').css('display','');

    $('.table-filter.username').css('display','');
} else if(type == "hashtag"){
        $('#follow-tags-table-container').html("");
        $('#follow-tags-table-container').html(html);
        //data table
             $('#follow-tags-table thead tr').clone(true).appendTo( '#follow-tags-table thead' );
    $('#follow-tags-table thead tr:eq(1) th').each( function (i) {
        var title = $(this).text();
        $(this).html( '<input class="form-control datatable-input" type="text" placeholder="Search '+title+'" />' );
 
        $( 'input', this ).on( 'keyup change', function () {
            if ( table.column(i).search() !== this.value ) {
                table
                    .column(i)
                    .search( this.value )
                    .draw();
            }
        } );
    } );
 
    var table = $('#follow-tags-table').DataTable( {
        orderCellsTop: true,
        fixedHeader: true,
         "lengthMenu": [ 5, 10, 25, 50, 75, 100 ]
    } );
         //data table
        $('#follow-tags-table_filter').css('display', 'none');
        $('.table-filter.hashtag').css('display','');
        $('.loader-table').css('display','none');
        $('#follow-tags-table_length').css('display','');

}
}
else {
    $('.table-filter.hashtag').css('display','none');
        $('.table-filter.username').css('display','none');
  $('.loader-table').css('display','block');
	$('.memberlist').css('display','block');
	
    $('.loader-img').html('<strong>Not Found</strong>');
    }
    
  });
  

}
$('document').ready(function()
{
    $('.datatable-input').css("width","auto");
     var fontSize = '13px';
    var styleContent = '.datatable-input:-moz-placeholder {font-size:' + fontSize + ';} .datatable-input::-webkit-input-placeholder {font-size:' + fontSize + ';}';
    var styleBlock = '<style id="placeholder-style-addfollower">' + styleContent + '</style>';
    $('head').append(styleBlock);
});



</script>
<!-- this filterchange.js is used when  filter change occur and show different filter fields accordingly-->

<?php include_once './../includes/main_footer.php'; ?>






