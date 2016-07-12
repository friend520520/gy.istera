
        
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
            
                /*FB.ui(
                    {
                        method: 'feed',
                        from: '878626368826404',
                        name: $.page_data.title,
                        link: "http://ttshow.tw/page-inner.php" + location.search,
                        picture: $.page_data.article_icon,
                        caption: 'Reference Documentation',
                        description: $.page_data.describe
                    },
                    function(response) {
                        if (response && response.post_id) {
                          facebook_get_count();
                        } else {
                          console.log(response);
                        }
                    }
                );*/
                
                window.open('https://www.facebook.com/sharer/sharer.php?u='+"http://ttshow.tw/page-inner.php" + location.search,'facebook-share-dialog','width=626,height=436');
                
                /*FB.ui(
                    {
                      method: 'share',
                      href: location.href,
                    },
                    function(response) {
                      if (response && !response.error_code) {
                        console.log(response);
                      } else {
                        console.log(response);
                      }
                    }
                );*/
            
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
                    //dataType: "json",
                    success: function(data) {
                            
                            console.log( data );
                            var total_count = parseInt( data[0].total_count );
                            var share_count = parseInt( data[0].share_count );
                            var total_percent = 100;
                            if( total_count <= 10000 )
                                total_percent = total_count/400;
                            else if( total_count <= 20000 )
                                total_percent = 25 + ( total_count - 10000 )/400;
                            else if( total_count <= 50000 )
                                total_percent = 50 + ( total_count - 10000 )/1200;
                            else if( total_count <= 100000 )
                                total_percent = 75 + ( total_count - 10000 )/2000;
                            
                            var cover_total_percent = 100 - total_percent;
                            $( "[now=share_count]" ).html( total_count );
                            $( "[now=progress-bar-cover]" ).css( "width" , cover_total_percent + "%" );
                            
                            $.ajax({
                                        type: "POST",
                                        url: "php/share_update.php",
                                        data: {
                                                    page_id    : getParameterByName("page_id") ,
                                                    share_conut: share_count
                                        },
                                        //dataType: "json",
                                        success: function(data) {

                                                
                                                    
                                        }
                            });
                            
                            
                    }
                });
                
        }
        

        function getbody() {
                
                
                $.ajaxq( "test" , {
                            type: "POST",
                            url: "php/json_list_insidepagehead.php",
                            data: {
                                        page        : getParameterByName("page_id")
                            },
                            //dataType: "json",
                            success: function(data) {

                                        if( data === "false" )
                                                $( "#pagehead" ).html("");
                                        else
                                        {
                                                data = JSON.parse( data );
                                                $.page_data = data;
                                                
                                                console.log( data );
                                                
                                                var tag_html = "";
                                                if( data.tag[0] === undefined )
                                                    tag_html = '<span class="label label-inverse chessboard-tag" style="margin-right: 6px; margin-bottom: 6px;">超人氣</span>' +
                                                                '<span class="label label-inverse chessboard-tag" style="margin-right: 6px; margin-bottom: 6px;">超人氣</span>' +
                                                                '<span class="label label-inverse chessboard-tag" style="margin-right: 6px; margin-bottom: 6px;">超人氣</span>';
                                                else
                                                    $.each( data.tag , function( index , value ){

                                                            tag_html += '<span onclick="location.href=\'search_results.php?search=' + value + '\'" class="label label-inverse chessboard-tag" style="margin-right: 6px; margin-bottom: 6px;">' + value + '</span>';

                                                    });

                                                var a = data.date.split(":");
                                                a.splice( a.length - 1 , 1 );
                                                data.date = a.join(":");

                                                
                                                if( data.img_path !== "" )
                                                    var specialtag = '<div class="page-tag-img" style="float: right;">' +
                                                                        '<img onclick="location.href=\'search_results.php?specialtag=' + data.special_id + '\'" width="42" height="42" style="cursor:pointer;" src="' + data.img_path +'" alt="ttshow">' +
                                                                    '</div>';
                                                else
                                                    var specialtag = "";
                                                
                                                var tmp ='<h2 class="page-h4" style="margin: 0px; padding-top: 11px; font-size: 20pt; line-height: 36px; color: rgb(21, 77, 125); letter-spacing: 1px;">' +
                                                            specialtag +
                                                            data.title +
                                                    '</h2>' +
                                                    '<div style="color: gray; margin-top: 15px; font-size: 11pt; margin-top: 20px; margin-bottom: 10px;">' +
                                                            '<i class="ace-icon glyphicon glyphicon-user page-icon"></i>' +
                                                            '<a><span style="color: rgb(51, 122, 183); cursor: pointer; font-size: 11pt; margin-right: 7px;">' + data.channel_info.name + '</span></a>' +// href="cooperate.php?ch=' + data.channel_info.id + '"BOHAN0717
                                                            '<i class="ace-icon glyphicon glyphicon-time" style="color: gray;margin-right: 4px;"></i>' +
                                                            '<span style="color: gray; font-size: 11pt; margin-right: 8px;">' + data.date + '</span>&nbsp;' +
                                                            /*'<i class="ace-icon fa fa-eye "></i>' +
                                                            '<span>' + data.c_num_click + '</span>&nbsp;' +*/
                                                            '<i class="ace-icon fa fa-gavel page-icon-edit"></i>' +
                                                            '<span id="report" data-toggle="modal" data-target="#myModalReport" style="margin-right: 8px; color: rgb(51, 122, 183); cursor: pointer; font-size: 14px;">檢舉</span>' +
                                                    '</div>';

                                                $( "#pagehead" ).html( tmp );
                                                $( "[name=gettag]" ).html( tag_html );
                                                
                                                if( data.img_path !== "" )
                                                    $( "[name=special_img]" ).attr( "src" , data.img_path ).attr( "onclick" , "location.href='search_results.php?specialtag=" + data.special_id + "'" );
                                                else
                                                    $( "[name=special_img]" ).hide();
                                                $( "[name=c_num_click]" ).html( data.c_num_click );
                                                
                                                //https://www.facebook.com/TaiwanTalentShow facebook
                                                //TaiwanTalentShow youtube
                                                //ttshow.tw instagram
                                                        
                                                //////////////////////getbody
                                                
                                                $( "#pagecontent" ).html( data.body );
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
                                                    
                                                    if( $.page_data.channel_community.youtube[0] )
                                                        $( ".youtobe_video" ).append( '<div style="width: ' + width + '; max-width:100%; background-color: black; color: white; padding: 15px 0px; text-align: center;">' +
                                                                                        '<span style="font-size: 17px; vertical-align: middle;">訂閱' + $.page_data.channel_community.youtube[0]["name"] + ' &gt; </span>' +
                                                                                        '<span style="position: relative; top: 8px;">' +
                                                                                            '<div style="vertical-align: middle;" class="g-ytsubscribe" data-channelid="' + $.page_data.channel_community.youtube[0]["url"] + '" data-layout="default" data-count="default"></div>' +
                                                                                        '</span>' +
                                                                                    '</div>' );
                                                    else
                                                        $( ".youtobe_video" ).append( '<div style="width: ' + width + '; background-color: black; color: white; padding: 15px 0px; text-align: center;">' +
                                                                                        '<span style="font-size: 17px; vertical-align: middle;">訂閱台灣達人秀 &gt; </span>' +
                                                                                        '<span style="position: relative; top: 8px;">' +
                                                                                            '<div style="vertical-align: middle;" class="g-ytsubscribe" data-channel="TaiwanTalentShow" data-layout="default" data-count="default"></div>' +
                                                                                        '</span>' +
                                                                                    '</div>' );

                                                }


                                                window.scrollTo( 0 , 0 );
                                                $( "body" ).show();

                                                //console.log( "adsbygoogle1" );
                                                //(adsbygoogle = window.adsbygoogle || []).push({});
                                                //(adsbygoogle = window.adsbygoogle || []).push({});
                                                //(adsbygoogle = window.adsbygoogle || []).push({});
                                                $(".adsbygoogle").css( "display" , "inline-block" );
                                                
                                                //////////////////////getbody
                                                var tmp = "";
                                                $.each( data.channel_page , function( index , value ){
                                                    tmp += create_chessboard( value , "col-xs-3" , "padding:6px;" );
                                                });
                                                $( "#pageauthorother" ).html( tmp );
                                                
                                                init_scroll();
                                                
                                        }

                            }
                });
                
                /*$.ajaxq( "test" , {
                            type: "POST",
                            url: "php/html_list_insidepagebody.php",
                            data: {
                                        page_id        : getParameterByName("page_id")
                            },
                            //dataType: "json",
                            success: function(data) {

                                        if( data == "false" )
                                        {
                                                $( "#pagecontent" ).html("");
                                        }
                                        else {
                                                
                                                $( "#pagecontent" ).html( data );
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
                                                    if( $(".youtobe_video [name=u2_player]")[0] )
                                                        var width = "100%";
                                                    else
                                                        var width = $(".youtobe_video iframe").css("width");

                                                    if( $.page_data.channel_community.youtube[0] )
                                                        $( ".youtobe_video" ).append( '<div style="width: ' + width + '; background-color: black; color: white; padding: 15px 0px; text-align: center;">' +
                                                                                        '<span style="font-size: 17px; vertical-align: middle;">訂閱' + $.page_data.channel_community.youtube[0]["name"] + ' &gt; </span>' +
                                                                                        '<span style="position: relative; top: 8px;">' +
                                                                                            '<div style="vertical-align: middle;" class="g-ytsubscribe" data-channelid="' + $.page_data.channel_community.youtube[0]["url"] + '" data-layout="default" data-count="default"></div>' +
                                                                                        '</span>' +
                                                                                    '</div>' );
                                                    else
                                                        $( ".youtobe_video" ).append( '<div style="width: ' + width + '; background-color: black; color: white; padding: 15px 0px; text-align: center;">' +
                                                                                        '<span style="font-size: 17px; vertical-align: middle;">訂閱台灣達人秀 &gt; </span>' +
                                                                                        '<span style="position: relative; top: 8px;">' +
                                                                                            '<div style="vertical-align: middle;" class="g-ytsubscribe" data-channel="TaiwanTalentShow" data-layout="default" data-count="default"></div>' +
                                                                                        '</span>' +
                                                                                    '</div>' );

                                                }


                                                window.scrollTo( 0 , 0 );
                                                $( "body" ).show();

                                                //console.log( "adsbygoogle1" );
                                                //(adsbygoogle = window.adsbygoogle || []).push({});
                                                //(adsbygoogle = window.adsbygoogle || []).push({});
                                                //(adsbygoogle = window.adsbygoogle || []).push({});
                                                $(".adsbygoogle").css( "display" , "inline-block" );

                                                //bohanfast
                                        }
                                        
                                        
                            } ,
                            error:  function(data) {

                                        //console.log(data);
                                        $( "#pagecontent" ).html( "" );

                            }
                });*/
                
                /*
                if( !getCookie( "ttshow_suggest_show" ) ) {
                        
                        $.ajax({
                                    type: "POST",
                                    url: "php/json_list_channel.php",
                                    data: {
                                                page_num    : "7" ,
                                                page        : "1" ,
                                                channel_type        : "common"
                                    },
                                    success: function(data) {
                                                if( data !== "false" )
                                                {
                                                        data = JSON.parse( data );
                                                        console.log( data );
                                                        var tmp = "";
                                                        $.each( data , function( index , value ){

                                                                tmp += '<span style="left: 0px; text-align: center; display: inline; float: left; margin: 15px 8px 0px; position: relative;">' +
                                                                            '<div class="bg_top" style="background-image: url(\'' + value.icon + '\'); cursor: pointer; width: 100px; height: 100px; margin: 0px; border: 1px solid #dddddd;"></div>' +//onclick="location.href=\'cooperate.php?ch=' + value.id + '\'" BOHAN0717
                                                                            '<div style="width: 100px; margin-top: 8px; font-size: 19px; overflow-y: hidden; height: 35px;">' + value.channelname + '</div>' +//onclick="location.href=\'cooperate.php?ch=' + value.id + '\'" BOHAN0717
                                                                        '</span>';

                                                        });
                                                        $( "#suggest_channel" ).html( tmp );
                                        
                                                        resize_function();
                                                        
                                                }
                                    }
                        });
                        
                        $( "#featured_channel" ).show();
                        
                        var d = new Date();
                        d.setTime(d.getTime() + (1 * 60 * 60 * 1000));
                        var expires = "expires=" + d.toGMTString();
                        document.cookie = "ttshow_suggest_show=ttshow_suggest_show; " + expires + "; path=/";
                        
                }*/
                
                
                
                                                                
                /*$.ajaxq( "test" , {
                            type: "POST",
                            url: "php/json_list_insidesmallpage.php",
                            data: {
                                        article        : getParameterByName("page_id") ,
                                        page_type   : "author" ,
                                        page_num    : 8 ,
                                        page        : 1
                            },
                            success: function(data) {
                                        if( data == "false" ) {
                                                $( "#pageauthorother" ).html("");
                                        }
                                        else {
                                                data = JSON.parse( data );
                                                var tmp = "";

                                                $.each( data , function( index , value ){

                                                    tmp += create_chessboard( value , "col-xs-3" , "padding:6px;" );

                                                });
                                                
                                                $( "#pageauthorother" ).html( tmp );
                                        }
                            }
                });*/
                /*$.Scroll_Event[$.Scroll_Event.length] = { id   : "pageinteresting_small" , 
                                                          ajax : '$.ajaxq( "test" , {' +
                                                                            'type: "POST",' +
                                                                            'url: "php/html_list_insidesmallpage.php",' +
                                                                            'data: {' +
                                                                                        'article        : getParameterByName("page_id") ,' +
                                                                                        'page_type   : "interesting" ,' +
                                                                                        'page_num    : 8 ,' +
                                                                                        'page        : 1' +
                                                                            '},' +
                                                                            'success: function(data) {' +
                                                                                        'if( data == "false" ) ' +
                                                                                            '$( "#pageinteresting_small" ).html("");' +
                                                                                        'else ' +
                                                                                            '$( "#pageinteresting_small" ).html( data );' +
                                                                            '}' +
                                                                '})' };*/
                
                
                /*$.ajaxq( "test" , 
                        {   type: "POST",
                            url: "php/html_list_insidesmallpage.php",
                            data: {article        : getParameterByName("page_id") ,
                                page_type   : "author" ,
                                page_num    : 8 ,
                                page        : 1
                            },
                            success: function(data) {
                                if( data == "false" ) {
                                    $( "#pageauthorother" ).html("");
                                }
                                else {
                                    $( "#pageauthorother" ).html( data );
                                }
                            }
                        })*/
                
                
                /*
                $.ajax({
                            type: "POST",
                            url: "php/html_list_insidepageTab.php",
                            data: {
                                        user        : $.member.facebook_mail ,
                                        page_num    : "6" ,
                                        page        : "1" ,
                                        sub         : "" ,
                                        page_type        : "hot"
                                        
                            },
                            //dataType: "json",
                            success: success5 ,
                            error: fail5
                });*/
            
            
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
                                                $( "#author_info > p" ).html( data.ch_introduce )
                                                if( data.subscribe === 0 || data.subscribe === 2 )
                                                    var subscribe = '<button style="padding: 0px 13px;border-radius: 3px" class="btn btn-sm btn-primary subscribe" channel="' + data.channel_id + '">訂閱</button>';
                                                else if( data.subscribe === 1 )
                                                    var subscribe = '<button style="padding: 0px 13px;border-radius: 3px" class="btn btn-sm btn-primary subscribe already" channel="' + data.channel_id + '">已訂閱</button>';
                                                
                                                data.ch_icon = data.ch_icon.replace( "ttshow.tw/" , "www.ooxxoox.com/" );//replace domain
                                                var tmp = '<a class="panel-float-left page-author">' +// href="cooperate.php?ch=' + data.channel_id + '"BOHAN0717
                                                                '<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 cover-text1 bg_top" style="border: 1px solid rgb(221, 221, 221); cursor: pointer; background-image: url(' + data.ch_icon + '); margin: 0px 1% 1% 0px; padding: 0px; height: 70px; width: 70px;"></div>' +
                                                            '</a>' +
                                                            '<div class="child-middle">' +
                                                                '<a style="color: #337ab7; font-size: 12pt; margin-left: 10px;">' + data.ch_name + '</a>' +// href="cooperate.php?ch=' + data.channel_id + '"BOHAN0717
                                                                //'<div class="" style="font-size: 10pt; display: inline-block; padding: 0px 10px; background-color: yellow;">最強導演</div>' +
                                                            '</div>' +
                                                            '<div class="" style="font-size: 10pt; position: absolute; left: 81px; top: 21px;">' + data.ch_type + '</div>' +
                                                            '<div class="panel-float-left" style="left: 80px; position: absolute; top: 45px;">' + subscribe + '</div>' +
                                                            '<div class="clearfix"></div>';
                                                $( "#pageauthor" ).html( tmp );
                                                collect_subscribe_event();
                                                
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
                                                                        
                                                                        console.log( value );
                                                                        delete_html = '<a class="btn btn-minier btn-info delete" msg="' + value.id + '">x</a>';
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
                                            $( "#report" ).after( edit );
                                        }
                                        
                            }
                });
                
                $.ajaxq( "test" , {
                            type: "POST",
                            url: "php/html_list_insidepage_get_collect.php",
                            data: {
                                        user        : $.member.email ,
                                        page        : getParameterByName("page_id")
                            },
                            //dataType: "json",
                            success: function(data) {
                                        
                                        if( data == "false" )
                                        {
                                                $( "#get_collect" ).html("");
                                                $( "#get_collect2" ).html( "" );
                                        }
                                        else {
                                                $( "#get_collect" ).html( data );
                                                $( "#get_collect2" ).html( data );
                                                collect_subscribe_event();
                                        }
                                        
                                        setTimeout(function(){
                                                    $.getScript("https://apis.google.com/js/platform.js", function(){});
                                                    (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];g.src="//x.instagramfollowbutton.com/follow.js";s.parentNode.insertBefore(g,s);}(document,"script"));
                                        }, 5000);
                                        
                            }
                });
                
        }
        
        
        
        
        
        
        function init_scroll() {
                
                console.log( "init_scroll" );
                
                $.last_num = 1;
                $.last_pagetype = 1;
                $.last_times = 1;
                $( "#pageinteresting" ).html("");
                
                scroll();
                
                $( window ).unbind( "scroll" ).bind( "scroll" , function(){ 
                        DisplayCurrentScroll(); 
                });
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
        
        function DisplayCurrentScroll () {
                    
                    /*if( $.device != "pc" )
                    var tmp_div = $( "body" )[0] ;
                    else
                    var tmp_div = $( "html" )[0]; */

                    //var tmp_div = $( "html" )[0] ;
                    
                    if( $( "body" )[0].scrollTop >= $( "html" )[0].scrollTop )
                        var tmp_div = $( "body" )[0] ;
                    else
                        var tmp_div = $( "html" )[0] ;

                    var tmp_persent = tmp_div.scrollTop  / ( tmp_div.scrollHeight - tmp_div.clientHeight ) ;

                    Scroll_Event( tmp_div );
                    
                    //console.log( "body = " + $( "body" )[0].scrollTop + " , html = " + $( "html" )[0].scrollTop + " , final = " + tmp_div.scrollTop );
                    
                    check_load_data( tmp_div );
                    
                    /*if( $("#web_sidebar1").css("display") === "block" )
                        check_load_data_web_sidebar( tmp_div );*/
                    

        }
        
        function check_load_data( tmp_div ) {
            
                    if( tmp_div.scrollTop >= $( "[name=load_img]" ).offset().top - $( "#window_size" ).height() - $("#pageinteresting").children(":eq(0)").height()*6 )
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
                                url: "php/json_list_get_random.php",
                                data: {
                                            user        : $.member.email ,
                                            page_num    : "16" ,
                                            /*page        : $.last_num ,
                                            page_type   : $.last_pagetype ,
                                            sub         : "" ,
                                            author      : $.page_data.author_id ,
                                            category_class : $.page_data.category_class ,
                                            tag    : $.page_data.tag*/
                                            /*subsub      : "1"*/
                                },
                                //dataType: "json",
                                success: function( data ) {

                                        $( "#loading_icon" ).css( "visibility" , "hidden" );
                                        if( data !== "false" )
                                        {
                                                var tmp = "";
                                                data = JSON.parse( data );
                                                $.each( data , function( index , value ){
                                                    
                                                        tmp += create_upright( value , "col-xs-12 col-sm-6 col-md-6 col-lg-6" , false , "padding: 0 6px 12px 6px;" );
                                                        
                                                });
                                                $( "#pageinteresting" ).append( tmp );
                                               
                                               
                                                if( $.last_times === 2 )
                                                {
                                                        if( !getCookie( "ttshow_popop_show" ) ) {
                                                                $( "#popop" ).css( "z-index" , "1500" ).css( "background-color" , "" );
                                                                $( "body" ).addClass( "modal-open" );
                                                                var d = new Date();
                                                                d.setTime(d.getTime() + (1 * 60 * 60 * 1000));
                                                                var expires = "expires=" + d.toGMTString();
                                                                document.cookie = "ttshow_popop_show=ttshow_popop_show; " + expires + "; path=/";
                                                        }
                                                }
                                                
                                                if( $.last_times === 1 && $.last_times === 2 )
                                                {
                                                        //$( "#pageinteresting" ).append( '<a href="http://www.spp.com.tw/event/live/2015-mydeerdog/index.htm"><img src="images/mddad728.gif" width="100%" style="padding:5px 0;"></a>' );
                                                        //$( "#pageinteresting" ).append( '<div class="col-xs-12" style="text-align: center; padding: 6px 0px;"><ins class="adsbygoogle" style="display:inline-block;width:336px;height:280px" data-ad-client="ca-pub-6993208558764142" data-ad-slot="6835431408"></ins></div>' );
                                                        //(adsbygoogle = window.adsbygoogle || []).push({});
                                                }
                                                
                                                collect_subscribe_event();
                                                
                                                
                                                $.loading = 0;
                                                $.last_times++;
                                                
                                                DisplayCurrentScroll ();
                                                
                                        }
                                        else{
                                                $.last_num = 1;
                                                //$( "#loading_icon" ).css( "visibility" , "hidden" );
                                                if( $.last_pagetype === 8 )
                                                {
                                                    $( "#loading_icon" ).css( "visibility" , "hidden" );
                                                    $.last_pagetype++;
                                                }
                                                else
                                                {
                                                    $.last_pagetype++;
                                                    scroll();
                                                }
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
                                                        
                                                        console.log( value );
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
                                    
                                    console.log( data );
                                    if( data === "true" )
                                        board_list();
                                    
                                }
                    });
                    
            });
            
        }