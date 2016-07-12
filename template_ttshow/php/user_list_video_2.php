<?php

//http://www.ggyyggy.com/bohan/1-0-3/socialstreaming/api-samples-master/php/my_uploads.php
// Call set_include_path() as needed to point to your client library.
require_once 'google-api-php-client-master/src/Google/Client.php';
require_once 'google-api-php-client-master/src/Google/Service/YouTube.php';
session_start();

        include("config.php");
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

// Check to ensure that the access token was successfully acquired.
if ($client->getAccessToken()) {
  try {
      
        $con = mysqli_connect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
        $con->query( "SET NAMES utf8" );

        if (mysqli_connect_errno()) {
                    echo "false";
        }
        else{
                // Call the channels.list method to retrieve information about the
                // currently authenticated user's channel.
                $channelsResponse = $youtube->channels->listChannels('id,contentDetails', array(
                  'mine' => 'true',
                ));

                $htmlBody = '';
                foreach ($channelsResponse['items'] as $channel) {
                  // Extract the unique playlist ID that identifies the list of videos
                  // uploaded to the channel, and then call the playlistItems.list method
                  // to retrieve that list.
                    $channel['id'];

                    $uploadsListId = $channel['contentDetails']['relatedPlaylists']['uploads'];

                    $playlistItemsResponse = $youtube->playlistItems->listPlaylistItems('contentDetails,id,snippet,status', array(
                      'playlistId' => $uploadsListId,
                      'maxResults' => 50
                    ));

                    $array = array();

                    foreach ($playlistItemsResponse['items'] as $playlistItem) {
                        
                            $date = new DateTime( $playlistItem['snippet']['publishedAt'] , new DateTimeZone("Asia/Taipei") );
                            //echo $date ->format( 'YmdHis' ) . " ";
                            $date = $date ->format( 'YmdHis' );
                            
                            array_push($array, array(
                                                    "iid" => $playlistItem['id'] ,
                                                    "publishedAt" => $playlistItem['snippet']['publishedAt'] , 
                                                    "time" => $date ,
                                                    "channelId" => $playlistItem['snippet']['channelId'] , 
                                                    "description" => $playlistItem['snippet']['description'] ,
                                                    "channelTitle" => $playlistItem['snippet']['channelTitle'] ,
                                                    "playlistId" => $playlistItem['snippet']['playlistId'] ,
                                                    "position" => $playlistItem['snippet']['position'] ,
                                                    "resourceId_kind" => $playlistItem['snippet']['resourceId']['kind'] ,
                                                    "videoId" => $playlistItem['contentDetails']['videoId'] ,
                                                    "startAt" => $playlistItem['contentDetails']['startAt'] ,
                                                    "endAt" => $playlistItem['contentDetails']['endAt'] ,
                                                    "note" => $playlistItem['contentDetails']['note'] ,
                                                    "status" => $playlistItem['status']['privacyStatus'] ,
                                                    
                                                    "image" => $playlistItem['snippet']['thumbnails']['default']['url'] ,
                                                    "id" => $playlistItem['snippet']['resourceId']['videoId'] ,
                                                    "title" => $playlistItem['snippet']['title'] ) );
                            
                            $playlistItem['status']['privacyStatus'];
                            
                            $result = mysqli_query($con, "SELECT * FROM movie WHERE yt_id='" . $playlistItem['snippet']['resourceId']['videoId'] . "'");

                            if (mysqli_num_rows($result) > 0) {

                                $sql = "UPDATE movie SET title='" . $playlistItem['snippet']['title'] . "' , describe='" . $playlistItem['snippet']['description'] . "' , date=$date WHERE yt_id='" . $playlistItem['snippet']['resourceId']['videoId'] . "'";
                                mysqli_query( $con , $sql );
                                
                            }
                            else {
                                
                                $sql = "INSERT INTO movie( user_id, movie_id, class, tag, title, describe, path, image, date, yt_id ) VALUES "
                                    . "('" . $playlistItem['snippet']['channelId'] . "','','','','" . $playlistItem['snippet']['title'] . "','" . $playlistItem['snippet']['description'] . "','https://www.youtube.com/embed/" . $playlistItem['snippet']['resourceId']['videoId'] . "','" . $playlistItem['snippet']['modelData']['thumbnails']['default']['url'] . "','"  . $date . "'," . $playlistItem['snippet']['resourceId']['videoId'] . ")";
                                mysqli_query( $con , $sql );
                                
                            }
                            
                            
                        }
                        //print_r($playlistItem['snippet']);

                    ////[medium][high][standard][maxres][url]
                    mysqli_close($con);
                    echo json_encode($array);

                }
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