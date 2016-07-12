<div id="sidebar_setting" class="submenu">
        <ul> 
<!--                <li class="set_open">
                        <a href="mgm_managers_console.php"  h_target="mgm_managers_console">
                                管理者控制台首頁
                        </a>
                </li>-->
                <li class="set_open">
                        <a href="mgm_system.php"  h_target="mgm_system">
                                系統設定
                        </a>
                </li>
                <li class="set_open" >
                        <a href="mgm_management_account.php">會員管理</a>
                        <ul>
                                <li class="">
                                        <a href="mgm_management_account.php"  h_target="mgm_management_account">
                                                會員管理 <!--AL 20160531-->
                                        </a>
                                </li>
                                <li class="">
                                        <a href="mgm_new_member.php"  h_target="mgm_new_member">
                                                新增會員
                                        </a>
                                </li>
                                <!--li class=""> AL 20160512
                                        <a href="mgm_partners_tree.php"  h_target="mgm_partners_tree">
                                                夥伴樹
                                        </a>
                                </li-->
                        </ul>
                </li>
                <!--li class="set_open" > AL 20160512
                        <a>文章管理</a>
                        <ul>
                                <li class="">
                                        <a href="mgm_category_preferences.php"  h_target="mgm_category_preferences">
                                                新增分類
                                        </a>
                                </li>
                                <li class="">
                                        <a href="mgm_publish.php"  h_target="mgm_publish">
                                                新增文章
                                        </a>
                                </li>
                                <li class="">
                                        <a href="mgm_articles_list_manage.php"  h_target="mgm_articles_list_manage">
                                                文章清單
                                        </a>
                                </li>
                        </ul>
                </li-->
                <li class="set_open" >
                        <a href="mgm_pairing_pool.php">幫助與被幫助</a>
                        <ul>
                                <li class="">
                                        <a href="mgm_pairing_pool.php"  h_target="mgm_pairing_pool">
                                                配對池
                                        </a>
                                </li>
                                <li class="">
                                        <a href="mgm_pairing_confirmation.php"  h_target="mgm_pairing_confirmation">
                                                配對確認
                                        </a>
                                </li>
                        </ul>
                </li>
                <li class="set_open">
                        <a href="mgm_performance_reports.php"  h_target="mgm_performance_reports">
                                業績報表
                        </a>
                </li>
                <li class="set_open" >
                        <a href="mgm_bonus_statistics.php">統計報表</a>
                        <ul>
                                <li class="">
                                        <a href="mgm_bonus_statistics.php"  h_target="mgm_bonus_statistics">
                                                獎金統計
                                        </a>
                                </li>
                                <li class="">
                                        <a href="mgm_interest_statistics.php"  h_target="mgm_interest_statistics">
                                                利息統計
                                        </a>
                                </li>
                                <li class="">
                                        <a href="mgm_membership_growth_statistics.php"  h_target="mgm_membership_growth_statistics">
                                                會員成長統計
                                        </a>
                                </li>
                        </ul>
                </li>
                <li class="set_open" >
                        <a href="mgm_bonus_details.php">獎金明細</a>
                        <ul>
                                <li class="">
                                        <a href="mgm_bonus_details.php"  h_target="mgm_bonus_details">
                                                <i class="menu-icon fa fa-caret-right"></i>
                                                獎金明細
                                        </a>
                                </li>
                                <li class="">
                                        <a href="mgm_interest_details.php"  h_target="mgm_interest_details">
                                                <i class="menu-icon fa fa-caret-right"></i>
                                                利息明細
                                        </a>
                                </li>
                        </ul>
                </li>
                <li class="set_open">
                        <a href="mgm_bonus_set.php"  h_target="mgm_bonus_set">
                                獎金設定
                        </a>
                </li>
                <li class="set_open">
                        <a href="mgm_membership_income_maintenance.php"  h_target="mgm_membership_income_maintenance">
                                會員收益維護
                        </a>
                </li>
                <li class="set_open" >
                        <a href="mgm_site_notice_manage.php">消息管理</a>
                        <ul>
                                <li class="">
                                        <a href="mgm_site_notice_manage.php"  h_target="mgm_site_notice_manage">
                                                管理公告
                                        </a>
                                </li>
                                <li class="">
                                        <a href="mgm_station_message.php"  h_target="mgm_station_message">
                                                信件管理
                                        </a>
                                </li>
                        </ul>
                </li>
                <li class="set_open">
                        <a href="mgm_language_packs.php"  h_target="mgm_language_packs">
                                語言包
                        </a>
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
