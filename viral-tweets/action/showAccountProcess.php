<?php
require_once (__DIR__.'/../../_libs/twitterSetting.php');

$twitter = new TwitterSetting();

if(isset($_GET['id'])) {
  $twitterSingleDetail =  $twitter->getSingleAccountDetail($_GET['id']);
  echo json_encode($twitterSingleDetail['data_profile']);
}