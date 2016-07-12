<?php

include("config.php");
include 'global.php';
$func = $_REQUEST["func"];

switch ($func) {
    case "action":
        action();
        break;
    case "get_status":
        get_status();
        break;
}

function action() {
    
    $email = $_REQUEST['email'];
    $page_id = $_REQUEST['page_id'];
    $collect = $_REQUEST['collect'];

    $con = mysqli_connect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
    $con->query( "SET NAMES utf8" );

    if (mysqli_connect_errno()) {
            echo "false";
    }
    else {

            $user = get_sql( $con , "user" , "email='" . $email . "'" , array( "user_id" ) );

            if( $collect === "cancel" )
            {

                    $sql = "DELETE FROM collect WHERE user_id='" . $user[0]['user_id'] . "' AND page_id='$page_id'";

                    if (mysqli_query($con, $sql)) {
                        echo "yet";
                    } else {
                        echo "false";
                    }

            }
            else if( $collect === "collect" )
            {
                    $result = mysqli_query($con, "SELECT * FROM collect WHERE user_id='" . $user[0]['user_id'] . "' AND page_id='$page_id'");

                    if ( mysqli_num_rows($result) > 0) {

                        echo "already";

                    }
                    else {

                        $sql = "INSERT INTO collect( user_id, page_id ) VALUES ( '" . $user[0]['user_id'] . "','$page_id')";

                        if (mysqli_query($con, $sql)) {
                            echo "already";
                        } else {
                            echo "false";
                        }
                    }
            }
    }

    
}

function get_status() {
    try
    {
                $user = $_REQUEST['user'];
                $page = $_REQUEST['page'];
                

                $con = mysqli_connect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
                $con->query( "SET NAMES utf8" );

                if (mysqli_connect_errno()) {
                        echo "false";
                }
                else {

                        if( $user === "" )
                        {
                                $collect = 0;
                        }
                        else
                        {
                                $user1 = get_sql( $con , "user" , "email='" . $user . "'" , array( "user_id" ) );
                                $collect = get_sql_array( $con , " collect" , "user_id='" . $user1[0]["user_id"] . "'" , array( "page_id" ) );

                                $collect = in_array( $page , $collect ) ? 1 : 2;
                        }

                        echo $collect;

                        mysqli_close($con);

                }
    }
    catch (Exception $e)
    {
            echo "false";
    }
}