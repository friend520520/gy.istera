<?php


    include("config.php");
    include 'global.php';
    
    $filepath_o = $upload_transient_file.$_REQUEST['icon'];
    
    $subname = substr( $_REQUEST['icon'] , strrpos( $_REQUEST['icon'] , ".")+1 , strlen( $_REQUEST['icon'] )+1-strrpos($_REQUEST['icon'], ".") );
    $page_path = $server_page_path."2122/";
    $filepath_to = $page_path."Original/pagicon.".$subname;
    
    copy( $filepath_o , $filepath_to );
    mkdir_trun_picture( $filepath_to , $page_path , "pagicon.".$subname );
    
    echo "<a href='http://www.ooxxoox.com/ttshow/web/data/2122/Original/pagicon.png?123'>Original</a>";
    echo "<a href='http://www.ooxxoox.com/ttshow/web/data/2122/Preview/pagicon.png?1232131'>Preview</a>";
    echo "<a href='http://www.ooxxoox.com/ttshow/web/data/2122/ThumbnailM/pagicon.png?324234'>ThumbnailM</a>";
    echo "<a href='http://www.ooxxoox.com/ttshow/web/data/2122/ThumbnailS/pagicon.png?2456546'>ThumbnailS</a>";
    echo "pagicon.".$subname;
    
    function mkdir_trun_picture( $src , $to , $fileName ) {
            $data = array(
                array(
                    "path"  => $to."ThumbnailS",
                    "width" => 240,
                    "height" => 180
                ),
                array(
                    "path"  => $to."ThumbnailM",
                    "width" => 480,
                    "height" => 360
                ),
                array(
                    "path"  => $to."Preview",
                    "width" => 1920,
                    "height" => 1080
                ),
            );

            $filetype = substr( $fileName , strrpos($fileName, ".")+1 , strlen($fileName)+1-strrpos($fileName, ".") );
            echo $filetype . " ";
            for( $i=0; $i<count($data); $i++ ) {
                    //mkdir( $data[$i]["path"], 0777);

                    list($width, $height) = getimagesize( $src );   
                    
                    echo $width . " " . $height . " ";
                    
                    if( $data[$i]["width"]/$width > $data[$i]["height"]/$height )
                        $data[$i]["width"] = $width*$data[$i]["height"]/$height;
                    else if( $data[$i]["height"]/$height > $data[$i]["width"]/$width )
                        $data[$i]["height"] = $height*$data[$i]["width"]/$width;
                    
                    //650 365
                    //$data[$i]["width"] = 130;
                    //$data[$i]["height"] = 73;
                    echo $data[$i]["width"] . " " . $data[$i]["height"] . " ";
                    $process_img = imagecreatetruecolor($data[$i]["width"], $data[$i]["height"]);
                    //$process_img = imagecreatetruecolor(130, 73);
                    imagealphablending($process_img,false);
                    imagesavealpha($process_img,true);

                    if( $filetype === "gif" ) {
                        $source = imagecreatefromgif( $src );
                        imagesavealpha($source,true);
                        imagecopyresampled($process_img, $source, 0, 0, 0, 0, $data[$i]["width"], $data[$i]["height"], $width, $height);
                        imagegif ( $process_img , $data[$i]["path"]."/".$fileName );
                    }
                    else if( $filetype === "jpeg" || $filetype === "jpg") {
                        $source = imagecreatefromjpeg( $src );
                        imagesavealpha($source,true);
                        imagecopyresampled($process_img, $source, 0, 0, 0, 0, $data[$i]["width"], $data[$i]["height"], $width, $height);

                        imagejpeg( $process_img , $data[$i]["path"]."/".$fileName );
                    }
                    else if( $filetype === "png" ) {
                        $source = imagecreatefrompng( $src );
                        imagesavealpha($source,true);
                        imagecopyresampled($process_img, $source, 0, 0, 0, 0, $data[$i]["width"], $data[$i]["height"], $width, $height);

                        imagepng ( $process_img , $data[$i]["path"]."/".$fileName );
                    }
                    //imagedestroy($process_img); 
            }

    }
