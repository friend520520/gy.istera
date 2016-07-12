<div id="sidebar" style="position: relative; height: 1000px; float: left; width: 190px; display: none;">
    
<div class="sidebar responsive" data-sidebar="true" data-sidebar-scroll="true" data-sidebar-hover="true" 
     style="float: left; position: fixed; background-color: rgb(46, 47, 49); overflow-y: auto; overflow-x: hidden;">
        
        <script type="text/javascript">
        try{
                    ace.settings.check('sidebar' , 'fixed')
        }
        catch(e)
        {
        }
        </script>

        <!--AL 0409清除多餘的code-->
        <ul class="nav nav-list" style="top: 0px;">
                    <!-- AL 0429 edit-->
                    <li class="" id="apply_account">
                      <a data-url="page/widgets" href="author_page.php" style="padding: 14px 10px; height: 90px;" id="modify_account">
                            <div id="sidebar_usericon" style="background-image: url(&quot;https://scontent-sjc.xx.fbcdn.net/hphotos-xaf1/v/t1.0-9/11096391_1585289685060935_5723086166710946159_n.jpg?oh=082aae28331d37eccb70c6547801a986&amp;oe=55D85813&quot;); border-radius: 100%; height: 55px; width: 55px; margin-left: 5px;" class="chessboard-icon bg_top"></div>
                            <h4 id="sidebar_name" style="margin-left: 76px; font-size: 15px; color: white; margin-top: 5px; margin-bottom: -1px;">狗與鹿</h4>
                            <h4 style="margin-left: 76px; color: darkgrey; font-size: 14px; letter-spacing: 1px;">設定</h4>
                      </a>
                    </li>
                    <!--li id="apply_account" class="active open">
                       <a class="dropdown-toggle" href="#">
                        <i class="menu-icon fa fa-star">
                        </i>
                        <span class="menu-text">
                          會員資料
                        </span>

                        <b class="arrow fa fa-angle-down">
                        </b>
                      </a>

                      <ul class="submenu nav-show" style="display: none;">
                        <!--li class="">
                          <a href="member.php" data-url="page/typography">
                            <i class="menu-icon fa fa-caret-right">
                            </i>
                            會員資料
                          </a>
                        </li>

                        <li class="">
                          <a href="signup.php" data-url="page/elements">
                            <i class="menu-icon fa fa-caret-right">
                            </i>
                            合作頻道資料
                          </a>
                        </li-->
                        
                    <!--li id="apply_member" class="">
                      <a data-url="page/typography">
                        <i class="menu-icon fa fa-caret-right">
                        </i>
                        申請會員
                      </a>
                    </li-->
                    <!-- AL 0429 edit-->
                    <!--li id="modify_account" class="">
                      <a data-url="page/typography" href="apply_account.php?modify_account">
                        <i class="menu-icon fa fa-caret-right">
                        </i>
                        修改會員資料
                      </a>
                    </li>

                    <li id="apply_channel" class="">
                      <a data-url="page/elements" href="apply_account.php?apply_channel">
                        <i class="menu-icon fa fa-caret-right">
                        </i>
                        申請合作頻道/小編
                      </a>
                    </li-->

                   <!--li class="" id="un_editor" style="display: none;">
                      <a href="apply_account.php?apply_channel" data-url="page/elements" style="color: red">
                        <i class="menu-icon fa fa-caret-right">
                        </i>
                          申請 (審核中)
                      </a>
                    </li>

                  </ul>
                </li-->

                    <li class="" level="member" >
                      <a data-url="page/widgets" href="manage_history.php">
                        <i class="menu-icon fa fa-eye">
                        </i>
                        <span class="menu-text">瀏覽紀錄</span>
                      </a>
                    </li>
                    <li class="" level="member" >
                      <a data-url="page/widgets" href="collect.php">
                        <i class="menu-icon fa 	fa-heart ">
                        </i>
                        <span class="menu-text">
                          我的收藏
                        </span>
                      </a>
                    </li>
                    <li class="" level="member" >
                      <a onclick="if( window.location.host === 'www.ooxxoox.com' )location.href='subscription.php'" data-url="page/widgets"><!-- href="subscription.php"-->
                        <i class="menu-icon fa fa-list">
                        </i>
                        <span class="menu-text">
                          訂閱頻道
                        </span>
                      </a>
                    </li>

                </ul>
                <!--AL 0429-->
                <div level="member">
                    <ul style="position: relative; transition-property: top; transition-duration: 0.15s; height: 30px;" class="nav nav-list">
                        <li style="list-style-type: none">
                                    <a style="background-color: rgb(27, 27, 27); padding: 5px 10px; font-weight: normal; font-size: 12px;">
                                                <span class="menu-text" style="color: white; font-weight: bold; text-align: left; margin-left: 5px;">小編管理</span>
                                    </a>
                        </li>
                    </ul>
                    <ul class="nav nav-list" style="top: 0px; position: relative; transition-property: top; transition-duration: 0.15s;">       

                        <li class="" level="root" >
                            <a data-url="page/widgets" href="tab_setting.php">
                                <i class="menu-icon fa fa-sliders">
                                </i>
                                <span class="menu-text">分類管理</span>
                            </a>
                        </li>
                        <li class="" level="root" >
                            <a href="channel_examine.php" data-url="page/widgets">
                                <i class="menu-icon fa fa-sliders">
                                </i>
                                <span class="menu-text">審核頻道</span>
                            </a>
                        </li>
                        <li class="" level="root" >
                            <a href="manage_account.php" data-url="page/widgets">
                                <i class="menu-icon fa fa-sliders">
                                </i>
                                <span class="menu-text">會員權限管理</span>
                            </a>
                        </li>
                        <li class="" level="root" >
                            <a href="manage_creation.php" data-url="page/widgets">
                                <i class="menu-icon fa fa-sliders">
                                </i>
                                <span class="menu-text">投稿管理</span>
                            </a>
                        </li>
                        <li class="" level="root" >
                            <a data-url="page/widgets" href="manage_specialtag.php">
                                <i class="menu-icon fa fa-sliders">
                                </i>
                                <span class="menu-text">特殊標籤管理</span>
                            </a>
                        </li>
                        <li class="" level="member" >
                            <a data-url="page/widgets" href="apply_cooperate.php">
                                <i class="menu-icon fa fa-sliders">
                                </i>
                                <span class="menu-text">申請合作頻道</span>
                            </a>
                        </li>

                        <li class="">
                            <a data-url="page/widgets" href="#page/widgets" style="background-color: rgb(68, 68, 68)">
                                <i class="menu-icon fa fa-envelope " style="color: gray;">
                                </i>
                                <span class="menu-text" style="color: gray;">站內訊息</span>
                            </a>
                        </li>
                        <!--li class="">
                          <a data-url="page/widgets" href="#page/widgets" style="background-color: rgb(68, 68, 68)">
                            <i class="menu-icon fa fa-credit-card" style="color: gray;">
                            </i>
                            <span class="menu-text" style="color: gray;">消費記錄</span>
                          </a>
                        </-->
                    </ul>
                </div>
            <!--AL 0428-->
