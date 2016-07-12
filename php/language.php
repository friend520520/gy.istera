<?php
//http://www.ggyyggy.com/bohan/admoney/php/account_record.php

include 'config.php';
include 'global.php';
include 'sample/check_login.php';

$func = $_REQUEST["func"];

switch ($func) {
    case "upload_language":
        $echo = upload_language();
        break;
    case "get_language":
        if (!isset($_SESSION)) { session_start(); }
        $echo = get_language();
        break;
    case "download":
        download();
        break;
}

echo json_encode($echo);

function upload_language(){
        
        $callback = array();
        try{
                
                if( !check_empty( array( "token" ) ) ) {
                        $callback['msg'] = "未登入";
                        $callback['success'] = false;
                        return $callback;
                }
                
                date_default_timezone_set('Asia/Taipei');
                
                $FileName = $_FILES["file"]['name'];
                //$FileName=mb_convert_encoding($FileName,"big5","UTF-8");
                $FileName = str_replace(' ', '_', $FileName);
                $FileSub = explode( "." , $FileName );
                $FileSub = $FileSub[count($FileSub)-1];
                
                if( !in_array($FileSub, array("xls")) ){
                        $callback['msg'] = "檔案格式錯誤";
                        $callback['success'] = false;
                        return $callback;
                }
                
                $DB_CON = DB_CON( DB_NAME );
                if( !$DB_CON["success"] ){
                        return $DB_CON;
                }
                $con = $DB_CON["data"];

                $check = check_admin($con);
                if( !$check["success"] ){
                        $callback['msg'] = $check['msg'];
                        $callback['success'] = false;
                        mysqli_close($con);
                        return $callback;
                }
                        
                

                require_once 'PHPExcel.php';
                try {
                    $objPHPExcel = PHPExcel_IOFactory::load($_FILES["file"]["tmp_name"]);
                } catch(Exception $e) {
                    $callback['msg'] = $e;
                    $callback['success'] = false;
                    mysqli_close($con);
                    return $callback;
                }
                
                $array = array( "success" => 0 , "false" => 0 );
                $sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
                unset($sheetData[1]);
                $sheetData = array_values($sheetData);
                if ( mysqli_query($con, "TRUNCATE translate") ) {
                    $array["success"]++;
                } else {
                    $array["false"]++;
                }
                foreach($sheetData as $key => $col)
                {
                    $insert_array = array();
                    foreach ($col as $colkey => $colvalue) {
                        if( $colkey === "A" ){
                            $insert_array["TraditionalChinese"] = $colvalue;
                        }
                        else if( $colkey === "B" ){
                            $insert_array["SimplifiedChinese"] = $colvalue;
                        }
                        else if( $colkey === "C" ){
                            $insert_array["English"] = $colvalue;
                        }
                    }
                    if( insert_sql($con, "translate", $insert_array) ){
                        $array["success"]++;
                    }
                    else{
                        $array["false"]++;
                    }
                }
                
                
                $file_to = language_path."online.xls";
                
                move_uploaded_file( $_FILES["file"]["tmp_name"] , $file_to );
                if( file_exists($file_to) ) {
                    $call_data = "成功".$array["success"]."筆，失敗".$array["false"]."筆。";
                    $callback['data'] = $call_data;
                    $callback['success'] = true;
                } else {
                    $callback['msg'] = "Upload fail";
                    $callback['success'] = false;
                }
                
                mysqli_close($con);
                
        }
        catch (Exception $e)
        {
                $callback['msg'] = $e;
                $callback['success'] = false;
        }
        return $callback;
}

function get_language(){
        
        $callback = array();
        try{
                
                $DB_CON = DB_CON( DB_NAME );
                if( !$DB_CON["success"] ){
                        return $DB_CON;
                }
                $con = $DB_CON["data"];
                
                if( isset($_SESSION["translate"]) ){
                    $data = $_SESSION["translate"];
                }
                else{
                    $translate = get_sql($con, "translate", "", "TraditionalChinese,SimplifiedChinese,English");
                    $data = $translate ? $translate : array();
                }
                
                $callback['data'] = $data;
                $callback['success'] = true;
                mysqli_close($con);
                
        }
        catch (Exception $e)
        {
                $callback['msg'] = $e;
                $callback['success'] = false;
        }
        return $callback;
}

