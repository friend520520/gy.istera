
        <nav>
                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="form-group">
                                <label for="nav-search-input" class="sr-only">搜尋</label>
                                <img id="nav-search-btn" class="nav-search-icon" src="template_new/images/index/nav/sreach_b.png">
                                <input onkeypress="header_keypress( event )" class="form-control nav-search" id="nav-search-input" placeholder="搜尋">
                        </div>
                        <script>
                                /*$( "#nav-search-btn" ).bind( "click" , function(){
                                        if( $( "#nav-search-input" ).val() !== "" )
                                            location.href = "../search_results.php?search=" + $( "#nav-search-input" ).val();
                                });*/
                                function header_keypress( event ) {
                                    if( event.which === 13 )
                                        $( "#nav-search-btn" ).trigger( "click" );
                                }
                        </script>
                        <?php

                            $echo = "";
                            foreach ($cate_json as $key => $value) {
                                    $echo .= '<div class="panel panel-default">
                                                        <div class="panel-heading" role="tab" id="heading' . $key . '">
                                                        <h4 class="panel-title">
                                                        <a category="' . $value['id'] . '" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse' . $key . '" aria-expanded="false" aria-controls="collapseOne">' . $value['name'] . '</a>
                                                        </h4>
                                                </div>
                                                <div id="collapse' . $key . '" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                                        </div>
                                            </div>';
                            }
                            echo $echo;

                        ?>

                        <script>

                            $( "#accordion" ).children( ".panel" ).find( "a" ).bind( "click" ,function(){

                                    var category = $( this ).attr( "category" );
                                    $( "#owl-menu .swiper-slide[pagetype=" + category + "]" ).trigger( "click" );

                            });
                        </script>
                        <ul class="footer">
                            <li class="footer-copyright">
                                <p>
                                        Copyright &copy; 2015
                                </p>
                                <p>
                                        台灣達人秀 版權所有
                                </p>
                            </li>
                        </ul>
                </div>
        </nav>
        