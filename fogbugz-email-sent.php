<?php

require_once 'notify.php';

if(!$_REQUEST['event']) {
	exit();
}

$eventId = (int) $_REQUEST['event'];
$caseId = (int) $_REQUEST['case'];

$email_subject = $_REQUEST['email_subject'];
$assigned_to = contact_to_twitter($_REQUEST['assigned_to']);
$email_to = $_REQUEST['email_to'];
$email_body_text = $_REQUEST['email_body_text'];
$email_date = $_REQUEST['email_date'];

$email_to = normalize_email_address($email_to);

$message = "✉ $assigned_to sent $email_subject to $email_to";
if (strlen($message) > 120) {
	$message = substr($message, 0, 118)."..";
}
notify("$message ".shorten_url("https://XXX.fogbugz.com/default.asp?$caseId"));
?>
