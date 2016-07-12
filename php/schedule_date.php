<?php
        //http://www.ggyyggy.com/help/php/event.php?func=cal_interest
        date_default_timezone_set('Asia/Taipei');
        include __DIR__ . '/config.php';//_test
        include __DIR__ . '/global.php';
        include __DIR__ . '/account_event.php';

        $DB_CON = DB_CON( DB_NAME );
        if( !$DB_CON["success"] ){
                return $DB_CON;
        }
        $con = $DB_CON["data"];
        
        $system = get_sql( $con , "system" ,"WHERE s_id = 1");
        $s_help_interest_time = $system ? $system[0]["s_help_interest_time"] : DEFAULT_HELP_INTEREST_TIME;
        $SetTime = strtotime($s_help_interest_time);
        
        $Now = strtotime(date('H:i').":00") . " ";
        $Now_add4 = strtotime(date('H:i').":00 +4 hour") . " ";
        
        echo strtotime($s_help_interest_time) . " ";
        echo $Now . " ";
        echo $Now_add4 . " ";
        
        
        if( $SetTime >= $Now && $SetTime <= $Now_add4 ){
            
            $fn_event = fn_event( $con, "H00011" );
            if( !$fn_event["success"] ) {
                    $callback['msg'] = $fn_event["msg"];
                    $callback['success'] = false;
                    mysqli_close($con);
                    return $callback;
            }
            $callback['success'] = true;
            
        }
        else{
            $callback['msg'] = "TIME ERROR";
            $callback['success'] = false;
        }
        
        print_r($callback);
        
        mysqli_close($con);
        
        
        
        
        sleep(10);
        
        
?>