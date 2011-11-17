<?php

require_once 'twitteroauth.php';

function normalize_email_address($email) {
	$pos = strpos($email, "<");
	if ($pos !== false) {
		$email = substr($email, $pos + 1, -1);
	}
	return $email;
}

function notify_channel($message) {
	global $CHANNEL_KEYS;

	$connection = new TwitterOAuth($CONSUMER_KEY, $CONSUMER_SECRET, $OAUTH_TOKEN, $OAUTH_SECRET);
	$params = array('status' => "$message");
	$status = $connection->post('statuses/update', $params);

	$ch = curl_init("http://xxx.sample.com/post?group=Sample%20Chat&message=" . urlencode($channel . ": " . $message));
	curl_setopt($ch, CURLOPT_HEADER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_exec($ch);
	curl_close($ch);	
}


function shorten_url($url) {
	$ch = curl_init("http://api.bit.ly/v3/shorten?login=YOUR_LOGIN&apiKey=YOUR_API_KEY&domain=j.mp&longUrl=" . urlencode($url));
	curl_setopt($ch, CURLOPT_HEADER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$result = json_decode(curl_exec($ch));
	curl_close($ch);

	return $result->data->url;
}

?>