<div level="editor">
                <ul style="position: relative; transition-property: top; transition-duration: 0.15s; height: 30px;" class="nav nav-list">
                    <li style="list-style-type: none">
                      <a style="background-color: rgb(27, 27, 27); padding: 5px 10px; font-weight: normal; font-size: 12px;">
                        
                           <span class="menu-text" style="color: white; font-weight: bold; text-align: left; margin-left: 5px;">創作管理</span>
                      </a>
                    </li>
                </ul>
                
                <ul class="nav nav-list" style="top: 0px;">
                    <li class="">
                        <a href="editor.php">
                            <i class="menu-icon fa fa-pencil-square-o">
                            </i>
                            <span class="menu-text" style="">
                              頻道發文
                            </span>
                        </a>
                    </li>
                </ul>
    
                <ul class="nav nav-list" style="top: 0px;">
                    <li class="" id="get_my_editor">
                      <a class="dropdown-toggle" href="#">
                        <i class="menu-icon fa fa-pencil-square-o">
                        </i>
                        <span class="menu-text" style="">
                          我的媒體
                        </span>

                        <b class="arrow fa fa-angle-down">
                        </b>
                      </a>
                      <ul class="submenu nav-hide ace-scroll scroll-disabled" style="display: none;">
                        <li class="">
                          <a href="video_list.php" data-url="page/typography">
                            <i class="menu-icon fa fa-caret-right">
                            </i>
                            我的影片
                          </a>
                        </li>

                        <!--li class="">
                          <a href="#page/elements" data-url="page/elements">
                            <i class="menu-icon fa fa-caret-right">
                            </i>
                            我的插畫
                          </a>
                        </li-->

                        <li class="">
                          <a href="img_list.php" data-url="page/buttons">
                            <i class="menu-icon fa fa-caret-right">
                            </i>
                            我的圖片
                          </a>
                        </li>
                        <!--AL 0409-->
                        <!--li id="get_my_page" class="">
                          <a data-url="page/buttons" href="listtext.php?page" >
                            <i class="menu-icon fa fa-caret-right">
                            </i>
                            我的文章
                          </a>
                        </li>
                        <li id="get_my_draft" class="">
                          <a data-url="page/buttons" href="listtext.php?draft" >
                            <i class="menu-icon fa fa-caret-right">
                            </i>
                            我的草稿
                          </a>
                        </li-->
                      </ul>
                    </li>
                </ul>
            <div class="scroll-track scroll-detached no-track scroll-thin scroll-margin scroll-visible" style="display: none; top: -108px; left: 212px;"><div class="scroll-bar" style="top: 0px;"></div></div>
