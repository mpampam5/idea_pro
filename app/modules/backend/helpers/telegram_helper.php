<?php

function send_log($pesan='')
{
  // $pesan = urlencode($_GET["pesan"]);
  $token = "bot"."696535164:AAFWajPfINvRpAEA5XWf4LWKCSRb_xfDMYI";
  $chat_id = "627240491";
  $proxy = "";

  $url = "https://api.telegram.org/$token/sendMessage?parse_mode=markdown&chat_id=$chat_id&text=$pesan";

  $ch = curl_init();

  if($proxy==""){
  	$optArray = array(
  		CURLOPT_URL => $url,
  		CURLOPT_RETURNTRANSFER => true,
  		CURLOPT_CAINFO => "C:\cacert.pem"
  	);
  }
  else{
  	$optArray = array(
  		CURLOPT_URL => $url,
  		CURLOPT_RETURNTRANSFER => true,
  		CURLOPT_PROXY => "$proxy",
  		CURLOPT_CAINFO => "C:\cacert.pem"
  	);
  }

  curl_setopt_array($ch, $optArray);
  $result = curl_exec($ch);

  $err = curl_error($ch);
  curl_close($ch);

  if($err<>""){
    return false;
  }else {
    return true;
  }

}
