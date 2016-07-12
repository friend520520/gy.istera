<?php
//http://203.66.14.133/bohan/admoney/php/account_record.php

include("global.php");

$func = $_REQUEST["func"];

switch ($func) {
    case "loginbyFB":
        loginbyFB();
        break;
    case "loginbytoken":
        loginbytoken();
        break;
}

function loginbyFB()
{
        global $server_website_path;
        try{
                
                $email = $_REQUEST["email"];
                $id = $_REQUEST["id"];
                $name = $_REQUEST["name"];
                $updated_time = $_REQUEST["updated_time"];
                
                
                $con=mysqli_connect("localhost","root","ggyyggy","ttshow");
                $con->query("SET NAMES utf8");
                
                // Check connection
                if (mysqli_connect_errno()) {
                    echo "false";
                }
                else {
                    
                    /////////////
                    $result = mysqli_query($con, "SELECT * FROM user WHERE facebook_mail='$email'");

                    if (mysqli_num_rows($result) > 0) {

                            while($row = mysqli_fetch_array($result)) {

                                    $cart = array(
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
                                        "agreemsg" => $row['agreemsg'],
                                        "history_keep" => $row['history_keep'],
                                        "subscribe_newsletter" => $row['subscribe_newsletter'],
                                        "mail_notice" => $row['mail_notice'],
                                        "channel_name" => $row['channel_name'],
                                        "identification" => $row['identification'],
                                        "channel_introduce" => $row['channel_introduce'],
                                        "channel_url" => $row['channel_url'],
                                        "fb_club_name" => $row['fb_club_name'],
                                        "fb_club_url" => $row['fb_club_url'],
                                        "fb_club_number" => $row['fb_club_number'],
                                        "fb_user_url" => $row['fb_user_url'],
                                        "fb_follow_number" => $row['fb_follow_number'],
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
                                        "yt_id" => $row['yt_id'] 	 	 	
                                    );

                                    echo urldecode( json_encode( $cart ) );
                                
                            }
                            
                    } else {
                            mysqli_query($con,"INSERT INTO user( user_name, usericon, usertype, business, usertype_examine, facebook_mail, fb_id, fb_name )
                            VALUES ( '$name','','','','none','$email','$id','$name' )");
                            
                            $result = mysqli_query($con, "SELECT * FROM user WHERE facebook_mail='$email'");

                            if (mysqli_num_rows($result) > 0 ) {

                                    while($row = mysqli_fetch_array($result)) {

                                            $cart = array(
                                                "user_id" => $row['user_id'],
                                                "user_name" => urlencode( $row['user_name'] ),
                                                "usericon" => $row['usericon'],
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
                                                "agreemsg" => $row['agreemsg'],
                                                "history_keep" => $row['history_keep'],
                                                "subscribe_newsletter" => $row['subscribe_newsletter'],
                                                "mail_notice" => $row['mail_notice'],
                                                "channel_name" => $row['channel_name'],
                                                "identification" => $row['identification'],
                                                "channel_introduce" => $row['channel_introduce'],
                                                "channel_url" => $row['channel_url'],
                                                "fb_club_name" => $row['fb_club_name'],
                                                "fb_club_url" => $row['fb_club_url'],
                                                "fb_club_number" => $row['fb_club_number'],
                                                "fb_user_url" => $row['fb_user_url'],
                                                "fb_follow_number" => $row['fb_follow_number'],
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
                                                "yt_id" => $row['yt_id'] 	 	 	
                                            );

                                            echo urldecode( json_encode( $cart ) );

                                    }
                            } else {
                                    echo "false";
                            }
                            
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

?>