</div>                  
            <!--AL 0409-->
<!--div level="manage">
                <ul class="nav nav-list" style="top: 0px;">
                    <li class="" id="get_my_check">
                       <a class="dropdown-toggle" href="listtext.php">
                        <i class="menu-icon fa fa-check-square-o">
                        </i>
                        <span class="menu-text">審核</span>

                        <b class="arrow fa fa-angle-down">
                        </b>
                      </a>
                      <ul class="submenu nav-show" style="display: none;">
                        <li id="get_ready_check" class="">
                          <a data-url="page/typography" href="listtext.php?check" >
                            <i class="menu-icon fa fa-caret-right">
                            </i>待審核</a>
                        </li>
                      </ul>
                    </li>
                </ul>
</div-->    

            <!--AL 0429-->
<div level="editor">

                <ul class="nav nav-list" style="top: 0px;">
                            <li class="" id="get_my_editor">
                                    <a class="dropdown-toggle" href="#">
                                                <i class="menu-icon fa fa-pencil-square-o">
                                                </i>
                                                <span class="menu-text" style="">
                                                        資料管理
                                                </span>

                                                <b class="arrow fa fa-angle-down">
                                                </b>
                                    </a>
                                    <ul class="submenu nav-hide ace-scroll scroll-disabled" style="display: none;">
                                                <li class="" level="root">
                                                  <a data-url="page/typography">
                                                    <i class="menu-icon fa fa-caret-right">
                                                    </i>
                                                    會員管理
                                                  </a>
                                                </li>

                                                <li class="" level="editor">
                                                  <a href="channel_manager.php" data-url="page/buttons">
                                                    <i class="menu-icon fa fa-caret-right">
                                                    </i>
                                                    頻道管理
                                                  </a>
                                                </li>
                                                <li id="get_my_page" class="" level="root">
                                                    <a href="manager_page.php" data-url="page/typography">
                                                    <i class="menu-icon fa fa-caret-right">
                                                    </i>
                                                    文章管理
                                                  </a>
                                                </li>
                                    </ul>
                            </li>
                </ul>
                <ul style="position: relative; transition-property: top; transition-duration: 0.15s; height: 30px;" class="nav nav-list">
                            <li style="list-style-type: none">
                                        <a style="background-color: rgb(27, 27, 27); padding: 5px 10px; font-weight: normal; font-size: 12px;">
                                                    <span class="menu-text" style="color: white; font-weight: bold; text-align: left; margin-left: 5px;">報表</span>
                                        </a>
                            </li>
                </ul>
                <ul style="top: 0px;" class="nav nav-list">
                    <!--AL 0409-->
                    <li class="">
                      <a href="earnings.php" data-url="page/widgets">
                        <i class="menu-icon fa fa-bar-chart-o ">
                        </i>
                        <span class="menu-text">頻道數據</span>
                      </a>
                    </li>
                    <li class="">
                      <a href="use_setting.php" data-url="page/widgets">
                        <i class="menu-icon fa fa-bar-chart-o ">
                        </i>
                        <span class="menu-text">使用設定</span>
                      </a>
                    </li>
                    <li class="">
                      <a style="background-color: rgb(68, 68, 68)" href="#page/widgets" data-url="page/widgets">
                        <i style="color: gray;" class="menu-icon fa fa-cogs">
                        </i>
                        <span style="color: gray;" class="menu-text">通知設定</span>
                      </a>
                    </li>
                    <!--li class="">
                      <a style="background-color:  rgb(68, 68, 68)" href="#page/widgets" data-url="page/widgets">
                        <i style="color:gray" class="menu-icon fa fa-bolt">
                        </i>
                        <span style="color: gray;" class="menu-text">任務管理</span>
                      </a>
                    </li-->
                </ul>
</div>
        <!-- /.nav-list -->

        <!-- #section:basics/sidebar.layout.minimize -->
        <!--div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse" style="z-index: 1; background: none repeat scroll 0% 0% rgb(68, 68, 68); height: 40px; border-color: rgb(68, 68, 68);">
                    <i class="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-right" style="float: right; margin: 7px 10px; border-radius: 0px; background: none repeat scroll 0% 0% rgb(68, 68, 68);"></i>
        </div-->

        <!-- /section:basics/sidebar.layout.minimize -->
        <script type="text/javascript">
        try{
                    ace.settings.check('sidebar' , 'collapsed')
        }
        catch(e)
        {
        }
        </script>
</div>
</div>
