<?php
require_once(__DIR__.'/../../_libs/dbConnect.php');
$db = new dbConnect();
 if(isset($_GET['id']))
 {
     $mediaitemlist = array();
     $response = $db->showTweets($_GET['id']);
     foreach( $response as $data)
     {
         $datail = json_decode($data['caption']);
         $Tweetmedia[] = $datail->media;
     }
     foreach($Tweetmedia as $media)
     {
         foreach($media as $mediaitem)
     {
         $mediaitemlist[] = $mediaitem;
         
     }
     }
     foreach($mediaitemlist as $value)
     {
          if (file_exists($value))
          {
            unlink($value);
                   
            }
     }
     
     $deleteresponse = $db->deleteaccount($_GET['id']);
    echo json_encode($deleteresponse);

 }


?>