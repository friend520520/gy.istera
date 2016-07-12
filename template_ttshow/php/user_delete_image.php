<?php

        include("global.php");
        $path = $server_website_path;

        $id = $_REQUEST['account'];
        $img = $_REQUEST['img'];

        if( $id === "" )
            $id = "default";
        
        //$img = $json->decode( $img );
        
        foreach ($img as $key => $value) {
                
            try {

                unlink( $path . $id . "/Original/" . $value  );
                unlink( $path . $id . "/ThumbnailS/" . $value  );
                unlink( $path . $id . "/ThumbnailM/" . $value  );
                unlink( $path . $id . "/Preview/" . $value  );
                echo "true";
                
            } catch (Exception $exc) {
                echo "false";
            }

        }
        

?>