
        
$("document").ready(function() {
        //Enable swiping...
        
        $( "#share [type=facebook_like]" ).html( '<div class="fb-like" data-href="' + location.href + '" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>' );
        $( "#share2 [type=facebook_like]" ).html( '<div class="fb-like" data-href="' + location.href + '" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>' );
        
        //$( "#share [type=facebook]" ).html( '<div class="fb-share-button" data-href="' + location.href + '" data-layout="button_count"></div>' );
        $( "#share [type=google]" ).html( '<div class="g-plus" data-action="share" data-href="' + location.href + '"></div>' );
        //$( "#share2 [type=facebook]" ).html( '<div class="fb-share-button" data-href="' + location.href + '" data-layout="button_count"></div>' );
        $( "#share2 [type=google]" ).html( '<div class="g-plus" data-action="share" data-href="' + location.href + '"></div>' );
        
        $( "#fb-comments" ).html( '<div class="fb-comments" data-href="' + location.href + '" data-numposts="5" data-colorscheme="light"></div>' );
        
        
        $( "#tabs" ).children( "ul" ).children( "li" ).unbind( "click" ).bind( "click", function(e) {
                    
                    if( $( this ).attr( "pagetype" ) )
                    {
                        $( "#tabs" ).children( "ul" ).children( "li" ).removeClass( "ui-tabs-active" ).removeClass( "ui-state-active" );
                        $( this ).addClass( "ui-tabs-active" ).addClass( "ui-state-active" );
                    }
                    
                    
        });
        
        facebook_get_count();
        
        /*$.ajaxq( "test" , {
                            type: "POST",
                            url: "php/channel.php?func=info_by_page",
                            data: {
                                        page        : getParameterByName("page_id")
                            },
                            //dataType: "json",
                            success: function(data) {
                                    
                                    if( data !== "false" )
                                    {
                                            data = JSON.parse( data );
                                            console.log( data );
                                            
                                            $( "[name=channel_name]" ).html( data.channel_info.name );
                                                
                                                console.log( "append fb plugin" );
                                                
                                                if( data.channel_community.facebook[0] )
                                                    $( "#AuthorCommunity [type=facebook]" ).append( '<div style="padding: 0px; margin-top: 2px;" class="fb-like" data-href="' + data.channel_community.facebook[0]["url"] + '" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>' );
                                                
                                                console.log( "append fb plugin" );
                                                
                                                if( data.channel_community.youtube[0] )
                                                    $( "#AuthorCommunity [type=youtube]" ).append( '<div class="g-ytsubscribe" data-channelid="' + data.channel_community.youtube[0]["url"] + '" data-layout="default" data-count="default"></div>' );
                                                
                                                //////////////////////Community
                                                $( "#myModalAuthorCommunity .content" ).html( "" );
                                                
                                                $.each( data.channel_community , function( index , value ){
                                                        
                                                        var tmp_html = "";
                                                        var tmp_html1 = "";
                                                        var tmp_html2 = "";
                                                        switch( index )
                                                        {
                                                            case "facebook":
                                                                tmp_html1 = '<div class="fb-like" data-href="';
                                                                tmp_html2 = '" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>';
                                                                break;
                                                            case "youtube":
                                                                tmp_html1 = '<div class="g-ytsubscribe" data-channelid="';
                                                                tmp_html2 = '" data-layout="default" data-count="default"></div>';
                                                                break;
                                                            case "instagram":
                                                                tmp_html1 = '<span class="ig-follow" data-id="';
                                                                tmp_html2 = '" data-handle="igfbdotcom" data-count="false" data-size="small" data-username="false"></span>';
                                                                break;
                                                            case "line":
                                                                tmp_html1 = '<a class="_line" href="';
                                                                tmp_html2 = '">Line連結</a>'
                                                                break;
                                                            case "pixnet":
                                                                tmp_html1 = '<a class="_pixnet" href="';
                                                                tmp_html2 = '">痞客邦</a>'
                                                                break;
                                                            default:
                                                                tmp_html1 = '<a href="';
                                                                tmp_html2 = '">作品連結</a>'
                                                                break;
                                                        }
                                                        
                                                        $.each( value , function( index2 , value2 ){
                                                                
                                                                tmp_html += "<div class='col-xs-12' style='margin: 5px 0; padding: 0px 24px;'>" +
                                                                                "<div class='col-xs-5' style='padding:0;'>" + value2.name + "</div>" +
                                                                                "<div class='col-xs-7'>" +
                                                                                    tmp_html1 + value2.url + tmp_html2 +
                                                                                "</div>" +
                                                                            "</div>";
                                                                
                                                        });
                                                        
                                                        if( tmp_html !== "" )
                                                        {
                                                            tmp_html += '<hr class="col-xs-12" style="width: 90%;">';
                                                            
                                                            $( "#myModalAuthorCommunity .content" ).append( tmp_html );
                                                        }
                                                        
                                                });
                                            
                                            //$.getScript("js/fb-login.js", function(){  });
                                    }
                            }
        });*/
        
});
        
        function share_event() {
                
                window.open('https://www.facebook.com/sharer/sharer.php?u='+"http://ttshow.tw/page-inner.php" + location.search,'facebook-share-dialog','width=626,height=436');
            
        }
        
        function facebook_get_count() {
                
                $.ajax({
                    type    : "GET",
                    url     : "http://api.facebook.com/restserver.php" ,
                    data    : {
                      "method" : "links.getStats" ,
                      "urls"   : "http://ttshow.tw/page-inner.php" + location.search ,
                      "format" : "json"
                    },
                    success: function(data) {
                            
                            var total_count = parseInt( data[0].total_count );
                            var share_count = parseInt( data[0].share_count );
                            var total_percent = 100;
                            if( total_count < 10000 ) {
                                total_percent = total_count/400;
                            }
                            else if( total_count < 20000 ) {
                                total_percent = 25 + ( total_count - 10000 )/400;
                                $( "#pagespecialtag" )[0].src = 'template_new/images/inner/like/blue.png' ;
                                //$( "#pagespecialtag" ).parent().attr( "href" , '../search_results.php?specialtag=10k' );
                            }
                            else if( total_count < 50000 ) {
                                total_percent = 50 + ( total_count - 10000 )/1200;
                                $( "#pagespecialtag" )[0].src = 'template_new/images/inner/like/green.png' ;
                                //$( "#pagespecialtag" ).parent().attr( "href" , '../search_results.php?specialtag=20k' );
                            }
                            else if( total_count < 100000 ) {
                                total_percent = 75 + ( total_count - 10000 )/2000;
                                $( "#pagespecialtag" )[0].src = 'template_new/images/inner/like/yellow.png' ;
                                //$( "#pagespecialtag" ).parent().attr( "href" , '../search_results.php?specialtag=50k' );
                            }
                            else if( total_count === 100000 ) {
                                total_percent = 75 + ( total_count - 10000 )/2000;
                                $( "#pagespecialtag" )[0].src = 'template_new/images/inner/like/red.png' ;
                                //$( "#pagespecialtag" ).parent().attr( "href" , '../search_results.php?specialtag=100k' );
                            }
                            else {
                                $( "#pagespecialtag" )[0].src = 'template_new/images/inner/like/red.png' ;
                                //$( "#pagespecialtag" ).parent().attr( "href" , '../search_results.php?specialtag=100k' );
                            }
                            
                            var cover_total_percent = 100 - total_percent;
                            $( "[now=share_count]" ).html( total_count );
                            $( ".like-number1 .cover" ).css( "width" , cover_total_percent + "%" );
                            
                            $.ajax({
                                        type: "POST",
                                        url: "php/share_update.php",
                                        data: {
                                                    page_id    : getParameterByName("page_id") ,
                                                    share_conut: share_count
                                        },
                                        success: function(data) {}
                            });
                    }
                });
                
        }
        
        
        function getbody()
        {
                
                $.ajaxq( "test" , 
                {
                            type: "POST",
                            url: "php/json_list_insidepagehead.php",
                            data: {
                                        page        : getParameterByName("page_id")
                            },
                            //dataType: "json",
                            success: function(data) {

                                        if( data === "false" ) {
                                                $( "#pagehead" ).html("");
                                                $( "main" ).html( "404" )
                                                        .css( "font-size" , "48px" )
                                                        .css( "text-align" , "center" )
                                                        .css( "margin-top" , "120px" );
                                        }
                                        else
                                        {
                                                data = JSON.parse( data );
                                                $.page_data = data;
                                                
                                                var tag_html = "";
                                                if( data.tag[0] === undefined )
                                                {
                                                /*
                                                tag_html = '<span class="label label-inverse chessboard-tag" style="margin-right: 6px; margin-bottom: 6px;">超人氣</span>' +
                                                            '<span class="label label-inverse chessboard-tag" style="margin-right: 6px; margin-bottom: 6px;">超人氣</span>' +
                                                            '<span class="label label-inverse chessboard-tag" style="margin-right: 6px; margin-bottom: 6px;">超人氣</span>';
                                                */
                                                tag_html = '<li><a>超人氣</a></li><li><a>超人氣</a></li><li><a>超人氣</a></li>' ;
                                                }
                                                else
                                                {
                                                $.each( data.tag , function( index , value ){

                                                        //tag_html += '<span onclick="location.href=\'search_results.php?search=' + value + '\'" class="label label-inverse chessboard-tag" style="margin-right: 6px; margin-bottom: 6px;">' + value + '</span>';
                                                        tag_html += '<li><a>' + value + '</a></li>' ;
                                                });
                                                }
                                                    
                                                $( "#pagetag" ).html( tag_html );
                                                    

                                                var a = data.date.split(":");
                                                a.splice( a.length - 1 , 1 );
                                                data.date = a.join(":");

                                                /*
                                                if( data.img_path !== "" )
                                                    var specialtag = '<div class="page-tag-img" style="float: right;">' +
                                                                        '<img onclick="location.href=\'search_results.php?specialtag=' + data.special_id + '\'" width="42" height="42" style="cursor:pointer;" src="' + data.img_path +'" alt="ttshow">' +
                                                                    '</div>';
                                                else
                                                    var specialtag = "";*/
                                                

                                                    
                                                $( "#pagechannel" ).html( data.channel_info.name );
                                                $( "#pagedate" ).html( data.date );
                                                $( "#pagehead" ).html( data.title );
                                                
                                                $( "#pagecontent" ).html( data.body );
                                                
                                                //$( "[name=c_num_click]" ).html( data.c_num_click );
                                                $( "#pagenum" ).html( data.c_num_click );
                                                
                                                // tag
                                                $( "[name=gettag]" ).html( tag_html );
                                                
                                                // special_img
                                                /*if( data.img_path !== "" )
                                                    $( "[name=special_img]" ).attr( "src" , data.img_path ).attr( "onclick" , "location.href='search_results.php?specialtag=" + data.special_id + "'" );
                                                else
                                                    $( "[name=special_img]" ).hide();*/
                                                
                                                //https://www.facebook.com/TaiwanTalentShow facebook
                                                //TaiwanTalentShow youtube
                                                //ttshow.tw instagram
                                                        
                                                //////////////////////getbody
                                                
                                                //----------------------------------------------
                                                var img = $("#pagecontent img");
                                                //var img = $("img[key]");
                                                var src = "";
                                                for(var i=0;i<img.length;i++) {
                                                    src = img.eq(i).attr("src");
                                                    if( src.search("http") === -1 )
                                                        img.eq(i).attr("src" , $.user_image_path + getParameterByName("page_id") + "/" + src );
                                                }
                                                //--------------------------------------------------------
                                                if( $(".youtobe_video")[0] )
                                                {
                                                    /*if( $(".youtobe_video [name=u2_player]")[0] )
                                                        var width = "100%";
                                                    else
                                                        var width = $(".youtobe_video iframe").css("width");*/
                                                    var width = $(".youtobe_video [name=u2_player]").css("width");
                                                    
                                                    $( ".youtobe_video" ).css( "width" , width );
                                                    $( ".youtobe_video > div" ).attr( "style" , "" ).addClass( "video" );
                                                    /*if( $.page_data.channel_community.youtube[0] ) {
                                                        $( ".youtobe_video" ).append( '<div class="video-ad child-middle">' +
                                                                                        '<span>訂閱' + $.page_data.channel_community.youtube[0]["name"] + ' &gt; </span>' +
                                                                                        '<span style="position: relative; top: 8px;">' +
                                                                                            '<div style="vertical-align: middle;" class="g-ytsubscribe" data-channelid="' + $.page_data.channel_community.youtube[0]["url"] + '" data-layout="default" data-count="default"></div>' +
                                                                                        '</span>' +
                                                                                    '</div>' );
                                                    }
                                                    else {
                                                        $( ".youtobe_video" ).append( '<div class="video-ad child-middle">' +
                                                                                        '<span">訂閱台灣達人秀 &gt; </span>' +
                                                                                        '<span style="position: relative; top: 8px;">' +
                                                                                            '<div style="vertical-align: middle;" class="g-ytsubscribe" data-channel="TaiwanTalentShow" data-layout="default" data-count="default"></div>' +
                                                                                        '</span>' +
                                                                                    '</div>' );
                                                    }*/
                                                        

                                                }


                                                window.scrollTo( 0 , 0 );
                                                $( "body" ).show();
                                                
                                                ///////////相關page++
                                                var tmp = "";
                                                $.each( data.about_page , function( index , value ){
                                                        tmp += create_chessboard_hot( value , "true" , $( "#pageabout > .list" ).width() - 10 , 3 );
                                                });
                                                $( "#pageabout" ).html( tmp );
                                                ///////////相關page--
                                                
                                                init_scroll();
                                                
                                                $( "#content" ).css( "visibility" , "visible" );
                                                
                                        }

                            }
                });
                
                
                $.ajaxq( "test" , 
                {
                            type: "POST",
                            url: "php/json_list_categorypage.php",
                            data: {
                                        user        : "" ,
                                        page_num    : "5" ,
                                        page        : "1" ,
                                        sub         : "0" ,
                                        page_type        : "new"
                            },
                            success: function(data) {
                                    
                                    if( data != "false" )
                                    {
                                            data = JSON.parse( data );
                                            var tmp = "";
                                            $.each( data , function( index , value ){
                                                    tmp += create_chessboard_hot( value , "false" , 336 , 3 );
                                            });
                                            $( ".content-right > .place" ).append( tmp );
                                            $.fixed_area_top = $('.fixed-area').offset().top;
                                            
                                    }
                                
                            }
                });
            
        }

        function user_getbody() {
                
                $.ajaxq( "test" , {
                            type: "POST",
                            url: "php/json_list_insidepageauthor.php",
                            data: {
                                        user        : $.member.email ,
                                        page        : getParameterByName("page_id")
                            },
                            success:function(data) {
                                       if( data == "false" ) {
                                                $( "#pageauthor" ).html("");
                                        }
                                        else {
                                                data = JSON.parse( data );
                                                $( ".author-info .author-info-intro p" ).html( data.ch_introduce );
                                                $( ".author-info .author-info-name" ).html( data.ch_name );
                                                
                                                data.ch_icon = data.ch_icon.replace( "ttshow.tw/" , "www.ooxxoox.com/" );//replace domain
                                                $( ".author-info .author-info-icon div" ).css( "background-image" , "url(" + data.ch_icon + ")" );
                                                
                                                collect_subscribe_event_1();
                                                
                                                ///////////////board++
                                                
                                                if( $.open_inner_board )
                                                {
                                                        var html = ''
                                                        $( "#board" ).show();
                                                        $.board_lasttime = "";
                                                        if( data.board ) {
                                                            
                                                            $.each( data.board , function( index , value ){
                                                                    
                                                                    var delete_html = "";
                                                                    
                                                                    if( getCookie( "ttshow" ) && value.user_id === JSON.parse( getCookie( "ttshow" ) ).user_id ) {
                                                                        
                                                                        delete_html = '<a style="padding:0 8px;" class="btn btn-minier btn-info delete" msg="' + value.id + '">x</a>';
                                                                        $.board_lasttime = [];
                                                                        $.each( value.date.split(" ")[0].split("-") , function( index , value ){
                                                                            $.board_lasttime[$.board_lasttime.length] = parseInt( value );
                                                                        });
                                                                        $.each( value.date.split(" ")[1].split(":") , function( index , value ){
                                                                            $.board_lasttime[$.board_lasttime.length] = parseInt( value );
                                                                        });
                                                                    }
                                                                    
                                                                    
                                                                    html += '<div class="itemdiv dialogdiv">' +
                                                                                '<div class="user">' +
                                                                                    '<img alt="' + value.user_name + '" src="' + value.usericon + '">' +
                                                                                '</div>' +
                                                                                '<div class="body">' +
                                                                                    '<div class="time">' +
                                                                                        '<i class="ace-icon fa fa-clock-o"></i>' +
                                                                                        '<span class="green">' + value.date + '</span>' +
                                                                                    '</div>' +
                                                                                    '<div class="name">' +
                                                                                        '<a>' + value.user_name + '</a>' +
                                                                                    '</div>' +
                                                                                    '<div class="text">' + value.text + '</div>' +
                                                                                    '<div class="tools">' +
                                                                                            delete_html +
                                                                                    '</div>' +
                                                                                '</div>' +
                                                                            '</div>';

                                                            });
                                                        }
                                                        else {
                                                            html = "尚未有人留言";
                                                        }
                                                        
                                                        $( "#board .widget-body .dialogs" ).append( html );
                                                        
                                                        board_del_event();
                                                        
                                                        $( "#board_send" ).unbind( "click" ).bind( "click" , function(){
                                                                
                                                                if( !$.member.user_id ) {
                                                                    alert( "請登入" );
                                                                }
                                                                else if( $( "#board_text" ).val().length > 200 ) {
                                                                    alert( "字數超過200" );
                                                                }
                                                                else if( $( "#board_text" ).val() !== "" ) {
                                                                    var bool = true;

                                                                    if( $.board_lasttime )
                                                                    {
                                                                        var lasttime = new Date($.board_lasttime[0], $.board_lasttime[1]-1, $.board_lasttime[2], $.board_lasttime[3], $.board_lasttime[4], $.board_lasttime[5], 0);
                                                                        if( new Date( new Date().getTime() - lasttime.getTime() ).getTime() < 1000*60*10 ) 
                                                                            bool = false;
                                                                    }

                                                                    if( bool ) 
                                                                    {
                                                                        $.ajaxq( "test" , {
                                                                            type: "POST",
                                                                            url: "php/board.php?func=add",
                                                                            data: {
                                                                                        page        : getParameterByName("page_id") ,
                                                                                        user_id        : $.member.user_id ,
                                                                                        text        : $( "#board_text" ).val()
                                                                            },
                                                                            //dataType: "json",
                                                                            success: function(data) {

                                                                                if( data === "true" ) {
                                                                                    board_list();
                                                                                }
                                                                                else if ( data !== "false" ){
                                                                                    alert( data );
                                                                                }

                                                                            }
                                                                        });
                                                                    }
                                                                    else {
                                                                        alert( "同一篇留言10分內重複回復" );
                                                                    }
                                                                }
                                                        });
                                                }
                                                ///////////////board--
                                        }
                                        
                                        if( data.edit ) {
                                            var edit = '<i class="ace-icon glyphicon glyphicon-edit page-icon-edit"></i>' +
                                                        '<a href="editor.php?page=' + getParameterByName( "page_id" ) + '" style="color: #337ab7; cursor: pointer;">編輯</a>&nbsp;';
                                            $( ".report" ).after( edit );
                                        }
                                        
                            }
                });
                
                $.ajaxq( "test" , {
                            type: "POST",
                            url: "php/collect.php?func=get_status",
                            data: {
                                        user        : $.member.email ,
                                        page        : getParameterByName("page_id")
                            },
                            success: function(data) {
                                        
                                        if( data == "false" ) {
                                                $( "#get_collect span" ).html( "收藏" );
                                        }
                                        else {
                                                if( data === 0 || data === 2 ) {
                                                    $( "#get_collect span" ).html( "收藏" );
                                                    $( "#get_collect" ).removeClass( "already" );
                                                }
                                                else if( data === 1 ) {
                                                    $( "#get_collect span" ).html( "已收藏" );
                                                    $( "#get_collect" ).addClass( "already" );
                                                }
                                                
                                                collect_subscribe_event_1();
                                        }
                                        
                                        setTimeout(function(){
                                                    $.getScript("https://apis.google.com/js/platform.js", function(){});
                                                    (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];g.src="//x.instagramfollowbutton.com/follow.js";s.parentNode.insertBefore(g,s);}(document,"script"));
                                        }, 5000);
                                        
                            }
                });
                
        }
        
        
        
        
        
        
        function init_scroll() {
                
                $.last_num = 1;
                $.last_pagetype = 1;
                $.last_times = 1;
                
                scroll();
                
                $( "body" ).bind( "DisplayCurrentScroll" , function() {

                        if( $( "body" )[0].scrollTop >= $( "html" )[0].scrollTop )
                            var tmp_div = $( "body" )[0] ;
                        else
                            var tmp_div = $( "html" )[0] ;
                        
                        check_load_data( tmp_div );

                });
                
                $.fixed_area_top = $('.fixed-area').offset().top;
                var scrollTop = $(window).scrollTop();
                
                $(window).scroll(function() {
                        $( "body" ).trigger( "DisplayCurrentScroll" );
                        scrollTop = $(window).scrollTop();
                        console.log( $.fixed_area_top - 80 );
                        if(scrollTop >= ($.fixed_area_top - 80) ) {
                                $('.fixed-area').css({
                                        'position': 'fixed',
                                        'top': '80px'
                                });
                        }else {
                                $('.fixed-area').css({
                                        'position': 'relative',
                                        'top': '0'
                                });
                        }
                }).scroll();
                $( "#loading_icon" ).css( "visibility" , "visible" );
                
        }
        
        function Scroll_Event( tmp_div ) {
                
                if( $.Scroll_Event !== undefined && $.Scroll_Event[0] !== undefined )
                {
                        $.each( $.Scroll_Event , function( index , value ){
                                
                                if( tmp_div.scrollTop >= $( "#" + value.id ).offset().top - $(window).height() )
                                {
                                    eval( value.ajax );
                                    $.Scroll_Event.splice( index , 1 );
                                    return false;
                                }
                                
                        });
                }
        }
        
        function check_load_data( tmp_div ) {
            
                    if( tmp_div.scrollTop >= $( "[name=load_img]" ).offset().top - $( "#window_size" ).height() - $("#pagehot").children(":eq(0)").height()*6 )
                    {
                                /*if( $.tpathqueue )
                                clearTimeout( $.tpathqueue );
                                $.tpathqueue = setTimeout(function(){
                                            $.last_num++;
                                            scroll();
                                }, 500);*/
                                if(!$.loading)
                                {
                                            $.loading = 1;
                                            $.tpathqueue = setTimeout(function(){
                                                        $.last_num++;
                                                        scroll();
                                            }, 500);
                                }
                    }
            
        }
        
        function scroll() {
                
                if( $.member === undefined )
                {
                    $.member = { facebook_mail : "" , email : "" };
                }
                
                if( $.last_num && $.page_data && $.last_pagetype < 9 )
                {
                    //console.log( "$.last_pagetype = " + $.last_pagetype );
                    $( "#loading_icon" ).css( "visibility" , "visible" );
                    $.ajaxq( "test" , {
                                type: "POST",
                                url: "php/hot.php",
                                data: {
                                            user        : $.member.email ,
                                            page_num    : "16" ,
                                            page       : $.last_num
                                },
                                //dataType: "json",
                                success: function( data ) {
                                        
                                        $( "#loading_icon" ).css( "visibility" , "hidden" );
                                        if( data !== "false" )
                                        {
                                                console.log( $.last_num );
                                                if ( $.last_num === 1 ) {
                                                    $( "#pagehot" ).html( '<div class="list" style="visibility: hidden;">' +
                                                        '<a href="inner.php?page_id=1728">' +
                                                            '<div name="responsive_div">' +
                                                                '<div style="background-image: url(); "></div>' +
                                                            '</div>' +
                                                            '<div class="info">' +
                                                                '<h3 title="催淚圖文創作「狗與鹿」 描繪寵物與主人的深刻情感">催淚圖文創作「狗與鹿」 描繪寵物與主人的深刻情感</h3>' +
                                                                '<p class="view">' +
                                                                    '<img src="template_new/images/inner/view.png">' +
                                                                    '<span>353</span>' +
                                                                '</p>' +
                                                            '</div>' +
                                                            '<div class="list-icon"></div>' +
                                                        '</a>' +
                                                    '</div>' );
                                                    
                                                }
                                                var width = $( "#pagehot > .list" ).width() - 10;
                                                if( $.last_num === 1 ) $( "#pagehot" ).html("");
                                                var tmp = "";
                                                data = JSON.parse( data );
                                                $.each( data , function( index , value ){
                                                        
                                                        tmp += create_chessboard_hot( value , "true" , width , 3 );
                                                        
                                                });
                                                $( "#pagehot" ).append( tmp );
                                               
                                                if( $.last_times === 2 )
                                                {
                                                        /*if( !getCookie( "ttshow_popop_show" ) ) {
                                                                $( "#popop" ).css( "z-index" , "1500" ).css( "background-color" , "" );
                                                                $( "body" ).addClass( "modal-open" );
                                                                var d = new Date();
                                                                d.setTime(d.getTime() + (1 * 60 * 60 * 1000));
                                                                var expires = "expires=" + d.toGMTString();
                                                                document.cookie = "ttshow_popop_show=ttshow_popop_show; " + expires + "; path=/";
                                                        }*/
                                                }
                                                
                                                if( $.last_times === 1 && $.last_times === 2 )
                                                {
                                                        //$( "#pagehot" ).append( '<a href="http://www.spp.com.tw/event/live/2015-mydeerdog/index.htm"><img src="images/mddad728.gif" width="100%" style="padding:5px 0;"></a>' );
                                                        //$( "#pagehot" ).append( '<div class="col-xs-12" style="text-align: center; padding: 6px 0px;"><ins class="adsbygoogle" style="display:inline-block;width:336px;height:280px" data-ad-client="ca-pub-6993208558764142" data-ad-slot="6835431408"></ins></div>' );
                                                        //(adsbygoogle = window.adsbygoogle || []).push({});
                                                }
                                                
                                                collect_subscribe_event_1();
                                                
                                                
                                                console.log( "already append" );
                                                $.loading = 0;
                                                $.last_times++;
                                                
                                                $( "body" ).trigger( "DisplayCurrentScroll" );
                                                
                                        }
                                        else{
                                                
                                                $( "#loading_icon" ).css( "visibility" , "hidden" );
                                                $( "body" ).unbind( "DisplayCurrentScroll" );
                                        }

                                }
                    });
                }
                else
                {
                    $.loading = 0;
                }
        }
        
        function board_list() {
            
            $.ajaxq( "test" , {
                                type: "POST",
                                url: "php/board.php?func=list",
                                data: {
                                            page        : getParameterByName( "page_id" )
                                },
                                success: function( data ) {
                                    
                                    $.board_lasttime = "";
                                    if( data === "empty" ) {
                                        $( "#board .widget-body .dialogs" ).html( "尚未有人留言" );
                                    }
                                    else if( data !== "false" )
                                    {
                                            data = JSON.parse( data );
                                            var html = "";
                                            $.each( data , function( index , value ){
                                                    
                                                    var delete_html = "";
                                                    if( getCookie( "ttshow" ) && value.user_id === JSON.parse( getCookie( "ttshow" ) ).user_id ) {
                                                        
                                                        delete_html = '<a href="#" class="btn btn-minier btn-info delete" msg="' + value.id + '">x</a>';
                                                        $.board_lasttime = [];
                                                        $.each( value.date.split(" ")[0].split("-") , function( index , value ){
                                                            $.board_lasttime[$.board_lasttime.length] = parseInt( value );
                                                        });
                                                        $.each( value.date.split(" ")[1].split(":") , function( index , value ){
                                                            $.board_lasttime[$.board_lasttime.length] = parseInt( value );
                                                        });
                                                    }
                                                    
                                                    
                                                    html += '<div class="itemdiv dialogdiv">' +
                                                                '<div class="user">' +
                                                                    '<img alt="' + value.user_name + '" src="' + value.usericon + '">' +
                                                                '</div>' +
                                                                '<div class="body">' +
                                                                    '<div class="time">' +
                                                                        '<i class="ace-icon fa fa-clock-o"></i>' +
                                                                        '<span class="green">' + value.date + '</span>' +
                                                                    '</div>' +
                                                                    '<div class="name">' +
                                                                        '<a href="#">' + value.user_name + '</a>' +
                                                                    '</div>' +
                                                                    '<div class="text">' + value.text + '</div>' +
                                                                    '<div class="tools">' +
                                                                        delete_html +
                                                                    '</div>' +
                                                                '</div>' +
                                                            '</div>';

                                            });
                                            
                                            $( "#board .widget-body .dialogs" ).html( html );
                                            
                                            board_del_event();
                                            
                                    }
                                    
                                }
            });
            
            
            
        }
        
        function board_del_event() {
            
            $( "#board .delete" ).unbind( "click" ).bind( "click" , function(){
                    
                    var msg = $( this ).attr( "msg" );
                    $.ajaxq( "test" , {
                                type: "POST",
                                url: "php/board.php?func=delete",
                                data: {
                                            id        : msg
                                },
                                success: function( data ) {
                                    
                                    if( data === "true" )
                                        board_list();
                                    
                                }
                    });
                    
            });
            
        }