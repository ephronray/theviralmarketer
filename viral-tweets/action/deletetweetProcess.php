
<?php  
require_once(__DIR__.'/../../_libs/dbConnect.php');

$db = new dbConnect();
    $mediaIndex =  $_POST['mediaIndex'];
        $tweetId =  $_POST['tweetId'];
    $array = json_decode($_POST['dataArray']);
    $media = $array->media;
    $selectedMedia = $media[$mediaIndex];
     if (file_exists($selectedMedia))
    {
    unlink($selectedMedia);
   }
                
     array_splice($media,$mediaIndex,1);
    
     $array->media = $media;
    $data = json_encode($array);
  $response = $db->updateTweetMedia($data,$tweetId);
   echo json_encode($response);
   
   
?>