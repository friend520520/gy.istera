<!DOCTYPE html>
<html lang="zh-Hant-TW">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
	<link href="https://dl.dropboxusercontent.com/u/61856343/ttshow.ico" rel="shortcut icon">
	<title>台灣達人秀 | 最強自媒體聯播網</title>
	<meta property="og:title" content="台灣達人秀 │ 最強自媒體聯播網"/>
	<meta name="description" content="讓台灣的好作品、好人才被全世界看見" />
	<meta name="keywords" content="達人秀,ttshow,新媒體創作行銷平台,新媒體人才媒合,新媒體社群行銷,新媒體影音製作,明星,藝人,插畫家,網路紅人,導演,編劇,熱門影片,Youtube排行,facebook排行,喜劇,搞笑,梗圖,音樂,寵物,有趣新聞,Youtube,網路直播,youtube,facebook,instagram"/>
	<link href="template_new/css/bootstrap.min.css" rel="stylesheet">
	<link href="template_new/css/owl.carousel.css" rel="stylesheet">
	<link href="template_new/css/swiper.min.css" rel="stylesheet">
	<link href="template_new/css/jquery.growl.css" rel="stylesheet" type="text/css" />
	<link href="template_new/css/layout.css" rel="stylesheet" type="text/css">
	<link href="template_new/css/breaking_news.css" rel="stylesheet" type="text/css">
	<link href="css/all.css" rel="stylesheet" type="text/css">
        
        <script src="template_new/js/jquery-1.11.1.min.js"></script>
        
        <script src="js/device.js"></script>
        <script src="js/create.js"></script>
        
        <script src="template_new/js/owl.carousel.js"></script>
        <script src="template_new/js/swiper.min.js"></script>
        <script src="template_new/js/bootstrap.min.js"></script>
        
        <script src="js/md5.js"></script>
        <script src="js/ajaxq.js"></script>
        
        
        <script src="template_new/js/clamp.min.js"></script>
        <script src="template_new/js/fastclick.js"></script>
        <script src="template_new/js/jquery.growl.js"></script>
        <script src="template_new/js/main.js"></script>
        
        
        <script src="js/tmp.js"></script>
        
        <script>
                function getbody() {

                    $( "#loading_icon" ).css( "visibility" , "visible" );
                    $("#pagecontent").show();
                    
                    if( $.nuw_page_num === 1 ){
                        $( "#content" ).html( '<div class="list" style="visibility: hidden;">' +
                                                    '<a href="inner.php?page_id=2027">' +
                                                        '<div name="responsive_div">' +
                                                            '<div style="background-image: url(); "></div>' +
                                                        '</div>' +
                                                        '<div class="info">' +
                                                            '<h3>【Onion man】經典插畫(八)：九陰真經的厲害</h3>' +
                                                            '<p class="view">' +
                                                                '<img src="template_new/images/inner/view.png">' +
                                                                '<span>0</span>' +
                                                            '</p>' +
                                                        '</div>' +
                                                        '<div class="list-icon"></div>' +
                                                    '</a>' +
                                                '</div>' );
                        var width = $( "#content > .list" ).width() - 10;
                        $( "#content" ).html("");
                    }
                    else {
                        var width = $( "#content > .list" ).width() - 10;
                    }
                    $.ajax({
                                type: "POST",
                                url: "php/json_list_categorypage.php",
                                data: {
                                            user        : $.member.email ,
                                            page_num    : "16" ,
                                            page        : $.nuw_page_num.toString() ,
                                            sub         : $.now_tabs_name.toString() ,
                                            page_type   : $.page_type
                                            /*subsub      : "1"*/
                                },
                                //dataType: "json",
                                success: function(data) {

                                            $( ".loading" ).css( "visibility" , "hidden" );

                                            if( data == "false" )
                                            {
                                                $( window ).unbind( "scroll" );
                                                $( ".loading" ).hide();
                                            }
                                            else {
                                                
                                                data = JSON.parse( data );
                                                var tmp = "";
                                                
                                                $.each( data , function( index , value ){
                                                
                                                        tmp += create_upright_new( value , width , 2 , 18 );;

                                                });
                                                $( "#content" ).append( tmp );
                                                
                                                collect_subscribe_event_1();


                                            }
                                            $.loading = 0;

                                }
                    });
                }
        </script>
        
</head>
<body>
	<div id="wrap">
            
                <?php include( "tmp.php"); ?>
            
		<main>
                        <?php include( "tmp_bottom.php"); ?>
			<div id="content"></div>
		</main>
                <div class="pop-item">
                        <?php include( "tmp_mobile.php"); ?>
                </div>
		<div id="loading_icon" class="loading" name="load_img" style="visibility: hidden;"></div>
                
	</div>
        <script>

                function FB_connected_callback_init( response )
                {
                            $.member = response;

                            init_scroll();
                };

                function FB_unconnected_callback_init()
                {
                            $.member = { facebook_mail : "" , email : "" };

                            init_scroll();
                };
                
                function init_scroll() {

                            $.page_type = "new";
                            $.now_tabs_name = "0" ;
                            $.nuw_page_num = 1 ;

                            $( window ).unbind( "scroll" ).bind( "scroll" , function(){ 
                                    DisplayCurrentScroll(); 
                            });
                            $( "#loading_icon" ).show();
                            ///////////////////////
                            $( "#tabs" ).children( "ul" ).children( "li[pagetype=9999]" ).addClass( "ui-tabs-active" ).addClass( "ui-state-active" );
                            ///////////////////////

                            getbody();

                }
                        
                function DisplayCurrentScroll() {

                            if( $( "body" )[0].scrollTop >= $( "html" )[0].scrollTop )
                                var tmp_div = $( "body" )[0] ;
                            else
                                var tmp_div = $( "html" )[0] ;

                            var tmp_persent = tmp_div.scrollTop / (tmp_div.scrollHeight - tmp_div.clientHeight);

                            if( tmp_div.scrollTop >= $( "[name=load_img]" ).offset().top - $( "#window_size" ).height() - $("#pagecontent_body").children(":eq(0)").height()*6 )
                            {
                                    if (!$.loading)
                                    {
                                        $.loading = 1;
                                        $.tpathqueue = setTimeout(function() {
                                            $.nuw_page_num++;
                                            scroll();
                                        }, 500);
                                    }
                            }

                }

                function scroll() {

                            getbody();

                }

        </script>
        <script src="js/fb-login.js"></script>
</body>
</html>