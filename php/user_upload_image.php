<?php

set_time_limit(0);
ini_set( "memory_limit", "256M");
ini_set('MAX_EXECUTION_TIME', -1);

include 'config.php';
include 'global.php';

$func = $_REQUEST["func"];

switch ($func) {
    case "transient_nobody":
        $echo = transient_nobody();
        break;
    case "transient":
        $echo = transient();
        break;
    case "del_transient":
        $echo = del_transient();
        break;
    case "cloud_disk":
        $echo = cloud_disk();
        break;
    case "del_cloud_disk":
        $echo = del_cloud_disk();
        break;
}

echo json_encode($echo);

function transient_nobody() {
        
        $callback = array();

        $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
        $con->query("SET NAMES utf8");
        // Check connection
        if (mysqli_connect_errno()) {
                $callback['msg'] = "SQL connect fail";
                $callback['success'] = false;
                return $callback;
        }

        $FileName = $_FILES["file"]['name'];
        $FileSub = explode( "." , $FileName );
        $FileSub = $FileSub[count($FileSub)-1];

        if( !file_exists(upload_transient_file) ){
            mkdir(upload_transient_file, 0777, true);
        }
        $filepath_o = upload_transient_file.$_FILES["file"]['name'];
        if( file_exists($filepath_o) ) {
            unlink($filepath_o);
        }
        $time = udate('YmdHisu');
        $filepath = upload_transient_file.$time.".".$FileSub;
        //$httppath = "http://".$_SERVER["SERVER_NAME"]."/ttshow/transient_file/".$time.".".$_REQUEST['subname'];

        move_uploaded_file( $_FILES["file"]["tmp_name"] , $filepath );
        if( file_exists($filepath) ) {
            $callback['data'] = array( "file" => $time.".".$FileSub , "path" => http_upload_transient_file );
            $callback['success'] = true;
        } else {
            $callback['msg'] = "Upload fail";
            $callback['success'] = false;
        }
        mysqli_close($con);

        return $callback;
        
}

function transient() {
        
        $callback = array();
        if( check_empty( array( "token" ) ) ) {
            
            $token = md5( $_REQUEST[ "token" ] );
            $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
            $con->query("SET NAMES utf8");
            // Check connection
            if (mysqli_connect_errno()) {
                    $callback['msg'] = "SQL connect fail";
                    $callback['success'] = false;
                    return $callback;
            }
            
            $account = get_sql($con, "account", "WHERE a_token LIKE '%\\\"$token\\\"%'");
            if( !$account ) {
                    $callback['msg'] = "Login fail";
                    $callback['success'] = false;
                    mysqli_close($con);
                    return $callback;
            }

            $FileName = $_FILES["file"]['name'];
            $FileSub = explode( "." , $FileName );
            $FileSub = $FileSub[count($FileSub)-1];
            
            if( !file_exists(upload_transient_file) ){
                mkdir(upload_transient_file, 0777, true);
            }
            
            $i = 0;
            $time = udate('YmdHisu');
            $file_final_name = $time.".".$FileSub;
            $filepath = upload_transient_file.$file_final_name;
            //$httppath = "http://".$_SERVER["SERVER_NAME"]."/ttshow/transient_file/".$time.".".$_REQUEST['subname'];
            while(1){
                if( file_exists($filepath) ){
                    $i++;
                    $file_final_name = $time."_".(string)$i.".".$FileSub;
                    $filepath = upload_transient_file.$file_final_name;
                }
                else{
                    break;
                }
            }
            move_uploaded_file( $_FILES["file"]["tmp_name"] , $filepath );
            if( file_exists($filepath) ) {
                $callback['data'] = array( "file" => $file_final_name , "path" => http_upload_transient_file );
                $callback['success'] = true;
            } else {
                $callback['msg'] = "Upload fail";
                $callback['success'] = false;
            }
            mysqli_close($con);

        }
        else {
            $callback['msg'] = "parameter is error.";
            $callback['success'] = false;
        }
        return $callback;
        
}

function del_transient() {
        if( check_empty( array( "transient_file" ) ) ) {
            $transient_file = $_REQUEST['transient_file'];

            if( file_exists(upload_transient_file.$transient_file) ){
                unlink(upload_transient_file.$transient_file);
            }
            $callback['success'] = true;
        
        }
        else {
            $callback['msg'] = "parameter is error.";
            $callback['success'] = false;
        }
        return $callback;
}

