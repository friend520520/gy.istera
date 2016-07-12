<?php 
        include("config.php");
        include("global.php");
                
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
                                    $collect = '<button style="padding: 0px; width: 100%; height: 40px; background: rgb(243, 73, 0) none repeat scroll 0px 0px ! important; border-color: rgb(243, 73, 0) ! important;" class="btn-sm btn btn-grey col-lg-9 page-btnbar-btn collect" article="' . $page . '">
                                                        <i class="ace-icon fa  fa-heart fa-lg">
                                                            <span style="">收藏</span>
                                                        </i>
                                                    </button>';
                            }
                            else
                            {
                                    
                                    $user1 = get_sql( $con , "user" , "email='" . $user . "'" , array( "user_id" ) );
                                    $collect = get_sql_array( $con , " collect" , "user_id='" . $user1[0]["user_id"] . "'" , array( "page_id" ) );
                                    
                                    
                                    if( in_array( $page , $collect ) )
                                        $collect = '<button style="padding: 0px; width: 100%; height: 40px; background: rgb(243, 73, 0) none repeat scroll 0px 0px ! important; border-color: rgb(243, 73, 0) ! important;" class="btn-sm btn btn-grey col-lg-9 page-btnbar-btn collect already" article="' . $page . '">
                                                        <i class="ace-icon fa fa-lg">
                                                            <span style="">已收藏</span>
                                                        </i>
                                                    </button>';
                                    else
                                        $collect = '<button style="padding: 0px; width: 100%; height: 40px; background: rgb(243, 73, 0) none repeat scroll 0px 0px ! important; border-color: rgb(243, 73, 0) ! important;" class="btn-sm btn btn-grey col-lg-9 page-btnbar-btn collect" article="' . $page . '">
                                                        <i class="ace-icon fa fa-heart fa-lg">
                                                            <span style="">收藏</span>
                                                        </i>
                                                    </button>';
                                    
                                    
                                            
                                    
                                    
                            }

                            echo $collect;
                            
                            mysqli_close($con);

                    }
        }
        catch (Exception $e)
        {
                echo "false";
        }
        
?>