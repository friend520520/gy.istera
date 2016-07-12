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

                $videoid = $_REQUEST['videoid'];
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

                  try{
                            
                            $videoId = $videoid;
                            $imagePath = $filepath;
                            
                            //$imagePath = "../template/assets/img/icon_uplaod-01.png";
                            
                            if( is_file($imagePath) )
                                echo " file exist ";
                                
                            echo $_FILES["file"]["type"] . " " . $videoId . " " . $imagePath;
                            
                            
                            $chunkSizeBytes = 1 * 1024 * 1024;

                            // Setting the defer flag to true tells the client to return a request which can be called
                            // with ->execute(); instead of making the API call immediately.
                            $client->setDefer(true);

                            // Create a request for the API's thumbnails.set method to upload the image and associate
                            // it with the appropriate video.
                            $setRequest = $youtube->thumbnails->set($videoId);

                            // Create a MediaFileUpload object for resumable uploads.
                            $media = new Google_Http_MediaFileUpload(
                                $client,
                                $setRequest,
                                'image/png',
                                null,
                                true,
                                $chunkSizeBytes
                            );
                            $media->setFileSize(filesize($imagePath));


                            // Read the media file and upload it chunk by chunk.
                            $status = false;
                            $handle = fopen($imagePath, "rb");
                            while (!$status && !feof($handle)) {
                                $chunk = fread($handle, $chunkSizeBytes);
                                $status = $media->nextChunk($chunk);
                            }

                            fclose($handle);

                            // If you want to make other calls after the file upload, set setDefer back to false
                            $client->setDefer(false);


                            $thumbnailUrl = $status['items'][0]['default']['url'];
                            
                            
                            echo $thumbnailUrl;

                        //}


                  } catch (Google_ServiceException $e) {
                        echo 'false';
                  } catch (Google_Exception $e) {
                        echo $e;
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