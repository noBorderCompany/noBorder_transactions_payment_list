<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title> noBorder.tech Transactions List </title>
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
	
	$url = 'https://noborder.tech/action/ws/request_list';
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($ch);
	curl_close($ch);
		
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
