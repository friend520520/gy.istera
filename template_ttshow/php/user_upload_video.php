<?php

//header("Content-Type:text/html;Charset:utf-8");

if (//($_FILES["file"]["type"] == "text/plain")
($_FILES["file"]["size"] < 2000000000)
//&& in_array($extension, $allowedExts)
) {

    if ($_FILES["file"]["error"] > 0)
    {
        echo "false";
    }
    else {

        if ($_FILES['file']['error'] == UPLOAD_ERR_OK           //checks for errors
            && is_uploaded_file($_FILES['file']['tmp_name'])) {     //checks that file is uploaded

                $filepath = $_FILES['file']['tmp_name'];
                //$txt = file_get_contents($_FILES['file']['tmp_name']);

                $_privacyStatus = $_REQUEST['privacyStatus'];
                $_title = $_REQUEST['title'];
                $_tag = $_REQUEST['tag'];
                $_description = $_REQUEST['description'];
                $_main = $_REQUEST['main'];
                //$_secondary = $_REQUEST['secondary'];


                // Call set_include_path() as needed to point to your client library.
                require_once 'google-api-php-client-master/src/Google/Client.php';
                require_once 'google-api-php-client-master/src/Google/Service/YouTube.php';
                session_start();

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

                if (isset($_SESSION['token'])) {
                    $client->setAccessToken($_SESSION['token']);
                }

            // Check to ensure that the access token was successfully acquired.
                if ($client->getAccessToken()) {

                    /*if( $_privacyStatus === "public" )
                        echo '\$privacyStatus = ' . $_privacyStatus . " ";

                    echo '\$title = ' . $_title . " ";
                    echo '\$tag = ' . $_tag . " ";
                    echo '\$description = ' . $_description . " ";*/

                  try{

                        /*$con = mysqli_connect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
                        $con->query( "SET NAMES utf8" );

                        if (mysqli_connect_errno()) {
                                    echo "false";
                        }
                        else{*/


                            // REPLACE this value with the path to the file you are uploading.
                            //$videoPath = "file/192K.mp4";
                            $videoPath = $filepath;

                            // Create an asset resource and set its snippet metadata and type.
                            // This example sets the video's title, description, keyword tags, and
                            // video category.
                            $snippet = new Google_Service_YouTube_VideoSnippet();
                            $snippet->setTitle( $_title );
                            $snippet->setDescription( $_description );
                            $snippet->setTags(array( $_tag ));
                            /*$snippet->setTitle("Test title");
                            $snippet->setDescription("Test description");
                            $snippet->setTags(array("tag1", "tag2"));*/

                            // Numeric video category. See
                            // https://developers.google.com/youtube/v3/docs/videoCategories/list 
                            //$snippet->setCategoryId("22");
                            $snippet->setCategoryId("23");


                            // Set the video's status to "public". Valid statuses are "public",
                            // "private" and "unlisted".
                            $status = new Google_Service_YouTube_VideoStatus();
                            //$status->privacyStatus = $_description ;
                            if( $_privacyStatus === "public" )
                                $status->privacyStatus = "public";
                            else if( $_privacyStatus === "private" )
                                $status->privacyStatus = "private";
                            else if( $_privacyStatus === "unlisted" )
                                $status->privacyStatus = "unlisted";
                            // Associate the snippet and status objects with a new video resource.
                            $video = new Google_Service_YouTube_Video();
                            $video->setSnippet($snippet);
                            $video->setStatus($status);

                            // Specify the size of each chunk of data, in bytes. Set a higher value for
                            // reliable connection as fewer chunks lead to faster uploads. Set a lower
                            // value for better recovery on less reliable connections.
                            $chunkSizeBytes = 1 * 1024 * 1024;

                            // Setting the defer flag to true tells the client to return a request which can be called
                            // with ->execute(); instead of making the API call immediately.
                            $client->setDefer(true);

                            // Create a request for the API's videos.insert method to create and upload the video.
                            $insertRequest = $youtube->videos->insert( "id,status,snippet,contentDetails", $video );

                            // Create a MediaFileUpload object for resumable uploads.
                            $media = new Google_Http_MediaFileUpload(
                                $client,
                                $insertRequest,
                                'video/*',
                                null,
                                true,
                                $chunkSizeBytes
                            );
                            $media->setFileSize(filesize($videoPath));


                            // Read the media file and upload it chunk by chunk.
                            $status = false;
                            $handle = fopen($videoPath, "rb");
                            while (!$status && !feof($handle)) {
                              $chunk = fread($handle, $chunkSizeBytes);
                              $status = $media->nextChunk($chunk);
                            }

                            fclose($handle);

                            // If you want to make other calls after the file upload, set setDefer back to false
                            $client->setDefer(false);

                            $date = new DateTime( $status['snippet']['publishedAt'] , new DateTimeZone("Asia/Taipei") );
                            //echo $date ->format( 'YmdHis' ) . " ";
                            /*$date = $date ->format( 'YmdHis' );

                            $sql = "INSERT INTO movie( v, main_category, title, description, status, owner, image, upload_time ) VALUES "
                                                . "('" . $status['id'] . "','$_main','" . $status['snippet']['title'] . "','" . $status['snippet']['description'] . "','" . $status['status']['privacyStatus'] . "','" . $status['snippet']['channelId'] . "','" . $status['snippet']['modelData']['thumbnails']['default']['url'] . "'," . $date . ")";


                            if ( mysqli_query( $con , $sql ) ) {

                                echo "success";
                            }
                            else {
                                echo "false";
                            }

                            mysqli_close($con);*/
                            echo "success";

                        //}


                  } catch (Google_ServiceException $e) {
                        echo 'false';
                  } catch (Google_Exception $e) {
                        echo 'false';
                  }

                $_SESSION['token'] = $client->getAccessToken();

                } else {
                    echo "false";
                }

                
                
                
                
        }
        else {
            echo "false";
       }
    }
}
else 
{
    echo "false";
}

?>