function download(){
    
        try{
                
                date_default_timezone_set('Asia/Taipei');
                
                if( !check_empty( array( "token","data_type" ) ) ) {
                        exit;
                }
                
                $token = md5( $_REQUEST[ "token" ] );
                $data_type = $_REQUEST[ "data_type" ];
                
                
                if( !in_array($data_type, array("default","online")) ){
                        exit;
                }
                
                if( $data_type === "default" ){
                    $filepath = "../language/default.xls";
                    $filename = "default.xls";
                }
                else if( $data_type === "online" ){
                    $filepath = "../language/online.xls";
                    $filename = "online.xls";
                }
                
                header('Content-Type: application/octet-stream');
                header("Content-Length: " .(string)(filesize($filepath)));
                header("Content-Disposition: attachment; filename=".$filename);
                readfile($filepath);
                exit;
                
        }
        catch (Exception $e)
        {
                echo "false";
        }
}

function isUTF8($string)
{
    if(utf8_encode(utf8_decode($string)) == $string)
    {
        return "true";
    }
    else
    {
        echo utf8_encode(utf8_decode($string));
        return "false";
    }
}

function removeBOM($str)
{
    if (substr($str, 0,3) == pack("CCC",0xef,0xbb,0xbf))
        $str = substr($str, 3);

    return $str;
}

function StringToUrlencode( $value )
{
        $reture_value = "";
        for($i = 0; $i < mb_strlen( $value, "utf-8" ); $i++) 
        {
            if (mb_strlen( mb_substr($value, $i, 1, "utf-8") , "utf-8" ) == strlen( mb_substr($value, $i, 1, "utf-8") ))
            {
                $reture_value = $reture_value . mb_substr($value, $i, 1, "UTF-8");
            }
            else
            {
                $reture_value = $reture_value . urlencode( mb_substr($value, $i, 1, "UTF-8") );
            }
        }
        return $reture_value;
}

function checkreturn() {
        
        try{
                date_default_timezone_set('Asia/Taipei');
                
                $member = $_REQUEST["member"];
                $cart = array();
                $date = date("Ymd");
                
                $con=mysqli_connect("localhost","root","ggyyggy","adpay");
                $con->query("SET NAMES utf8");
                
                // Check connection
                if (mysqli_connect_errno()) {
                    echo "false";
                }
                else {
                    
                    $result = mysqli_query($con, "SELECT * FROM financialproduct WHERE member='$member' AND update_time != $date");
                    //
                    if (mysqli_num_rows($result) > 0) {

                            while($row = mysqli_fetch_array($result)) {
                                    
                                    $insurance = $row['index0'];
                                    
                                    $result1 = mysqli_query($con, "SELECT * FROM account_record_$insurance WHERE date <= $date AND mark='' ORDER BY date ASC");
                                    
                                    $return_money = 0;
                                    
                                    if (mysqli_num_rows($result1) > 0) {

                                            while($row1 = mysqli_fetch_array($result1)) {
                                                    
                                                    $return_money += (int)$row1['moneychange'];
                                                    $record_index = $row1['record_index'];
                                                    
                                                    $sql = "UPDATE account_record_$insurance SET mark='2' WHERE record_index=$record_index";
                                                    mysqli_query( $con , $sql );
                                                    
                                            }
                                            echo $insurance . ">>" . $return_money . " ";
                                            $sql = "UPDATE financialproduct SET dereferenceable=dereferenceable+$return_money , update_time=$date WHERE index0='$insurance'";
                                            mysqli_query( $con , $sql );
                                            
                                    }
                                
                            }

                            //echo urldecode( json_encode( $cart ) );


                    } else {
                        
                    }

                    ////////////////////////

                    mysqli_close($con);
                }
                
        }
        catch (Exception $e)
        {
                echo "false";
        }
        
        
        
}

?>