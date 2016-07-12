<?php 
        include("config.php");
        include("php_lib/JSON/Services_JSON.php");
        include("SQL_table_control.php");
        include("global.php");
        $json = new Services_JSON();
        $contorl_table = new SQL_table_control();
        
        //user account get login session
        $author_id = (int)$_POST["id"];
        $user_mail = $_POST["email"];
        $pageNumber = $_POST['pageNumber'];

        $contorl_table->init_DBconnect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
        
        if( isset($author_id) && !empty($author_id) )  {
                //cooperate message ++
                $data = array(
                    "user_id" => $author_id,
                );
                $data = $contorl_table->select_table_column( "user" , $data );
                if ($data->num_rows > 0) {
                    while($row = $data->fetch_assoc()) {
                        $files{"user_name"} = $row["user_name"];
                        $files{"usericon"} = $row["usericon"];
                        $files{"cover_photo"} = $row["cover_photo"];
                        $files{"channel_cover"} = $row["channel_cover"];
                        $files{"channel_name"} = $row["channel_name"];
                        $files{"channel_introduce"} = $row["channel_introduce"];
                        $files{"sex"} = $row["sex"];
                        $files{"page"} = "";
                    }
                } else {
                    echo "false";
                }
            
                $cmd = "select SUM(c_num_click) as click from page where user_id = ".$author_id;
                $sum_click = $contorl_table->SQL_cmd( $cmd );
                $sum_click = $sum_click->fetch_assoc();
                $sum_click = $sum_click["click"];
                //cooperate message --

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
                echo json_encode( $files );
        } else {
                echo "false";
        }
        
        function list_class_page( $user_id , $class_id , $pageNumber , $contorl_table ) {
                $Range = 10;
                $cmd = "select *,b.name class_name,c.name specialtag_name "
                      ."from page as a join category as b join specialtag as c "
                      ."on a.class = b.id AND a.special_tag_id = c.id "
                      ."where a.user_id = ".$user_id." AND a.class = ".(int)$class_id." "
                      ."LIMIT ".((int)$pageNumber).", ".$Range;
                $data = $contorl_table->SQL_cmd( $cmd );
                
                if ($data->num_rows > 0) {
                    while($row = $data->fetch_assoc()) {
                        $page[] = array(
                            "page_id" => $row["page_id"],
                            "icon" => "http://".$_SERVER["SERVER_NAME"]."/ttshow/web/data/".$row["page_id"]."/".$row["article_icon"],
                            "specialtag_name" => $row["specialtag_name"],
                            "specialtag_icon" => $row["img_path"],
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
