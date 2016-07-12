<?php
        
        ini_set( "memory_limit", "256M");
        
        date_default_timezone_set('Asia/Taipei');
        
        include("global.php");
        //user account get login session
        $id = $_REQUEST['id'];
                         
        
        /* ++ abin ++ */
        if( $_REQUEST['upload'] == "transient_file" && isset($_REQUEST['upload']) && !empty($_REQUEST['upload']) ) {
/*
                $c = json_decode( stripslashes($value) );
                foreach ($c as $a => $b)  {
                    echo $a." != ".$b;
                }
*/
                $filepath_o = $upload_transient_file.$_REQUEST['transient_file'];
                if( file_exists($filepath_o) && $_REQUEST['transient_file'] != "" && isset($_REQUEST['transient_file']) && !empty($_REQUEST['transient_file']) ) {
                    unlink($filepath_o);
                }
                $time = udate('YmdHisu');
                $filepath = $upload_transient_file.$time.".".$_REQUEST['subname'];
                $httppath = "http://".$_SERVER["SERVER_NAME"]."/TTSHOW/transient_file/".$time.".".$_REQUEST['subname'];
                move_uploaded_file( $_FILES["file"]["tmp_name"] , $filepath );
                if( file_exists($filepath) ) {
                    $json{"http"} = $httppath;
                    $json{"filename"} = $time.".".$_REQUEST['subname'];
                    echo json_encode( $json );
                } else {
                    echo "false";
                }
        } else if( $_REQUEST['type'] == "special_icon" && isset($_REQUEST['type']) && !empty($_REQUEST['type']) ) {
                $path = $server_specialIcon_path;
                $time = date("YmdHis");
                move_uploaded_file( $_FILES["file"]["tmp_name"] , $path  . $time."_".$_FILES["file"]["name"] );
                if( file_exists( $path  . $time."_".$_FILES["file"]["name"] ) ) {
                    echo "http://".$_SERVER["SERVER_NAME"]."/ttshow/Include_file/img/Special_icon/".$time."_".$_FILES["file"]["name"];
                } else {
                    echo "false";
                }
        }
        /* -- abin -- */
        else 
	{
                
                $path = $server_website_path;
                
                $time = udate('YmdHisu');

                if( $_FILES["file"]["type"] === "image/gif" )
                    $filetype = "gif";
                else if( $_FILES["file"]["type"] === "image/jpeg" )
                    $filetype = "jpg";
                else if( $_FILES["file"]["type"] === "image/png" )
                    $filetype = "png";

                $newfilename = $time . "." . $filetype;

                if( $id === "" )
                    $id = "default";

                if( !file_exists( $path . "/$id" ) )
                {
                        mkdir( $path . '/' . $id , 0777);
                        mkdir( $path . '/' . $id . "/original", 0777);
                        mkdir( $path . '/' . $id . "/thumbnailS", 0777);
                        mkdir( $path . '/' . $id . "/thumbnailM", 0777);
                        mkdir( $path . '/' . $id . "/preview", 0777);
                }
                $allowedExts = array("gif", "jpeg", "jpg", "png");
                $temp = explode(".", $_FILES["file"]["name"]);
                $extension = end($temp);

                if ((($_FILES["file"]["type"] == "image/gif")
                || ($_FILES["file"]["type"] == "image/jpeg")
                //|| ($_FILES["file"]["type"] == "image/jpg")
                || ($_FILES["file"]["type"] == "image/png"))
                && ($_FILES["file"]["size"] < 5242880)
                && in_array($extension, $allowedExts)) {
                    if ($_FILES["file"]["error"] > 0)
                    {
                        echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
                    } 
                    else {

                        if (file_exists( $path . "/" . $id . "/original/" . $newfilename )) 
                        {
                            echo $newfilename . " already exists. ";
                        }
                        else
                        {
                            move_uploaded_file( $_FILES["file"]["tmp_name"] , $path . "/" . $id . "/original/" . $newfilename );


                            /////////////////////resize++

                            $filename = $path . "/" . $id  . "/original/" . $newfilename;
                            //$percent = 0.5;

                            // Get new sizes
                            list($width, $height) = getimagesize($filename);
                            //$newwidth = $width * $percent;
                            //$newheight = $height * $percent;

                            ///////////////////////
                            $newbigwidth = 1920;
                            $newbigheight = 1080;

                            if( $newbigwidth/$width > $newbigheight/$height )
                                $newbigwidth = $width*$newbigheight/$height;
                            else if( $newbigheight/$height > $newbigwidth/$width )
                                $newbigheight = $height*$newbigwidth/$width;
                            ///////////////////////
                            $newsmallwidth = 240;
                            $newsmallheight = 180;

                            if( $newsmallwidth/$width > $newsmallheight/$height )
                                $newsmallwidth = $width*$newsmallheight/$height;
                            else if( $newsmallheight/$height > $newsmallwidth/$width )
                                $newsmallheight = $height*$newsmallwidth/$width;
                            ///////////////////////
                            $newmiddlewidth = 480;
                            $newmiddleheight = 360;

                            if( $newmiddlewidth/$width > $newmiddleheight/$height )
                                $newmiddlewidth = $width*$newmiddleheight/$height;
                            else if( $newmiddleheight/$height > $newmiddlewidth/$width )
                                $newmiddleheight = $height*$newmiddlewidth/$width;
                            ///////////////////////
                            // Load
                            $thumb_big = imagecreatetruecolor($newbigwidth, $newbigheight);
                            $thumb_small = imagecreatetruecolor($newsmallwidth, $newsmallheight);
                            $thumb_middle = imagecreatetruecolor($newmiddlewidth, $newmiddleheight);

                            if( $_FILES["file"]["type"] === "image/gif" )
                                $source = imagecreatefromgif($filename);
                            else if( $_FILES["file"]["type"] === "image/jpeg" )
                                $source = imagecreatefromjpeg($filename);
                            else if( $_FILES["file"]["type"] === "image/png" )
                                $source = imagecreatefrompng($filename);

                            // Resize
                            imagecopyresampled($thumb_big, $source, 0, 0, 0, 0, $newbigwidth, $newbigheight, $width, $height);
                            imagecopyresampled($thumb_small, $source, 0, 0, 0, 0, $newsmallwidth, $newsmallheight, $width, $height);
                            imagecopyresampled($thumb_middle, $source, 0, 0, 0, 0, $newmiddlewidth, $newmiddleheight, $width, $height);

                            // Output
                            if( $_FILES["file"]["type"] === "image/gif" )
                            {
                                imagegif ( $thumb_big , $path . "/" . $id  . "/preview/" . $newfilename );
                                imagegif ( $thumb_small , $path . "/" . $id  . "/thumbnailS/" . $newfilename );
                                imagegif ( $thumb_middle , $path . "/" . $id  . "/thumbnailM/" . $newfilename );
                            }
                            else if( $_FILES["file"]["type"] === "image/jpeg" )
                            {
                                imagejpeg( $thumb_big , $path . "/" . $id  . "/preview/" . $newfilename );
                                imagejpeg( $thumb_small , $path . "/" . $id  . "/thumbnailS/" . $newfilename );
                                imagejpeg( $thumb_middle , $path . "/" . $id  . "/thumbnailM/" . $newfilename );
                            }
                            else if( $_FILES["file"]["type"] === "image/png" )
                            {
                                imagepng ( $thumb_big , $path . "/" . $id  . "/preview/" . $newfilename );
                                imagepng ( $thumb_small , $path . "/" . $id  . "/thumbnailS/" . $newfilename );
                                imagepng ( $thumb_middle , $path . "/" . $id  . "/thumbnailM/" . $newfilename );
                            }
                        }
                    }
                    echo "http://".$_SERVER["SERVER_NAME"]."/ttshow/account/".$id."/original/".$newfilename;
                } else {
                        echo "Invalid file";
                }
        }
        
        function udate($format = 'u', $utimestamp = null) {
                if (is_null($utimestamp))
                    $utimestamp = microtime(true);

                $timestamp = floor($utimestamp);
                $milliseconds = round(($utimestamp - $timestamp) * 1000000);

                return date(preg_replace('`(?<!\\\\)u`', $milliseconds, $format), $timestamp);
        }


?>