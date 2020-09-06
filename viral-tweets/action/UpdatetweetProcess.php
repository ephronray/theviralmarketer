<?php
require_once(__DIR__.'/../../_libs/dbConnect.php');
require_once (__DIR__.'/../../_libs/twitterSetting.php');
require_once(__DIR__.'/../../_libs/contant.php');
$twitter = new TwitterSetting() ;
$db = new dbConnect();
if(isset($_POST['submit'])) {
    $currentdate = $_POST['currentdate'];
    $correctcurrentdateindex = strpos($currentdate , 'GMT');
    $currentdate = substr($currentdate,0,$correctcurrentdateindex);
    $currentdate = date_create($currentdate);
    $currentdate = date_format($currentdate,'Y-m-d h:i');
    $unpublishedData =$_POST['unpublishedData'];
    $media =array();
    $tweetid = $_GET['Tweetid'];
    $accountid = $_GET['id'];
    $tweetdata = $db->showSingleTweet($accountid ,$tweetid);
    $imageError = false;
    $imageMessage="";
    $caption = $_POST['caption'];
   
    /** 
     * Add Powered by String in twitter status
     * The String will only append If The member is free
     * And If the member is paid then shuld grant to append
     */
    $userLevel = $db->CheckMemberPaid();
    $referral = false;
    if($userLevel == 0) {
        $referral = true;
    } else {
        $branding = $db->getBrandingValue();
        if($branding == 1) {
            $referral = true;    
        }
    }

    if( $referral ) {
        $caption .= PHP_EOL . PHP_EOL . PHP_EOL;
        $caption .= 'Powered By TheViralTweet → '. $db->base_url.'referral/?ref='.$_SESSION['user']['ibm'];
    }

    /** Add referrer code to tweet end here */
			 
			 
    $datepicker = null; 
     $catagory_id = $_POST['catagory'];
     $Published = 'Published Successfully'; 
if($_POST['shedule'] == 1)     
     {
         $is_sheduled = 0;
                  $Published = 'In Progress';  
$date = date_create($_POST['datepicker']);
$datepicker = date_format($date,'Y-m-d H:i');

}    
 
else
{
     $is_sheduled = 1;
$datepicker = $currentdate;
     
      }
     

$datetime = $currentdate;
// echo $datepicker;

$account_id = $_GET['id'];
$type =  $_POST["type"];
// Video
 
    if($type == 'video'){
    if(empty($_FILES['video']['name']))
        {
            $imageError = true;
            $imageMessage = 'Please choose Video for new Tweet ';
    
        }
     else if(!empty($_FILES['video']['name']))
     {   
             $temp = explode('.', $_FILES['video']['name']);
             $imageName = round(microtime(true)).'.'.end($temp);
            if(end($temp) == 'mp4')
                {
                    $tempImage=$_FILES["video"]["tmp_name"];
                    $directory = '../../assets/Twitter/video/';
                    move_uploaded_file($tempImage,$directory.$imageName);
                    $mediasave = '../../assets/Twitter/video/'.$imageName;
                    $media = array($mediasave);
                }
            else
                {
                $imageError = true;
                $imageMessage = 'The media you tried to upload was invalid.';
                }
     }    }
   


//Multiple Video
//Multiple Image
if($type == 'image'){
     $media = json_decode($tweetdata['data'])->media;
    foreach ($_FILES['Image']['tmp_name'] as $key=>$tmp_name) {
        if ($_FILES['Image']['error'][$key] > 0) {
            $imageError = true;
            $imageMessage = 'Please choose  image for new Tweet';
        } elseif (getimagesize($_FILES['Image']['tmp_name'][$key]) == false) {
            $imageError = true;
            $imageMessage = 'Please choose image for new Tweet';
        } else {
            $temp = explode('.', $_FILES['Image']['name'][$key]);
            $imageName = round(microtime(true)).$key.'.'.end($temp);
            $imageType = $_FILES['Image']['type'][$key];
            $imageSize = $_FILES['Image']['size'][$key];
            $imageTempName = $_FILES['Image']['tmp_name'][$key];
            $validTypes = ['gif', 'jpg', 'jpe', 'jpeg', 'png'];
            $typeExt = pathinfo($imageName);
            $ext = strtolower($typeExt['extension']);
            //extension check
            if (!in_array($ext, $validTypes)) {
               $imageError = true;
                $imageMessage = 'The media you tried to upload was invalid';

            } elseif ($imageSize > 16777216) {
                $imageError = true;
                $imageMessage = 'Sorry, the image size is too big. Shorten it and try again.';
            } else {
                $directory = '../../assets/Twitter/images/';

                if (strlen($imageName) > 225) {
                    $imageName = substr($imageName, -225);
                }
                if (move_uploaded_file($_FILES['Image']['tmp_name'][$key], $directory.$imageName) === true) {
                    $imageMessage = false;
                            $dbDirectory = '../../assets/Twitter/images/' .$imageName;

                    $dbDirectory = '../../assets/Twitter/images/'.$imageName;
                     array_push($media,$dbDirectory); 
                        
                    

                } else {
                   $imageError = true;
                    $imageMessage = 'Sorry,Image was not uploaded successfully.Please Try again';
                }
            }
        }
    }
 
}    //multiple image
if( $imageError == false)
{
  $data = json_encode(array("media"=>$media, "caption"=> $caption, "url"=>"null")); 
    if($unpublishedData == 1)
    { 
        $Published = "Unpublished";
        $dbArray = array("category_id"=>$catagory_id , "type"=>$type ,"data"=>$data ,"time_post"=>$datepicker , "status"=>$is_sheduled , "result"=>$Published,"changedate"=>$datetime);  
        $responsesave = $db->updateTweet($dbArray, $_GET['Tweetid']);
        $imageMessage = "Your Tweet is Updated";
        header("Location: ../add-tweet.php?id=".$_GET['id']."&message=".$imageMessage."&tweetid=".$tweetid."&status=true");
    }
    else
    {
    if($is_sheduled == 0)
    {
        $dbArray = array("category_id"=>$catagory_id , "type"=>$type ,"data"=>$data ,"time_post"=>$datepicker , "status"=>$is_sheduled , "result"=>$Published,"changedate"=>$datetime);  
        $responsesave = $db->updateTweet($dbArray, $_GET['Tweetid']);
        $imageMessage = "Your Tweet is Scheduled";
        header("Location: ../add-tweet.php?id=".$_GET['id']."&message=".$imageMessage."&tweetid=".$tweetid."&status=true");
    }
    else {
        
        $dbArray = array("account_id"=>$account_id,"category_id"=>$catagory_id , "type"=>$type ,"data"=>$data ,"time_post"=>$datepicker , "status"=>$is_sheduled  , "result"=>$Published);    
        $result = $twitter->postTweet($dbArray);
        $response = $result['response'];
        
//        $extendedEntities = $response->extended_entities;
        // foreach($extendedEntities->media as $item) {
        // $medialist[] = $item->media_url;
        // }
        if($result['status']=='success') {
         $id = (int)$_GET['id'];
        //  foreach($media as $key=>$image){  
        //         if (file_exists($image)) {
        //             unlink($image);
                   
        //         }
        // }
        $data = json_encode(array("media"=>$media, "caption"=> $caption, "url"=>"null")); 
        $tweetid = $result['response']->id;
        $dbArray = array("account_id"=>$account_id,"category_id"=>$catagory_id , "type"=>$type ,"data"=>$data ,"time_post"=>$datepicker , "status"=>$is_sheduled ,"tweet_id"=>$tweetid, "result"=>$Published); 
        $responsesave = $db->updateTweet($dbArray, $_GET['Tweetid']);
       $imageMessage=$responsesave['message'];
        header("Location: ../add-tweet.php?id=".$_GET['id']."&message=".$imageMessage."&tweetid=".$_GET['Tweetid']."&status=true");
        }
        else if($result['status']=='error')
        {
        $imageMessage= $result['message'];
        header("Location: ../add-tweet.php?id=".$_GET['id']."&message=".$imageMessage."&tweetid=".$_GET['Tweetid']."&status=true&error=true");
        }

        }
    }
}
    if( $imageError == true)
    {
        header("Location: ../add-tweet.php?id=".$_GET['id']."&message=".$imageMessage."&tweetid=".$_GET['Tweetid']."&status=true&error=true");
    }

}
 ?>