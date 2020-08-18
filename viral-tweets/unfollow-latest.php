<?php 
session_start();
$menu = array('tab'=>4, 'option' => 'viral-tweet');

$currentpage = "unfollow";

require_once (__DIR__.'/../includes/main-header.php');
require_once (__DIR__.'/../_libs/twitterSetting.php');
require_once (__DIR__.'/../_libs/commonHelper.php');
require_once (__DIR__.'/../_libs/dbConnect.php');
$db = new dbConnect();

$twitter = new TwitterSetting();
 $common = new CommonHepler();
// //FollowBack status
  $data = array('accountId'=>$_GET['id']);
  $twitterLogs = $db->showTwitterLogs($data);
 $twitterFollowerIds =  $twitter->getFollowersIds($data);

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
function twitterIds($user_id , $twitterFollowerIds) {
$status = "";
foreach($twitterFollowerIds as $twitterid )
{
    // echo $twitterid;
    if($twitterid == $user_id )
    {
    $status = "Yes";
    
    } 
    else {
    $status = "No";    
    }
    
}
return $status;
}


// add tweeter account
 if(isset($_SESSION["twitter_oauth_token"]) && isset($_SESSION["twitter_oauth_token_secret"])){ 
    $twitter->saveNewTwitterAccount();
}
// add tweeter account

//get all tweeter Accounts

$alltwitterAccountDetail = $twitter->getAccountDetails();

//get all tweeter accounts

$previousCursor = 0;
$nextCursor = 0;
$page = isset($_GET['page'])?$_GET['page']:1;
$currentActiveUserFollowers;
//get single tweeter account
if(isset($_GET['id'])) {
  $twitterSingleDetail =  $twitter->getSingleAccountDetail($_GET['id']);
$cursor = isset($_GET['cursor']) ? $_GET['cursor'] :-1;
 $data = array('accountId'=>$_GET['id'],'cursor'=>$cursor );
  $allfriendsList =  $twitter->getSelfFriends($data); 
  $allActiveFrindListUser = $allfriendsList->users;
  $nextCursor     =  $allfriendsList->next_cursor;
  $previousCursor =  $allfriendsList->previous_cursor;
}

//get single tweeter account
 
function dateFormatChage($valueDate) {
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
 
 function dateFormatChageForLastAction($valueDate) {
    $date1 = date("Y-m-d", strtotime($valueDate));
    $date2 = date("Y-m-d");
  
 $diff = abs(strtotime($date2) - strtotime($date1));

$years = floor($diff / (365*60*60*24));
$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

$changeyears = $years != 0? (int)$years > 1? $years.' years': $years.' year':"";
$monthschange = $months != 0? $months > 1 ? $months.' month':$months.' months':"" ;
$dayChange = $days != 0? $days > 1 ? $days.' days':$days.' day':"" ;

return $changeyears.($changeyears != ""?" / ":"").$monthschange.($monthschange != ""?" / ":"").$dayChange. ($dayChange != "" ? " ago ": "Today");

 }

?>


 <div class="content-wrapper">
 <section class="content-header">
      <h1>
      Unfollow 
      </h1>
       <p class="title-description">Find the targeted users and then unfollow them.    </p>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        
        <li class="breadcrumb-item "><a href="viral-tweet.php?id=<?= $_GET['id'] ?>">Viral Tweets</a></li>
        <li class="breadcrumb-item active"><a href="#">Unfollow Tweets</a></li>

      </ol>
    </section>
    
     <section class="content-body">


    <article class="content grid-page">

      

        <section class="section">
         <?php require_once (__DIR__.'/../viral-tweets/single-twitter-account.php'); ?>
         
         
         </section>
         </article>
              </section>
    </div>

<?php include_once './../includes/main_footer.php'; ?>
