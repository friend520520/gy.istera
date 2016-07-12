<?php 

include 'config.php';
include 'global.php';
include 'account_event.php';
include 'sample/check_login.php';

                date_default_timezone_set('Asia/Taipei');
                $day = date('w');
                $week_start = date('Y-m-d', strtotime('-'.$day.' days'));
                $week_end = date('Y-m-d', strtotime('+'.(6-$day).' days'));
                
                echo $week_start . " ";
                echo $week_end . " ";
                        
                
                
?>