<?php
//http://www.ggyyggy.com/bohan/admoney/php/member.php

$func = $_REQUEST["func"];

switch ($func) {
    case "add":
        add();
        break;
    case "login":
        login();
        break;
    case "loginbyFB":
        loginbyFB();
        break;
    case "getonelist":
        getonelist();
        break;
    case "list":
        member_list();
        break;
    case "check":
        check();
        break;
}

function add(){
    
        try{
                
                $signup_username = $_REQUEST["username"];
                $signup_account = $_REQUEST["account"];
                $signup_password = $_REQUEST["password"];
                
                
                $con=mysqli_connect("localhost","root","ggyyggy","anesthesia");
                $con->query("SET NAMES utf8");
                
                
                // Check connection
                if (mysqli_connect_errno()) {
                  echo "Failed to connect to MySQL: " . mysqli_connect_error();
                }

                $result = mysqli_query($con, "SELECT * FROM member WHERE email='$email'");
                
                if (mysqli_num_rows($result) > 0) {
                    
                        echo "exist";
                
                } else {
                        echo $signup_username,$signup_account,$signup_password;
                        
                        mysqli_query($con,"INSERT INTO member( username, account, password)
                        VALUES ('$signup_username','$signup_account','$signup_password')");
                        echo "true";
                        
                }


                        
                     
                mysqli_close($con);
        }
        catch (Exception $e)
        {
                echo "false";
        }
}

function login(){
                
        try{
                $login_account = $_REQUEST["account"];
                $login_password = $_REQUEST["password"];
                
                $con=mysqli_connect("localhost","root","ggyyggy","anesthesia");
                $con->query("SET NAMES utf8");
                
                
                // Check connection
                if (mysqli_connect_errno()) {
                  echo "Failed to connect to MySQL: " . mysqli_connect_error();
                }

                $result = mysqli_query($con, "SELECT * FROM member WHERE account='$login_account' AND password='$login_password'");
                
                if (mysqli_num_rows($result) > 0) {
                    
                        while($row = mysqli_fetch_array($result)) {

                                    $cart = array(
                                                "username" => urlencode( $row['signup_username'] ),
                                                "account" => $row['login_account'],
                                                "password" => $row['login_password']
                                    );

                        }

                        echo urldecode( json_encode( $cart ) );

                
                } else {
                        
                        echo "false";
                        
                }

                mysqli_close($con);
        }
        catch (Exception $e)
        {
                echo "false";
        }
        
}

function loginbyFB(){
    
        try{
                $email = $_REQUEST["email"];
                $id = $_REQUEST["id"];
                $name = $_REQUEST["name"];
                $updated_time = $_REQUEST["updated_time"];
                
                
                $con=mysqli_connect("localhost","root","ggyyggy","socialstreaming");
                $con->query("SET NAMES utf8");
                
                
                // Check connection
                if (mysqli_connect_errno()) {
                    
                        echo "false";
                        
                }
                else {
                    
                        $result = mysqli_query($con, "SELECT * FROM fbmember WHERE id='$id'");

                        if (mysqli_num_rows($result) > 0) {

                                $sql = "UPDATE fbmember SET name='$name' , email='$email' , updated_time='$updated_time' WHERE id='$id'";

                                if ( mysqli_query( $con , $sql ) ) {

                                        if ( mysqli_query( $con , $sql ) ) {

                                                $result = mysqli_query($con, "SELECT * FROM fbmember WHERE id='$id'");

                                                if (mysqli_num_rows($result) > 0) {

                                                        while($row = mysqli_fetch_array($result)) {

                                                            $cart = array(
                                                                "id"    => $row['id'],
                                                                "email" => $row['email'],
                                                                "name" => urlencode( $row['name'] ),
                                                                "updated_time" => $row['updated_time']
                                                            );

                                                        }
                                                        echo urldecode( json_encode( $cart ) );
                                                        //echo getToken();
                                                        
                                                        
                                                } else {
                                                        echo "false";
                                                }
                                        } else {
                                            echo "false";
                                        }

                                } else {
                                    echo "false";
                                }

                        } else {

                                mysqli_query($con,"INSERT INTO fbmember( id, email, name, updated_time )
                                VALUES ('$id','$email','$name','$updated_time' )");

                                $cart = array(
                                        "id"    => $id,
                                        "email" => $email,
                                        "name" => urlencode( $name ),
                                        "updated_time" => $updated_time
                                    );

                                echo urldecode( json_encode( $cart ) );

                        } 

                        mysqli_close($con);
                
                }
        }
        catch (Exception $e)
        {
                echo "false";
        }
}


function getonelist(){
        
        try{
            
                $index_id = $_REQUEST["index_id"];
                $cart = "";
                
                $con=mysqli_connect("localhost","root","ggyyggy","bohan");
                $con->query("SET NAMES utf8");
                
                // Check connection
                if (mysqli_connect_errno()) {
                    echo "Failed to connect to MySQL: " . mysqli_connect_error();
                }

                $result = mysqli_query($con, "SELECT * FROM admoney_member WHERE index_id='$index_id'");

                while($row = mysqli_fetch_array($result)) {
                    
                    $name = $row['name'];
                    /*$id = $row['id'];
                    $email = $row['email'];
                    $name = $row['name'];
                    $sex = $row['sex'];
                    $born = $row['born'];
                    $phone = $row['phone'];
                    $address = $row['address'];
                    $note = $row['note'];*/
                    
                    $cart = array(
                              "index_id" => $row['index_id'],
                              "id" => $row['id'],
                              "email" => $row['email'],
                              "name" => urlencode( $row['name'] ),
                              "sex" => $row['sex'],
                              "born" => $row['born'],
                              "phone" => $row['phone'],
                              "address" => urlencode( $row['address'] ),
                              "note" => $row['note'],
                              "account_info" => json_decode( StringToUrlencode( $row['account_info'] ) )
                            );
                        
                    
                }
                
                if( $name == "" ) {
                    echo "false";
                }
                else{
                    echo urldecode( json_encode( $cart ) );
                }

                mysqli_close($con);
        }
        catch (Exception $e)
        {
                echo "false";
        }
    
}

function member_list(){
        
        try{
                $page = $_REQUEST["page"];
                $pagenum = $_REQUEST["pagenum"];
                $index_id = $_REQUEST["index_id"];
                $cart = array();
                
                
                
                $con=mysqli_connect("localhost","root","ggyyggy","bohan");
                $con->query("SET NAMES utf8");
                
                // Check connection
                if (mysqli_connect_errno()) {
                    echo "Failed to connect to MySQL: " . mysqli_connect_error();
                }
                
                
                foreach ( $index_id as $key => $value){
                        
                        $result = mysqli_query($con, "SELECT * FROM admoney_member WHERE index_id='$value'");

                        while($row = mysqli_fetch_array($result)) {
                            
                            
                            
                            array_push( $cart , array(
                                      "index" => $row['index_id'],
                                      //"email" => $row['email'],
                                      "name" => urlencode( $row['name'] ),
                                      //"sex" => $row['sex'],
                                      //"born" => $row['born'],
                                      "phone" => $row['phone'],
                                      "address" => urlencode( $row['address'] ),
                                      //"note" => $row['note']
                                    ) );

                        }
                    
                }
                
                echo urldecode( json_encode( $cart ) );
                mysqli_close($con);
                
        }
        catch (Exception $e)
        {
                echo "false";
        }
        
}

function check(){
    
        try{
            
                $id = $_REQUEST["account"];
                $password = $_REQUEST["password"];
        
                $con=mysqli_connect("localhost","root","ggyyggy","socialstreaming");
                $con->query("SET NAMES utf8");
                
                // Check connection
                if (mysqli_connect_errno()) {
                    echo "Failed to connect to MySQL: " . mysqli_connect_error();
                }

                $result = mysqli_query($con, "SELECT * FROM admoney_member WHERE id='$id' AND password='$password'");
                
                if (mysqli_num_rows($result) > 0) {
                    
                        echo "true";
                        
                } else {
                    echo "false";
                }

                mysqli_close($con);
        }
        catch (Exception $e)
        {
                echo "false";
        }
        
}

function StringToUrlencode( $value )
{
        $reture_value = "";
        for($i = 0; $i < mb_strlen( $value, "utf-8" ); $i++) 
        {
            if (mb_strlen( mb_substr($value, $i, 1, "utf-8") , "utf-8" ) == strlen( mb_substr($value, $i, 1, "utf-8") ))
            {
                $reture_value = $reture_value . mb_substr($value, $i, 1, "UTF-8");
            }
            else
            {
                $reture_value = $reture_value . urlencode( mb_substr($value, $i, 1, "UTF-8") );
            }
        }
        return $reture_value;
}

function getToken() {
    
        $random = getRandom();
        $random = md5( $random );
        return $random;
    
}

function getRandom()
{
    $var = "";
    for( $i=1 ; $i<=12 ; $i++ )
    {
        $ASCII = getASCII();
        $var .= $ASCII;
    }
    return $var;
}

function getASCII()
{//48~57,65~90 //48~83 65-58=7
    $count = ceil(lcg_randf(47, 57));
    return chr( $count );
}

function lcg_randf($min, $max)
{
    return $min + lcg_value() * abs($max - $min);
}

?>
