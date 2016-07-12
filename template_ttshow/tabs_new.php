<div class="menu">
        <div class="menu-swiper-container">
            <div id="owl-menu" class="swiper-wrapper">
                <!--div class="swiper-slide selected" pagetype="0" style="display: none;"><a href="index.php?tab=0">首頁</a></div-->
                <?php
                        include("php/config.php");
                        $con = mysqli_connect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
                        $con->query( "SET NAMES utf8" );
                        $echo = "";
                        $cate_json = array();
                        $i = 0;

                        if (mysqli_connect_errno()) {}
                        else {
                                $result = mysqli_query($con, "SELECT * FROM category WHERE display='true' ORDER BY _order");
                                if ( mysqli_num_rows($result) > 0) {
                                        while($row = mysqli_fetch_array($result)) {
                                                $i ++ ;
                                                $cate_json[] = array( "id" => $row['id'] , "name" => $row['name'] );
                                        }
                                }
                                mysqli_close($con);
                        }
                        
                        
                        $echo = "";
                        foreach ($cate_json as $key => $value) {
                                $echo .= '<div class="swiper-slide" pagetype="' . $value['id'] . '"><a href="index.php?tab=' . $value['id'] . '">' . $value['name'] . '</a></div>';
                        }
                        echo $echo;

                ?>
            </div>
        </div>
</div>
<!--script>
        
        var owl = $("#owl-menu");
 
        owl.owlCarousel({

                navigation : false,

                itemsCustom : [
                        [0, 5],
                        [450, 6],
                        [600, 8],
                        [700, 8],
                        [1000, 12],
                        [1200, 13],
                        [1400, 13],
                        [1600, 15]
                ]

        });
        
</script-->