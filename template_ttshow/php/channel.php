<?php

    include("config.php");
    include 'global.php';

    $func = $_REQUEST["func"];
    
    switch ($func) {

        case "overview":
            overview();
            break;
        case "display":
            display();
            break;
        case "info_by_ch":
            info_by_ch();
        break;
        case "info_by_page":
            info_by_page();
        break;
        case "delete":
            delete();
        break;

    }


    function overview(){

        $con = mysqli_connect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
        $con->query( "SET NAMES utf8" );
        if (mysqli_connect_errno()) {
                echo "false";
        }
        else {

            foreach ($_REQUEST as $key => $value)  
            {
                $data{$key} = stripslashes($value);
                if( $key == "people" ) {
                        $data{$key} = $value;
                } else {
                        $data{$key} = stripslashes($value);
                }
            }
            $data['ttshow'] = json_decode( stripslashes( $data{'ttshow'} ) , true );        

            if( $data['ttshow']['usertype'] === "boss" || $data['ttshow']['usertype'] === "root")
            {

                    $echo = array();

                    $result = mysqli_query($con, "SELECT * FROM channel");
                    if ( mysqli_num_rows($result) > 0) {

                            while($row = mysqli_fetch_array($result)) {

                                    $subscribe = get_sql_array( $con , " subscribe" , "channel_id=" . $row['channel_id'] , array( "user_id" ) ); 

                                    $num = 0;
                                    $page_click = get_sql_array( $con , " page" , "channel_id=" . $row['channel_id'] , array( "c_num_click" ) ); 

                                    foreach ($page_click as $value) {
                                        $num += (int)$value;
                                    }

                                    $echo[] = array( "channel_id" => $row['channel_id'] ,
                                                     "user_id" => $row['user_id'] ,
                                                     "ch_icon" => $row['ch_icon'] ,
                                                     "ch_type" => $row['ch_type'] ,
                                                     "ch_name" => $row['ch_name'] ,
                                                     "display" => $row['display'] ,
                                                     "registration_time" => $row['registration_time'] ,
                                                     "subscribe_count" => count( $subscribe ) ,
                                                     "num_click" => $num );

                            }

                            echo json_encode($echo);

                    }
            }
            else if( $data['ttshow']['usertype'] === "manage" || $data['ttshow']['usertype'] === "editor" )
            {
                    $echo = array();



                    $result = mysqli_query($con, "select * "
                                                ."from channel_group as a join channel as b join user as c "
                                                ."on a.channel_id = b.channel_id AND a.user_id = c.user_id "
                                                ."where a.user_id = ".$data['ttshow']['user_id']);
                    if ( mysqli_num_rows($result) > 0) {

                            while($row = mysqli_fetch_array($result)) {

                                    $subscribe = get_sql_array( $con , " subscribe" , "channel_id=" . $row['channel_id'] , array( "user_id" ) ); 

                                    $num = 0;
                                    $page_click = get_sql_array( $con , " page" , "channel_id=" . $row['channel_id'] , array( "c_num_click" ) ); 

                                    foreach ($page_click as $value) {
                                        $num += (int)$value;
                                    }

                                    $echo[] = array( "channel_id" => $row['channel_id'] ,
                                                     "user_id" => $row['user_id'] ,
                                                     "ch_icon" => $row['ch_icon'] ,
                                                     "ch_type" => $row['ch_type'] ,
                                                     "ch_name" => $row['ch_name'] ,
                                                     "registration_time" => $row['registration_time'] ,
                                                     "subscribe_count" => count( $subscribe ) ,
                                                     "num_click" => $num );

                            }

                            echo json_encode($echo);

                    }
                    else
                    {
                            echo "false";
                    }
            }
            else
            {
                    echo "false";
            }
            mysqli_close($con);
            
        }

    }

    function display(){

        $con = mysqli_connect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
        $con->query( "SET NAMES utf8" );
        if (mysqli_connect_errno()) {
                echo "false";
        }
        else {

            foreach ($_REQUEST as $key => $value)  
            {
                $data{$key} = stripslashes($value);
                if( $key == "people" ) {
                        $data{$key} = $value;
                } else {
                        $data{$key} = stripslashes($value);
                }
            }
            $data['ttshow'] = json_decode( stripslashes( $data{'ttshow'} ) , true );        
            
            if( $data['ttshow']['usertype'] === "boss" || $data['ttshow']['usertype'] === "root" )
            {
                    if( $data['display'] === "show" )
                    {
                            $sql_cmd = "UPDATE channel SET display='' WHERE channel_id=". $data['ch'];
                            if( mysqli_query( $con , $sql_cmd ) ) {
                                    echo "display";
                                    
                                    $sql_cmd = "UPDATE page SET display='' WHERE channel_id=". $data['ch'];
                                    mysqli_query( $con , $sql_cmd );
                                    
                            }
                            else
                                    echo "false";
                    }
                    else if( $data['display'] === "hide" )
                    {
                            $sql_cmd = "UPDATE channel SET display='none' WHERE channel_id=". $data['ch'];
                            if( mysqli_query( $con , $sql_cmd ) ) {
                                    echo "none";
                                    
                                    $sql_cmd = "UPDATE page SET display='none' WHERE channel_id=". $data['ch'];
                                    mysqli_query( $con , $sql_cmd );
                                    
                            }
                            else
                                    echo "false";
                    }
            }
            else if( $data['ttshow']['usertype'] === "manage" || $data['ttshow']['usertype'] === "editor" )
            {
                $check = get_sql($con, "channel_group", "channel_id=" .$data['ch'] . " AND user_id=" . $data['ttshow']['user_id'] . " AND ch_usertype='manage'", array("user_id"));
                if( $check[0]['user_id'] ) {

                    if( $data['display'] === "show" )
                    {
                            $sql_cmd = "UPDATE channel SET display='' WHERE channel_id=". $data['ch'];
                            if( mysqli_query( $con , $sql_cmd ) )
                                    echo "display";
                            else
                                    echo "false";
                    }
                    else if( $data['display'] === "hide" )
                    {
                            $sql_cmd = "UPDATE channel SET display='none' WHERE channel_id=". $data['ch'];
                            if( mysqli_query( $con , $sql_cmd ) )
                                    echo "none";
                            else
                                    echo "false";
                    }


                }
                else {
                    //echo "No permissions";
                    echo "false";
                }
            }
            
            mysqli_close($con);

        }

    }


    function info_by_ch() {
        
        try
        {
                    $ch = $_REQUEST['ch'];
                    //$callback = array();
                    
                    
                    $con = mysqli_connect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
                    $con->query( "SET NAMES utf8" );

                    if (mysqli_connect_errno()) {
                            echo "false";
                    }
                    else {
                            
                            $channel = get_sql( $con , "channel" , "channel_id=" . $ch , array( "ch_name" , "facebook_url" , "youtube_url" , "instagram_url" , "line_url" , "pixnet_url" , "other_url" ) );

                            $callback = array(  "channel_info" => array( "id" => $ch ,
                                                                        "name" => $channel[0]['ch_name'] ) ,
                                                "channel_community" => array( "facebook" => json_decode( $channel[0]['facebook_url'] ) ,
                                                                            "youtube" => json_decode( $channel[0]['youtube_url'] ) ,
                                                                            "instagram" => json_decode( $channel[0]['instagram_url'] ) ,
                                                                            "line" => json_decode( $channel[0]['line_url'] ) ,
                                                                            "pixnet" => json_decode( $channel[0]['pixnet_url'] ) ,
                                                                            "other" => json_decode( $channel[0]['other_url'] ) ) );


                            echo json_encode( $callback );
                            
                            mysqli_close($con);

                    }
        }
        catch (Exception $e)
        {
                echo "false";
        }
        
    }
    
    function info_by_page() {
        
        try
        {
                    $page = $_REQUEST['page'];
                    //$callback = array();
                    
                    
                    $con = mysqli_connect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
                    $con->query( "SET NAMES utf8" );

                    if (mysqli_connect_errno()) {
                            echo "false";
                    }
                    else {
                            $page = get_sql( $con , "page" , "page_id=" . $page , array( "channel_id" ) );
                            $channel = get_sql( $con , "channel" , "channel_id=" . $page[0]['channel_id'] , array( "ch_name" , "facebook_url" , "youtube_url" , "instagram_url" , "line_url" , "pixnet_url" , "other_url" ) );

                            $callback = array(  "channel_info" => array( "id" => $ch ,
                                                                        "name" => $channel[0]['ch_name'] ) ,
                                                "channel_community" => array( "facebook" => json_decode( $channel[0]['facebook_url'] ) ,
                                                                            "youtube" => json_decode( $channel[0]['youtube_url'] ) ,
                                                                            "instagram" => json_decode( $channel[0]['instagram_url'] ) ,
                                                                            "line" => json_decode( $channel[0]['line_url'] ) ,
                                                                            "pixnet" => json_decode( $channel[0]['pixnet_url'] ) ,
                                                                            "other" => json_decode( $channel[0]['other_url'] ) ) );


                            echo json_encode( $callback );
                            
                            mysqli_close($con);

                    }
        }
        catch (Exception $e)
        {
                echo "false";
        }
        
    }
    
    function delete() {
        
        try
        {
                    $email = $_REQUEST['email'];
                    $channel_id = $_REQUEST['channel_id'];
                    //$callback = array();
                    
                    $con = mysqli_connect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
                    $con->query( "SET NAMES utf8" );

                    if (mysqli_connect_errno()) {
                            echo "false";
                    }
                    else {
                            
                            $page = get_sql( $con , "user" , "email='" . $email . "'" , array( "usertype" , "user_id" ) );
                            
                            if( $page[0]["usertype"] === "root" || $page[0]["usertype"] === "boss" ) {
                                
                                echo delete_channel( $con , $channel_id );
                                
                            }
                            else {
                                
                                $ch_usertype = get_sql( $con , "channel_group" , "channel_id=" . $channel_id . " and user_id=" . $page[0]["user_id"] , array( "ch_usertype" ) );
                                
                                if( $ch_usertype[0]["ch_usertype"] === "manage" ) {
                                    echo delete_channel( $con , $channel_id );
                                }
                                else
                                    echo "false";
                            }
                            
                            mysqli_close($con);

                    }
        }
        catch (Exception $e)
        {
                echo "false";
        }
        
    }
    
    function delete_channel( $con , $channel_id ) {
            
            $page = get_sql( $con , "page" , "channel_id=" . $channel_id , array( "page_id" ) );

            foreach ($page as $key => $value) {

                mysqli_query($con, "DELETE FROM click_num WHERE page_id=". $value["page_id"]);
                mysqli_query($con, "DELETE FROM click_num_m WHERE page_id=". $value["page_id"]);
                mysqli_query($con, "DELETE FROM click_num_w WHERE page_id=". $value["page_id"]);
                mysqli_query($con, "DELETE FROM collect WHERE page_id=". $value["page_id"]);
                mysqli_query($con, "DELETE FROM history WHERE page_id=". $value["page_id"]);
                mysqli_query($con, "DELETE FROM page WHERE page_id=". $value["page_id"]);

            }

            mysqli_query($con, "DELETE FROM subscribe WHERE channel_id=". $channel_id);
            mysqli_query($con, "DELETE FROM channel_group WHERE channel_id=". $channel_id);

            if( mysqli_query($con, "DELETE FROM channel WHERE channel_id=". $channel_id) )
                    return "true";
            else
                    return "false";

        
    }
?>