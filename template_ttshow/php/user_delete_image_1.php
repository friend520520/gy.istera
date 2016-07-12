<?php

        include("php_lib/JSON/Services_JSON.php");
        $json = new Services_JSON();
        


        $id = $_REQUEST['account'];
        $img = $_REQUEST['img'];
        $dir = "../../../TTShow/account";

        if( $id === "" )
            $id = "default";
        
        $img = $json->decode( $img );
        
        foreach ($img as $key => $value) {
                
                @unlink( $dir . "/" . $id . "/Original/" . $value  );
                @unlink( $dir . "/" . $id . "/ThumbnailS/" . $value  );
                @unlink( $dir . "/" . $id . "/ThumbnailM/" . $value  );
                @unlink( $dir . "/" . $id . "/Preview/" . $value  );
                
        }
        
        

?>