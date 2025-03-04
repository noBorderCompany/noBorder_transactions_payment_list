<?php

/*
* Plugin Name: Transactions List Sample code
* Description: displays the list of the latest transactions on your website gateway by receiving the API
* Version: 1.1
* Author: noBorder.company
* Author URI: https://noBorder.company
* Author Email: info@noBorder.company
* copyright (C) 2020 noBorder.company
* license http://www.gnu.org/licenses/gpl-3.0.html GPLv3 or later
*/

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title> noBorder.company Transactions List </title>
</head>
<body>

<style type="text/css">
body {text-align: center;}
clear {display: block; clear: both;}
pre{white-space: pre-wrap;}
wrapper {display: block; width: 500px; padding: 20px; margin: 10px auto; text-align: center; background-color: lightblue; border-radius: 5px;}
result {display: block; width: 500px; padding: 20px; margin: 10px auto; text-align: center; background-color: cadetblue; border-radius: 5px; text-align: left;}
result b {color: red;}
</style>

<?php

ini_set('display_errors', 1);

if ($_POST['action'] == 'process') {
	
	$params = array(
		'api_key' => $_POST['api_key'],
		'limit_count' => $_POST['limit_count'],
	); 
	
	$url = 'https://noborder.company/action/ws/request/list';
	$curl = curl_init();
	curl_setopt_array($curl, [
		CURLOPT_URL => $url,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_MAXREDIRS => 5,
		CURLOPT_TIMEOUT => 60,
		CURLOPT_USERAGENT => $_SERVER["HTTP_USER_AGENT"],
		CURLOPT_CUSTOMREQUEST => "POST",
		CURLOPT_POSTFIELDS => json_encode($params),
	]);
	$response = curl_exec($curl);
	curl_close($curl);
	
	$result = json_decode($response, true);
	
	echo '<result>';
	print('<pre>' . print_r($result, true) . '</pre>');
	echo '</result>';
	echo '<clear></clear>';
}

?>

<wrapper>
<form method="post">
<input type="hidden" name="action" value="process">
<input type="text" name="api_key" value="<?= $_POST['api_key']; ?>" placeholder="API Key">
<input type="text" name="limit_count" value="<?= $_POST['limit_count']; ?>" placeholder="Limit Count (1-100)">
<button type="submit"> Get List </button>
</form>
</wrapper>

</body>
</html>
