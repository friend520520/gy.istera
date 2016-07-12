<?php 
        include("config.php");
        include("php_lib/JSON/Services_JSON.php");
        include("SQL_table_control.php");
        include("global.php");
        $json = new Services_JSON();
        $contorl_table = new SQL_table_control();
        settingUTCtime();
        
        $project = urldecode($_POST["project"]);
        $dialog_data = json_decode( stripslashes($_POST["data"]) );
        
        //user account get login session
        $user   = "abc@gmai.com";
        $path   = $server_website_path.$user."\edit\\".$project;
        $pathTo = $server_website_path.$user."\check\\".$project;
        $contorl_table->init_DBconnect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
        
        /*
        //process  move  img ++
        $data = array(
            "name" => $project,
        );
        $data = $contorl_table->select_table_column( "editor" , $data );
        if ($data->num_rows > 0) {
            // output data of each row
            while($row = $data->fetch_assoc()) {
                //process path data
                echo $row["photo_list"];
                echo $row["movie_list"];
            }
        } else {
            echo "aa";
        }
        //process  move  img --
        */

        $time = date("Y-m-d H:i:s");
        $data = array(
            "state" => "check" ,
            "check_date" => $time ,
            "article_icon" => $dialog_data->{'article_icon'} ,
            "title" => $dialog_data->{'title'} ,
            "describe" => $dialog_data->{'describe'} ,
            "class" => $dialog_data->{'class'} ,
            "special_tag_id" => $dialog_data->{'special_tag'} ,
            "tag" => $dialog_data->{'tag'}
        );
        $target = array(
            "name" => $project
        );
        
        $process_file = Copy_folder( iconv("UTF-8","BIG5", $path) , iconv("UTF-8","BIG5", $pathTo) );
        if( $process_file == "true" ) {
            $process_DB = $contorl_table->table_update( "editor",$data,$target );
        }
        
        if( $process_DB == "true" && $process_file == "true" ) {
            echo "true";
        } else {
            echo "false";
        }
        
        

        function Copy_folder( $path , $pathTo) {
            if( file_exists( $pathTo )) {
                DeleteProject( $pathTo );
            }
            $bool = "true";
            $dir = opendir($path);
            $old = umask(0); 
            mkdir( $pathTo , 0777 );
            umask($old);
            while(false !== ( $file = readdir($dir)) ) { 
                if (( $file != '.' ) && ( $file != '..' )) { 
                    if ( is_dir($path . '/' . $file) ) { 
                        recurse_copy($path . '/' . $file,$pathTo . '/' . $file); 
                    } 
                    else { 
                        if( !copy($path . '/' . $file,$pathTo . '/' . $file) ) {
                            break;
                            $bool = "false";
                        }
                    } 
                } 
            } 
            closedir($dir); 
            return $bool;
        } 

        function DeleteProject( $path ) {
            if ($handle = opendir($path)) {
                $array = array();

                    while (false !== ($file = readdir($handle))) {
                        if ($file != "." && $file != "..") {

                            if(is_dir($path.$file))
                            {
                                if(!@rmdir($path.$file)) // Empty directory? Remove it
                                {
                                    $this->delete_directory($path.$file.'\\'); // Not empty? Delete the files inside it
                                }
                            }
                            else
                            {
                               @unlink($path.$file);
                            }
                        }
                    }
                    closedir($handle);

                    @rmdir($path);
               return "true";
            }
            return "false";
        }
?>