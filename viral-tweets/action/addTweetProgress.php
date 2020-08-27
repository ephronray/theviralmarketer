

<?php

ob_start();
//session_start();
//$menu = array('tab'=>4, 'option' => 'viral-tweet');
//include_once './../includes/main-header.php'; 
require_once(__DIR__.'/../../_libs/dbConnect.php');
require_once (__DIR__.'/../../_libs/twitterSetting.php');
require_once(__DIR__.'/../../_libs/contant.php');
//$paid_levels = "SELECT * FROM  `subscribed_levels` WHERE  `sender_ibm` =  '".$_SESSION['user']['ibm']."' AND  `payment_status` = '1'";
//$all_level   = $newsifyObj->db_select($paid_levels);
//$paid_levels =  $all_level->num_rows;

$twitter = new TwitterSetting() ;
$db = new dbConnect();
$paid_facility_list = $db->paidmembers();
if(isset($_POST['submit']))
 {
     
     $saveinMediaLibrary = $_POST['saveinMediaLibrary'];
     $currentdate = $_POST['currentdate'];
     $correctcurrentdateindex = strpos($currentdate , 'GMT');
     $currentdate = substr($currentdate,0,$correctcurrentdateindex);
     $currentdate = date_create($currentdate);
     $currentdate = date_format($currentdate,'Y-m-d H:i');
     $media = array();
     $imageError = false;
     $imageMessage="";
     $caption = $_POST['caption'];
   //  if($_SESSION['user']['ibm'] != 'IBM1') {
	  if(!empty($paid_facility_list)){
				foreach($paid_facility_list as $paid_item){
			 if((($paid_item['slug'] == MembershipConstant::WATERMARK_FOR_TWITTER ) && ($paid_item['is_show'] == 1)) || $paid_item['slug'] != MembershipConstant::WATERMARK_FOR_TWITTER ) {
                
                

			$caption = $caption.'\n &lt;a href=&quot;'.$db->base_url.'/referral/?ref='.$_SESSION['user']['ibm'].'&quot;&gt;Powered By TheViralMarketer&lt;/a&gt;';
		 }}}else{ 
            $caption = $caption.'\n &lt;a href=&quot;'.$db->base_url.'/referral/?ref='.$_SESSION['user']['ibm'].'&quot;&gt;Powered By TheViralMarketer&lt;/a&gt;';
	
             } 
            
     //       }
	
	$datepicker = null; 
     $catagory_id = $_POST['catagory'];
     $Published = 'Published Successfully'; 
if($_POST['shedule'] == 1)     
     {
         $is_sheduled = 0;
                  $Published = 'Pending';  
$date = date_create($_POST['datepicker']);
$datepicker = date_format($date,'Y-m-d H:i');

}    
 
else
{ 
    $datepicker = $currentdate;
     $is_sheduled = 1;
     
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
     }
        }
   


//Multiple Video
//Multiple Image
if($type == 'image'){
    foreach ($_FILES['Image']['tmp_name'] as $key=>$tmp_name) {
        if ($_FILES['Image']['error'][$key] > 0) {
            $imageError = true;
            $imageMessage = 'Please choose photo for new Tweet ';
        } elseif (getimagesize($_FILES['Image']['tmp_name'][$key]) == false) {
            $imageError = true;
            $imageMessage = 'Please choose photo for new Tweet .';
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
                    $dbDirectory = '../../assets/Twitter/images/'.$imageName;
                    
                        $media[] = $dbDirectory; 
     
                } else {
                   $imageError = true;
                    $imageMessage = 'Sorry , Image was not uploaded successfully.Please Try Again';
                }
            }
        }
    }
   
}    //multiple image

if($imageError == false)
{  $data = json_encode(array("media"=>$media, "caption"=> $caption  , "url"=>"null")); 
    if($saveinMediaLibrary == 1)
    {  
        if($is_sheduled == 0)
            {
                $dbArray = array("account_id"=>$account_id,"category_id"=>$catagory_id , "type"=>$type ,"data"=>$data ,"time_post"=>$datepicker , "status"=>$is_sheduled , "result"=>$Published); 
                $responsesave = $db->saveTweets($dbArray);  
                $imageMessage = "Your Tweet is Scheduled";
                echo "<script>window.location.href = '".$db->base_url."/viral-tweets/add-tweet.php?id=".$_GET['id']."&message=".$imageMessage."&status=true';</script>";
                die();    

            }
            else
            {
                $Published = "Unpublished";
                $dbArray = array("account_id"=>$account_id,"category_id"=>$catagory_id , "type"=>$type ,"data"=>$data ,"time_post"=>$datepicker , "status"=>$is_sheduled , "result"=>$Published); 
                $responsesave = $db->saveTweets($dbArray);  
                $imageMessage = "Successfuly Saved Tweet";
                echo "<script>window.location.href = '".$db->base_url."/viral-tweets/add-tweet.php?id=".$_GET['id']."&message=".$imageMessage."&status=true';</script>";
                die();    

            }
        
    }
    else {
    if($is_sheduled == 0)
    {
        $dbArray = array("account_id"=>$account_id,"category_id"=>$catagory_id , "type"=>$type ,"data"=>$data ,"time_post"=>$datepicker , "status"=>$is_sheduled , "result"=>$Published); 
        $responsesave = $db->saveTweets($dbArray);
        $imageMessage = "Your Tweet is Scheduled";
        echo "<script>window.location.href = '".$db->base_url."/viral-tweets/add-tweet.php?id=".$_GET['id']."&message=".$imageMessage."&status=true';</script>";
        die();
    }
    else {
        $dbArray = array("account_id"=>$account_id,"category_id"=>$catagory_id , "type"=>$type ,"data"=>$data ,"time_post"=>$datepicker , "status"=>$is_sheduled  , "result"=>$Published);    
        $result = $twitter->postTweet($dbArray);
        $response = $result['response'];
        $extendedEntities = $response->extended_entities;
        //     foreach($extendedEntities->media as $item) {
        //     $medialist[] = $item->media_url;
        // }
        //     print_r($result);
        // die();
    
        if($result['status'] =='success') {

        $id = (int)$_GET['id'];
        
        $data = json_encode(array("media"=>$media, "caption"=> $caption, "url"=>"null")); 
        $tweetid = $result['response']->id;
      //  print_r($data);
      
        
        $dbArray = array("account_id"=>$account_id,"category_id"=>$catagory_id , "type"=>$type ,"data"=>$data ,"time_post"=>$datepicker , "status"=>$is_sheduled ,"tweet_id"=>$tweetid, "result"=>$Published); 
        //print_r($dbArray);
        //die();
        $responsesave = $db->saveTweets($dbArray);
        
         $imageMessage=$responsesave['message'];
     
        echo "<script>window.location.href = '".$db->base_url."/viral-tweets/add-tweet.php?id=".$_GET['id']."&message=".$imageMessage."&status=true';</script>";
        die();    
        }
        else if($result['status']=='error')
        {
        $imageMessage= $result['message'];

         echo "<script>window.location.href = '".$db->base_url."/viral-tweets/add-tweet.php?id=".$_GET['id']."&message=".$imageMessage."&status=true&error=true';</script>";
        die();
        }

    }

}
}
if( $imageError == true)
{
         echo "<script>window.location.href = '".$db->base_url."/viral-tweets/add-tweet.php?id=".$_GET['id']."&message=".$imageMessage."&status=true&error=true';</script>";
        die();
}

}
ob_end_flush();
?>

