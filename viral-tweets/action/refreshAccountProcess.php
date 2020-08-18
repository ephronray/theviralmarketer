<?php
require_once (__DIR__.'/../../_libs/twitterSetting.php');

$twitter = new TwitterSetting();

if(isset($_GET['id'])) {
    $twitter->refreshTwitterAccount($_GET['id']);
}