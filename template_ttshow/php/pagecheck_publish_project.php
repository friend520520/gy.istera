<?php 
        include("config.php");
        include("php_lib/JSON/Services_JSON.php");
        include("SQL_table_control.php");
        include("global.php");
        $json = new Services_JSON();
        $contorl_table = new SQL_table_control();
        settingUTCtime();
        
        $tag = "[]";
        $special_tag = 0;
        
        $index = $_POST["index"];
        $tag = $_POST["tag"];
        $special_tag = (int)$_POST["special_tag"];
        
        $SQL_photo_list = array();
        
        
        $contorl_table->init_DBconnect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
        $next = $contorl_table->select_AUTO_INCREMENT( "ttshow" , "page" );
        
        //select SQL ++

        $data = array(
            "examine_id" =>  (int)$index ,
        );
        $data = $contorl_table->select_table_column( "examine" , $data );
        if ($data->num_rows > 0) {
            $row = $data->fetch_assoc();
            $draft_id = $row["draft_id"];
        }
        
        //get user_mail ++
        $data = array(
            "user_id" => $row["user_id"],
        );
        $data = $contorl_table->select_table_column( "user" , $data );
        if ($data->num_rows > 0) {
            $row2 = $data->fetch_assoc();
            $user_mail = $row2["facebook_mail"];
        } else {
            $user_mail = "undefined";
        }
        //get user_mail --
        //select SQL --
        
        //copy html ++
        $myFile = $server_examine_path.$index."\index.html.publish";
        if( filesize($myFile) > 0 ) {
            $fh = fopen($myFile, 'r');
            $theData = fread($fh, filesize($myFile));
            fclose($fh);
            $html_code = $theData;
        } else {
            $html_code = "undefined";
        }
        //copy html --
        
        //file ++
        $file_move  = $server_page_path.$next."\\";
        if( (isset($index) && !empty($index) && (int)$index != 0 )  ||  $index == "0" ) {
                $file_src = $server_examine_path.$index."\\";
                $process_file = Copy_folder( $file_src , $file_move );
                if( $process_file == "true" ) {
                        rrmdir( $file_src );
                        $draft_path = $server_website_path.$user_mail."\draft\\".$draft_id."\\";
                        rrmdir( $draft_path );
                }
        } else {
            //echo "is null";
        }
        //file --

        
        //SQL ++
        $time = date("Y-m-d H:i:s");
        $data = array(
            "page_id" => $next,
            "user_id" => $row["user_id"] ,
            "special_tag_id" =>  $special_tag,
            "checker_id" => $row["checker_id"] ,
            "photo_list" => $row["photo_list"] ,
            "movie_list" => $row["movie_list"],
            "article_icon" => $row["article_icon"] ,
            "c_num_click" => 0,
            "class" => $row["class"],
            "tag" => $tag,
            "title" => $row["title"],
            "describe" => $row["describe"],
            "appraisal" => 0,
            "html" => $contorl_table->Check_mysqli_real_escape_string($html_code),
            "date" => $time ,
        );
        $process_sql = $contorl_table->table_add_insert("page", $data);
        
        
        $target = array(
            "examine_id" => (int)$index,
        );
        $process_sql = $contorl_table->table_delete( "examine", $target);


        $target = array(
            "user_id" => $row["user_id"] ,
            "name" => $row["name"] ,
        );
        $process_sql = $contorl_table->table_delete( "draft", $target);
        //SQL --
        
        function udate($format = 'u', $utimestamp = null) {
            if (is_null($utimestamp))
                $utimestamp = microtime(true);

            $timestamp = floor($utimestamp);
            $milliseconds = round(($utimestamp - $timestamp) * 1000000);

            return $milliseconds;
        }

        echo "true";
        
        /* new photo img 
        $examine_path = $server_examine_path.$row["user_id"]."\\".iconv("UTF-8","BIG5",$row["name"])."\\";
        foreach ($photo_list as $key => $value) {
                $time = getdate();
                $fileName = $time[0].udate('Y-m-d H:i:s.u')."_".$value;
                $file_src = $examine_path.$value;
                $file_to = $server_page_img_path.$fileName;
                copy( $file_src , $file_to );
                $SQL_photo_list["\"".$key."\""] = $fileName;
        } 
        */
?>