function cloud_disk() {
        
        $callback = array();
        if( check_empty( array( "token" ) ) ) {
        
                $token = md5( $_REQUEST[ "token" ] );
                
                $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
                $con->query("SET NAMES utf8");
                // Check connection
                if (mysqli_connect_errno()) {
                        $callback['msg'] = "SQL connect fail";
                        $callback['success'] = false;
                        return $callback;
                }
                
                $account = get_sql($con, "account", "WHERE a_token LIKE '%\\\"$token\\\"%'");
                if( !$account ) {
                        $callback['msg'] = "Login fail";
                        $callback['success'] = false;
                        mysqli_close($con);
                        return $callback;
                }
                
                $id = $account[0]["a_id"];
                if( !file_exists(account_path.$id) ){
                    mkdir(account_path.$id."\\", 0777, true);
                }
                check_folder_exist( account_path.$id."\\" , array( "Original","Preview","ThumbnailM","ThumbnailS" ) );
                
                $FileName = $_FILES["file"]['name'];
                //$FileName=mb_convert_encoding($FileName,"big5","UTF-8");
                $FileName = str_replace(' ', '_', $FileName);
                $FileSub = explode( "." , $FileName );
                $FileSub = $FileSub[count($FileSub)-1];
                
                $extra = 0;
                $FileOriName = substr($FileName, 0, -(strlen( $FileSub )+1));
                
                $FileFinalName = $FileName;
                while(1) {
                    if( file_exists(account_path.$id."\\Original\\".mb_convert_encoding($FileFinalName,"big5","UTF-8")) ) {
                        $extra++;
                        $FileFinalName = $FileOriName."_".(string)$extra.".".$FileSub;
                    }
                    else{
                        break;
                    }
                }
                $filepath = account_path.$id."\\Original\\".mb_convert_encoding($FileFinalName,"big5","UTF-8");
                move_uploaded_file( $_FILES["file"]["tmp_name"] , $filepath );
                if( file_exists($filepath) ) {
                    mkdir_trun_picture($filepath, account_path.$id."\\", mb_convert_encoding($FileFinalName,"big5","UTF-8"));
                    $callback['data'] = http_account_path.$id."/Original/".$FileFinalName;//mb_convert_encoding($FileName,"UTF-8","big5")
                    $callback['success'] = true;
                } else {
                    $callback['msg'] = "Upload fail";
                    $callback['success'] = false;
                }
                mysqli_close($con);

        }
        else {
            $callback['msg'] = "parameter is error.";
            $callback['success'] = false;
        }
        return $callback;
        
}

function del_cloud_disk() {
        
        $callback = array();
        $result = array( "SUCCESS" => 0 , "FAIL" => 0 );
        
        if( check_empty( array( "token" , "img" ) ) ) {
        
                $token = md5( $_REQUEST[ "token" ] );
                $img = $_REQUEST[ "img" ];
                
                $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
                $con->query("SET NAMES utf8");
                // Check connection
                if (mysqli_connect_errno()) {
                        $callback['msg'] = "SQL connect fail";
                        $callback['success'] = false;
                        return $callback;
                }
                
                $account = get_sql($con, "account", "WHERE a_token LIKE '%\\\"$token\\\"%'");
                if( !$account ) {
                        $callback['msg'] = "Login fail";
                        $callback['success'] = false;
                        mysqli_close($con);
                        return $callback;
                }
                
                foreach ($img as $key => $value) {
                    if( file_exists(account_path.$account[0]["a_id"]."\\Original\\".$value) ){
                        unlink(account_path.$account[0]["a_id"]."\\Original\\".$value);
                        unlink(account_path.$account[0]["a_id"]."\\ThumbnailS\\".$value);
                        unlink(account_path.$account[0]["a_id"]."\\ThumbnailM\\".$value);
                        unlink(account_path.$account[0]["a_id"]."\\Preview\\".$value);
                        if( file_exists(account_path.$account[0]["a_id"]."\\Original\\".$value) ){
                            $result["FAIL"]++;
                        }
                        else{
                            $result["SUCCESS"]++;
                        }
                    }
                    else{
                        $result["FAIL"]++;
                    }
                }
                
                $callback['data'] = $result;
                $callback['success'] = true;

        }
        else {
            $callback['msg'] = "parameter is error.";
            $callback['success'] = false;
        }
        return $callback;
        
}

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

        for( $i=0; $i<count($data); $i++ ) {
                //mkdir( $data[$i]["path"], 0777);

                list($width, $height) = getimagesize( $src );   

                if( $data[$i]["width"]/$width > $data[$i]["height"]/$height )
                    $data[$i]["width"] = $width*$data[$i]["height"]/$height;
                else if( $data[$i]["height"]/$height > $data[$i]["width"]/$width )
                    $data[$i]["height"] = $height*$data[$i]["width"]/$width;

                $process_img = imagecreatetruecolor($data[$i]["width"], $data[$i]["height"]);
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
        }

}     

function check_folder_exist( $path , $arr ){
        
        if( gettype($arr) === "array" ) {
                foreach ($arr as $key => $value) {
                        if( !file_exists($path.$value) ){
                            mkdir($path.$value, 0777, true);
                        }
                }
        }
        
}


?>