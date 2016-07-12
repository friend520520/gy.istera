<?php 
class FileManage {
        //list dir
        function listdir( $dir ) { 
            if (!is_dir($dir)) { 
                return false; 
            } 
            $files = array(); 
            $files = $this->listdiraux($dir, $files);
            return $files; 
        } 

        function listdiraux($dir, $files) {
            $handle = opendir($dir); 
            while (($file = readdir($handle)) !== false) {
                if ($file == '.' || $file == '..') { 
                    continue;
                } 
                $filepath = $dir == '.' ? $file : $dir . '/' . $file; 
                if (is_link($filepath)) {
                    continue;
                }
                if (is_file($filepath)) {
                    $filepath = str_replace("/","",$filepath);
                    $files[] = array(
                        "type" => "file" ,
                        "path" => $filepath ,
                        "name" => substr( $filepath , strrpos($filepath, "\\")+1 , strlen($filepath)+1 - strrpos($filepath, "\\") )
                    );
                }
                else if (is_dir($filepath)) {
                    $filepath = str_replace("/","",$filepath);
                    $files[] = array(
                        "type" => "folder" ,
                        "path" => $filepath ,
                        "name" => substr( $filepath , strrpos($filepath, "\\")+1 , strlen($filepath)+1 - strrpos($filepath, "\\") )
                    );
                } 
            }
            closedir($handle); 
            return $files;
        } 
        
        //ReadFile
        function ReadFile( $dir ) {
            $fh = fopen( $dir, 'r');
            $theData = fread($fh, filesize($dir));
            fclose($fh);
            return $theData;
        }
        
        //mkdir
        function mkDir( $path , $mod) {
                if( !file_exists($path) ) {
                        mkdir( $path , $mod );
                        return true;
                }
                return false;
        }
        
        //mkfile
        function mkFile( $path , $str ) {
                header("Content-Type:text/html; charset=utf-8");
                if( !file_exists($path) ) {
                        $file = fopen( $path ,"x+"); //開啟檔案
                        fwrite($file , $str);
                        fclose($file);
                        return true;
                }
                return false;
        }
        
        //delete file
        function DeleteFile( $path ) {
                if( file_exists( $path ) && is_file( $path ) ) {
                        unlink( $path );
                        return true;
                }
                return false;
        }
        
        //delete file
        function DeleteFolder( $path ) {
                $this->delete_directory($path);
                if( !file_exists( $path ) ) {
                        return true;
                } else {
                        return false;
                }
        }
        function delete_directory($dir)
        {
            if ($handle = opendir($dir)) {
                $array = array();

                    while (false !== ($file = readdir($handle))) {
                        if ($file != "." && $file != "..") {

                            if(is_dir($dir.$file))
                            {
                                if(!@rmdir($dir.$file)) // Empty directory? Remove it
                                {
                                    $this->delete_directory($dir.$file.'\\'); // Not empty? Delete the files inside it
                                }
                            }
                            else
                            {
                               @unlink($dir.$file);
                            }
                        }
                    }
                    closedir($handle);

                    @rmdir($dir);
            }
        }
        
        //move file    A-->B
        function MoveFile( $srcPath , $movePath ) {
                if( file_exists( $srcPath ) && !file_exists( $movePath ) ) {
                        rename( $srcPath , $movePath );
                        return true;
                }
                return "movefail";
        }
        
        //copy file   
        function CopyFile( $srcPath , $movePath ) {
                if( file_exists( $srcPath ) && !file_exists( $movePath ) ) {
                        copy( $srcPath , $movePath );
                        return true;
                }
                return false;
        }

/*
        //mkfile
        public function mkFile( $path , $name , $str ) {
                $path = "C:\AppServ\www\data\account\friend520520@gmail.com\edit\abc";  //檔案路徑
                $filename = "ABC.html";  //檔名
                $str = "Hello World";  //內容
                header("Content-Type:text/html; charset=utf-8");
                if( is_file($path.'/'.$filename) && file_exists($path.'/'.$filename) )
                {
                    echo "檔案存在!<br>";
                }
                else
                {
                    echo "檔案不存在!<br>";

                        if (isset($_POST["html"]) && !empty($_POST["html"])) { //Checks if action value exists
                            $str = $_POST["html"];
                        }
                        $file = fopen( $path."/".$filename ,"x+"); //開啟檔案
                        fwrite($file , $str);
                        fclose($file);

                        if (isset($_POST["edit"]) && !empty($_POST["edit"])) { //Checks if action value exists
                            $str = $_POST["edit"];
                        }
                        $filename = "ABC.html.edit";  //檔名
                        $file = fopen( $path."/".$filename ,"x+"); //開啟檔案
                        fwrite($file , $str);
                        fclose($file);
                        echo "建立檔案：".$filename."<br>";
                        echo "內容：".$str."<br>";
                }
        }
*/
}
?>