<?php

//http://www.ggyyggy.com/bohan/1-0-3/socialstreaming/api-samples-master/php/my_uploads.php
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
$OAUTH2_CLIENT_ID = '243099245928-oge6c8l5k79jn6a1mittcpngn0e91llv.apps.googleusercontent.com';
$OAUTH2_CLIENT_SECRET = 'IZinmFnOXZY5ReO-on6cVkry';

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

if (isset($_SESSION['token'])) {
  $client->setAccessToken($_SESSION['token']);
}

$yt_id = $_REQUEST["yt_id"];

// Check to ensure that the access token was successfully acquired.
if ($client->getAccessToken()) {
  try {
                foreach ($yt_id as $value) {
                        
                        $listResponse = $youtube->videos->delete( $value );
                        echo $listResponse;
                        
                        /*$liveBroadcastsResponse = $youtube->liveBroadcasts->delete( $value );
                        echo $liveBroadcastsResponse . " ";*/
                        
                }
                
  } catch (Google_ServiceException $e) {
        echo "false";
  } catch (Google_Exception $e) {
        echo "false";
  }

  $_SESSION['token'] = $client->getAccessToken();
  
} else {
  echo "false";
}
?>
