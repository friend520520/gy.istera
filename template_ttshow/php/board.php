<?php
//http://203.66.14.133/bohan/admoney/php/account_record.php
include("config.php");
include 'global.php';

$func = $_REQUEST["func"];

switch ($func) {
    case "add":
        add();
        break;
    case "list":
        _list();
        break;
    case "delete":
        delete();
        break;
}

function add()
{
        try{
                date_default_timezone_set('Asia/Taipei');
                
                $page_id = $_REQUEST["page"];
                $user_id = $_REQUEST["user_id"];
                $text = $_REQUEST["text"];
                $datetime = date('Y-m-d H:i:s');
                
                $con = mysqli_connect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
                $con->query("SET NAMES utf8");
                
                // Check connection
                if (mysqli_connect_errno()) {
                    echo "false";
                }
                else {
                    
                    $text = mysqli_real_escape_string($con,$text);
                    
                    $lasttime = get_sql2($con, "board", "page_id=$page_id AND user_id=$user_id ORDER BY date DESC limit 1", array( "date" ));
                    
                    $bool = true;
                    
                    if( strlen($text) > 200 ) {
                        $bool = false;
                        $msg = "字數超過200";
                    }
                    else if( $lasttime )
                    {
                        $from_time = strtotime( $lasttime[0]["date"] );
                        $to_time = strtotime( $datetime );
                        
                        if( round(abs($to_time - $from_time) / 60,2) < 10 )
                        {
                            $bool = false;
                            $msg = "同一篇留言10分內重複回復";
                        }
                                
                        
                    }
                    
                    if( $bool ) {
                        $sql = "INSERT INTO board( page_id , user_id , text , date ) VALUES ( $page_id,$user_id,'$text','$datetime' )";

                        if( mysqli_query($con, $sql) )
                                echo "true";
                        else
                                echo "false";
                    }
                    else {
                        echo $msg;
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

function _list()
{
        try{
                
                $page = $_REQUEST["page"];
                
                $con = mysqli_connect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
                $con->query( "SET NAMES utf8" );

                if (mysqli_connect_errno()) {
                        echo "false";
                }
                else {
                        
                        $board = get_sql2($con, "board", "page_id=$page", array( "id" , "user_id" , "text" , "date" ) );
                        
                        if( $board ) {
                            
                            foreach ($board as $key => $value) {

                                    $user_info = get_sql($con, "user", "user_id=" . $value['user_id'], array( "user_name" , "usericon" ) );
                                    $board[$key]['user_name'] = $user_info[0]['user_name'];
                                    $board[$key]['usericon'] = $user_info[0]['usericon'];

                            }

                            echo json_encode( $board );
                            
                        }
                        else {
                            echo "empty";
                        }
                        
                        mysqli_close($con);

                }
        }
        catch (Exception $e)
        {
                echo "false";
        }
}

function delete()
{
        try{
                
                $id = $_REQUEST["id"];
                
                
                $con = mysqli_connect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
                $con->query( "SET NAMES utf8" );

                if (mysqli_connect_errno()) {
                        echo "false";
                }
                else {
                        
                        $sql = "DELETE FROM board WHERE id=$id";
                        
                        if( mysqli_query($con, $sql) )
                                echo "true";
                        else
                                echo "false";
                        
                        mysqli_close($con);

                }
        }
        catch (Exception $e)
        {
                echo "false";
        }
}

?>
