<?php
if($_GET['code']){
  $code = $_GET['code'];
  $client_id = '986293143775-n7juk31aha6scli5j007m7j74llrg14k.apps.googleusercontent.com';
  $client_secret = 'i7aZh-f6BA27vpg1ojh903eg';
  $redirect_uri = 'http://localhost/admin_services/api_google_calendar/index.php';
  $grant_type = 'authorization_code';
  $url = "https://www.googleapis.com/oauth2/v4/token";
  $content = "code=" . $code . "&client_id=" . $client_id . "&client_secret=" . $client_secret . "&redirect_uri=" . $redirect_uri . "&grant_type=" . $grant_type;
  $curl = curl_init($url);
  curl_setopt($curl, CURLOPT_HEADER, false);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_POST, true);
  curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
  $response = curl_exec($curl);
  curl_close($curl);
  unset($curl);
  var_dump($response);
  if(!empty($response) && !empty($response['access_token'])){
      //create event
      $url_create_event = 'https://www.googleapis.com/calendar/v3/calendars/primary/events';
      $content_create_event = "access_token=".$response->access_token;
      $curl = curl_init($url_create_event);
      curl_setopt($curl, CURLOPT_HEADER, false);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($curl, CURLOPT_POST, true);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $content_create_event);
      $response_creating_event = curl_exec($curl);
      curl_close($curl);
      if(!empty($response_creating_event)){
        echo 'Evénement '.$i;
        var_dump($response_creating_event);
      }
      //events since 30 days
      // $next_date = date('Y-m-d', strtotime("+30 days"));
      $url_list_events = 'https://www.googleapis.com/calendar/v3/calendars/primary/events';
      $content_list_events = "access_token=" . urlencode($response['access_token']) . "&maxResults=" . 30;
      $curl = curl_init($url_list_events);
      curl_setopt($curl, CURLOPT_HEADER, false);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($curl, CURLOPT_POST, true);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $content_list_events);
      $response_list_events = curl_exec($curl);
      curl_close($curl);
  }
}
