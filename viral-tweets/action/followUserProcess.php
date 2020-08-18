<?php 
require_once (__DIR__.'/../../_libs/twitterSetting.php');
$twitter = new TwitterSetting();

if(isset($_GET['user-id']) && isset($_GET['account-id'])) {
    $data = array('user-id'=>$_GET['user-id'], 'account-id'=>$_GET['account-id']);
$response = $twitter->addFollow($data);
   echo json_encode($response);
   
}
?>