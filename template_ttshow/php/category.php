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
    case "delete":
        delete();
        break;
    case "save":
        save();
        break;
    case "save_order":
        save_order();
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
                    
                    $result = mysqli_query($con, "SELECT * FROM category WHERE display='true' ORDER BY _order DESC LIMIT 1");
                    if ( mysqli_num_rows($result) > 0) {

                            while($row = mysqli_fetch_array($result)) {

                                    $order = (int)$row['_order'];
                                    
                            }
                            echo $order;
                            $order ++;
                            $sql = "INSERT INTO category( name , display , _order ) VALUES ( '$name','false',$order )";

                            if( mysqli_query($con, $sql) )
                                    echo "true";
                            else
                                    echo "false";
                    }
                    else {
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
                        $result = mysqli_query($con, "SELECT * FROM category ORDER BY _order");
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
                                                        "page" => json_decode( $row['page'] ) ,
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

function delete()
{
        try{
                
                $con = mysqli_connect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
                $con->query( "SET NAMES utf8" );
                $echo = array();
                $cate_id = $_REQUEST['cate_id'];
                $transfer = $_REQUEST['transfer'];
                
                $i = 0;

                if (mysqli_connect_errno()) {
                        echo "false";
                }
                else {
                        $result = mysqli_query($con, "SELECT * FROM category WHERE id=$cate_id");
                        if ( mysqli_num_rows($result) > 0) {
                                
                                $result = mysqli_query($con, "SELECT * FROM category WHERE id=$transfer");
                                if ( mysqli_num_rows($result) > 0) {
                                        
                                        //$sql_cmd = "DELETE FROM category WHERE id=". $cate_id;
                                        $sql_cmd = "UPDATE page SET class=$transfer WHERE class=". $cate_id;
                                        if( mysqli_query( $con , $sql_cmd ) ) {
                                                
                                                $sql_cmd = "DELETE FROM category WHERE id=". $cate_id;
                                                if( mysqli_query( $con , $sql_cmd ) )
                                                        echo "true";
                                                else
                                                        echo "false";
                                                
                                        }
                                        else
                                                echo "false";
                                        
                                        
                                }
                                else {
                                    echo "false";
                                }
                                
                        }
                        else {
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

function save()
{
        try{
                
                $con = mysqli_connect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
                $con->query( "SET NAMES utf8" );
                $echo = array();
                $cate_id = $_REQUEST['cate_id'];
                $name = $_REQUEST['name'];
                $display = $_REQUEST['display'];
                $color = $_REQUEST['color'];
                $slogon = $_REQUEST['slogon'];
                $page = $_REQUEST['page'];
                $page = json_encode($page);
                
                if (mysqli_connect_errno()) {
                        echo "false";
                }
                else {
                        
                        $result = mysqli_query($con, "SELECT * FROM category WHERE id=$cate_id");
                        if ( mysqli_num_rows($result) > 0) {
                                
                                $sql_cmd = "UPDATE category SET name='$name',display='$display',color='$color',slogon='$slogon',page='$page' WHERE id=". $cate_id;
                                if( mysqli_query( $con , $sql_cmd ) )
                                        echo "true";
                                else
                                        echo "false";
                        }
                        else {
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

function save_order()
{
        try{
                
                $con = mysqli_connect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
                $con->query( "SET NAMES utf8" );
                $echo = array();
                $order = $_REQUEST['order'];
                $i = 0;
                
                if (mysqli_connect_errno()) {
                        echo "false";
                }
                else {
                        
                        foreach ($order as $key => $value) {
                                
                                $i++;
                                mysqli_query( $con , "UPDATE category SET _order=$i WHERE id=". $value['id'] );
                                
                        }
                        
                        echo "true";
                        /*$sql_cmd = "UPDATE category SET name='$name',display='$display',color='$color',slogon='$slogon' WHERE id=". $cate_id;
                        if( mysqli_query( $con , $sql_cmd ) )
                                echo "true";
                        else
                                echo "false";*/

                        mysqli_close($con);

                }
        }
        catch (Exception $e)
        {
                echo "false";
        }
}


        
        
?>
