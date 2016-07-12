<div id="sidebar_setting" class="submenu">
        <ul> 
                <li class="set_open">
                        <a href="mgm_managers_console.php"  h_target="mgm_managers_console">
                                管理者控制台首頁
                        </a>
                </li>
                
                
                
                <li class="set_open" >
                        <a href="mgm_management_account.php">帳號管理</a>
                        <ul>
                                <li class="">
                                        <a href="mgm_management_account.php"  h_target="mgm_management_account">
                                                會員管理w
                                        </a>
                                </li>
                        </ul>
                </li>
                
                
                
                <li class="set_open" >
                        <a href="mgm_question.php">客戶服務</a>
                        <ul>
                                <li class="">
                                        <a href="mgm_question.php"  h_target="mgm_question">
                                                常見問題管理
                                        </a>
                                </li>
                        </ul>
                </li>
                
                <li class="set_open" >
                        <a href="mgm_site_notice_manage.php">站務管理</a>
                        <ul>
                                <li class="">
                                        <a href="mgm_site_notice_manage.php"  h_target="mgm_site_notice_manage">
                                                公告管理
                                        </a>
                                </li>
                        </ul>
                </li>
                
                
                <li class="set_open" >
                        <a href="mgm_statistics_support.php">統計報表</a>
                        <ul>
                                <li class="">
                                        <a href="mgm_statistics_support.php"  h_target="mgm_statistics_support">
                                                贊助資料統計
                                        </a>
                                </li>
                        </ul>
                </li>
                
                <li class="set_open" >
                        <a href="mgm_behavioral_event_set_level.php">系統設定</a>
                        <ul>
                                <li class="">
                                        <a href="mgm_member_permissions.php"  h_target="mgm_member_permissions">
                                                管理者權限設定
                                        </a>
                                </li>
                                <li class="">
                                        <a href="mgm_system.php"  h_target="mgm_system">
                                                系統設定
                                        </a>
                                </li>
                        </ul>
                </li>
                
        </ul>
</div> 

<script type="text/javascript">
        var html = location.href.split("/")[ location.href.split("/").length-1 ];
        html = html.split( "?" )[0].split( "#" )[0].split( ".php" )[0];
        //$( "#sidebar a[h_target=" + html + "]" ).parents( ".set_open" ).addClass( "open" );
        //$( "#sidebar a[h_target=" + html + "]" ).parents( ".nav-hide" ).addClass( "nav-show" ).removeClass( "nav-hide" ).css( "display" , "block" );
        $( "#sidebar_setting a[h_target=" + html + "]" ).parents( "ul" ).css( "display" , "block" );
        $( "#sidebar_setting a[h_target=" + html + "]" ).parents( "li" ).addClass( "now" );
</script>
