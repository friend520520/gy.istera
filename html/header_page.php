<div id="header">
        <div class="container">
                <div class="top">
                        <ul>
                                <li><a href="v_service.php">客服中心</a></li>
                                <li><a href="v_common_problem.php">常見問題</a></li>
                                <li><a href="v_site_notice.php">網站公告</a></li>
                                <li><a href="v_hot-rank-channel.php">會員頻道</a></li>
                        </ul>
                        <ul>
                                <li><a href="v_support.php">升級VIP</a></li>
                                <li><a href="v_support.php">購買點數</a></li>
                                <li><a href="mgc_franchisee_console.php">加盟商控制台</a></li>
                                <li><a href="mgm_pairing_pool.php">管理者控制台</a></li>
                                <li class="login"><a href="#"></a>
                                        <div id="login-block">
                                                <div class="arrow"></div>
                                                <span>
                                                <form>
                                                        <b>信箱：
                                                        <input type="email" placeholder="" class="txt">
                                                        </b> <b>密碼：
                                                        <input type="password" placeholder="" class="txt">
                                                        </b> <b>
                                                        <input type="checkbox">
                                                        記住帳號
                                                        <input type="button" value="登入" class="button">
                                                        </b>
                                                </form>
                                                <h6>聯盟網站會員可直接登入</h6>
                                                <img alt="" src="template/images/upload/member1.jpg"><img alt="" src="template/images/upload/member2.jpg">
                                                <p><a href="v_forget.php">忘記密碼</a><a href="signup.php">立即註冊</a></p>
                                                </span> </div>
                                        <script>

                                                $('.top ul li.login #login-block input:not([type=checkbox]):not(.button)').unbind( "keypress" ).bind( "keypress" , function(e){
                                                        if( e.which === 13 ){
                                                            $('.top ul li.login #login-block input.button').trigger('click');
                                                        }
                                                });

                                        </script>
                                        <div id="logout-block"> <a>發表文章</a> <a>我的頻道</a> <a>控制台</a> <a>站內訊息</a> <a class="logout">登出</a> </div>
                                </li>
                        </ul>
                </div>
                <dl class="nav">
                        <dt>
                                <h1 style="margin: 0px;"><a href="v_index.php" class="logo">LOGO</a></h1>
                                <h2><a href="v_index.php">發文賺錢</a><a href="#">購物網</a><a href="http://www.ggyyggy.com/178tube">影音網</a></h2>
                        </dt>
                        <dd>
                                <form>
                                        <input type="search" placeholder="">
                                        <input type="button" class="btn">
                                </form>
                        </dd>
                </dl>
                <div class="menu">
                        <ul>
                                <li><a href="v_index.php">首頁</a></li>
                                <li><a href="v_article_list.php?mod=New">最新</a></li>
                                <li><a href="v_article_list.php?mod=Hot">熱門</a></li>
                                <?php
                                    
                                    function get_string_bywidth( $utf8_str , $length ){

                                        if( get_string_width($utf8_str) <= $length ){
                                                return $utf8_str;
                                        }
                                        else {
                                                $i = 0;
                                                $str = "";
                                                for ($index = 0; $index < mb_strlen($utf8_str,'utf8'); $index++) {
                                                    $i += get_string_width( mb_substr($utf8_str,$index,1,"UTF-8") );
                                                    if( $i > $length-3 ){
                                                        $str .= "...";
                                                        break;
                                                    }
                                                    else{
                                                        $str .= mb_substr($utf8_str,$index,1,"UTF-8");
                                                    }
                                                }
                                                return $str;
                                        }

                                    }
                                    function get_string_width( $utf8_str ){
                                            $i = 0;
                                            for ($index = 0; $index < mb_strlen($utf8_str,'utf8'); $index++) {
                                                if( preg_match("/\p{Han}+/u", mb_substr($utf8_str,$index,1,"UTF-8")) ){
                                                    //中文 寬度3
                                                    $i += 3;
                                                }
                                                else if( ctype_upper(mb_substr($utf8_str,$index,1,"UTF-8")) ){
                                                    //大寫英文 寬度2
                                                    $i += 2;
                                                }
                                                else{
                                                    //
                                                    $i ++;
                                                }
                                            }
                                            return $i;
                                    }
                                    $url = "http://www.ggyyggy.com/funbook19/php/category.php?func=list";
                                    $ch = curl_init();
                                    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
                                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                                    curl_setopt($ch, CURLOPT_VERBOSE, true);
                                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                    
                                    curl_setopt($ch, CURLOPT_URL, $url );
                                    $result = curl_exec($ch);
                                    $result = json_decode($result,true);
                                    if( $result["success"] ){
                                        $category = $result["data"];
                                        $cate_html = "";
                                        foreach ($category as $key => $value) {
                                                if( $value["cate_display"] === "block" ){
                                                    $cate_html .= '<li><a href="v_article_list.php?c='.$value['id'].'">'.get_string_bywidth( $value['cate_name'] , 12 ).'</a>';
                                                    if( isset($value["children"]) ){
                                                        $cate_html .= '<ul>';
                                                        foreach ($value["children"] as $key2 => $value2) {
                                                            $cate_html .= ' <li><a href="v_article_list.php?c='.$value['id'].'">'.$value['cate_name'].'</a></li>';
                                                        }
                                                        $cate_html .= '</ul>';
                                                    }
                                                    $cate_html .= '</li>';
                                                }
                                        }
                                        echo $cate_html;
                                    }
                                    else{
                                        exit;
                                    }
                                    curl_close($ch);
                                ?>
                        </ul>
                </div>
        </div>
</div>