<?php
require_once (__DIR__.'/../../_libs/twitterSetting.php');
$twitter = new TwitterSetting();
if(isset($_GET['account-id']) && isset($_GET['tweet-id']) && isset($_GET['screenName']) ) {
$data = array("accountId"=>$_GET['account-id'],"id"=>$_GET['tweet-id'] , "screen_name" =>$_GET['screenName']);    
$response = $twitter->getSingleTweet($data);    
echo json_encode($response);
}

// echo $data = json_decode($_GET);
//echo json_encode($data);
// if(isset($_GET['data'])) {
    
//     echo $_GET['tweet-id'];
// }
?>