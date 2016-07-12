<!doctype html>
<html>
        <head>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
                <meta name="format-detection" content="telephone=no">
                <meta name="robots" content="index,follow">
                <meta name="keywords" content="幫助網,幫助網,幫助網,幫助網,幫助網" />
                <meta name="description" content="幫助網幫助網幫助網幫助網幫助網幫助網幫助網幫助網幫助網幫助網" />
                <link rel='shortcut icon' href='images/favicon.ico' type='x-icon'>
                <title>忘記密碼 | help.com</title>
                <meta name="description" content="What you see what you get Enjoy to Interactive with living objects" >
                <link rel="stylesheet" href="css/all.css">
                <link href="template/css/mian.css" rel="stylesheet" type="text/css">
                <link href="template/css/info.css" rel="stylesheet" type="text/css">
                <link href="css/login.css" rel="stylesheet" type="text/css">
                
                <?php include( "js/all_js.php"); ?>
                
                <style>
                    .container {
                        left: 0;
                        width: 100%;
                    }
                    .list {
                        margin: 0.5% auto;
                        width: 87%;
                    }
                    .set li:nth-child(2n+1) {
                        background: rgba(163, 177, 178, 0.1) none repeat scroll 0 0;
                    }
                    .set li {
                        border-bottom: 1px dotted #ccc;
                        display: block;
                        line-height: 40px;
                        margin: 0;
                        padding: 2px 5px;
                    }
                    .list li {
                        font-size: 13px;
                        letter-spacing: 1px;
                        color: #666;
                        font-size: 15px;
                        line-height: 28px;
                        padding: 10px 0 10px 220px;
                        position: relative;
                    }
                    .set span {
                        left: 0;
                        position: absolute;
                        padding: 2px 5px;
                    }
                    .set form li.verify img {
                        left: 350px;
                    }
                    .set form li.verify .refresh {
                        left: 470px;
                    }
                    /* RWD */
                    @media screen and (max-width:1200px){
                        .list {width: 87%;}
                    }
                    @media screen and (max-width:680px){
                        .list {width: 87%;margin-top: 50px;}
                        .list li {padding: 15px 0;}
                        .set span {position: relative;}
                        .set input.long {width: 95%}
                        .set form li.verify img {left: 190px;top: 15px;}
                        .set form li.verify .refresh {left: 310px;top: 15px;}
                    }
                    @media screen and (max-width:400px){
                        .list {width: 87%;margin-top: 50px;}
                        .list li {padding: 15px 0;}
                    }
                </style>
                
        </head>

        <body>
                <?php include 'html/loading.php'; ?> 
                <?php include( "html/header.php"); ?>
                
                <div class="content">
                        <div class="container">
                                <div class="list">
                                        <nav class="set" id="full">
                                                <h2 class="set-title">忘記密碼</h2>
                                                <form>
                                                        <ul>
                                                                <li style="padding-left: 0;">
                                                                        <span style="position: relative;">如果您忘記密碼，請輸入您的電子郵件地址或電話號碼，我們將會寄給給您一封電子郵件，提示您如何恢復密碼</span>  
                                                                </li>
                                                                <li>
                                                                        <span>請輸入您的電話號碼或Email</span>
                                                                        <input id="email" type="text" value="" class="necessary long">
                                                                        <div class="alert success" style="display:none;"></div>
                                                                        <div class="alert warning" style="display:none;">必填欄位</div>
                                                                        <div class="alert error" style="display:none;">請輸入有效的電子郵箱</div>
                                                                </li>
                                                                <li class="verify captcha">
                                                                        <span>驗證碼</span>
                                                                        <input id="input_captcha" type="text" placeholder="輸入驗證碼" style="width: 100px;">
                                                                        <img src="php/verification.php"><a onclick="re_captcha()" class="refresh">重新整理</a>
                                                                        <div class="alert success" style="display:none;"></div>
                                                                        <div class="alert error" style="display:none;">驗證碼錯誤</div>
                                                                </li>
                                                        </ul>
                                                        <input id="send" type="button" value="找回密碼" class="button" style="display:block; margin:20px auto;">
                                                </form>
                                        </nav>
                                
                                        <!-- mail -->
                                        <div id="send_success" class="input-group" style="padding: 30px; text-align: center; display: none;">
                                                    <img src="images/success.png" style="margin: auto; right: 0px; width: 100px; height: 100px; left: 0px;">
                                                    <div style="margin-bottom: 40px; position: relative; text-align: center; top: 20px;">取回密碼的方法已通過Email發送到您的信箱中，請在1天之內修改您的密碼。</div>
                                        </div>
                                        
                                        <!-- 修改密碼 -->
                                        <nav id="change_pwd" class="set" style="display: none;">
                                                <h2 class="set-title">修改密碼( *必填欄位 )</h2>
                                                <form>
                                                        <ul>
                                                                <li>
                                                                        <span>* 輸入新密碼</span>
                                                                        <input type="password" error-msg="輸入新密碼" class="form-control necessary" id="account_pwd">
                                                                </li>
                                                                <li>
                                                                        <span>* 確認密碼</span>
                                                                        <input type="password" class="form-control" id="account_pwd2">
                                                                </li>
                                                        </ul>
                                                        <input id="send_change_pwd" type="button" value="修改密碼" class="button" style="display:block; margin:20px auto;">
                                                </form>
                                        </nav>
                                </div>
                        </div>
                </div>
            
                <?php include( "html/footer.php"); ?>
            
        <script src="template/js/owl.carousel.js"></script> 
        <script src="template/js/masonry.pkgd.min.js"></script> 
        <script src="template/js/imagesloaded.pkgd.js"></script> 
        <script type="text/javascript">
                
                
                $("document").ready(function() {
                        
                        if( getParameterByName( "t" ) ){
                                init_change_pwd();
                                $( "#change_pwd" ).show();
                        }
                        else{
                                init_send_email();
                                $( "#full" ).show();
                        }
                        
                        function init_change_pwd(){
                                
                                loading_ajax_show();
                                var data = {
                                        token : getParameterByName( "t" )
                                };
                                var success_back = function( data ) {

                                        data = JSON.parse( data );
                                        console.log(data);
                                        $( "#account_pwd" ).val( "" );
                                        $( "#account_pwd2" ).val( "" );
                                        loading_ajax_hide();
                                        if( data.Success ) {
                                            $( "#full" ).hide();
                                            $( "#change_pwd" ).show();
                                        }
                                        else {
                                            show_remind( data.ErrMsg , "error" );
                                            $( "#full" ).show();
                                        }

                                }
                                var error_back = function( data ) {
                                        console.log(data);
                                }
                                $.Ajax( "POST" , "php/member.php?func=check_forget_token" , data , "" , success_back , error_back);
                                
                                $( "#send_change_pwd" ).bind( "click" , function(){

                                        var bool = true;
                                        var msg = "";
                                        if( $( "#account_pwd" ).val() === "" ) {
                                                bool = false;
                                                $( "#account_pwd" ).parent().addClass( "has-error" );
                                                msg += msg === "" ? "請" : "、";
                                                msg += $( "#account_pwd" ).attr( "error-msg" );
                                        }
                                        else {
                                                $( "#account_pwd" ).parent().removeClass( "has-error" );
                                        }
                                        
                                        if( $( "#account_pwd2" ).val() !== $( "#account_pwd" ).val() ) {
                                            bool = false;
                                            msg += msg === "" ? "" : "、";
                                            msg += "確認密碼錯誤";
                                            $( "#account_pwd2" ).parent().addClass( "has-error" );
                                            $( "#account_pwd2" ).val( "" );
                                        }
                                        else {
                                            $( "#account_pwd2" ).parent().removeClass( "has-error" );
                                        }

                                        if( bool ) {
                                            loading_ajax_show();
                                            var data = {
                                                    password : md5( $( "#account_pwd" ).val() ) ,
                                                    token : getParameterByName( "t" )
                                            };
                                            var success_back = function( data ) {

                                                    data = JSON.parse( data );
                                                    console.log(data);
                                                    loading_ajax_hide();
                                                    if( data.Success ) {
                                                        show_remind( "成功修改完畢，請重新登入，三秒後轉跳到首頁。" );
                                                        // setTimeout( function(){ location.href = "v_index.php" }, 3000);
                                                    }
                                                    else {
                                                        show_remind( data.ErrMsg , "error" );
                                                    }

                                            }
                                            var error_back = function( data ) {
                                                    console.log(data);
                                            }
                                            $.Ajax( "POST" , "php/member.php?func=change_pwd_bytoken" , data , "" , success_back , error_back);
                                        }
                                        else{
                                            show_remind( msg , "error" );
                                        }
                                });
                                
                        }
                        
                        function init_send_email(){
                                
                                console.log( $( "#send" ) );
                                $( "#send" ).bind( "click" , function(){

                                        var bool = true;
                                        var msg = "";
                                        if( $( "#email" ).val() === "" ) {
                                                bool = false;
                                                $( "#email" ).parent().addClass( "has-error" );
                                                msg += msg === "" ? "請" : "、";
                                                msg += $( "#email" ).attr( "error-msg" );
                                        }
                                        else {
                                                $( "#email" ).parent().removeClass( "has-error" );
                                        }
                                        if( $( "#input_captcha" ).val() === "" ) {
                                                bool = false;
                                                $( "#input_captcha" ).parent().addClass( "has-error" );
                                                msg += msg === "" ? "請" : "、";
                                                msg += "輸入認證碼";
                                        }
                                        else {
                                                $( "#input_captcha" ).parent().removeClass( "has-error" );
                                        }

                                        if( bool ) {
                                            loading_ajax_show();
                                            var data = {
                                                    email : $( "#email" ).val() ,
                                                    authentication : $( "#input_captcha" ).val()
                                            };
                                            var success_back = function( data ) {

                                                    data = JSON.parse( data );
                                                    console.log(data);
                                                    loading_ajax_hide();
                                                    if( data.Success ) {
                                                        $( "#full" ).hide();
                                                        $( "#send_success" ).show();
                                                    }
                                                    else {
                                                        show_remind( data.ErrMsg , "error" );
                                                        $( ".captcha img" ).attr( "src" , "php/verification.php?" + Math.random() );
                                                    }

                                            }
                                            var error_back = function( data ) {
                                                    console.log(data);
                                            }
                                            $.Ajax( "POST" , "php/member.php?func=send_forget" , data , "" , success_back , error_back);
                                        }
                                        else{
                                            show_remind( msg , "error" );
                                        }
                                });
                                
                                console.log( $( "#send" ) );
                        }
                        
                });
                
        </script>

</body>

</html>
