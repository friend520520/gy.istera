<div id="sidebar" class="submenu">
        <ul>
                <li class="set_open"><a href="mgc_franchisee_console.php" h_target="mgc_franchisee_console">控制台首頁</a></li>
                <li class="set_open">
                        <a href="mgc_personal_information.php">設定</a>
                        <ul>
                                <li>
                                        <a href="mgc_personal_information.php" h_target="mgc_personal_information">
                                            個人資料
                                        </a>
                                </li>
                                <li class="">
                                        <a href="mgc_data_collection.php"  h_target="mgc_data_collection">
                                            <i class="menu-icon fa fa-caret-right"></i>
                                            收款資料
                                        </a>
                                </li>
                                <li class="">
                                        <a href="mgc_change_password.php" h_target="mgc_change_password">
                                            修改密碼
                                        </a>
                                </li>
                                <!--li class="">
                                        <a href="mgc_security_code.php"  h_target="mgc_security_code">
                                            <i class="menu-icon fa fa-caret-right"></i>
                                            安全密碼
                                        </a>
                                </li>
                                <li class="">
                                        <a href="mgc_report.php"  h_target="mgc_report">
                                            <i class="menu-icon fa fa-caret-right"></i>
                                            問題回報
                                        </a>
                                </li-->
                        </ul>
                </li>
                <li class="set_open">
                        <a href="mgc_help_with_the_help.php">互助中心</a>
                        <ul>
                                <li class="">
                                        <a href="mgc_help_with_the_help.php"  h_target="mgc_help_with_the_help">
                                            幫助與被幫助
                                        </a>
                                </li>
                                <li class="">
                                        <a href="mgc_help_list.php"  h_target="mgc_help_list">
                                            幫助列表
                                        </a>
                                </li>
                                <li class="">
                                        <a href="mgc_helped_list.php"  h_target="mgc_helped_list">
                                            被幫助列表
                                        </a>
                                </li>
                        </ul>
                </li>
                <li class="set_open">
                        <a href="mgc_statement_of_earnings.php">收益報表</a>
                        <ul>
                                <li class="">
                                        <a href="mgc_statement_of_earnings.php"  h_target="mgc_statement_of_earnings">
                                            收益明細
                                        </a>
                                </li>
                                <li class="">
                                        <a href="mgc_earnings_list.php"  h_target="mgc_earnings_list">
                                            收益列表
                                        </a>
                                </li>
                        </ul>
                </li>
                <li class="set_open">
                        <a href="mgc_partners_tree.php">我的夥伴</a>
                        <ul>
                                <li class="">
                                        <a href="mgc_partners_tree.php"  h_target="mgc_partners_tree">
                                            夥伴樹
                                        </a>
                                </li>
                                <li class="">
                                        <a href="mgc_my_partner.php"  h_target="mgc_my_partner">
                                            我的夥伴
                                        </a>
                                </li>
                                <!--li class="">
                                        <a href="mgc_my_team_members.php"  h_target="mgc_my_team_members">
                                            <i class="menu-icon fa fa-caret-right"></i>
                                            我的團隊會員
                                        </a>
                                </li-->
                        </ul>
                </li>
                <li class="set_open">
                        <a href="mgc_station_message.php"  h_target="mgc_station_message">站內訊息</a>
                </li>
                <li class="set_open">
                        <a href="mgc_site_notice.php"  h_target="mgc_site_notice">網站公告</a>
                </li>
        </ul>

</div>

<script type="text/javascript">
        var html = location.href.split("/")[ location.href.split("/").length-1 ];
        html = html.split( "?" )[0].split( "#" )[0].split( ".php" )[0];
        //$( "#sidebar a[h_target=" + html + "]" ).parents( ".set_open" ).addClass( "open" );
        //$( "#sidebar a[h_target=" + html + "]" ).parents( ".nav-hide" ).addClass( "nav-show" ).removeClass( "nav-hide" ).css( "display" , "block" );
        $( "#sidebar a[h_target=" + html + "]" ).parents( "ul" ).css( "display" , "block" );
        $( "#sidebar a[h_target=" + html + "]" ).parents( "li" ).addClass( "now" );
</script>