<?php 
        include("global.php");
        
        //user account get login session
        $user = "abc@gmai.com";
        $path = $server_website_path."\\".$user."\edit\\";

        $project = urldecode($_POST["project"]);
        $project = iconv("UTF-8","BIG5", $project);
        
        $data =  DeleteProject( $project );
        echo $data;
        
        function DeleteProject( $project ) {
            global $path;
            global $user;
            $filepath = $path.$project."\\";
            if ($handle = opendir($filepath)) {
                $array = array();

                    while (false !== ($file = readdir($handle))) {
                        if ($file != "." && $file != "..") {

                            if(is_dir($filepath.$file))
                            {
                                if(!@rmdir($filepath.$file)) // Empty directory? Remove it
                                {
                                    $this->delete_directory($filepath.$file.'\\'); // Not empty? Delete the files inside it
                                }
                            }
                            else
                            {
                               @unlink($filepath.$file);
                            }
                        }
                    }
                    closedir($handle);

                    @rmdir($filepath);
               return "true";
            }
            return "false";
        }
?>