<?php
require_once (__DIR__.'/../../_libs/twitterSetting.php');
require_once (__DIR__.'/../../_libs/dbConnect.php');
$twitter = new TwitterSetting();
$db = new dbConnect();
if(isset($_GET['account-id']) && isset($_GET['tweetid']) && isset($_GET['screenName']) && isset($_GET['postid']) ) {
    if($_GET['tweetid'] != 0)
    {
        $data = array("accountId"=>$_GET['account-id'],"id"=>$_GET['tweetid'] , "screen_name" =>$_GET['screenName']);    
        $response = $twitter->getSingleTweet($data);    
        echo json_encode($response);
    }
    else {
        $response = $db->showSingleTweet($_GET['account-id'],$_GET['postid']);
        echo json_encode($response);
        }
    }
?>