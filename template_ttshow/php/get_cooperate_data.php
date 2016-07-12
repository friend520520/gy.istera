<?php 
        include("config.php");
        include("php_lib/JSON/Services_JSON.php");
        include("SQL_table_control.php");
        include("global.php");
        $json = new Services_JSON();
        $contorl_table = new SQL_table_control();
        
        //user account get login session
        $user_mail = $_REQUEST["email"];
        $pageNumber = $_REQUEST["pageNumber"];
        $ch_url = $_REQUEST["url"];

        $contorl_table->init_DBconnect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
        if( isset($ch_url) && !empty($ch_url) )  {
                //get channel_id ++
                $data = array(
                    "ch_url" => $ch_url,
                );
                $data = $contorl_table->select_table_column( "channel" , $data );
                if ($data->num_rows > 0) {
                    $row = $data->fetch_assoc();
                    $channel_id = (int)$row["channel_id"];
                } else {
                    $channel_id = "undefined";
                }
                //get channel_id --
            
                //cooperate message ++
                $data = array(
                    "channel_id" => $channel_id,
                );
                $data = $contorl_table->select_table_column( "channel" , $data );
                if ($data->num_rows > 0) {
                    while($row = $data->fetch_assoc()) {
                        $files{"ch_name"} = $row["ch_name"];
                        $files{"icon"} = $row["ch_icon"];
                        $files{"cover"} = $row["ch_cover"];
                        $files{"ch_type"} = $row["ch_type"];
                        $files{"introduce"} = $row["ch_introduce"];
                        $files{"facebook"} = $row["facebook_url"];
                        $files{"youtube"} = $row["youtube_url"];
                        $files{"instagram"} = $row["instagram_url"];
                        $files{"other"} = $row["other_url"];
                        $files{"registration_time"} = $row["registration_time"];
                    }
                } else {
                    echo "false";
                }
                $cmd = "select SUM(c_num_click) as click from page where channel_id = ".$channel_id;
                $sum_click = $contorl_table->SQL_cmd( $cmd );
                $sum_click = $sum_click->fetch_assoc();
                $sum_click = $sum_click["click"];
                $files{"sum_click"} = $sum_click;
                //cooperate message --
                
                //page list ++                
                    //select class ++
                    $data = $contorl_table->select_table_column( "category" , "" );
                    //select class --
                if ($data->num_rows > 0) {
                    while($row = $data->fetch_assoc()) {
                        $author_id = 0;
                        $data2 = list_class_page( $channel_id , $row["id"], $pageNumber, $contorl_table);
                        if( $data2 != null ) {
                            $page[]{"data"} = $data2;
                            $page[count($page)-1]{"class_id"} = $row["id"];
                            $page[count($page)-1]{"class_name"} = $row["name"];
                        }
                    }
                }
                //page list --
                $files{"page"} = $page;
                $files{"page_number"} = (int)$pageNumber + 10;
                
/*
                $data = array(
                    "author_id" => $author_id,
                );
                $data = $contorl_table->select_table_column( "subscribe" , $data );
                $files{"all_follow"} = $data->num_rows;
                
                
                //page list ++
                
                //select class ++
                $data = $contorl_table->select_table_column( "category" , "" );
                //select class --
                if ($data->num_rows > 0) {
                    while($row = $data->fetch_assoc()) {
                        $author_id = 0;
                        $data2 = list_class_page( $author_id , $row["id"], $pageNumber, $contorl_table);
                        if( $data2 != null ) {
                            $page[]{"data"} = $data2;
                            $page[count($page)-1]{"class_id"} = $row["id"];
                            $page[count($page)-1]{"class_name"} = $row["name"];
                        }
                    }
                }
                //page list --

                $files{"page"} = $page;
                $files{"all_click"} = $sum_click;
                                
                if( isset($user_mail) && !empty($user_mail) )  {
                        //get user_id ++
                        $data = array(
                            "facebook_mail" => $user_mail,
                        );
                        $data = $contorl_table->select_table_column( "user" , $data );
                        if ($data->num_rows > 0) {
                            $row = $data->fetch_assoc();
                            $user_id = (int)$row["user_id"];
                        } else {
                            $user_id = "undefined";
                        }
                        //get user_id --

                        
                        
                        $data = array(
                            "user_id" => $author_id,
                        );
                        $data = $contorl_table->select_table_column( "page" , $data );
                        $files{"length"} = $data->num_rows;
                        
                        
                        //add subscribe message ++
                        $data = array(
                            "user_id" => $user_id,
                            "author_id" => $author_id,
                        );
                        $data = $contorl_table->select_table_column( "subscribe" , $data );

                        if ($data->num_rows > 0) {
                            $files{"subscribe"} = $author_id;
                        } else {
                            $files{"subscribe"} = "false";
                        }
                        //add subscribe message --  
                }
*/
                echo json_encode( $files );
        } else {
                echo "false";
        }

        function list_class_page( $channel_id , $class_id , $pageNumber , $contorl_table ) {
                $Range = 10;
                $cmd = "select * "
                      ."from channel as a join page as b join category as c "
                      ."on a.channel_id = b.channel_id AND b.class = c.id "
                      ."where a.channel_id = ".$channel_id." AND b.class = ".(int)$class_id." "
                      ."LIMIT ".((int)$pageNumber).", ".$Range;
                $data = $contorl_table->SQL_cmd( $cmd );
                
                if ($data->num_rows > 0) {
                    while($row = $data->fetch_assoc()) {
                        $page[] = array(
                            "page_id" => $row["page_id"],
                            "icon" => "http://".$_SERVER["SERVER_NAME"]."/ttshow/web/data/".$row["page_id"]."/".$row["article_icon"],
                            "title" => $row["title"],
                            //"author" => $row["author"],
                            //"author_id" => $row["user_id"],
                            //"author_icon" => $row["usericon"],
                            "class" => $row["class_name"],
                            "tag" => $row["tag"],
                            "page_date" => $row["date"],
                            "click" => $row["c_num_click"],
                            "share" => $row["share_num"],
                        );
                    }
                }
                return $page;
        }
?>
