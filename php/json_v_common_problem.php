<?php

include 'config.php';
include 'global.php';

$func = $_REQUEST["func"];

switch ($func) {
    case "get_list":
        $echo = get_list();
        break;
}

echo json_encode($echo);

function get_list(){
        
        $callback = array();
        try{
                
                $DB_CON = DB_CON( DB_NAME );
                if( !$DB_CON["success"] ){
                        return $DB_CON;
                }
                $con = $DB_CON["data"];
                
                $data = get_sql($con, "common_problem_class as cpc left join ( SELECT cpc_id,group_concat( cp_title separator ';' ) as 'cp_title',group_concat( cp_description separator ';' ) as 'cp_description' FROM common_problem group by cpc_id ) a on cpc.cpc_id=a.cpc_id", 
                               "" ,
                               "*,cpc.cpc_id");
                
                if( $data ) {
                        foreach ($data as $key => $value) {
                                $data[$key]["child"] = array();
                                if( $value["cp_title"] !== "" && $value["cp_title"] !== NULL ){
                                    $cp_title = explode(";", $data[$key]["cp_title"]);
                                    $cp_description = explode(";", $data[$key]["cp_description"]);
                                    unset( $data[$key]["cp_title"] );
                                    unset( $data[$key]["cp_description"] );
                                    foreach ($cp_title as $key2 => $value2) {
                                            $data[$key]["child"][$key2]["cp_title"] = $value2;
                                            $data[$key]["child"][$key2]["cp_description"] = $cp_description[$key2];
                                    }
                                }
                        }
                        $callback['data'] = $data;
                        $callback['success'] = true;
                }
                else {
                        $callback['data'] = array();
                        $callback['success'] = true;
                }

                mysqli_close($con);

                return $callback;
                
        }
        catch (Exception $e)
        {
                echo "false";
        }
}

?>
