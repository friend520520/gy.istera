<?php

date_default_timezone_set('Asia/Taipei');

// Call set_include_path() as needed to point to your client library.
require_once 'google-api-php-client-master/src/Google/Client.php';
require_once 'google-api-php-client-master/src/Google/Service/YouTube.php';
session_start();

/*
 * You can acquire an OAuth 2.0 client ID and client secret from the
 * {{ Google Cloud Console }} <{{ https://cloud.google.com/console }}>
 * For more information about using OAuth 2.0 to access Google APIs, please see:
 * <https://developers.google.com/youtube/v3/guides/authentication>
 * Please ensure that you have enabled the YouTube Data API for your project.
 */
include 'google_api_parameter.php';

$client = new Google_Client();
$client->setClientId($OAUTH2_CLIENT_ID);
$client->setClientSecret($OAUTH2_CLIENT_SECRET);
$client->setScopes('https://www.googleapis.com/auth/youtube');
$redirect = filter_var('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'],
    FILTER_SANITIZE_URL);
$client->setRedirectUri($redirect);

// Define an object that will be used to make all API requests.
$youtube = new Google_Service_YouTube($client);

if (isset($_GET['code'])) {
  if (strval($_SESSION['state']) !== strval($_GET['state'])) {
    die('The session state did not match.');
  }

  $client->authenticate($_GET['code']);
  $_SESSION['token'] = $client->getAccessToken();
  header('Location: ' . $redirect);
}
//bohan++
/*if($client->isAccessTokenExpired()) {

    $authUrl = $client->createAuthUrl();
    header('Location: ' . filter_var($authUrl, FILTER_SANITIZE_URL));

}*/
//bohan--
if (isset($_SESSION['token'])) {
  $client->setAccessToken($_SESSION['token']);
}

// Check to ensure that the access token was successfully acquired.
if ($client->getAccessToken()) {
    
        //echo success;
    
        $_SESSION['token'] = $client->getAccessToken();
        
        
        if( $_SERVER['SERVER_NAME'] === "www.ooxxoox.com" )
        {
                header("Location:http://www.ooxxoox.com/ttshow/web/video_list.php" );
        }
        else
        {
                header("Location:http://ttshow.tw/video_list.php" );
        }
        
} else {
  // If the user hasn't authorized the app, initiate the OAuth flow
    $state = mt_rand();
    $client->setState($state);
    $_SESSION['state'] = $state;
    $authUrl = $client->createAuthUrl();
    
    //$txt = iconv("BIG5","UTF-8", "登入後必須要取得Google帳號-youtube的資料");
    header("Location:$authUrl" );
    
    $htmlBody = <<<END
          
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    </head>
    <body>
    <h3>登入後必須要取得Google帳號-youtube的資料</h3>
    <p>You need to <a href="$authUrl">authorize access</a> before proceeding.<p>
    </body>
    
    
    
END;
}
?>

<!doctype html>
<html>
<head>
<title>Bound Live Broadcast</title>
</head>
<body>
  <?=$htmlBody?>
</body>
</html>