<?php 
        header("Access-Control-Allow-Origin:*");
        header('Access-Control-Allow-Credentials:true');
        header('Access-Control-Allow-Methods:GET, POST, PUT, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers:Origin, No-Cache, X-Requested-With, If-Modified-Since, Pragma, Last-Modified, Cache-Control, Expires, Content-Type, X-E4M-With');
        header('Content-Type:text/html; charset=utf-8');
        
        include("config.php");
        include("global.php");
        include("emoji.php");
        
        try
        {
                    $page = $_REQUEST['page'];
                    $page = explode(",", $page);
                    $callback = array();
                    
                    $con = mysqli_connect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
                    $con->query( "SET NAMES utf8" );

                    if (mysqli_connect_errno()) {
                            echo "false";
                    }
                    else {
                            
                            foreach ($page as $key => $value) {
                                    
                                    $result = mysqli_query($con, "SELECT * FROM page WHERE display!='none' AND page_id='$value'");
                                    if ( mysqli_num_rows($result) > 0) {

                                            while($row = mysqli_fetch_array($result)) {

                                                    $author = get_sql( $con , "user" , "user_id='" . $row['user_id'] . "'" , array( "user_name" , "usericon" , "business" , "facebook_mail" ) );
                                                    $callback[] = array(  "title" => $row['title'] , 
                                                                        "describe" => $row['describe'] , 
                                                                        "article_icon" => $user_image_path . $row['page_id'] . "/ThumbnailM/" . $row['article_icon'] ,
                                                                        "author_name" => $author[0]['user_name'] , 
                                                                        "url" => "http://ttshow.tw/new/inner.php?page_id=" . $value );

                                            }

                                    } else {
                                            $callback[] = false;
                                    }
                                    
                                    
                            }
                            echo json_encode( $callback );
                        
                            

                            mysqli_close($con);

                    }
        }
        catch (Exception $e)
        {
                echo "false";
        }
        
?>
