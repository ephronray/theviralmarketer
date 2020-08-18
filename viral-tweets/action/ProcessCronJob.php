<?php 

require_once(__DIR__.'/../../_libs/dbConnect.php');
require_once(__DIR__.'/../../_libs/twitterSetting.php');

$db = new dbConnect();
date_default_timezone_set('UTC');
$response = $db->showTweetforChrone();
 $dbArray = [];
  foreach($response as $value)
  {
$givendate = date_create($value['time_post']);
$now =  date('Y-m-d H:i:s');
$time   = strtotime($now);
$time   = $time - (60*60); //one hour
$beforeOneHour = date("Y-m-d H:i:s", $time);
$newdate = date_create($beforeOneHour);

$accountId = $value['account_id'];

if($value['status'] == 0 )
{

  if((date_format($givendate,"Y-m-d") == date_format($newdate,"Y-m-d"))&& (date_format($givendate,"h:i") == date_format($newdate,"h:i"))) { 
      $twitter = new TwitterSetting();
     $tweetid =  0 ; 
    $id = $value['id'];
    $resultarray = "Published Successfully";
     $dbArray = array("account_id"=>$accountId,"category_id"=>$value['category_id'], "type"=>$value['type'] ,"data"=>$value['data'] ,"time_post"=>$value['time_post'] , "status"=>$value['status'],"tweet_id"=>$tweetid); 
    $responsedata = $twitter->postTweet($dbArray);
 
    if($responsedata['status'] == "success") {
    $tweetid = $responsedata['response']->id;
     
    $result = "Published Successfully";
    $status = 1; 
      $data = array("result"=>$result,"tweet_id"=>$tweetid,"status"=>$status,"timepost"=>$value['time_post']);
    $response = $db->updateTweetforChrone($data,$id);
    } else {
        
     $id = $value['id'];
    $result = "pending";
    $status = 0; 
    $data = array("result"=>$responsedata['message'],"tweet_id"=>$tweetid,"status"=>$status,"timepost"=>date('Y-m-d h:i'));
    $response = $db->updateTweetforChrone($data,$id);
    }
    
}


  }
  }


?>
