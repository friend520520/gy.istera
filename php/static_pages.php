<?php

include 'config.php';
include 'global.php';

$func = $_REQUEST["func"];

switch ($func) {
    case "get_state":
        $echo = get_state();
        break;
    case "upload":
        $echo = upload();
        break;
    case "return_default":
        $echo = return_default();
        break;
}

echo json_encode($echo);

function get_state(){
        $callback = array();
        try{
                if( check_empty( array( "token" ) ) ) {
                     
                    $token = md5( $_REQUEST[ "token" ] );
                    $data = array();
                    
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
                    if( $account[0]['a_admin'] !== "true" ){
                            $callback['msg'] = "you dont have admin";
                            $callback['success'] = false;
                            mysqli_close($con);
                            return $callback;
                    }
                    
                    $static_array = [ array( "file_name" => "site_notice.php" , "page_name" => "網站公告" ) , 
                                      array( "file_name" => "v_common_problem.php" , "page_name" => "常見問題" ) ];
                    $data = array();
                    
                    foreach ($static_array as $key => $value) {
                            $array = array( "file_name" => $value["file_name"] ,
                                            "page_name" => $value["page_name"] );
                            if( file_exists(default_funbook19_path."default_static_pages\\".$value["file_name"]) ){
                                    $array["uploaded"] = "already";
                                    $array["datetime"] = date("F d Y H:i:s.", filectime(default_funbook19_path."default_static_pages\\".$value["file_name"]));  
                            }
                            else{
                                    $array["uploaded"] = "yet";
                            }
                            $data[] = $array;
                    }

                    $callback['data'] = $data;
                    $callback['success'] = true;
                             
                    mysqli_close($con);
                    
                }
                else {
                    $callback['msg'] = "parameter is error.";
                    $callback['success'] = false;
                }
                    
        }
        catch (Exception $e)
        {
                $callback['msg'] = $e;
                $callback['success'] = false;
        }
        return $callback;
        
}

function upload() {
        
        $callback = array();
        if( check_empty( array( "token" , "file" ) ) ) {
            
            $token = md5( $_REQUEST[ "token" ] );
            $file = $_REQUEST[ "file" ];
            
            if( !in_array($file, array("site_notice.php","v_common_problem.php")) ){
                    $callback['msg'] = "parameter is error.";
                    $callback['success'] = false;
                    return $callback;
            }
            
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
            if( $account[0]['a_admin'] !== "true" ){
                    $callback['msg'] = "you dont have admin";
                    $callback['success'] = false;
                    mysqli_close($con);
                    return $callback;
            }
            
            $FileName = $_FILES["file"]['name'];
            $FileSub = explode( "." , $FileName );
            $FileSub = $FileSub[count($FileSub)-1];
            
            if( $FileSub !== "php" ){
                    $callback['msg'] = "you upload file is not .php";
                    $callback['success'] = false;
                    mysqli_close($con);
                    return $callback;
            }
            
            //備份default
            $filepath_to = default_static_pages_path.$file;
            if( file_exists($filepath_to) ) {
                    unlink($filepath_to);
            }
            $filepath_from = default_funbook19_path.$file;
            if( !copy($filepath_from, $filepath_to) ){
                    $callback['msg'] = "backup fail";
                    $callback['success'] = false;
                    mysqli_close($con);
                    return $callback;
            }
            
            move_uploaded_file( $_FILES["file"]["tmp_name"] , $filepath_from );
            if( file_exists($filepath_from) ) {
                $callback['data'] = $file;
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

function return_default() {
        
        $callback = array();
        if( check_empty( array( "token" , "file_name" ) ) ) {
            
            $token = md5( $_REQUEST[ "token" ] );
            $file_name = $_REQUEST[ "file_name" ];
            
            if( !in_array($file_name, array("site_notice.php","v_common_problem.php")) ){
                    $callback['msg'] = "parameter is error.";
                    $callback['success'] = false;
                    return $callback;
            }
            
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
            if( $account[0]['a_admin'] !== "true" ){
                    $callback['msg'] = "you dont have admin";
                    $callback['success'] = false;
                    mysqli_close($con);
                    return $callback;
            }
            
            //備份default
            $filepath_from = default_static_pages_path.$file_name;
            if( !file_exists($filepath_from) ) {
                    $callback['msg'] = "原始檔不存在";
                    $callback['success'] = false;
                    mysqli_close($con);
                    return $callback;
            }
            $filepath_to = default_funbook19_path.$file_name;
            if( !copy($filepath_from, $filepath_to) ){
                    $callback['msg'] = "復原預設失敗";
                    $callback['success'] = false;
                    mysqli_close($con);
                    return $callback;
            }
            
            unlink($filepath_from);
            $callback['data'] = $file_name;
            $callback['success'] = true;
            mysqli_close($con);

        }
        else {
            $callback['msg'] = "parameter is error.";
            $callback['success'] = false;
        }
        return $callback;
        
}

?>
