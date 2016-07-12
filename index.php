<!doctype html>
<html>
        <head>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
                <meta name="format-detection" content="telephone=no">
                <meta name="robots" content="index,follow">
                <meta name="keywords" content="istera,istera,istera,istera,istera" />
                <meta name="description" content="isteraisteraisteraisteraisteraisteraisteraisteraisteraistera" />
                <link rel='shortcut icon' href='images/favicon.ico' type='x-icon'>
                <title>首頁 | istera.com</title>
                <meta name="description" content="What you see what you get Enjoy to Interactive with living objects" >
                <link rel="stylesheet" href="css/all.css">
                <link href="template/css/mian.css" rel="stylesheet" type="text/css">
                <link href="template/css/info.css" rel="stylesheet" type="text/css">
                <link href="css/login.css" rel="stylesheet" type="text/css">

                <!-- jquery.dataTables -->
                <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css">
                
                <?php include( "js/all_js.php"); ?>
                
                
                <!--chart-->
                <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
                <script type="text/javascript" src="template_j/js/jquery.mousewheel.js"></script>

                <script src="https://code.highcharts.com/stock/highstock.js"></script>
                <script src="https://code.highcharts.com/stock/modules/exporting.js"></script>
		<script src="js/global_highstock.js"></script>
                

                <!-- jquery.dataTables -->
                <!--link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css"-->
                <script type="text/javascript" language="javascript" src="js/jquery.dataTables.js"></script>
                <script type="text/javascript" language="javascript" src="js/dataTablesPlugin.js"></script>
                
                <script type="text/javascript">


                $.initSymbol = function initSymbol() {
                    
                        var tmp_country = $( "#controller_istera_country" ).val() ;
                        var tmp_langauge = $( "#istera_langauge" ).val() ;
                    
                        $.ajax({
                                type: 'Get',
                                url     : website_ws_url + 'api/symbol/country' ,
                                dataType: "json",
                                    headers: {
                                    'Authorization':$.loginmsg.Token,
                                },
                                data: {
                                           'country'    : tmp_country ,
                                           'lang'       : tmp_langauge
                                },
                                async: false,
                                success: function(data) {

                                            console.log(data);
                                        // $.loginmsg.symbol_country = data.Data ;

                                        $.loginmsg.symbol_country = {} ;
                                        $.each( data.Data , function( index , value ){
                                            
                                                    $.loginmsg.symbol_country[ value.Topic ] = value.Text ;
                                           });

                                        $.initDatatable_1( "0" );
                                }
                        });

                }

                $.initDatatable_1 = function initDatatable_1( focus_rank ) {

                        //destory dataTable
                        $("#example").DataTable().destroy();
                        $("#datatable").html("");

                        $.ajax({
                                type: 'Get',
                                url: website_ws_url + 'api/rank/' + focus_rank + '?country=' + 'CN' ,
                                dataType: "json",
                                headers: {
                                        'Authorization':$.loginmsg.Token,
                                },
                                data: {
                                },
                                async: false,
                                success: function(data) {

                                        console.log(data);

                                        var ajax = {} ;
                                        ajax.data = [] ;
                                        
                                        var column = Object.keys( data.Data[0] ); // ["信箱暱稱", "加盟商類別", "會員<br>種類", "上線會員", "下線<br>會員數<br>本月<br>新增<br>下線數", "本月點閱<br>累積點閱", "最後登入時間<br>註冊時間", "管理權限", "IP", "狀態", "操作"];

                                        createSearchTable('#search_Datatable', '#example', column);

                                        console.log(column);
                                        $.each( data.Data , function( index , value ){
                                            
                                                    var index_1 = index ;
                                                    var index_2 = 0 ;
                                                    ajax.data[ index_1 ] = [] ;
                                                    $.each( value , function( index , value ){
                                                                if( index_2 == 0 )
                                                                {
                                                                ajax.data[ index_1 ][ index_2 ] = value.toString();
                                                                index_2++ ;
                                                                }

                                                                if( index == "Topic"  )
                                                                ajax.data[ index_1 ][ index_2 ] = '<div style="width : 80px;" >' + $.loginmsg.symbol_country[ value ] + '</div>' ;
                                                                else
                                                                ajax.data[ index_1 ][ index_2 ] = value.toString() ;

                                                                
                                                                index_2++ ;

                                                    });

                                        });

                                        var order = [
                                                [1, 'desc']
                                        ];

                                                               
                                        createTable( '#datatable' , '#example' , column );
                                        createDataTable( '#example' , ajax , order );
                                        $('#example').data("rows_selected", []);
                                        addEvent('#datatable', '#example');

                                        console.log( ajax.data[0][0] );
                                        if( $("#container_1").html() == "" )
                                        stockpoint( ajax.data[0][0] , 'SHSE' , website_ws_url , $("#container_1") , 1 );
                                }
                        });

                }

                function init_data()
                {
                        init_global_highstock();
                        $.initSymbol();

                        $(".tabs-li").unbind("click").bind( "click" , function(){

                                    $( this ).parent().children( "li" ).removeClass( "active" );
                                    $( this ).addClass( "active" );

                                    if( $( this ).parent().parent().attr( "id" ) == "controller_istera_1" )
                                    {
                                                $.initDatatable_1( parseInt( $( this ).children( "a" ).attr( "target-href" ).split( "#tab" )[1] ) - 1 );
                                                
                                                if( ( parseInt( $( this ).children( "a" ).attr( "target-href" ).split( "#tab" )[1] ) - 1 ) == 1 )
                                                {
                                                            $( "#controller_istera_TOPLAST" ).show();
                                                }else{
                                                            $( "#controller_istera_TOPLAST" ).hide();
                                                }
                                                
                                                /*
                                                if( $( this ).children( "a" ).attr( "target-href" ) == "#tab1" )
                                                {
                                                }
                                                if( $( this ).children( "a" ).attr( "target-href" ) == "#tab2" )
                                                {
                                                            $.initDatatable_1( "1" );
                                                }
                                                if( $( this ).children( "a" ).attr( "target-href" ) == "#tab3" )
                                                {
                                                            $.initDatatable_1();
                                                }*/
                                    }
                                    else
                                    {
                                        
                                                $( this ).parent().parent().find(".tab_content").hide();

                                                console.log( $( this ).children( "a" ).attr( "target-href" ) );
                                                var tmp_focus = $( this ).children( "a" ).attr( "target-href" ).split( "#" )[1] ;
                                                $( this ).parent().parent().find("[id=" + tmp_focus + "].tab_content").show();
                                    }

                                        


                        });
                    
                }
                
                function connected_callback( loginmsg )
                {
                        
                        $( "#controller_login" ).hide();
                        $( "#controller_istera" ).show();
                        init_data();
                        
                        
                        
                }
                
                
                
                $(function() {
                    
                        $( "#controller_istera_country" ).val( "CN" );
                        
                        $( "#controller_istera_marketdata_get" ).unbind('click').bind( "click" , function(e) {

                                    $.initSymbol();
                                
                        });
                        
                        $( "#member_test" ).unbind('click').bind( "click" , function(e) {
                                $( "#account_email1" ).val( "jack" );
                                $( "#account_pwd1" ).val( "jack" );
                        });
                        
                        $( "#member_login" ).unbind('click').bind( "click" , function(e) {
                                
                                $(".alert").hide();
                                var bool = true;
                                var msg = "",pos,input_type;
                                $.each( $("#member-login .login input.necessary") , function( index , value ){
                                        input_type = $( value ).attr( "type" );
                                        if( input_type === "email" ){
                                                if( $( value ).val() === "" ) {
                                                        bool = false;
                                                        $( value ).parent().find(".alert.warning").show();
                                                        pos = $( value );
                                                }
                                                else if( !value.validity.valid ){
                                                        bool = false;
                                                        $( value ).parent().find(".alert.error").show();
                                                        pos = $( value );
                                                }
                                                else {
                                                        $( value ).parent().find(".alert").hide();
                                                        $( value ).parent().find(".alert.success").show();
                                                }
                                        }
                                        else{
                                                if( $( value ).val() === "" ) {
                                                        bool = false;
                                                        $( value ).parent().find(".alert.warning").show();
                                                        pos = $( value );
                                                }
                                                else {
                                                        $( value ).parent().find(".alert").hide();
                                                        $( value ).parent().find(".alert.success").show();
                                                }
                                        }
                                
                                });
                                
                                if( $( "#input_captcha1" ).val() === "" ) {
                                        bool = false;
                                        msg += msg === "" ? "請" : "、";
                                        msg += "輸入驗證碼";
                                        pos = $( "#input_captcha1" );
                                }
                                if( $( "#auto_login_time" ).val() === null ) {
                                        bool = false;
                                        msg += msg === "" ? "請" : "、";
                                        msg += "選擇自動登入時間";
                                        pos = $( "#auto_login_time" );
                                }
                                if( bool ) {
                                        loading_ajax_show();
                                        login_func( $( "#account_email1" ).val() , $( "#account_pwd1" ).val() );
                                }
                                else {
                                        re_captcha();
                                        show_remind( msg , "error" );
                                        scrollto( pos );
                                }
                                
                        });
                        
                        
                });

                </script>
                
                <!-- controller_istera -->
                <style>
                    .container {
                        left: 0;
                        width: 100%;
                    }
                    .left_container {
                        width: 59%;
                        margin-right: 1%;
                    }
                    .right_container {
                        width: 40%; 
                    }
                    .left_content , .right_content {
                        min-height: 800px;margin: 5px;padding: 5px;
                    }
                    
                    
                    /* RWD */
                    @media screen and (max-width:980px){
                        .content {
                            margin-top: 47px;
                            min-width: 99%;
                        }
                        .left_container,.right_container {
                            width: 100%; 
                        }
                    }
                    
                    .dataTables_length {
                        display: none;
                    }
                    .dataTables_filter {
                        display: none;
                    }
                </style>
                
                <!-- controller_login -->
                <style>
                    .container {
                        left: 0;
                        width: 100%;
                    }
                    .list {
                        float: left;
                        margin: 0.5%;
                        width: 45%;
                        clear: right;
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
                        padding: 10px 0 10px 90px;
                        position: relative;
                    }
                    .set span {
                        left: 0;
                        position: absolute;
                        padding: 2px 5px;
                    }
                    .set form li.verify img {
                        left: 214px;
                    }
                    .set form li.verify .refresh {
                        left: 330px;
                    }
                    .set > form > ul > li.check > input,
                    .list p > input{
                        height: 13px;
                    }
                    /* RWD */
                    @media screen and (max-width:937px){
                        .list {width: 94%;}
                        .set input.long {width: 95%}
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
                <style>
                            #example_wrapper, #example2_wrapper
                            {
                                        overflow-x: auto;
                            }
                </style>
                
                
        </head>

        <body>
                <?php include 'html/loading.php'; ?> 
                <?php include( "html/header.php"); ?>

                <div class="content" id="controller_login" >
                    
                            
                        <div class="container">
                                
                                <!-- login -->
                                <div class="list">
                                        <nav class="set">
                                                <h2 class="set-title">登入</h2>
                                                <form>
                                                        <ul>
                                                                <li>
                                                                        <span>帳號</span>
                                                                        <input id="account_email1"  type="email" placeholder="帳號或 E-mail"  class="necessary long">
                                                                        <div class="alert success" style="display:none;"></div>
                                                                        <div class="alert warning" style="display:none;">必填欄位</div>
                                                                        <div class="alert error" style="display:none;">請輸入有效的電子郵箱</div>
                                                                </li>
                                                                <li>
                                                                        <span>密碼</span>
                                                                        <input id="account_pwd1" type="password" class="necessary long">
                                                                        <div class="alert success" style="display:none;"></div>
                                                                        <div class="alert warning" style="display:none;">必填欄位</div>
                                                                </li>
                                                                <li class="check">
                                                                        <!--input id="remember_account1" type="checkbox"-->
                                                                        <!-- 記憶帳號 / 密碼 ( 自動登入一天內系統會自動退出 )-->
                                                                        ( 自動登入一天內系統會自動退出 )
                                                                </li>
                                                                </ul>
                                                                <input id="member_test" type="button" value="測試帳號" class="button" style="display:block; margin:20px auto;">
                                                                <input id="member_login" type="button" value="會員登入" class="button" style="display:block; margin:20px auto;">
                                                </form>
                                        </nav>
                                </div>
                                
                                <!-- register -->
                                <!--div class="list">
                                        <nav id="cooperate_form1" class="set">
                                                <h2 class="set-title">註冊( *必填欄位 )</h2>
                                                <form>
                                                        <ul>
                                                                <li>
                                                                        <span>* 帳號</span>
                                                                        <input id="account_email" type="email" placeholder="帳號或 E-mail" class="necessary long" onblur="t_bind($(this),'email_event')">
                                                                        <div class="alert success" style="display:none;"></div>
                                                                        <div class="alert warning" style="display:none;">必填欄位</div>
                                                                        <div class="alert error" style="display:none;">請輸入有效的電子郵箱</div>
                                                                        <div class="alert error error2" style="display:none;">電子郵件重複</div>
                                                                </li>
                                                                <li>
                                                                        <span>* 輸入密碼</span>
                                                                        <input id="account_pwd" type="password" class="necessary long" onblur="t_bind($(this),'password_event')">
                                                                        <div class="alert success" style="display:none;"></div>
                                                                        <div class="alert warning" style="display:none;">請輸入安全的密碼: 至少八個字元組以上，需要包括小寫字母和數字。</div>
                                                                </li>
                                                                <li>
                                                                        <span>* 確認密碼</span>
                                                                        <input id="account_pwd2" type="password" class="necessary long">
                                                                        <div class="alert success" style="display:none;"></div>
                                                                        <div class="alert warning" style="display:none;">請輸入安全的密碼: 至少八個字元組以上，需要包括小寫字母和數字。</div>
                                                                        <div class="alert error" style="display:none;">確認密碼錯誤</div>
                                                                </li>
                                                                <li>
                                                                        <span>公開暱稱</span>
                                                                        <input id="account_nickname" type="text" class="necessary long" onblur="t_bind($(this),'input_event')">
                                                                        <div class="alert success" style="display:none;"></div>
                                                                        <div class="alert warning" style="display:none;">必填欄位</div>
                                                                </li>
                                                                <li>
                                                                        <span>國家</span>
                                                                        <select data-placeholder="請選擇" id="account_country" class="chosen-select form-control">
                                                                                <option value="Taiwan">台灣</option>
                                                                                <option value="Japan">日本</option>
                                                                        </select>
                                                                        <div class="alert success" style="display:none;"></div>
                                                                        <div class="alert warning" style="display:none;">請選擇國家</div>
                                                                </li>
                                                        </ul>
                                                                <P class="check">
                                                                        <input id="account_eighteen" type="checkbox">我已經滿18歲
                                                                </P>
                                                                <P class="check">
                                                                        <input id="account_accept" type="checkbox">我已經閱讀<a href="v_general_disclaimer.php"><u>服務條款</u></a>及<a href="v_privacy_policy.php"><u>隱私權政策</u></a>，並同意註冊為會員
                                                                </P>
								<input id="accept" type="button" value="建立會員" class="button" style="display:block; margin:20px auto;">
                                                </form>
                                        </nav>
                                        
                                        <div id="cooperate_form3" style="padding: 30px;text-align: center;display: none;">
                                                <img style="margin: auto; right: 0px; left: 0px; height: 100px; width: 100px;" src="template_ttshow/template/assets/img/loading.png">
                                                <div class="alert success" style="margin: 30px 0 10px;;text-align: center;">感謝您註冊AAA GLOBAL</div>
                                                <div class="success">系統給您發送了一封認證信件，快去登入Email認證激活帳號吧! (請注意垃圾信件or廣告信件夾)。</div>
                                                
                                                <p class="MsoNormal"><a href="v_index.php"><span style="font-family:新細明體,serif;color:rgb(55,96,146)">如您的瀏覽器沒有自動跳轉，請點此連結</span></a><span lang="EN-US" style="color:rgb(55,96,146)"></span> </p>
                                                <p class="MsoNormal"><span lang="EN-US" style="color:rgb(55,96,146)">&nbsp;</span> </p>
                                                <p class="MsoNormal"><span lang="EN-US">&nbsp;</span> </p>
                                                <div style="font-size: 20pt; margin-bottom: 20px;">
                                                        已經完成註冊，三秒鐘後自動轉跳到首頁
                                                </div>

                                                <a href="v_index.php"><u>返回首頁</u></a>
                                        </div>
                                </div-->
                        </div>
                </div>
            
                <div class="content" id="controller_istera" style=" display: none;">
                        <div class="container">
                            
                                <!--left-->
                                <div class="float-left left_container">
                                        <!-- top -->
                                        <div id="controller_istera_1" class="tab-wrap float-left" style="max-height:600px;">
                                                <ul class="tabs">
                                                        <li class="tabs-li" ><a target-href="#tab1">自選</a></li>
                                                        <li class="tabs-li" ><a target-href="#tab2">個股排行</a></li>
                                                        <li class="tabs-li" ><a target-href="#tab3">空頭訊號</a></li>
                                                        <li class="tabs-li" ><a target-href="#tab4">連續空頭</a></li>
                                                        <li class="tabs-li" ><a target-href="#tab5">多頭訊號</a></li>
                                                        <li class="tabs-li" ><a target-href="#tab6">連續多頭</a></li>
                                                </ul>
                                                <div class="tab_container">
                                                        <!--sample code-->
                                                        <div style="display:block;" id="tab1" class="tab_content">
                                                                <h2 id="controller_istera_title" class="set-title">All / CN
                                                                        <select id="controller_istera_country" >
                                                                                <option value="All" >All</option>
                                                                                <option value="CN" >CN</option>
                                                                        </select>
                                                                        <select id="controller_istera_TOPLAST" style=" display: none;">
                                                                                <option value="TOP" >TOP</option>
                                                                                <option value="LAST" >LAST</option>
                                                                        </select>
                                                                        <input id="controller_istera_marketdata_get" type="button" class="button float-right" value="重整" id="search_btn">
                                                                </h2>
                                                            
                                                                <!--datatable-->
                                                                <div class="tablebox" style=" height: 300px;">
                                                                        <form action="" method="get">
                                                                                <!--AL 20160626 sample code-->
                                                                                <div class="tablebox">

                                                                                        <div id="datatable"></div>
                                                                                </div>
                                                                        </form>
                                                                </div>
                                                        </div>
                                                        
                                                </div>
                                        </div>
                                        
                                        <!-- bottom-left-->
                                        <div class="list float-left" style="overflow-x: hidden; width: 43%; margin-right: 1%;">
                                                <!--h2 class="set-title">2357 華碩
                                                        <select name="example_length" aria-controls="example" class="">
                                                                <option value="10">第一組</option>
                                                                <option value="10">第二組</option>
                                                                <option value="10">第三組</option>
                                                                <option value="10">第四組</option>
                                                                <option value="10">第五組</option>
                                                        </select>
                                                        <input type="button" class="button float-right" value="查詢" id="search_btn">
                                                </h2-->
                                                <div id="container_1" style="height: 300px;"></div>
                                        </div>
                                        
                                        <!-- bottom-left-->
                                        <div class="tab-wrap float-left" style="width:50%;overflow-x: hidden; max-height:400px;">
                                                <ul class="tabs">
                                                        <li class="tabs-li active"><a target-href="#tab12">五檔</a></li>
                                                        <li class="tabs-li"><a target-href="#tab13">分時</a></li>
                                                        <li class="tabs-li"><a target-href="#tab14">九宮格</a></li>
                                                        <li class="tabs-li"><a target-href="#tab15">指標</a></li>
                                                </ul>
                                                <div class="tab_container">
                                                        <div style="display:block;" id="tab12" class="tab_content">

                                                                    <div id="datatable7"></div>
                                                        </div>
                                                        <div style="display:none;" id="tab13" class="tab_content">

                                                                    <div id="datatable8"></div>
                                                        </div>
                                                </div>

                                        </div>
                                </div>
                                
                                <!-- right -->
                                <div class="float-left right_container">
                                        <!-- top --> 
                                        <div class="tab-wrap">
                                                <!--ul class="tabs">
                                                        <li class="tabs-li active"><a target-href="#tab1">上証指數</a></li>
                                                        <li class="tabs-li"><a target-href="#tab2">滬深300</a></li>
                                                        <li class="tabs-li"><a target-href="#tab3">綜合指數</a></li>
                                                        <li class="tabs-li"><a target-href="#tab4">商業指數</a></li>
                                                        <li class="tabs-li"><a target-href="#tab5">工業指數</a></li>
                                                </ul-->
                                                <div class="tab_container">
                                                        <div style="display:block;" id="tab1" class="tab_content">
                                                                    <h2 class="set-title">Topic
                                                                            <select id="controller_istera_ApiSymbolInde" ></select>
                                                                            <input id="controller_istera_ApiSymbolInde_get" type="button" class="button float-right" value="重整" >
                                                                    </h2>

                                                                    <div id="container_stock" style="height: 400px;"></div>
                                                        </div>
                                                        <div style="display:none;" id="tab2" class="tab_content">
                                                                    <h2 class="set-title">類股
                                                                            <select name="example_length" aria-controls="example" class="">
                                                                                    <option value="10">TSE加權指數</option>
                                                                            </select>
                                                                            <input type="button" class="button" value="查詢" id="search_btn">
                                                                    </h2>

                                                                    <div id="container_2" style="height: 400px;"></div>
                                                        </div>
                                                        <div style="display:none;" id="tab3" class="tab_content">
                                                                    <h2 class="set-title">類股
                                                                            <select name="example_length" aria-controls="example" class="">
                                                                                    <option value="10">TSE加權指數</option>
                                                                            </select>
                                                                            <input type="button" class="button" value="查詢" id="search_btn">
                                                                    </h2>

                                                                    <div id="container_3" style="height: 400px;"></div>
                                                        </div>
                                                        <div style="display:none;" id="tab4" class="tab_content">
                                                                    <h2 class="set-title">類股
                                                                            <select name="example_length" aria-controls="example" class="">
                                                                                    <option value="10">TSE加權指數</option>
                                                                            </select>
                                                                            <input type="button" class="button" value="查詢" id="search_btn">
                                                                    </h2>

                                                                    <div id="container_4" style="height: 400px;"></div>
                                                        </div>
                                                        <div style="display:none;" id="tab5" class="tab_content">
                                                                    <h2 class="set-title">類股
                                                                            <select name="example_length" aria-controls="example" class="">
                                                                                    <option value="10">TSE加權指數</option>
                                                                            </select>
                                                                            <input type="button" class="button" value="查詢" id="search_btn">
                                                                    </h2>

                                                                    <div id="container_5" style="height: 400px;"></div>
                                                        </div>
                                                </div>
                                        </div> 

                                        <!--div class="tab-wrap float-left">
                                                <ul class="tabs">
                                                        <li class="active"><a href="#tab7">上証指數</a></li>
                                                        <li><a href="#tab8">滬深300</a></li>
                                                        <li><a href="#tab9">綜合指數</a></li>
                                                        <li><a href="#tab10">商業指數</a></li>
                                                        <li><a href="#tab11">工業指數</a></li>
                                                </ul>
                                                <div class="tab_container">
                                                        <div style="display:block;" id="tab7" class="tab_content">
                                                                <h2 class="set-title">類股
                                                                        <select name="example_length" aria-controls="example" class="">
                                                                                <option value="10">TSE加權指數</option>
                                                                        </select>
                                                                        <input type="button" class="button" value="查詢" id="search_btn">
                                                                </h2>
                                                            
                                                                <div id="container_stock" style="height: 400px;"></div>
                                                        </div>
                                                </div>
                                        </div-->
                                </div>
                                
                                
                                        
                        </div>
                </div>
            
                <?php include( "html/footer.php"); ?>
        </body>
        

        <script type="text/javascript">
                
                $("document").ready(function() {
                        
                        //init web ++
                        $(window).scrollTop( 0 );
                        $( "#loadingpage" ).css("height", $(document).height() + 50 + "px");
                        $("input[type=text][id!=cooperate_url_2]").val("");
                        $("textarea").val("");
                        $("select").val("");
                        //init web --
                        
                        $('form').submit(false);
                });
                
                function t_bind( pos , event ){
                    
                    pos.unbind("input").bind("input",function(){
                            eval( event+'($(this))' );
                    });
                    pos.trigger( "input" );
                    
                }
                
                function init(){
                        
                        $( "#accept" ).unbind('click').bind( "click" , function(e) {
                                
                                $(".alert").hide();
                                var bool = true;
                                var msg = "",pos,input_type;
                                $.each( $(".register input.necessary") , function( index , value ){
                                        input_type = $( value ).attr( "type" );
                                        if( input_type === "email" ){
                                                if( !email_event( $( value ) ) ){
                                                        bool = false;
                                                        pos = $( value );
                                                }
                                        }
                                        else if( input_type === "password" ){
                                                if( !password_event( $( value ) ) ){
                                                        bool = false;
                                                        pos = $( value );
                                                }
                                        }
                                        else{
                                                if( !input_event( $( value ) ) ){
                                                        bool = false;
                                                        pos = $( value );
                                                }
                                        }
                                
                                });
                                
                                if( $( "#account_pwd2" ).val() === "" ){
                                    bool = false;
                                    $( "#account_pwd2" ).parent().find(".alert.warning").show();
                                    $( "#account_pwd" ).val( "" );
                                    $( "#account_pwd2" ).val( "" );
                                    pos = $( "#account_pwd2" );
                                }
                                else if( $( "#account_pwd2" ).val() !== $( "#account_pwd" ).val() ) {
                                    bool = false;
                                    $( "#account_pwd2" ).parent().find(".alert.error").show();
                                    $( "#account_pwd" ).val( "" );
                                    $( "#account_pwd2" ).val( "" );
                                    pos = $( "#account_pwd2" );
                                }
                                else {
                                    $( "#account_pwd2" ).parent().find(".alert.error").hide();
                                }
                                
                                if( $( "#account_country" ).val() === null ) {
                                    bool = false;
                                    $( "#account_country" ).parent().find(".alert.error").show();
                                    pos = $( "#account_country" );
                                }
                                else{
                                    $( "#account_country" ).parent().find(".alert.error").hide();
                                }
                                if( $( "#input_captcha2" ).val() === "" ) {
                                    bool = false;
                                    msg += msg === "" ? "請" : "、";
                                    msg += "輸入驗證碼";
                                    pos = $( "#input_captcha2" );
                                }
                                if( !$( "#account_accept:checked" )[0] ) {
                                    bool = false;
                                    msg += msg === "" ? "請" : "、";
                                    msg += "閱讀並同意條款";
                                }
                                
                                if( bool ) {
                                    loading_ajax_show();
                                    var data = {
                                                a_icon:    $.upload_file.account_icon,
                                                a_email:      $( "#account_email" ).val(),
                                                a_password:   md5( $( "#account_pwd" ).val() ),
                                                a_nickname:       $( "#account_nickname" ).val(),
                                                a_country:     $( "#account_country" ).val(),
                                                a_eighteen:     $( "#account_eighteen" ).is( ":checked" ),
                                                captcha:     $( "#input_captcha2" ).val(),
                                                a_id:       getParameterByName( "id" )
                                    };
                                    var success_back = function( data ) {

                                            data = JSON.parse( data );
                                            console.log(data);
                                            loading_ajax_hide();
                                            if( data.Success ) {
                                                setCookie( "istera_cookie" , data.data, "", "/", ".ggyyggy.com");
                                                $( "#cooperate_form1" ).hide();
                                                $( "#cooperate_form3" ).show();
                                                setTimeout( function(){
                                                        location.href=website_memberhome_url;
                                                } , 3000 );
                                            }
                                            else {
                                                re_captcha();
                                                show_remind( data.ErrMsg , "error" );
                                                if( data.action === "email" ){
                                                        $( "#account_email" ).parent().find(".alert").hide();
                                                        $( "#account_email" ).parent().find(".alert.error2").show();
                                                        scrollto( $( "#account_email" ) );
                                                }
                                                else if( data.action === "captcha" ){
                                                        $( "#input_captcha2" ).parent().find(".alert").hide();
                                                        $( "#input_captcha2" ).parent().find(".alert.error").show();
                                                        scrollto( $( "#input_captcha2" ) );
                                                }
                                            }

                                    }
                                    var error_back = function( data ) {
                                            console.log(data);
                                    }
                                    $.Ajax( "POST" , "php/member.php?func=add" , data , "" , success_back , error_back);
                                    
                                }
                                else {
                                    re_captcha();
                                    show_remind( msg , "error" );
                                    scrollto( pos );
                                }
                                
                        });
                        
                }
                
                function email_event( pos ){
                        
                        var bool = true;
                        pos.parent().find(".alert").hide();
                        if( pos.val() === "" ) {
                                bool = false;
                                pos.parent().find(".alert.warning").show();
                        }
                        else if( !pos[0].validity.valid ){
                                bool = false;
                                pos.parent().find(".alert.error:not(.error2)").show();
                        }
                        else {
                                pos.parent().find(".alert.success").show();
                        }
                        return bool;
                }
                function password_event( pos ){
                        
                        var bool = true;
                        pos.parent().find(".alert").hide();       
                        if( pos.val() === "" || !/^(?=.*\d)(?=.*[a-z]).{8,}$/.test( pos.val() ) ){
                                bool = false;
                                pos.parent().find(".alert.warning").show();
                        }
                        else {
                                pos.parent().find(".alert.success").show();
                        }
                        return bool;
                }
                function input_event( pos ){
                        
                        var bool = true;
                        pos.parent().find(".alert").hide();
                        if( pos.val() === "" ) {
                                bool = false;
                                pos.parent().find(".alert.warning").show();
                        }
                        else {
                                pos.parent().find(".alert.success").show();
                        }
                        return bool;
                }
                
                function unconnected_callback() {
                        init();
                };
                /*function connected_callback( member ) {
                        loading_ajax_hide();
                        show_remind( "已登入，三秒後轉跳到會員頁。" , "error"  );
                        setTimeout( function(){ location.href = website_memberhome_url }, 3000);
                };*/
                
        </script>
</html>
