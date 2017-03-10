<?php
$redirect_uri = 'http://localhost/admin_services/api_google_calendar/index.php';
$response_type = 'code';
$client_id = '132686886616-758m46po2am1u2amosgsejq9l0e60104.apps.googleusercontent.com';
$url = 'https://accounts.google.com/o/oauth2/v2/auth?scope=https://www.googleapis.com/auth/calendar&redirect_uri='. $redirect_uri . '&response_type=' . $response_type . '&client_id=' . $client_id;

echo '<a href="'. $url .'">Me connecter au calendrier</a>';
