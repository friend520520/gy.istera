<?php

include 'config.php';
include 'global.php';
include 'account_event.php';
include 'sample/check_login.php';


$echo = send_sms();

echo json_encode($echo);

function send_sms(){
        
        $callback = array();
        date_default_timezone_set('Asia/Taipei');
        
        if( !check_empty( array('a_phone','token') ) ) {
                $callback['msg'] = "parameter is error.";
                $callback['success'] = false;
                return $callback;
        }
        
        $token = md5( $_REQUEST[ "token" ] );
        $a_phone = $_REQUEST[ "a_phone" ];
        $date = date('Y-m-d H:i:s');
        
        $DB_CON = DB_CON( DB_NAME );
        if( !$DB_CON["success"] ){
                return $DB_CON;
        }
        $con = $DB_CON["data"];
        
        $check = check_login($con);
        if( !$check["success"] ){
                $callback['msg'] = $check['msg'];
                $callback['success'] = false;
                mysqli_close($con);
                return $callback;
        }
        $account = $check["data"];
        
        if( get_sql($con, "account", "WHERE a_phone='$a_phone'") ) {
                $callback['msg'] = "此電話號碼已有人認證使用";
                $callback['success'] = false;
                mysqli_close($con);
                return $callback;
        }
        
        $ID="jack99";//帳號..

        $PW="jack99";//密碼..

        //SourceProdID,SourceMsgID 可依時間亂數產生..

        $SourceProdID="YOYO8SMS";

        srand((double)microtime()*1000000);

        $SourceMsgID=time().rand(1,9999);

        $random = rand(1000, 9999);
        
        $Password=md5("$ID:$PW:$SourceProdID:$SourceMsgID");

//        $Phone="";//接收簡訊手機號碼..

        $CharSet="U";//簡訊文字編碼..

        $SMSMessage="這是幫助網認證信，請輸入認證碼".$random."。";//簡訊內容..

        $SMSMessage=urlencode($SMSMessage);//URLEncode..

        $ch = curl_init();

        $ChkUrl="http://www.yoyo8.com.tw/SMSBridge.php"

        ."?MemberID=$ID"

        ."&Password=$Password"

        ."&MobileNo=$a_phone"

        ."&CharSet=$CharSet"

        ."&SMSMessage=$SMSMessage"

        ."&SourceProdID=$SourceProdID"

        ."&SourceMsgID=$SourceMsgID";


        curl_setopt($ch, CURLOPT_URL, $ChkUrl);

        curl_setopt($ch, CURLOPT_HEADER, false);

        curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $aResult = curl_exec($ch);

        curl_close($ch);

        $cReturnArray=array();

        $cReturnArray=explode("&",$aResult);

        foreach ($cReturnArray as $row) {

                $row=trim(urldecode($row));

                if (preg_match("/^status=/",$row)) {

                $status=preg_replace("/^status=/","",$row);

                }

                if (preg_match("/^MemberID=/",$row)) {

                $MemberID=preg_replace("/^MemberID=/","",$row);

                }

                if (preg_match("/^MessageID=/",$row)) {

                $MessageID=preg_replace("/^MessageID=/","",$row);

                }

                if (preg_match("/^UsedCredit=/",$row)) {

                $UsedCredit=preg_replace("/^UsedCredit=/","",$row);

                }

                if (preg_match("/^Credit=/",$row)) {

                $Credit=preg_replace("/^Credit=/","",$row);

                }

                if (preg_match("/^MobileNo=/",$row)) {

                $MobileNo=preg_replace("/^MobileNo=/","",$row);

                }

                if (preg_match("/^retstr=/",$row)) {

                $retstr=preg_replace("/^retstr=/","",$row);

                }

        }

        if (strcmp($status,"0")==0) {
            
            //寫入廠商資料庫..
            
            
            $json = array( "a_phone_confirm" => $random , "a_phone_tmp" => $a_phone , "a_phone_send_time" => $date );
            $keyword = array( "a_id" => $account["a_id"] );
            if( !update_sql($con, "account", $json, $keyword) ){
                    $callback['msg'] = "存入錯誤";
                    $callback['success'] = false;
                    mysqli_close($con);
                    return $callback;
            }
            
            mysqli_close($con);
            $callback["success"] = true;
            
        } else {
            
            $callback["msg"] = "發送失敗...錯誤碼為 $status ";
            $callback["success"] = false;
            
        }
        
        return $callback;
        
}



?>