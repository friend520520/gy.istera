<?php 
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
?>