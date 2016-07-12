<?php 
	$path       = "C:\AppServ\www\data\account\friend520520@gmail.com\edit\abc";  //檔案路徑
	$filename = "t.html";  //檔名
	$str = "Hello World";  //內容
	header("Content-Type:text/html; charset=utf-8");
	if( file_exists($path) && is_dir($path))
	{
	    echo "目錄存在!<br>";
	}
	else
	{
	    echo "目錄不存在!<br>";
	    mkdir( $path , 0777);
	    echo "建立目錄：".$path."<br>";
	}
?>