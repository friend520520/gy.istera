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
            case "fn_list_new_post_5":
                $echo = fn_list_new_post_5();
                break;
            case "fn_list_board_new_post_5_single_dialogue":
                $echo = fn_list_board_new_post_5_single_dialogue();
                break;
        }
        
        
    function fn_list_new_post_5(){
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
                            
                        $res = mysqli_query($con, "SELECT b_id, b_title, b_date FROM board ORDER BY b_date DESC LIMIT 5");
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
        
    function fn_list_board_new_post_5_single_dialogue(){
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
                                            "b_content" => $row["b_content"] );
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