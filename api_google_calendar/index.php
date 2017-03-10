<?php
if($_GET['code']){
  $code = $_GET['code'];
  $client_id = '132686886616-758m46po2am1u2amosgsejq9l0e60104.apps.googleusercontent.com';
  $client_secret = '0BGq2l7dJl3cZKDYpUopb8At';
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
  $response = json_decode($response);
  var_dump($response);
  if(!empty($response) && !empty($response->access_token)){
      //create event
      $evenement1 = json_encode(array("start" => array("date" => "2016-02-01"),"end" => array("date" => "2017-03-15"),"description" => "évent1"));
      var_dump($evenement1);
      $url_create_event = 'https://www.googleapis.com/calendar/v3/calendars/primary/events';
      $content_create_event = "access_token=" . urlencode($response->access_token);
      $curl = curl_init($url_create_event);
      curl_setopt($curl, CURLOPT_HEADER, false);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($curl, CURLOPT_POST, true);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $content_create_event . $evenement1);
      $response_creating_event = curl_exec($curl);
      curl_close($curl);
      if(!empty($response_creating_event)){
        echo '<h3> Evénement créé ! </h3><br>';
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
      $response_list_events = json_decode($response_list_events);
      for($response_list_events->items as $event){
          echo '<h3> Evenement ' . $event['summary'] . ' </h3><br>';
          echo '<p> start : ' . $event['start']['date'] . ' </p><br>';
          echo '<p> end : ' . $event['end']['date'] . ' </p><br>';
          echo '<hr>';
      }
  }
}
