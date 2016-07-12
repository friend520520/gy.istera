<?php
        
        date_default_timezone_set('Asia/Taipei');
        
        include("global.php");
        //user account get login session
        $email = $_REQUEST['email'];
        $nickname = $_REQUEST['nickname'];
        $born = $_REQUEST['born'];
        $sex = $_REQUEST['sex'];
        $address = $_REQUEST['address'];
        $phone = $_REQUEST['phone'];
        

        
        $path = $server_contribute_path;
        //$path = "../../../ttshow/account";
        $time = udate('YmdHisu');
        
        if( $_FILES["file"]["type"] === "image/gif" )
            $filetype = "gif";
        else if( $_FILES["file"]["type"] === "image/jpeg" )
            $filetype = "jpg";
        else if( $_FILES["file"]["type"] === "image/png" )
            $filetype = "png";
        else if( $_FILES["file"]["type"] === "video/mp4" )
            $filetype = "mp4";
        else if( $_FILES["file"]["type"] === "video/avi" )
            $filetype = "avi";
        
        
        
        $newfilename = $time . "." . $filetype;
        
        if( $id === "" )
            $id = "default";
        
        if( !file_exists( $path . "/$time" ) )
        {
                $old = umask(0); 
                mkdir( $path . '/' . $time , 0777 );
                umask($old);
        }
        $allowedExts = array("gif", "jpeg", "jpg", "png", "mp4", "avi");
        $temp = explode(".", $_FILES["file"]["name"]);
        $extension = end($temp);
        
        if ((($_FILES["file"]["type"] == "image/gif")
        || ($_FILES["file"]["type"] == "image/jpeg")
        //|| ($_FILES["file"]["type"] == "image/jpg")
        || ($_FILES["file"]["type"] == "image/png")
        || ($_FILES["file"]["type"] == "video/mp4")
        || ($_FILES["file"]["type"] == "video/avi"))
        && ($_FILES["file"]["size"] < 5242880)
        && in_array($extension, $allowedExts)) {
            if ($_FILES["file"]["error"] > 0)
            {
                echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
            }
            else {

                if (file_exists( $path . "/" . $time . "/" . $newfilename )) 
                {
                    echo $newfilename . " already exists. ";
                }
                else
                {
                    move_uploaded_file( $_FILES["file"]["tmp_name"] , $path . "/" . $time . "/" . $newfilename );
                    ////////////
                    $info = array(  "email"    => $email , 
                                    "nickname" => $nickname , 
                                    "born"     => $born , 
                                    "sex"      => $sex , 
                                    "address"  => $address , 
                                    "phone"    => $phone  );
                    
                    $info = json_encode( $info );
                    
                    $myfile = fopen( $path . "/" . $time . "/" . "info.txt", "w") or die("Unable to open file!");
                    $txt = $info;
                    fwrite($myfile, $txt);
                    fclose($myfile);
                    
                    /////////////////
                    echo "true";
                    
                }
            }
        }
        else 
        {
            echo "Invalid file";
        }
        
        
        
        
        function udate($format = 'u', $utimestamp = null) {
            if (is_null($utimestamp))
                $utimestamp = microtime(true);

            $timestamp = floor($utimestamp);
            $milliseconds = round(($utimestamp - $timestamp) * 1000000);

            return date(preg_replace('`(?<!\\\\)u`', $milliseconds, $format), $timestamp);
        }
?>