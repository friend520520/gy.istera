<?php

        require 'gmail.php';
        
        if( isset($_REQUEST["email"]) && !empty($_REQUEST["email"]) )
        {
            

                    $userid     = $_REQUEST["email"] ;
                    
                    
                    if( $_SERVER['SERVER_NAME'] === "www.ooxxoox.com" )
                    {
                        //$url        = 'www.ooxxoox.com/ttshow/gmailsystem/callback.php' ;
                        $url        = 'www.ooxxoox.com/ttshow/web/callback.php' ;
                    }
                    else
                    {
                        $url        = 'ttshow.tw/callback.php' ;
                    }
                    
                    
                    
                    // token encode
                    //$tokenencode = base64_encode( $_SESSION[ $userid ] );
                    $tokenencode = base64_encode( $userid );
                    
                    // gmail
                    mstart( $userid , '<b>http://' . $url . '?token=' . $tokenencode . '</b>' );
                    
        }
        
        /*
        function start_session($expire = 0)
        {
            if ($expire == 0) {
                $expire = ini_get('session.gc_maxlifetime');
            } else {
                ini_set('session.gc_maxlifetime', $expire);
             }

            if (empty($_COOKIE['PHPSESSID'])) {
                session_set_cookie_params($expire);
                session_start();
            } else {
                session_start();
                setcookie('PHPSESSID', session_id(), time() + $expire);
            }
        }
        
        session_start();
        //start_session( 30 );
        // store session data
        echo $_SESSION[ $userid ] = $userid ;
        */
        

?>