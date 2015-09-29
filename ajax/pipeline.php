<?php

$json = array();

$captcha = $_GET['g-recaptcha-response'];
$ipAddress = $_GET['ip-address'];

try{

  if($captcha){

    $gCurl = curl_init("https://www.google.com/recaptcha/api/siteverify");
    $gCurlPost = array(
      "secret" => "6LeZvg0TAAAAAMOvPQANX3qtIQ4ZS4XGC9-ERvvb",
      "response" => $captcha,
      "remoteip" => $ipAddress
    );
    curl_setopt($gCurl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($gCurl, CURLOPT_POST, true);
    curl_setopt($gCurl, CURLOPT_POSTFIELDS, $gCurlPost);
    $gCurlResponse = curl_exec($gCurl);
    curl_close($gCurl);

    $response = json_decode($gCurlResponse, true);
    $valid = $response['success'];

    if($valid){

      $pCurl = curl_init("https://api.pipelinedeals.com/api/v3/people.json?api_key=OETZxu9jACPstKsjmhB");
      $pCurlPost = array(
        "person[full_name]" => $_GET['name'],
        "person[email]" => $_GET['email'],
        "person[phone]" => $_GET['phone'],
        "person[website]" => $_GET['website'],
        "person[type]" => "Lead"
      );
      curl_setopt($pCurl, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($pCurl, CURLOPT_POST, true);
      curl_setopt($pCurl, CURLOPT_POSTFIELDS, $pCurlPost);
      $pCurlResponse = curl_exec($pCurl);
      curl_close($pCurl);

      $person = json_decode($pCurlResponse, true);
      $pError = $person['error'];

      // $json['response'] = $person;

      if(!$pError){

        $cCurl = curl_init("https://api.pipelinedeals.com/api/v3/calendar_entries.json?api_key=OETZxu9jACPstKsjmhB");
        $cCurlPost = array(
          "calendar_entry[type]" => "CalendarTask",
          "calendar_entry[association_type]" => "Person",
          "calendar_entry[association_id]" => $person['id'],
          "calendar_entry[active]" => true,
          "calendar_entry[name]" => "Contact " . $_GET['name'],
          "calendar_entry[description]" => $_GET['comments'],
          "calendar_entry[due_date]" => date('Y-m-d')
        );
        curl_setopt($cCurl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($cCurl, CURLOPT_POST, true);
        curl_setopt($cCurl, CURLOPT_POSTFIELDS, $cCurlPost);
        $cCurlResponse = curl_exec($cCurl);
        curl_close($cCurl);

        $calTask = json_decode($cCurlResponse, true);
        $cError = $calTask['error'];

        if(!$cError){
          $json['success'] = true;
        }else{ // if cError
          throw new Exception('Something seems to have gone wrong on our end. Sorry about the inconvience. Please contact Andrew at andrew.goldberg@ishb.us with your inquiry. Again, we apologize for the inconvience, but we look forward to hearing from you soon.');
        }

      }else{ // if pError
        throw new Exception('Something seems to have gone wrong on our end. Sorry about the inconvience. Please contact Andrew at andrew.goldberg@ishb.us with your inquiry. Again, we apologize for the inconvience, but we look forward to hearing from you soon.');
      }

    }else{ // if !valid
      throw new Exception('Invalid captcha. The token may have expired or you already submit. If you are unsure if your message sent, please revalidate the captcha and try again.');
    }

  }else{ // if !captcha
    throw new Exception('Please validate the captcha.');
  }

}catch(Exception $ex){

  $json['error'] = true;
  $json['message'] = $ex->getMessage();

}

echo json_encode($json);
