<?php 
        include("global.php");
        
        //user account get login session
        $user = "abc@gmai.com";
        $path = $server_website_path.$user."\edit\\";
        
        $project = urldecode($_POST["project"]);
        $project = iconv("UTF-8","BIG5", $project);
        
        $html = stripslashes($_POST["html"]);
        $edit = stripslashes($_POST["edit"]);
        
        $data =  CreateProject( $project , $html , $edit );
        echo $data;
        
        function CreateProject( $project , $html , $edit ) {
                global $path;
                global $user;
                $bool = "false";
                
                $filepath = $path.$project;
                if( !file_exists($filepath) ) {
                        mkdir( $filepath , "0777" );
                } else {
                        return $bool;
                }
                $html_path = $filepath."\index.html";
                $edit_path = $filepath."\index.html.edit";
                
                $bool = "false";
                if( file_exists($html_path) && file_exists($edit_path) ) {
                    unlink( $html_path );
                    unlink( $edit_path );
                }
                header("Content-Type:text/html; charset=utf-8");
                $file = fopen( $html_path  ,"x+"); //開啟檔案
                fwrite($file , $html);
                fclose($file);
                $file = fopen( $edit_path ,"x+"); //開啟檔案
                fwrite($file , $edit);
                fclose($file);
                $bool = "true";

                return $bool;
        }
?>