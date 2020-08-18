<?php
require_once (__DIR__.'/../../_libs/twitterSetting.php');
require_once(__DIR__.'/../../_libs/dbConnect.php');
$twitter = new TwitterSetting();
$db = new dbConnect();

if(isset($_GET['account-id']) && isset($_GET['tweet-id'])  ) {
$data = array("account-id"=>$_GET['account-id'],"tweet_id"=>$_GET['tweet-id'] );
$twitterdetails = $twitter->reweetTweet($data);
$twitterdetail= $twitterdetails;


if(isset($twitterdetails->errors)) {
    $responseArray = array("success"=>false , "message"=>$twitterdetails->errors[0]->message , 'data'=>$twitterdetails);
    echo json_encode($responseArray);
}
else if(!isset($twitterdetails->errors))
{
$tweetId = $twitterdetails->id; 
$caption = $twitterdetails->text; 
if(isset($twitterdetails->retweeted_status)) {
$retweetedStatus = $twitterdetails->retweeted_status;
$caption = $retweetedStatus->text;
}
$data = json_encode(array("media"=>array(), "caption"=> $caption));
$type = "text";
$result = "Successfully retweet";
$timePost = date('Y-m-d H:i');
$dbArray = array("account_id"=>$_GET['account-id'],"category_id"=>1, "type"=>$type ,"data"=>$data ,"time_post"=>$timePost , "status"=>1 ,"result"=>$result, "tweet_id"=>$tweetId);    
$responseArray = $db->saveTweets($dbArray);
$mesage = "Twitter is  Successfully Retweeted";
 $responseArray = array("success"=>true , "message"=>$mesage , 'data'=>$responseArray);
 echo json_encode($responseArray);
}

// echo json_encode($Result);

    
}
