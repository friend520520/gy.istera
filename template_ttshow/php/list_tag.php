<?php 
        include("config.php");
        include("SQL_table_control.php");
        include("global.php");
        $contorl_table = new SQL_table_control();
        
        $contorl_table->init_DBconnect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
        try
        {
                    $jsonData{'email'} = $_REQUEST['user'];
                    $jsonData{'tag'} = $_REQUEST['tag'];
                    $jsonData{'pageNumber'} = $_REQUEST['pageNumber'];
                    $json = list_tag( $contorl_table , $jsonData );
                    echo json_encode( $json );
        }
        catch (Exception $e)
        {
                echo "false";
        }
        
        
        function list_tag( $contorl_table , $jsonData ) {
            
                //get user_id ++
                $data = array(
                    "facebook_mail" => $jsonData{'email'},
                );
                $data = $contorl_table->select_table_column( "user" , $data );
                if ($data->num_rows > 0) {
                    $row = $data->fetch_assoc();
                    $user_id = (int)$row["user_id"];
                } else {
                    $user_id = "undefined";
                }
                //get user_id --
                    
                $Range = 30;
                
                $tag = $jsonData{'tag'};
                //$cmd = "select *,a.name specialtag_name,b.date page_date,c.user_name author,d.name class_name from specialtag as a join page as b join user as c join category as d on a.id = b.special_tag_id AND b.user_id = c.user_id AND b.class = d.id where a.id = ".$specialtag;
                $cmd = "select *,a.name specialtag_name,b.date page_date,c.user_name author,d.name class_name "
                       ."from specialtag as a join page as b join user as c join category as d "
                       ."on a.id = b.special_tag_id AND b.user_id = c.user_id AND b.class = d.id "
                       ."where b.tag LIKE '%".urldecode($tag)."%' "
                       ." LIMIT ".((int)$jsonData{'pageNumber'}).", ".$Range;
                $data = $contorl_table->SQL_cmd( $cmd );
                $files{'keyword'} = $tag;
                if ($data->num_rows > 0) {
                    while($row = $data->fetch_assoc()) {
                        $files{'collect'}[] = array(
                            "specialtag_name" => $row["specialtag_name"],
                            "specialtag_icon" => $row["img_path"],
                            "page_id" => $row["page_id"],
                            "icon" => "http://".$_SERVER["SERVER_NAME"]."/ttshow/web/data/".$row["page_id"]."/".$row["article_icon"],
                            "title" => $row["title"],
                            "author" => $row["author"],
                            "author_id" => $row["user_id"],
                            "author_icon" => $row["usericon"],
                            "class" => $row["class_name"],
                            "tag" => $row["tag"],
                            "page_date" => $row["page_date"],
                            "click" => $row["c_num_click"],
                            "share" => $row["share_num"],
                        );
                    }
                } else {
                    $files{'keyword'} = $tag;
                }
                $files{'length'} = $data->num_rows;
                //add subscribe message ++
                $data = array(
                    "user_id" => $user_id,
                );
                $data = $contorl_table->select_table_column( "subscribe" , $data );
                
                if ($data->num_rows > 0) {
                    $i = 0;
                    $files{'subscribe'} = array();
                    while($row = $data->fetch_assoc()) {
                        $files{'subscribe'}[$i] = $row["author_id"];
                        $i++;
                    }
                    unset($files{'subscribe'}[$i-1]);
                }
                //add subscribe message --
                
                $contorl_table->dis_DBconnect();
                return $files;
        }
           
?>
