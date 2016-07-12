<?php
//http://203.66.14.133/bohan/admoney/php/account_record.php

include("config.php");
$func = $_REQUEST["func"];

switch ($func) {
    case "add":
        add();
        break;
    case "list":
        _list();
        break;
    case "listbyid":
        listbyid();
        break;
    case "detail_list":
        detail_list();
        break;
    case "save":
        save();
        break;
}

function add()
{
        try{
                
                $name = $_REQUEST["name"];
                $id = $_REQUEST["id"];
                
                
                $con = mysqli_connect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
                $con->query("SET NAMES utf8");
                
                // Check connection
                if (mysqli_connect_errno()) {
                    echo "false";
                }
                else {
                    
                    /////////////
                    $result = mysqli_query($con, "SELECT * FROM category WHERE id=$id");

                    if (mysqli_num_rows($result) > 0) {

                            echo "exist";
                            
                    } else {
                            
                            $sql = "INSERT INTO category( id, name ) VALUES ( $id,'$name' )";
                            
                            if( mysqli_query($con, $sql) )
                                    echo "true";
                            else
                                    echo "false";
                            
                            
                            
                    }

                    ////////////////////////

                    mysqli_close($con);
                
                }
        }
        catch (Exception $e)
        {
                echo "false";
        }
}

function _list()
{
        try{
                
                $con = mysqli_connect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
                $con->query( "SET NAMES utf8" );
                $echo = array();

                $i = 0;

                if (mysqli_connect_errno()) {
                        echo "false";
                }
                else {
                        $result = mysqli_query($con, "SELECT * FROM category WHERE display='true' ORDER BY _order");
                        if ( mysqli_num_rows($result) > 0) {

                                while($row = mysqli_fetch_array($result)) {

                                        $i++;
                                        $echo[] = array( "id" => $row['id'] , "name" => $row['name'] );

                                }

                                echo json_encode($echo);

                        }

                        mysqli_close($con);

                }
        }
        catch (Exception $e)
        {
                echo "false";
        }
}

/* jack */
function listbyid()
{
        try{
                
                $con = mysqli_connect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
                $con->query("SET NAMES utf8");
                
                // Check connection
                if (mysqli_connect_errno()) {
                            echo "false";
                }
                else {
                    
                            /////////////
                            $result = mysqli_query($con, "SELECT * FROM category");

                            if (mysqli_num_rows($result) > 0) {

                                        while($row = mysqli_fetch_array($result)) {

                                                    $cart[] = array(
                                                        "id" => $row['id'],
                                                        "name" => urlencode( $row['name'] )
                                                    );
                                        }

                                        echo urldecode( json_encode( $cart ) );

                            } else {

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

function detail_list()
{
        try{
                
                $con = mysqli_connect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
                $con->query( "SET NAMES utf8" );
                $echo = array();

                $i = 0;

                if (mysqli_connect_errno()) {
                        echo "false";
                }
                else {
                        $result = mysqli_query($con, "SELECT * FROM category");
                        if ( mysqli_num_rows($result) > 0) {

                                while($row = mysqli_fetch_array($result)) {

                                        $i++;
                                        $echo[] = array( "id" => $row['id'] ,
                                                        "name" => $row['name'] ,
                                                        "display" => $row['display'] ,
                                                        "children" => $row['children'] ,
                                                        "color" => $row['color'] ,
                                                        "image_blue" => $row['image_blue'] ,
                                                        "image_gray" => $row['image_gray'] ,
                                                        "image_white" => $row['image_white'] ,
                                                        "slogon" => $row['slogon'] ,
                                                        "meta" => $row['meta'] ,
                                                        "_order" => $row['_order'] );
 	 	 	 	 	 	 	 	
                                }

                                echo json_encode($echo);

                        }

                        mysqli_close($con);

                }
        }
        catch (Exception $e)
        {
                echo "false";
        }
}

function save()
{
        try{
                
                $con = mysqli_connect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
                $con->query( "SET NAMES utf8" );
                $echo = array();

                if (mysqli_connect_errno()) {
                        echo "false";
                }
                else {
                        $result = mysqli_query($con, "SELECT * FROM category");
                        if ( mysqli_num_rows($result) > 0) {

                                while($row = mysqli_fetch_array($result)) {

                                        $i++;
                                        $echo[] = array( "id" => $row['id'] ,
                                                        "name" => $row['name'] ,
                                                        "display" => $row['display'] ,
                                                        "children" => $row['children'] ,
                                                        "color" => $row['color'] ,
                                                        "image_blue" => $row['image_blue'] ,
                                                        "image_gray" => $row['image_gray'] ,
                                                        "image_white" => $row['image_white'] ,
                                                        "slogon" => $row['slogon'] ,
                                                        "meta" => $row['meta'] ,
                                                        "_order" => $row['_order'] );
 	 	 	 	 	 	 	 	
                                }

                                echo json_encode($echo);

                        }

                        mysqli_close($con);

                }
        }
        catch (Exception $e)
        {
                echo "false";
        }
}


        
        
?>
