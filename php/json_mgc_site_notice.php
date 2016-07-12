<?php
        /*
        * @file json_franchisee_console.php
        * @brief 網站公告資料表

        * detail DB funbook19; TABLE board;

        * @author arod ( howareu520@gmail.com )
        * @date 2016-01-21 */

        include 'config.php';
        include 'global.php';
        
        $func = $_REQUEST["func"];

        switch ($func) {
            case "fn_list_new_post_10":
                $echo = fn_list_new_post_10();
                break;
            case "fn_list_new_post_2_regex":
                $echo = fn_list_new_post_2_regex();
                break;
            case "fn_list_new_post_10_regex":
                $echo = fn_list_new_post_10_regex();
                break;
            case "fn_read_board_single_dialogue":
                $echo = fn_read_board_single_dialogue();
                break;
        }
        
        
    function fn_list_new_post_10(){
        try{
                date_default_timezone_set("Asia/Taipei");
                
                //$token = md5( $_REQUEST[ AJAX_ENTER_TOKEN ] );
                
                $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
                $con->query("SET NAMES utf8");
                $cart = array();
                $callback = array();
                
                
                // Check connection
                if (mysqli_connect_errno()) {
                        $callback['msg'] = "SQL connect fail";
                        $callback['success'] = false;
                }
                else {
                            
                        $res = mysqli_query($con, "SELECT b_id, b_title, b_date FROM board ORDER BY b_date DESC LIMIT 10");
                        $i=0;
                        
                        while($row = mysqli_fetch_array($res)) {
                            
                                $cart[$i] = array();
                                
                                foreach ($row as $key => $value) {
                                    
                                        if( gettype($key) !== 'integer' ){
                                            
                                                if( $key == 'b_date' ){
                                                        $cart[$i][$key] = substr( $value , 0 , 10 );
                                                        
                                                } else if ( $key == 'b_title' ){
                                                        if(mb_strlen($value,'utf-8') >= 20){
                                                                $cart[$i][$key] = mb_substr($value,0,20,"UTF-8").'...';
                                                        } else {
                                                                $cart[$i][$key] = $value;
                                                        }
                                                } else {

                                                        $cart[$i][$key] = $value;
                                                }
                                        }
                                }
                                $i++;
                                /*
                                    $cart[] = array( "a_id" => $row["a_id"] , 
                                        "a_icon" => $row["a_icon"] ,
                                        "a_name" => $row["a_name"] ,
                                        "a_nickname" => $row["a_nickname"] ,
                                        "a_email" => $row["a_email"] ,
                                        "a_country" => $row["a_country"] , );
                                */
                        }

                        $callback['date'] = date("Y-m-d");
                        $callback['data'] =  $cart;
                        $callback['success'] = true;
                        
                        mysqli_close($con);
                        
                }
        }
        catch (Exception $e)
        {
                $callback['msg'] = $e;
                $callback['success'] = false;
        }
        echo json_encode($callback);
    
    }
        
    function fn_list_new_post_2_regex(){
        
        try{
                date_default_timezone_set("Asia/Taipei");
                
                $DB_CON = DB_CON( DB_NAME );
                if( !$DB_CON["success"] ){
                        echo json_encode($DB_CON);
                        return;
                }
                $con = $DB_CON["data"];
                
                $cart = array();
                $callback = array();
                
                $board = get_sql($con, "board", "ORDER BY b_date DESC LIMIT 2", "b_id, b_title, b_content, b_date");
                if( $board ){
                    
                    foreach ($board as $k => $v) {
                        $b_content = (mb_strlen( $v['b_content'], "utf-8")>50)? mb_substr( $v['b_content'],0,49, "utf-8")."...":$v['b_content'];
                        $board[$k]["b_content"] = $b_content;
                    }
                    
                    $cart = $board;
                    
                }
                
                $callback['data'] =  $cart;
                $callback['success'] = true;
                mysqli_close($con);

        }
        catch (Exception $e)
        {
                $callback['msg'] = $e;
                $callback['success'] = false;
        }
        echo json_encode($callback);
    
    }
        
    function fn_list_new_post_10_regex(){
        try{
                date_default_timezone_set("Asia/Taipei");
                
                //$token = md5( $_REQUEST[ AJAX_ENTER_TOKEN ] );
                $operation_html = empty($_REQUEST[ "operation_html" ]) ? "" : $_REQUEST["operation_html"];
                
                $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
                $con->query("SET NAMES utf8");
                $cart = array();
                $callback = array();
                
                
                // Check connection
                if (mysqli_connect_errno()) {
                        $callback['msg'] = "SQL connect fail";
                        $callback['success'] = false;
                }
                else {
                            
                        $res = mysqli_query($con, "SELECT b_id, b_title, b_content, b_date FROM board ORDER BY b_date DESC LIMIT 10");
                        
                        while($row = mysqli_fetch_array($res)) {
                            
                                $b_content = (mb_strlen( $row['b_content'], "utf-8")>50)? mb_substr( $row['b_content'],0,49, "utf-8")."...":$row['b_content'];
                                
                                $cart[] = array( "0" => $row["b_id"] , 
                                                "1" => $row["b_date"] ,
                                                "2" => $row["b_title"] ,
                                                "3" => $b_content ,
                                                "4" => $operation_html );
                                
                        }

                        $callback['data'] =  $cart;
                        
                        mysqli_close($con);
                        
                }
        }
        catch (Exception $e)
        {
                $callback['msg'] = $e;
                $callback['success'] = false;
        }
        echo json_encode($callback);
    
    }
        
    function fn_read_board_single_dialogue(){
        try{
                //$token = md5( $_REQUEST[ "token" ] );
                $b_id = $_REQUEST[ 'b_id' ];

                $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
                $con->query("SET NAMES utf8");

                $callback = array();
                $cart = array();

                if (mysqli_connect_errno()) {
                        $callback['msg'] = "SQL connect fail";
                        $callback['success'] = false;
                        return $callback;
                }  

                $res = mysqli_query($con, "SELECT * FROM board WHERE b_id=$b_id");

                while($row = mysqli_fetch_array($res)) {

                            $cart = array( "b_id"       => $row["b_id"] , 
                                            "b_title"   => $row["b_title"] ,
                                            "b_content" => $row["b_content"] ,
                                            "b_date" => $row["b_date"] );
                }

                $callback['data'] =  $cart;
                $callback['success'] = true;

                mysqli_close($con);


        }
        catch (Exception $e)
        {
                $callback['msg'] = $e;
                $callback['success'] = false;
        }
        echo json_encode($callback);
    
    }
?>
