

    <div id="main_tab" class="main-content-inner" style="height: 45px;">
                        <!-- /section:basics/content.breadcrumbs -->
                        <div class="page-content" style="background-color: rgb(249, 249, 249); height: 45px;">
                                <div class="row">
                                        <div class="col-xs-12">
                                            <div id="tabs" style="margin-left: 107px; display: none;">
                                                <ul style="height: 33px; overflow-x: auto; overflow-y: hidden;" class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all" role="tablist">
                                                        <a href="index.php?tab=0">
                                                            <li pagetype="0" style="position: absolute; left: 0px;" class="ui-state-default ui-corner-top" role="tab" tabindex="0" aria-controls="1" aria-labelledby="ui-id-1" aria-selected="true" aria-expanded="true">
                                                                        <p class="ui-tabs-anchor" role="presentation" tabindex="-1" id="ui-id-1">首頁</p>
                                                            </li>
                                                        </a>
                                                        <?php

                                                            include("php/config.php");
                                                            $con = mysqli_connect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
                                                            $con->query( "SET NAMES utf8" );
                                                            $echo = "";
                                                            $i = 0;

                                                            if (mysqli_connect_errno()) {

                                                            }
                                                            else {
                                                                    $result = mysqli_query($con, "SELECT * FROM category WHERE display='true' ORDER BY _order");
                                                                    if ( mysqli_num_rows($result) > 0) {

                                                                            $left = 65;

                                                                            while($row = mysqli_fetch_array($result)) {

                                                                                    $echo .= '<a href="index.php?tab=' . $row['id'] . '">' .
                                                                                                '<li pagetype="' . $row['id'] . '" style="position: absolute; left: ' . $left . 'px;" class="ui-state-default ui-corner-top">
                                                                                                            <p class="ui-tabs-anchor" href="#' . $row['id'] . '">' . $row['name'] . '</p>
                                                                                                </li>' .
                                                                                            '</a>';
                                                                                    $left += 33 + 16/3 *strlen($row['name']);
                                                                            }

                                                                            echo $echo;

                                                                    }

                                                                    mysqli_close($con);

                                                            }

                                                        ?>

                                                </ul>
                                            </div>
                                            
                                            <script>

                                                /*var data = [ "名人堂" , "百萬經典" , "部落格" , "投稿入選" ];

                                                var left = parseInt( $( "#tabs ul a" ).children(":last").css("left") ) + $( "#tabs ul a" ).children(":last").children("p").html().length * 16 + 33;
                                                $.each( data , function( index , value ){

                                                            $( "#tabs ul" ).append( '<a>' +
                                                                                        '<li style="position: absolute; left: ' + left + 'px;" class="ui-state-default ui-corner-top">' +
                                                                                                    '<p class="ui-tabs-anchor">' + value + '</p>' +
                                                                                        '</li>' +
                                                                                    '</a>' );
                                                            left += 33 + 16 * value.length;
                                                });*/

                                            </script>

                                        </div><!-- /.col -->
                                </div><!-- /.row -->
                        </div><!-- /.page-content -->
                        <div style="display: none; padding: 0px 10px; background-color: white;" class="col-xs-12 col-sm-12">
                            <div id="sub_category" style="font-size: 15px; position: relative; height: 35px; overflow-x: auto; overflow-y: hidden; padding: 8px 0px; word-break: keep-all;">

                            </div>
                        </div>
                        <script>
                                
                                
                                
                                var bohan_sub_category = ["本日熱門"];

                                var left = 0;
                                $.each( bohan_sub_category , function( index , value ){

                                            $( "#sub_category" ).append( '<span value="' + value + '" style="position: relative; padding: 2px 10px;">' + value + '</span>' );
                                            
                                });

                        </script>
</div>
