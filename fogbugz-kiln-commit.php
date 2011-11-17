<?php
 if(!$_REQUEST['payload']) exit();
 require_once 'notify.php';
 
 $payload = json_decode(stripslashes($_REQUEST['payload']), true);

 foreach ($payload['commits'] as $c) {
   $message = "☯ ".contact_to_twitter($c['author'])
   ." committed ".$c['message']
   ." to ".$payload['repository']['name'].": ";

  if (strlen($message) > 120)
    $message = substr($message, 0, 118)."..";
  
  $message .= " ".shorten_url($c['url']); 
  notify($message);
 }
?>
