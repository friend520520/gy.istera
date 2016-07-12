<?php

if( isset($_REQUEST["aaa"])  ) {
    echo "true";
}
else {
    echo "false";
}
//&& !empty($_REQUEST["aaa"])
$aaa = "";
if( empty($aaa)  ) {
    echo "true";
}
else {
    echo "false";
}
?>