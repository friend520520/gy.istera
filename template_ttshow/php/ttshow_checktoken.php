<?php

//abin edit++ 2015/2/13

session_start();

if (isset($_POST["cmd"]) && !empty($_POST["cmd"])) {
        switch($_POST["cmd"]) {
                case "check" :
                    echo GoogleLoginSESSION(); 
                    break;
        }
}

function GoogleLoginSESSION() {
        if( $_SESSION['token'] && !empty($_SESSION['token'] ) ) {
            return "true";
        } else {
            return "false";
        }
}
               