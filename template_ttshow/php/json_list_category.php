<?php
                        
    include("config.php");                    
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

?>