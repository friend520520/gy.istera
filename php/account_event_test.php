<?php
    
    
    include 'config.php';
    include 'global.php';
    include 'account_event.php';
    
    $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    $con->query("SET NAMES utf8");
    
    // Check connection
    if (mysqli_connect_errno()) {
            echo "SQL connect fail";
            exit();
    }
    
    $callback = fn_count( $con, "AV00001", "IEX9SNRC9AD57QN3OGS9" );
    print_r($callback);
    echo $callback['success'] ? " true" : " false";
    echo "<br>";
    
    $callback = fn_count( $con, "AV00002", "IEX9SNRC9AD57QN3OGS9" );
    print_r($callback);
    echo $callback['success'] ? " true" : " false";
    echo "<br>";
    
    $callback = fn_count( $con, "AV00003", "IEX9SNRC9AD57QN3OGS9" );
    print_r($callback);
    echo $callback['success'] ? " true" : " false";
    echo "<br>";
    
?> 