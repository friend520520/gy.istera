<header>
        <div class="wrapper">
                <!--h1><a href="v_index.php"><img src="images/logo.png"/></a></h1-->
                <div class="column">
                        <div class="gotop"><a href="#">gotop</a></div>
                        <!--div class="language">
                                <form>
                                        <select>
                                                <option>繁體中文</option>
                                                <option>简体中文</option>
                                                <option>ENGLISH</option>
                                        </select>
                                </form>
                        </div-->
                        <div class="link"><a href="index.php">返回網站</a></div>
                        <!--div class="user">abc123@gmail.com</div-->
                        
                        <div id="header">
                                <div class="top">
                                        <ul>

                                                <!--li><a id="sn"  href="v_site_notice.php">網站公告</a></li>
                                                <li><a id="cp"  href="v_common_problem.php">常見問題</a></li-->
                                                <!--li><a id="fc"  href="index.php">會員控制台</a></li>
                                                <!--li><a id="mac" href="mgms_manager_console.php">經理控制台</a></li-->
                                                <li><a id="mc"  href="mgm_managers_console.php">管理者控制台</a></li>
                                                <li class="login user"><a href="#"></a>
                                                        <div id="login-block">
                                                                <div class="arrow"></div>
                                                                <span>
                                                                        <form>  
                                                                                <ul>
                                                                                        <li><span>信箱</span>
                                                                                                <input type="email" class="txt" placeholder="">
                                                                                        </li>
                                                                                        <li><span>密碼</span>
                                                                                                <input type="password" class="txt" placeholder="">
                                                                                        </li>
                                                                                        <li class="check">
                                                                                                <input type="checkbox" style="margin-right: 5px; margin-top: 11px;" id="remember_account">
                                                                                                記住帳號
                                                                                                <input type="button" value="登入" class="button" style="float:right;">
                                                                                                <input type="button" value="測試" class="button button-g" style="float:right;">
                                                                                        </li>
                                                                                </ul>
                                                                        </form>

                                                                        <p><a href="v_forget.php">忘記密碼</a><a href="v_index.php">立即註冊</a></p>
                                                                </span> 
                                                        </div>
                                                        <script>

                                                                $('.top ul li.login #login-block input:not([type=checkbox]):not(.button)').unbind( "keypress" ).bind( "keypress" , function(e){
                                                                        if( e.which === 13 ){
                                                                            $('.top ul li.login #login-block input.button:not(".button-g")').trigger('click');
                                                                        }
                                                                });

                                                        </script>
                                                        <div id="logout-block">
                                                                <a class="logout">登出</a>
                                                        </div>
                                                </li>
                                        </ul>
                                </div>
                        </div>  
                        
                </div>
        </div>
</header>