<?php
        header("Access-Control-Allow-Origin:*");
        header('Access-Control-Allow-Credentials:true');
        header('Access-Control-Allow-Methods:GET, POST, PUT, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers:Origin, No-Cache, X-Requested-With, If-Modified-Since, Pragma, Last-Modified, Cache-Control, Expires, Content-Type, X-E4M-With');
        header('Content-Type:text/html; charset=utf-8');
        
        require 'gmail.php';
        
        $token = $_REQUEST["token"];
        
        if( isset($_REQUEST["email"]) && !empty($_REQUEST["email"]) && $_REQUEST["func"] === "forget" && $token )
        {
                    
                    
                    //$url        = 'www.ggyyggy.com/bohan/gmailsystem/callback.php' ;
                    //echo $_SERVER['SERVER_NAME'];
                    
                    $url        = 'ttshow.tw/change_psw.php' ;
                    // token encode
                    //$tokenencode = base64_encode( $_SESSION[ $userid ] );
                    
                    // gmail
                    mstart( $_REQUEST["email"] , '<b>http://' . $url . '?token=' . $token . '</b>' );
                    
        }
        
?>