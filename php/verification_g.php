<?php 
// 開啟 session  
if (!isset($_SESSION)) { session_start(); }
  
// 將驗證碼記錄在 session 中  
echo $_SESSION["verification__session"] ;
  

?>