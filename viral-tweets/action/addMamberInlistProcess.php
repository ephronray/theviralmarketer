<?php
require_once (__DIR__.'/../../_libs/twitterSetting.php');

$twitter = new TwitterSetting();
if(isset($_GET['account-id'])  && isset($_GET['list-id'])   && isset($_GET['slug'] ) && isset($_GET['user-id'] ) && isset($_GET['screen-name'] )) {
    
    $data = array('account-id'=>$_GET['account-id'], 'list-id'=>$_GET['list-id'],'slug'=>$_GET['slug'] , 'user-id'=>$_GET['user-id'] , 'screen-name'=>$_GET['screen-name']);
    
$response =   $twitter->addNewMamberInList($data);

    echo json_encode($response);
    
}

?>