<?php 
        include("config.php");
        include("global.php");
                
        try
        {
                    $user = $_REQUEST['user'];
                    $callback = array();
                    $page_num = $_REQUEST['page_num'];
                    $page = $_REQUEST['page'];
                    $select_con = "";
                    //SELECT * FROM articles 
                    
                    $_page = ( (int)$page - 1 )* (int)$page_num;
                    $con = mysqli_connect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
                    $con->query( "SET NAMES utf8" );

                    if (mysqli_connect_errno()) {
                            echo "false";
                    }
                    else {
                            
                            if( $user === "" )
                            {
                                    echo "false";
                            }
                            else
                            {

                                    $user1 = get_sql( $con , "user" , "email='" . $user . "'" , array( "user_id" ) );
                                    $subscribe = get_sql_array( $con , " subscribe" , "user_id=" . $user1[0]["user_id"] , array( "channel_id" ) );
                                    
                                    foreach ($subscribe as $key => $value) {
                                            
                                            if( $key === 0 )
                                                $select_con .= " AND ( channel_id=" . $value;
                                            else
                                                $select_con .= " OR channel_id=" . $value;
                                            
                                            if( $key === count( $subscribe ) - 1 )
                                                $select_con .= " )";

                                    }
                                    
                                    if( $select_con === "" )
                                    {
                                        echo "false";
                                    }
                                    else
                                    {
                                            
                                            $result = mysqli_query($con, "SELECT * FROM page WHERE display!='none'$select_con ORDER BY date DESC LIMIT $_page, $page_num");
                                            
                                            if ( mysqli_num_rows($result) > 0) {

                                                    while($row = mysqli_fetch_array($result)) {
                                                            
                                                            $callback[] = create_json2( $con , $user , $row );
                                                            
                                                    }
                                                    echo json_encode( $callback );
                                                    
                                            }
                                            else {
                                                    echo "false";
                                            }
                                    }
                            }



                            mysqli_close($con);

                    }
        }
        catch (Exception $e)
        {
                echo "false";
        }
        
?>