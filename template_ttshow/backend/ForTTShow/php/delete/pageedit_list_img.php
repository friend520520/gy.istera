<?php 
        include("global.php");        
        //user account get login session
        $user_mail = $_POST["user_mail"];
        $project = urldecode($_POST["project"]);
        $path = $server_website_path.$user_mail."/Original";

        echo json_encode( ListImg($path) );
        
        function ListImg( $path ) {
            $handle = opendir( $path ); 
            while (($file = readdir($handle)) !== false) {
                if ($file == '.' || $file == '..') { 
                    continue;
                } 
                $filepath = $path == '.' ? $file : $path . '/' . $file; 
                if (is_link($filepath)) {
                    continue;
                }
                if (is_file($filepath)) {
                    $filepath = str_replace("\\","/",$filepath);
                    $files_path = substr( $filepath , strrpos($filepath, "www")+3 , strlen($filepath ) );
                    $files_path = iconv("BIG5","UTF-8",$files_path);
                            
                    $name = substr( $filepath , strrpos($filepath, "/")+1 , strlen($filepath)+1-strrpos($filepath, "/") );
                    $name = iconv("BIG5","UTF-8",$name);

                    $files[] = array(
                        "type" => "file" ,
                        "path" => $files_path ,
                        "name" => $name
                    );
                }
            }
            closedir($handle); 
            return $files;
        }
?>