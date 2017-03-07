<?php
$redirect_uri = 'http://localhost/admin_services/api_google_calendar/index.php';
$response_type = 'code';
$client_id = '986293143775-n7juk31aha6scli5j007m7j74llrg14k.apps.googleusercontent.com';
$url = 'https://accounts.google.com/o/oauth2/v2/auth?scope=https://www.googleapis.com/auth/calendar&redirect_uri='. $redirect_uri . '&response_type=' . $response_type . '&client_id=' . $client_id;

echo '<a href="'. $url .'">Me connecter au calendrier</a>';
