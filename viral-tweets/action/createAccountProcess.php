<?php
require_once (__DIR__.'/../../_libs/twitterSetting.php');

$twitter = new TwitterSetting();
header("Location:".$twitter->oauth());
?>


?>