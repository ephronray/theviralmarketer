<?php 
if(checkSession()) {
	$redirect = $settings['url']."account/wallet";
	header("Location: $redirect");
} 
?>