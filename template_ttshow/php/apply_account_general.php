<?php 

        include("config.php");
        include("global.php");
        include("SQL_table_control.php");
        $contorl_table = new SQL_table_control();
        settingUTCtime();
        
        //user account get login session
        $user_data = $_POST["user_data"];
        $user_mail = $_POST["user_mail"];
        
        $contorl_table->init_DBconnect( DB_HOST , DB_USER , DB_PASS , DB_NAME );

        $dirName = array(
                $server_website_path.$user_mail ,
                $server_website_path.$user_mail."/Draft" ,
                $server_website_path.$user_mail."/Original" ,
                $server_website_path.$user_mail."/Preview" ,
                $server_website_path.$user_mail."/ThumbnailM" ,
                $server_website_path.$user_mail."/ThumbnailS" ,
                $server_website_path.$user_mail."/Profile" ,
        );
        for( $i=0 ; $i<count($dirName) ; $i++ ) {
            if( !file_exists( $dirName[$i]."/" ) ) {
                $old = umask(0); 
                mkdir( $dirName[$i] , 0777 );
                umask($old);
            }
        }
        
        
        $data_array = array();
        foreach ($user_data as $key => $value) {
            if( $key == "birthday" ) {
                $time = date( "Y-m-d" , (float)$value/1000 + get_timezone_offset( 'UTC' , 'Asia/Krasnoyarsk' ) );
                $value = $time;
            }
            $data_array{ $key } = $value;
        }
        
        $data = array(
            "facebook_mail"  => $user_mail
        );
        echo $contorl_table->table_update( "user", $data_array ,$data );
        
        function get_timezone_offset($remote_tz, $origin_tz = null) {
                if($origin_tz === null) {
                    if(!is_string($origin_tz = date_default_timezone_get())) {
                        return false; // A UTC timestamp was returned -- bail out!
                    }
                }
                $origin_dtz = new DateTimeZone($origin_tz);
                $remote_dtz = new DateTimeZone($remote_tz);
                $origin_dt = new DateTime("now", $origin_dtz);
                $remote_dt = new DateTime("now", $remote_dtz);
                $offset = $origin_dtz->getOffset($origin_dt) - $remote_dtz->getOffset($remote_dt);
                
                return $offset;
        }

?>