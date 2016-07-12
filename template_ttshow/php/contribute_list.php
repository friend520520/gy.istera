<?php 
        include("config.php");
        include("SQL_table_control.php");
        include("global.php");
        
        $con = mysqli_connect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
        $con->query( "SET NAMES utf8" );
        $callback = array();
        $user = $_REQUEST['user'];
        
        if (mysqli_connect_errno()) {
                echo "false";
        }
        else {
                
                $user1 = get_sql($con, "user", "email='$user'", array( "usertype" ) );
                
                if( $user1[0]['usertype'] === "root" || $user1[0]['usertype'] === "boss" ) {
                    
                    $result = mysqli_query($con, "SELECT * FROM contribute");

                    if ( mysqli_num_rows($result) > 0) {

                            while($row = mysqli_fetch_array($result)) {
                                    
                                    $author = get_sql($con, "user", "user_id=" . $row['user_id'], array( "user_name" , "usericon" , "email" ) );
                                
                                    $callback[] = array( "contribute_id" => $row['page_id'] , 
                                                        "user_id" => $row['user_id'] , 
                                                        "user_name" => $author[0]['user_name'] , 
                                                        "usericon" => $author[0]['usericon'] , 
                                                        "user_email" => $author[0]['email'] , 
                                                        "article_icon" => $row['article_icon'] , 
                                                        "tag" => $row['tag'] , 
                                                        "title" => $row['title'] , 
                                                        "html" => $row['html'] ,
                                                        "date" => $row['date'] );

                            }

                            echo json_encode($callback);
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
        
        
?>
