<?php 
        $myFile = "C:/AppServ/www/data/account/friend520520@gmail.com/edit/abc/abc.html.edit";
        $fh = fopen($myFile, 'r');
        $theData = fread($fh, filesize($myFile));
        fclose($fh);
        echo $theData;
?>