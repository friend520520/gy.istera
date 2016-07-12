<?php 
class bk_manage {
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
                if (is_link($filepath))
                    continue;
                if (is_file($filepath))
                    $files[] = array(
                        "type" => "file" ,
                        "name" => $filepath
                    );
                else if (is_dir($filepath)) 
                    $files[] = array(
                        "type" => "folder" ,
                        "name" => $filepath
                    );
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
}
?>