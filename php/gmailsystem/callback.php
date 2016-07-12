<?php
        header("Access-Control-Allow-Origin:*");
        header('Access-Control-Allow-Credentials:true');
        header('Access-Control-Allow-Methods:GET, POST, PUT, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers:Origin, No-Cache, X-Requested-With, If-Modified-Since, Pragma, Last-Modified, Cache-Control, Expires, Content-Type, X-E4M-With');
        header('Content-Type:text/html; charset=utf-8');
        
        
        // get userid 
        //echo urldecode( json_encode( $cart ) );
        date_default_timezone_set('Asia/Taipei');
        $time = date('Y-m-d H:i');
        
        $con=mysqli_connect("localhost","root","ggyyggy","ttshow");
        $con->query("SET NAMES utf8");

        // Check connection
        if (mysqli_connect_errno()) {
            echo "false";
        }
        else {

            /////////////
            $result = mysqli_query($con, "SELECT * FROM user WHERE facebook_mail='" . base64_decode( $_REQUEST['token'] ) . "'");

            if (mysqli_num_rows($result) > 0) {

                    while($row = mysqli_fetch_array($result)) {

                            $sql = "UPDATE user SET last_login_time='" . $time . "', email_confirm='1' WHERE facebook_mail='" . base64_decode( $_REQUEST['token'] ) . "'";
                            mysqli_query( $con , $sql );

                            $cart = array(
                                "status" => "old",
                                "user_id" => $row['user_id'],
                                "user_name" => urlencode( $row['user_name'] ),
                                "usericon" => $row['usericon'],
                                "cover_photo" => $row['cover_photo'],
                                "usertype" => $row['usertype'],
                                "business" => $row['business'],
                                "usertype_examine" => $row['usertype_examine'],
                                "facebook_mail" => $row['facebook_mail'],
                                "google_mail" => $row['google_mail'],
                                "link_token" => $row['link_token'],
                                "selfie" => $row['selfie'],
                                "email" => $row['email'],
                                "nickname" => $row['nickname'],
                                "birthday" => $row['birthday'],
                                "sex" => $row['sex'],
                                "residence" => $row['residence'],
                                "phone" => $row['phone'],
                                "agreelaw" => $row['agreelaw'],
                                "subscribe_newsletter" => $row['subscribe_newsletter'],
                                "identification" => $row['identification'],
                                "fb_club_name" => $row['fb_club_name'],
                                "fb_club_url" => $row['fb_club_url'],
                                "fb_club_number" => $row['fb_club_number'],
                                "fb_user_url" => $row['fb_user_url'],
                                "fb_user_number" => $row['fb_user_number'],
                                "yt_name" => $row['yt_name'],
                                "yt_url" => $row['yt_url'],
                                "yt_subscribe" => $row['yt_subscribe'],
                                "yt_view" => $row['yt_view'],
                                "ig_id" => $row['ig_id'],
                                "ig_number" => $row['ig_number'],
                                "other_association" => $row['other_association'],
                                "fb_id" => $row['fb_id'],
                                "fb_name" => $row['fb_name'],
                                "google_id" => $row['google_id'],
                                "yt_id" => $row['yt_id'],
                                "registration_time" => $row['registration_time'],
                                "last_login_time" => $time

                            );


                    }
                    
                    
                    echo urldecode( json_encode( $cart ) );
                    
            } else {

                    echo "false";

            }
            
            mysqli_close($con);
            
        }
        
        

?>