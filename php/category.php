<?php
//http://203.66.14.133/bohan/admoney/php/account_record.php

include 'config.php';
include 'global.php';

$func = $_REQUEST["func"];

switch ($func) {
    case "add":
        $echo = add();
        break;
    case "listbyid":
        listbyid();
        break;
    case "list":
        $echo = _list();
        break;
    case "search_category":
        $echo = search_category();
        break;
    case "detail_list":
        $echo = detail_list();
        break;
    case "delete":
        $echo = delete();
        break;
    case "save_single_info":
        $echo = save_single_info();
        break;
    case "save_order":
        $echo = save_order();
        break;
}

echo json_encode($echo);

function add()
{
        $callback = array();
        try{
                
                if( !check_empty( array( "token" ) ) ) {
                    $callback['msg'] = "parameter is error.";
                    $callback['success'] = false;
                    return $callback;
                }
                
                $token = md5( $_REQUEST[ "token" ] );
                $con = mysqli_connect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
                $con->query("SET NAMES utf8");
                
                // Check connection
                if (mysqli_connect_errno()) {
                        $callback['msg'] = "SQL connect fail";
                        $callback['success'] = false;
                        return $callback;
                }
                
                $result = mysqli_query($con, "SELECT * FROM account WHERE a_token LIKE '%\\\"$token\\\"%'");
                if (mysqli_num_rows($result) !== 1) {
                    $callback['msg'] = "帳號已從其他地方登入";
                    $callback['success'] = false;
                    mysqli_close($con);
                    return $callback;
                }
                
                $name =  "新增分類";
                $i = 1;
                
                while( 1 ){
                    $category = get_sql($con, "category", "WHERE cate_name='" . $name . (string)$i . "'");
                    if( $category ){
                            $i++;
                    }
                    else {
                            break;
                    }
                }
                
                $sql = "INSERT INTO category( cate_name , cate_display , cate_color ) VALUES ( '" . $name . (string)$i . "','none','#a19e9e' )";
                if( !mysqli_query($con, $sql) ){
                    $callback['msg'] = "add error";
                    $callback['success'] = false;
                    mysqli_close($con);
                    return $callback;
                }
                
                $new_id = (int)mysqli_insert_id($con);
                $group_tree = get_sql($con, "category_tree_json", "order by c_id DESC limit 1");
                
                if( $group_tree ) {
                    $tree = json_decode( $group_tree[0]['c_json'] , true );
                    $tree[] = array( "id" => $new_id );
                    $tree = json_encode($tree);
                    $sql_cmd = "INSERT INTO category_tree_json( c_json ) VALUES ( '$tree' )";

                    if( mysqli_query($con, $sql_cmd) ) {
                        $callback['success'] = true;
                    }
                    else {
                        $callback['msg'] = "insert data error";
                        $callback['success'] = false;
                    }

                }
                else {
                    $callback['msg'] = "fail";
                    $callback['success'] = false;
                }
                
                mysqli_close($con);
                
        }
        catch (Exception $e)
        {
                $callback['msg'] = $e;
                $callback['success'] = false;
        }
        return $callback;
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

function _list()
{
        $callback = array();
        try{
                
                $con = mysqli_connect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
                $con->query( "SET NAMES utf8" );
                $echo = array();

                $i = 0;
                if (mysqli_connect_errno()) {
                        $callback['msg'] = "SQL connect fail";
                        $callback['success'] = false;
                        return $callback;
                }
                
                $category_tree = get_sql($con, "category_tree_json", "order by c_id DESC limit 1");
                if( $category_tree ) {
                    $tree = json_decode( $category_tree[0]['c_json'] , true );

                    $tree = get_group_info( $con , $tree );

                    $callback['data'] = $tree;
                    $callback['success'] = true;
                }
                else {
                    $callback['msg'] = "list fail";
                    $callback['success'] = false;
                }
                mysqli_close($con);

        }
        catch (Exception $e)
        {
                $callback['msg'] = $e;
                $callback['success'] = false;
        }
        return $callback;
}

function search_category()
{
        $callback = array();
        try{
                if( !check_empty( array( "c" , "ori" ) ) ) {
                    $callback['msg'] = "parameter is error.";
                    $callback['success'] = false;
                    return $callback;
                }
                
                $c = $_REQUEST[ "c" ];
                $ori = $_REQUEST[ "ori" ];
                $con = mysqli_connect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
                $con->query( "SET NAMES utf8" );
                $echo = array();
                if( !in_array($ori, array("All","true","false")) ){
                        $callback['msg'] = "parameter is error.";
                        $callback['success'] = false;
                        return $callback;
                }
                        
                $i = 0;
                if (mysqli_connect_errno()) {
                        $callback['msg'] = "SQL connect fail";
                        $callback['success'] = false;
                        return $callback;
                }
                
                $category = get_sql($con, "category", "WHERE cate_display='block' AND cate_id=" . $c);
                if( !$category ){
                        $callback['msg'] = "分類隱藏或不存在";
                        $callback['success'] = false;
                        mysqli_close($con);
                        return $callback;
                }
                
                $category_tree = get_sql($con, "category_tree_json", "order by c_id DESC limit 1");
                if( $category_tree ) {
                    $tree = json_decode( $category_tree[0]['c_json'] , true );
                    
                    $tree = search_group_info( $con , $tree , $c , $ori );
                    if( $tree ){
                        $callback['data'] = $tree;
                        $callback['success'] = true;
                    }
                    else{
                        $callback['msg'] = "找不到分類";
                        $callback['success'] = false;
                    }
                }
                else {
                    $callback['msg'] = "list fail";
                    $callback['success'] = false;
                }
                mysqli_close($con);

        }
        catch (Exception $e)
        {
                $callback['msg'] = $e;
                $callback['success'] = false;
        }
        return $callback;
}

function detail_list()
{
        $callback = array();
        try{
                if( !check_empty( array( "token" ) ) ) {
                    $callback['msg'] = "parameter is error.";
                    $callback['success'] = false;
                    return $callback;
                }
                
                $token = md5( $_REQUEST[ "token" ] );
                $con = mysqli_connect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
                $con->query( "SET NAMES utf8" );
                $echo = array();

                $i = 0;
                if (mysqli_connect_errno()) {
                        $callback['msg'] = "SQL connect fail";
                        $callback['success'] = false;
                        return $callback;
                }
                
                $result = mysqli_query($con, "SELECT * FROM account WHERE a_token LIKE '%\\\"$token\\\"%'");
                if (mysqli_num_rows($result) !== 1) {
                    $callback['msg'] = "帳號已從其他地方登入";
                    $callback['success'] = false;
                    mysqli_close($con);
                    return $callback;
                }
                
                $category_tree = get_sql($con, "category_tree_json", "order by c_id DESC limit 1");
                if( $category_tree ) {
                    $tree = json_decode( $category_tree[0]['c_json'] , true );

                    $tree = get_detail_info( $con , $tree );

                    $callback['data'] = $tree;
                    $callback['success'] = true;
                }
                else {
                    $callback['msg'] = "list fail";
                    $callback['success'] = false;
                }
                mysqli_close($con);

        }
        catch (Exception $e)
        {
                $callback['msg'] = $e;
                $callback['success'] = false;
        }
        return $callback;
}

function delete()
{
        try{
                if( !check_empty( array( "token" , "cate_id" , "transfer" ) ) ) {
                    $callback['msg'] = "parameter is error.";
                    $callback['success'] = false;
                    return $callback;
                }
                
                $con = mysqli_connect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
                $con->query( "SET NAMES utf8" );
                $echo = array();
                $token = md5( $_REQUEST[ "token" ] );
                $cate_id = $_REQUEST['cate_id'];
                $transfer = $_REQUEST['transfer'];
                $i = 0;

                if (mysqli_connect_errno()) {
                        $callback['msg'] = "SQL connect fail";
                        $callback['success'] = false;
                        return $callback;
                }
                
                $result = mysqli_query($con, "SELECT * FROM account WHERE a_token LIKE '%\\\"$token\\\"%'");
                if (mysqli_num_rows($result) !== 1) {
                        $callback['msg'] = "帳號已從其他地方登入";
                        $callback['success'] = false;
                        mysqli_close($con);
                        return $callback;
                }
                
                $category = get_sql($con, "category", "WHERE cate_id=$cate_id");
                if( !$category ){
                        $callback['msg'] = "Delete ID is not exist";
                        $callback['success'] = false;
                        mysqli_close($con);
                        return $callback;
                }
                
                $category_tree = get_sql($con, "category_tree_json", "order by c_id DESC limit 1");
                if( $category_tree ) {

                    $tree = json_decode( $category_tree[0]['c_json'] , true );
                    $tree = delete_category( $con , $tree , $cate_id , $transfer );

                    $tree = json_encode($tree);
                    $sql_cmd = "INSERT INTO category_tree_json( c_json ) VALUES ( '$tree' )";
                    
                    if( mysqli_query($con, $sql_cmd) ) {
                        $callback['success'] = true;
                    }
                    else {
                        $callback['msg'] = "insert fail";
                        $callback['success'] = false;
                    }

                }
                else {
                    $callback['msg'] = "fail";
                    $callback['success'] = false;
                }
                
                mysqli_close($con);
                
        }
        catch (Exception $e)
        {
                $callback['msg'] = $e;
                $callback['success'] = false;
        }
        return $callback;
}

function save_single_info()
{
        
        $callback = array();
        try{
                if( !check_empty( array( "token" ,
                                         "cate_id" ,
                                         "cate_name" ,
                                         "cate_color" ,
                                         "cate_display" ,
                                         "cate_page" ) ) ) {
                    $callback['msg'] = "parameter is error.";
                    $callback['success'] = false;
                    return $callback;
                }
                
                $con = mysqli_connect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
                $con->query( "SET NAMES utf8" );
                $echo = array();
                $token = md5( $_REQUEST[ "token" ] );
                $cate_id = $_REQUEST['cate_id'];
                $cate_name = $_REQUEST['cate_name'];
                $cate_color = $_REQUEST['cate_color'];
                $cate_display = $_REQUEST['cate_display'];
                $cate_page = $_REQUEST['cate_page'];
                
                if (mysqli_connect_errno()) {
                        $callback['msg'] = "SQL connect fail";
                        $callback['success'] = false;
                        return $callback;
                }
                
                $result = mysqli_query($con, "SELECT * FROM account WHERE a_token LIKE '%\\\"$token\\\"%'");
                if (mysqli_num_rows($result) !== 1) {
                        $callback['msg'] = "帳號已從其他地方登入";
                        $callback['success'] = false;
                        mysqli_close($con);
                        return $callback;
                }
                
                $category = get_sql($con, "category", "WHERE cate_id=$cate_id");
                if ( !$category ) {
                        $callback['msg'] = "ID of category is wrong";
                        $callback['success'] = false;
                        mysqli_close($con);
                        return $callback;
                }
                
                if( $category[0]["cate_name"] !== $cate_name && get_sql($con, "category", "WHERE cate_name='$cate_name'") ) {
                        $callback['msg'] = "分類名稱已存在";
                        $callback['success'] = false;
                        mysqli_close($con);
                        return $callback;
                }
                
                $json = array( "cate_name" => $cate_name ,
                               "cate_color" => $cate_color , 
                               "cate_display" => $cate_display , 
                               "cate_page" => $cate_page );
                if( update_sql($con, "category", $json, array( "cate_id" => (int)$cate_id ) ) ) {
                        $callback['success'] = true;
                }
                else {
                        $callback['msg'] = "update fail";
                        $callback['success'] = false;
                }

                mysqli_close($con);

        }
        catch (Exception $e)
        {
                $callback['msg'] = $e;
                $callback['success'] = false;
        }
        return $callback;
}

function save_order()
{
        $callback = array();
        try{
                if( !check_empty( array( "token" , "tree" ) ) ) {
                    $callback['msg'] = "parameter is error.";
                    $callback['success'] = false;
                    return $callback;
                }
                
                $con = mysqli_connect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
                $con->query( "SET NAMES utf8" );
                $echo = array();
                $token = md5( $_REQUEST[ "token" ] );
                $tree = $_REQUEST['tree'];
                $i = 0;
                
                if (mysqli_connect_errno()) {
                        $callback['msg'] = "SQL connect fail";
                        $callback['success'] = false;
                        return $callback;
                }
                
                $result = mysqli_query($con, "SELECT * FROM account WHERE a_token LIKE '%\\\"$token\\\"%'");
                if (mysqli_num_rows($result) !== 1) {
                    $callback['msg'] = "帳號已從其他地方登入";
                    $callback['success'] = false;
                    mysqli_close($con);
                    return $callback;
                }
                
                $sql_cmd = "INSERT INTO category_tree_json( c_json ) VALUES ( '$tree' )";
                if( mysqli_query($con, $sql_cmd) ) {
                    $callback['success'] = true;
                }
                else {
                    $callback['msg'] = "add fail";
                    $callback['success'] = false;
                }

                mysqli_close($con);

        }
        catch (Exception $e)
        {
                $callback['msg'] = $e;
                $callback['success'] = false;
        }
        return $callback;
}

function get_detail_info( $con , $json ) {
    
    foreach ($json as $key => $value) {
                        
            $category = get_sql($con, "category", "WHERE cate_id=" . $value['id']);
            if( $category )
            {
                $total_click = 0;
                $page_num = 0;
                $page = get_sql($con, "page", "WHERE p_category_id=" . $category[0]['cate_id']);
                if( $page ){
                    $page_num = count( $page );
                    foreach ($page as $key2 => $value2) {
                            $total_click += (int)$value2["p_click_num"];
                    }
                }
                $json[$key]["cate_name"] = $category[0]["cate_name"];
                $json[$key]["cate_color"] = $category[0]["cate_color"];
                $json[$key]["cate_display"] = $category[0]["cate_display"];
                $json[$key]["cate_page"] = json_decode($category[0]["cate_page"]);
                $json[$key]["total_click"] = $total_click;
                $json[$key]["page_num"] = $page_num;
            }
            
            if( isset($value['children']) && !empty($value['children']) ) {
                $json[$key]['children'] = get_detail_info( $con , $value['children'] );
            }
            
    }
    return $json;
}

function get_group_info( $con , $json ) {
    
    foreach ($json as $key => $value) {

            $category = get_sql($con, "category", "WHERE cate_id=" . $value['id']);
            if( $category )
            {
                $json[$key]["cate_name"] = $category[0]["cate_name"];
                $json[$key]["cate_display"] = $category[0]["cate_display"];
                $json[$key]["cate_page"] = json_decode($category[0]["cate_page"]);
            }
            
            if( isset($value['children']) && !empty($value['children']) ) {
                $json[$key]['children'] = get_group_info( $con , $value['children'] );
            }
            
    }
    return $json;
}

function search_group_info( $con , $json , $search , $ori ) {
    
    foreach ($json as $key => $value) {
            if( $value['id'] === (int)$search ){
                
                $return_json = array( "id" => $value['id'] );
                $category = get_sql($con, "category", "WHERE cate_id=" . $value['id']);
                if( $category ) {
                    $return_json["cate_name"] = $category[0]["cate_name"];
                    $return_json["cate_display"] = $category[0]["cate_display"];
                    $return_json["cate_page"] = json_decode($category[0]["cate_page"]);
                    $return_json["focus"] = true;
                }
                
                if( isset($value['children']) && !empty($value['children']) ) {
                    $return_json['children'] = sub_get_info( $con , $value['children'] , $ori );
                }
                return $return_json;
            }
            else{
                if( isset($value['children']) && !empty($value['children']) ) {
                    $check = sub_search_group_info( $con , $value['children'] , $search , $ori );
                    if( $check ){
                        $return_json = array( "id" => $value['id'] );
                        $category = get_sql($con, "category", "WHERE cate_id=" . $value['id']);
                        if( $category ) {
                            $return_json["cate_name"] = $category[0]["cate_name"];
                            $return_json["cate_display"] = $category[0]["cate_display"];
                            $return_json["cate_page"] = json_decode($category[0]["cate_page"]);
                        }
                        $return_json['children'] = $check;
                        return $return_json;
                    }
                }
            }
    }
    return false;
}
function sub_get_info( $con , $json , $ori ) {
    
    foreach ($json as $key => $value) {

            $category = get_sql($con, "category", "WHERE cate_id=" . $value['id']);
            if( $category ) {
                $page_num = 0;
                switch ($ori) {
                    case "All":
                        $ori_mysql_str = "";
                        break;
                    case "true":
                        $ori_mysql_str = " AND p_originality=1";
                        break;
                    case "false":
                        $ori_mysql_str = " AND p_originality=0";
                        break;
                }
                $page = get_sql($con, "page", "WHERE p_display='block' AND p_category_id=" . $category[0]['cate_id'] . $ori_mysql_str);
                if( $page ){
                    $page_num = count( $page );
                }
                $json[$key]["page_num"] = $page_num;
                $json[$key]["cate_name"] = $category[0]["cate_name"];
                $json[$key]["cate_display"] = $category[0]["cate_display"];
                $json[$key]["cate_page"] = json_decode($category[0]["cate_page"]);
            }
            
    }
    return $json;
}
function sub_search_group_info( $con , $json , $search , $ori ) {
    
    $bool = false;
    foreach ($json as $key => $value) {
            
            if( $value['id'] === (int)$search ){
                    $bool = true;
                    $json[$key]["focus"] = true;
            }
            $category = get_sql($con, "category", "WHERE cate_id=" . $value['id']);
            if( $category ) {
                $page_num = 0;
                switch ($ori) {
                    case "All":
                        $ori_mysql_str = "";
                        break;
                    case "true":
                        $ori_mysql_str = " AND p_originality=1";
                        break;
                    case "false":
                        $ori_mysql_str = " AND p_originality=0";
                        break;
                }
                $page = get_sql($con, "page", "WHERE p_display='block' AND p_category_id=" . $category[0]['cate_id'].$ori_mysql_str);
                if( $page ){
                    $page_num = count( $page );
                }
                $json[$key]["cate_name"] = $category[0]["cate_name"];
                $json[$key]["cate_display"] = $category[0]["cate_display"];
                $json[$key]["cate_page"] = json_decode($category[0]["cate_page"]);
                $json[$key]["page_num"] = $page_num;
            }
    }
    if( $bool )
        return $json;
    return $bool;
}

function delete_category( $con , $json , $delete_id , $transfer_id ) {
    
    foreach ($json as $key => $value) {
            
            if( (string)$value["id"] === $delete_id )
            {
                if( isset($value['children']) && !empty($value['children']) ) {
                    delete_all( $con , $value['children'] , $transfer_id );
                }
                delete_one_category( $con , $delete_id , $transfer_id );
                unset( $json[$key] );
                $json = array_values($json);
                return $json;
            }
            else {
                if( isset($value['children']) && !empty($value['children']) ) {
                    $children = delete_category( $con , $value['children'] , $delete_id , $transfer_id );
                    if( empty($children) ){
                        unset($json[$key]["children"]);
                    }
                    else {
                        $json[$key]['children'] = $children;
                    }
                }
            }
            
    }
    
    return $json;
}

function delete_all( $con , $json , $transfer_id ) {
    
    foreach ($json as $key => $value) {
            
            $delete_id = $value["id"];
            if( isset($value['children']) && !empty($value['children']) ) {
                    delete_all( $con , $value['children'] , $transfer_id );
            }
            delete_one_category( $con , $delete_id , $transfer_id );
            
    }
}

function delete_one_category( $con , $delete_id , $transfer_id ) {
    
    $page = get_sql($con, "page", "WHERE p_category_id = $delete_id");
    if( $page ) {
        foreach ($page as $key => $value) {
            $p_category = $transfer_id;
            $cmd = "UPDATE page SET p_category_id=$p_category WHERE page_id=" . $value['page_id'];
            mysqli_query($con, $cmd);
        }
    }
    
    $cmd = "DELETE FROM category WHERE cate_id=$delete_id";
    mysqli_query($con, $cmd);
    
}

?>
