<div id="navbar-container" class="navbar-container" style="height: 50px;">

            <div style="display: none; color: white;" class="nav-search pull-left" id="user-profile">
            </div>

            <!--div id="header_login" class="status_logout" style="display: none; cursor: pointer;margin-right: 85px">
                <i style="color: white; float: right; margin: 15px 10px; font-size: 12pt;" class="menu-icon child-middle">
                    <img  src="template/assets/images/member.png" alt="ttshow" style="margin: 0 3px;cursor: pointer;width: 15px">
                    <span onclick="Login_Popup_show()" style="font-style: normal;">登入</span>

                </i>
            </div 0730email-->

            <ul class="ace-nav status_login" style="float: right; display: none; padding-right: 85px;">
                    <li style="display: block;">
                            <b data-toggle="dropdown" href="#" class="dropdown-toggle" aria-expanded="true">
                                    <div id="header_user_icon" style="position: relative; border-radius: 100%; height: 30px; width: 30px; vertical-align: middle; display: inline-block;" class="bg_top"></div>
                                    <span id="header_user_name" style="top:0px; vertical-align: middle;"></span>
                                    <i class="ace-icon fa fa-caret-down"></i>
                            </b>
                            <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                                    <li>
                                            <a href='author_page.php'>
                                                    <i class="ace-icon fa fa-user"></i>Profile
                                            </a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                            <a style="cursor: pointer;" id="FB_logout_btn">
                                                    <i class="ace-icon fa fa-power-off"></i>Logout
                                            </a>
                                    </li>
                            </ul>
                    </li>
            </ul>

            <div class="status_login" style="color: white; float: right; margin: 15px 10px;">
                <img style="vertical-align: middle; width: 28px;" src="images/mail.png">
            </div>

            <a href="http://bit.ly/1Fi4u8T" target="_blank">
                <i style="color: white; float: right; margin: 15px 10px; font-size: 12pt;" class="menu-icon child-middle">
                    <img style="cursor: pointer; margin: 0px 3px; width: 16px;" alt="ttshow" src="template/assets/images/write.png">
                    <span style="font-style: normal; font-size: 18px;">發表創作</span>
                </i>
            </a>

            <a href='new.php'>
                <i style="color: white; float: right; margin: 15px 10px; font-size: 12pt;" class="menu-icon child-middle">
                    <img src="http://www.ooxxoox.com/ttshow/mobile/template/assets/images/1-2white.png" alt="ttshow" style="cursor: pointer; width: 16px; margin: 0px 3px;">
                    <span style="font-style: normal; font-size: 18px;">動態</span>
                </i>
            </a>
            <!--div>
                <i class="menu-icon " style="color: white; float: right; margin: 14px 10px; font-size: 12pt;">
                <img style="cursor: pointer; margin: 0px 3px; width: 14px;" alt="ttshow" src="template/assets/images/dowload.png" onclick="window.open('https://www.apple.com/tw/itunes/charts/free-apps/')/*javascript:location.href='https://play.google.com/store/apps';*/;">
                <span style="font-style: normal;">APP下載</span></i>
            </div-->


            <!--button style="display: none;" type="button" class="navbar-toggle menu-toggler pull-right" id="user-profile-join"> 加入 </button-->

            <div style="cursor: pointer;" class="navbar-header pull-left">
                    <a href='index.php'>
                        <img style="width: 120px; margin: 12px 0px 12px 85px;" alt="ttshow" src="images/ttshow-logo.png">
                    </a>
            </div>
            <!--AL 0427 edit-->
            <!--button data-target="#sidebar" id="menu-toggler" class="status_login navbar-toggle menu-toggler pull-left" type="button" style="display: none;cursor: pointer; margin-left: 25px; border: 0px none; margin-top: 10px; margin-right: 15px;"
                    onclick="location.href='author_page.php'">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
            </button-->
            <div id="nav-search" class="nav-search pull-left" style="margin: 11px 0 11px 10px;">
                <div class="form-search">
                    <span class="input-icon" id="header_search">
                        <input onkeypress="header_keypress( event )" type="text" autocomplete="off" id="nav-search-input" class="nav-search-input" placeholder="" style="padding-left: 6px;">
                        <i class="ace-icon fa fa-search nav-search-icon" style="cursor: pointer; color: gray ! important; right: 0%; left: auto;"></i>
                    </span>
                </div>
            </div>
            <script>
                    $( "#header_search i" ).bind( "click" , function(){

                            if( $( "#header_search input" ).val() !== "" )
                                location.href = "search_results.php?search=" + $( "#header_search input" ).val();

                    });

                    function header_keypress( event ) {

                        console.log( event.which );
                        if( event.which === 13 )
                            $( "#header_search i" ).trigger( "click" );

                    }

            </script>

            <div style="margin: 15px 10px;" class="pull-left">
                <div class="fb-like" data-href="https://www.facebook.com/TaiwanTalentShow" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>
            </div>

            <div data-target="#myModalCommunity" data-toggle="modal" style="cursor: pointer; text-align: center; float: right; background-color: white; padding: 0px 8px; margin: 13px 0px;" class="btn-group pull-left">
                    <h4 style="text-align: center; font-size: 14px; margin: 0px;">更多 <i style="color: gray; font-size: 15px; margin-top: 3px;" class="fa fa-plus"></i></h4>
            </div>

</div>