
  <?php
	 $url = "http://localhost:3000/merchant/ea9be4db-ae89-4769-abbd-3ec916ff57cc/new_address?password=".urlencode("Passw0rd@0271")."&label=razatest&api_code=0c2b010c-a5ea-4699-9aa1-70f2794d8e9f";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_URL, $url);
	$ccc = curl_exec($ch);
    $json = json_decode($ccc, true);
   	echo "<pre>";
    var_dump($json);
    echo "</pre>";
?>