<?php
//http://203.66.14.133/bohan/admoney/php/account_record.php
        include 'global.php';

        include("config.php");
        $con = mysqli_connect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
        $con->query("SET NAMES utf8");

        // Check connection
        if (mysqli_connect_errno()) {
            echo "false";
        }
        else {

            $result = mysqli_query($con, "SELECT * FROM click_num");

            if (mysqli_num_rows($result) > 0) {

                    while($row = mysqli_fetch_array($result)) {

                            $category = get_sql( $con , "page", "page_id=" . $row['page_id'] , array( "class" ) );
                            echo $category[0]['class'] . " ";
                            $sql = "UPDATE click_num SET category_id=" . $category[0]['class'] . " WHERE page_id=" . $row['page_id'];
                            mysqli_query( $con , $sql );

                   }
            }
            

            $result = mysqli_query($con, "SELECT * FROM click_num_m");

            if (mysqli_num_rows($result) > 0) {

                    while($row = mysqli_fetch_array($result)) {

                            $category = get_sql( $con , "page", "page_id=" . $row['page_id'] , array( "class" ) );
                            echo $category[0]['class'] . " ";
                            $sql = "UPDATE click_num_m SET category_id=" . $category[0]['class'] . " WHERE page_id=" . $row['page_id'];
                            mysqli_query( $con , $sql );

                   }
            }
            

            $result = mysqli_query($con, "SELECT * FROM click_num_w");

            if (mysqli_num_rows($result) > 0) {

                    while($row = mysqli_fetch_array($result)) {

                            $category = get_sql( $con , "page", "page_id=" . $row['page_id'] , array( "class" ) );
                            echo $category[0]['class'] . " ";
                            $sql = "UPDATE click_num_w SET category_id=" . $category[0]['class'] . " WHERE page_id=" . $row['page_id'];
                            mysqli_query( $con , $sql );

                   }
            }

            mysqli_close($con);

        }

?>
