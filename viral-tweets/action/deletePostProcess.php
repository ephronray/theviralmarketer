<?php
require_once(__DIR__.'/../../_libs/dbConnect.php');
$db = new dbConnect();
if(isset($_GET['id']) && isset($_GET['account_id']) )
{       $id = $_GET['id'];
        $accountid = $_GET['account_id'];
        $tweetdata = $db->showSingleTweet($accountid,$id );
         $media = json_decode($tweetdata['data'])->media;
        foreach($media as $key=>$image){  
                if (file_exists($image)) {
                    unlink($image);
                   
                }
        }
   $response =  $db->deleteTweets($id); 
    echo json_encode($response);
}
?>