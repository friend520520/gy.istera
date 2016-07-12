    
    $.open_inner_board = false;
    $.open_facebook_board = true;
    
    
    $.Ajax = function ( type , url , data , data2 , back , error_back) 
    {
               if( error_back == "" ) {
                       error_back = function(e) { console.log(e); };
               }
               $.ajax({
                           type : type ,
                           url : url ,
                           async: true ,
                           data : data ,
                           data2 : data2 ,
                           success : back ,
                           error : error_back
               });
    }
                 
    function create_upright( data , bootstrap_class , delete_icon , css ) {
                
                css = css || "padding: 0 15px 15px 0;";
                
                if( delete_icon )
                {
                    var delete_icon_html = '<img src="template/assets/images/apply/x1.png" class="delete" style="cursor: pointer; width: 20px; position: absolute; right: 22px; top: 10px;">';
                    
                }
                else
                {
                    var delete_icon_html = "";
                }
                
                var tag_html = "";
                
                if( data.tag[0] === undefined )
                        tag_html = '<span class="label label-inverse chessboard-tag" style="margin-right: 6px; margin-bottom: 6px;">超人氣</span>' +
                                   '<span class="label label-inverse chessboard-tag" style="margin-right: 6px; margin-bottom: 6px;">超人氣</span>' +
                                   '<span class="label label-inverse chessboard-tag" style="margin-right: 6px; margin-bottom: 6px;">超人氣</span>';
                else
                $.each( data.tag , function( index , value ){
                        
                        tag_html += '<a href="search_results.php?search=' + value + '"><span class="label label-inverse chessboard-tag" style="margin-right: 6px; margin-bottom: 6px;">' + value + '</span></a>';
                        
                });
                
                /*if( data.special_icon_path === "" )
                    var specialtag = '';
                else
                    var specialtag = '<img width="42px" height="42px" src="' + data.special_icon_path + '" style="position:absolute; right:-7px; top:-7px;" onclick="location.href=\'search_results.php?specialtag=' + data.specialtag_id + '\'">';*/
        
                if( parseInt( data.share_num ) > 100000 )
                    var specialtag = '<img width="42px" height="42px" src="images/100k.png" style="position:absolute; right:-7px; top:-7px;" onclick="location.href=\'search_results.php?specialtag=100\'">';
                else if( parseInt( data.share_num ) > 50000 )
                    var specialtag = '<img width="42px" height="42px" src="images/50k.png" style="position:absolute; right:-7px; top:-7px;" onclick="location.href=\'search_results.php?specialtag=50\'">';
                else if( parseInt( data.share_num ) > 20000 )
                    var specialtag = '<img width="42px" height="42px" src="images/20k.png" style="position:absolute; right:-7px; top:-7px;" onclick="location.href=\'search_results.php?specialtag=20\'">';
                else if( parseInt( data.share_num ) > 10000 )
                    var specialtag = '<img width="42px" height="42px" src="images/10k.png" style="position:absolute; right:-7px; top:-7px;" onclick="location.href=\'search_results.php?specialtag=1\'">';
                else
                    var specialtag = '';
                
                if( data.subscribe === 0 )
                    var subscribe = '<button class="btn btn-sm btn-primary panel-float-right subscribe" style="padding: 0px 13px; border-radius: 3px; position: absolute; margin-top: 25px; top: auto; right: 25px;" channel="' + data.channel_id + '">訂閱</button>';
                else if( data.subscribe === 1 )
                    var subscribe = '<button class="btn btn-sm btn-primary panel-float-right subscribe already" style="padding: 0px 13px; border-radius: 3px; position: absolute; margin-top: 25px; top: auto; right: 25px;" channel="' + data.channel_id + '">已訂閱</button>';
                else if( data.subscribe === 2 )
                    var subscribe = '<button class="btn btn-sm btn-primary panel-float-right subscribe" style="padding: 0px 13px; border-radius: 3px; position: absolute; margin-top: 25px; top: auto; right: 25px;" channel="' + data.channel_id + '">訂閱</button>';
                
                data.channel_icon = data.channel_icon.replace( "ttshow.tw/" , "www.ooxxoox.com/" );//replace domain
                
                return '<div style="' + css + '" class="' + bootstrap_class + '" article="' + data.page_id + '" user="' + data.user_id + '">' +
                            '<div index="1" class="panel panel-default chessboard-box">' +
                              '<div class="panel-body chessboard-body"> ' +
                                '<a>' +// href="cooperate.php?ch=' + data.channel_id + '"BOHAN0717
                                    '<div style="background-image: url(' + data.channel_icon + '); " class="chessboard-icon bg_top"></div>' +
                                '</a>' +
                                '<a class="chessboard-id" index="1">' +// href="cooperate.php?ch=' + data.channel_id + '"BOHAN0717
                                    data.channel_name +
                                '</a>' +
                                //'<div class="chessboard-type">' + data.channel_type + '</div>' +0730email8
                                '<div>' +
                                delete_icon_html +
                                subscribe +
                                '</div>' +
                                '<span class="panel1-identity">' +
                                  data.author_business +
                                '</span>' +
                                '<div class="chessboard-time">' +
                                  '<i class="ace-icon glyphicon glyphicon-time chessboard-time-icon"></i>' +
                                  '<span>' +
                                    data.date +
                                  '</span>' +
                                '</div>' +
                                '<div class="clearfix">' +
                                '</div>' +
                                '<div name="responsive_div_level1" style="margin-top: 15px;">' +
                                    '<a href="page-inner.php?page_id=' + data.page_id + '" class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding: 0;" name="responsive_div">' +
                                        '<div style="background-image: url(' + data.article_icon + '); " class="chessboard-bgcenter">' +
                                        '</div>' +
                                    '</a>' +
                                    /*'<div onclick=\'$( "#tabs" ).children( "ul" ).children( "li[pagetype=' + data.class_id + ']" ).trigger("click");\' tab="' + data.class_id + '" class="chessboard-transparent">' +
                                        '<i class="ace-icon glyphicon glyphicon-film"></i>' +
                                        '<span>' + data.class_name + '</span>' +
                                    '</div>' +*/
                                    specialtag +
                                '</div>' +
                                /*'<div class="pos-rel page-btn-share-tem">' +
                                    '<div class="progress-bar progress-bar-warning page-btn-share-tem-progress" style="width:' + data.process_per + '%"></div>' +
                                '</div>' +*/
                                '<h4 class="upright-title">' +
                                    '<a href="page-inner.php?page_id=' + data.page_id + '" title="' + data.title + '">' + data.title + '</a>' +
                                '</h4>' +
                                '<div class="col-xs-12" style="margin-bottom: 3px; padding: 0px;">' +
                                  '<span class="chessboard-view" style="width: 25%;">' +
                                    '<i class="ace-icon fa fa-eye chessboard-icontext">' +
                                    '</i>' +
                                    data.num_click +
                                  '</span>' +
                                  '<span class="chessboard-replay" style="width: 25%;">' +
                                    '<i class="ace-icon fa fa-share chessboard-icontext">' +
                                    '</i>' +
                                    data.share_num +
                                  '</span>' +
                                '</div>' +
                                '<div class="col-xs-12" style="overflow-y: hidden; height: 46px; padding: 0px;">' +
                                    tag_html +
                                '</div>' +
                              '</div>' +
                            '</div>' +
                        '</div>';

    }
    
    function create_list( data , bootstrap_class , css , delete_icon ) {
                
                if( delete_icon )
                    var delete_icon_html = '<img style="cursor: pointer; width: 20px; position: absolute; right: 5px; margin: auto 0px; top: 0px; bottom: 0px;" class="delete" src="template/assets/images/apply/x1.png">';
                else
                    var delete_icon_html = "";
                
                if( parseInt( data.share_num ) > 100000 )
                    var specialtag = '<img width="42px" height="42px" src="images/100k.png" style="position:absolute; right:-7px; top:-7px;" onclick="location.href=\'search_results.php?specialtag=100\'">';
                else if( parseInt( data.share_num ) > 50000 )
                    var specialtag = '<img width="42px" height="42px" src="images/50k.png" style="position:absolute; right:-7px; top:-7px;" onclick="location.href=\'search_results.php?specialtag=50\'">';
                else if( parseInt( data.share_num ) > 20000 )
                    var specialtag = '<img width="42px" height="42px" src="images/20k.png" style="position:absolute; right:-7px; top:-7px;" onclick="location.href=\'search_results.php?specialtag=20\'">';
                else if( parseInt( data.share_num ) > 10000 )
                    var specialtag = '<img width="42px" height="42px" src="images/10k.png" style="position:absolute; right:-7px; top:-7px;" onclick="location.href=\'search_results.php?specialtag=1\'">';
                else
                    var specialtag = '';
                
                return '<div style="' + css + '" class="' + bootstrap_class + '" article="' + data.page_id + '" history_date="' + data.history_date + '">' +
                            '<div class="col-xs-6" name="responsive_div_level1" style="padding: 1px; cursor: pointer;">' +
                                '<a href="page-inner.php?page_id=' + data.page_id + '" class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding: 0;" name="responsive_div">' +
                                    '<div style="background-image: url(' + data.article_icon + '); " class="chessboard-bgcenter">' +
                                        //'<div class="cover-black-small_"></div>' +
                                        /*'<div style="color: white; position: absolute; left: 11px; bottom: 6px; text-shadow: 1px 2px 1px black;" class="index-smallbox">' +
                                            '<i class="ace-icon fa fa-eye panel-icon"></i>' + data.num_click +
                                            '<i class="ace-icon fa fa-share panel-icon" style="margin-left: 5px"></i>' + data.share_num +
                                        '</div>' +*/
                                    '</div>' +
                                '</a>' +
                                specialtag +
                            '</div>' +
                            '<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 cover-text1" name="responsive_div_level1" style="margin: 0px; padding: 1px;">' +
                                '<div  name="responsive_div" style="width: 100%;">' +
                                    '<a href="page-inner.php?page_id=' + data.page_id + '">' +
                                        '<p style="color: gray; overflow-y: hidden; font-size: 14px; line-height: 19px; text-align: left; position: absolute; top: 0px; margin: 2px 0px 2px 9px;">' + data.title + '</p>' +
                                    '</a>' +
                                    '<c style="bottom: 0px; position: absolute; left: 0px; text-align: left; padding-left: 9px;">' +
                                        '<h6 style="color: gray; position: relative; margin-bottom: 5px; overflow: hidden; font-size: 2.8vw; height: 3.8vw;">' +
                                            '<i class="ace-icon glyphicon glyphicon-user" style="margin-right: 10px"></i>' +
                                            '<a>' +// href="cooperate.php?ch=' + data.channel_id + '"BOHAN0717
                                                '<span>' + data.channel_name + '</span>' +
                                            '</a>' +
                                        '</h6>' +
                                        '<div class="col-xs-12" style="margin-bottom: 3px; padding: 0px;">' +
                                            '<span class="chessboard-view">' +
                                              '<i class="ace-icon fa fa-eye chessboard-icontext">' +
                                              '</i>' +
                                              data.num_click +
                                            '</span>' +
                                            '<span class="chessboard-replay">' +
                                              '<i class="ace-icon fa fa-share chessboard-icontext">' +
                                              '</i>' +
                                              data.share_num +
                                            '</span>' +
                                        '</div>' +
                                    '</c>' +
                                '</div>' +
                                delete_icon_html +
                            '</div>' +
                    '</div>';
    
    }
    
    function create_chessboard( data , bootstrap_class , css , rank_num ) {
                    
                    if( rank_num && rank_num <= 3 )
                        var rank_html = '<div style="border-color: #ff0000 transparent transparent;" class="triangle">' +
                                            '<p>' + rank_num + '</p>' +
                                        '</div>';
                    else if ( rank_num && rank_num >= 3 )
                        var rank_html = '<div style="border-color: gray transparent transparent;" class="triangle">' +
                                            '<p>' + rank_num + '</p>' +
                                        '</div>';
                    else
                        var rank_html = "";
                    
                    /*if( data.special_icon_path === "" )
                        var specialtag = '';
                    else
                        var specialtag = '<img width="42px" height="42px" src="' + data.special_icon_path + '" style="position:absolute; right:-7px; top:-7px;" onclick="location.href=\'search_results.php?specialtag=' + data.specialtag_id + '\'">';*/
        
                    if( parseInt( data.share_num ) > 100000 )
                        var specialtag = '<img width="42px" height="42px" src="images/100k.png" style="position:absolute; right:-7px; top:-7px;" onclick="location.href=\'search_results.php?specialtag=100\'">';
                    else if( parseInt( data.share_num ) > 50000 )
                        var specialtag = '<img width="42px" height="42px" src="images/50k.png" style="position:absolute; right:-7px; top:-7px;" onclick="location.href=\'search_results.php?specialtag=50\'">';
                    else if( parseInt( data.share_num ) > 20000 )
                        var specialtag = '<img width="42px" height="42px" src="images/20k.png" style="position:absolute; right:-7px; top:-7px;" onclick="location.href=\'search_results.php?specialtag=20\'">';
                    else if( parseInt( data.share_num ) > 10000 )
                        var specialtag = '<img width="42px" height="42px" src="images/10k.png" style="position:absolute; right:-7px; top:-7px;" onclick="location.href=\'search_results.php?specialtag=1\'">';
                    else
                        var specialtag = '';
                    
                    var title = getStrLength(data.title) <= 65 ? data.title : getInterceptedStr( data.title , 62 ) + "...";
                    
                    return '<div class="' + bootstrap_class + ' cover-text1" style="margin: 0px; ' + css + '">' +
                            '<div style="padding: 0px;margin: 0" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">' +
                                '<div name="responsive_div_level1">' +
                                    '<a href="page-inner.php?page_id=' + data.page_id + '" class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding: 0;" name="responsive_div">' +
                                        '<div style="background-image: url(' + data.article_icon + '); " class="chessboard-bgcenter">' +
                                            rank_html +
                                            //'<div class="cover-black-small_"></div>' +
                                            /*'<div style="color: white; position: absolute; left: 11px; bottom: 6px; text-shadow: 1px 2px 1px black;" class="index-smallbox">' +
                                                '<i class="ace-icon fa fa-eye panel-icon"></i>' + data.num_click +
                                                '<i class="ace-icon fa fa-share panel-icon" style="margin-left: 5px"></i>' + data.share_num +
                                            '</div>' +*/
                                        '</div>' +
                                    '</a>' +
                                    specialtag +
                                '</div>' +
                                /*'<div class="pos-rel page-btn-share-tem">' +
                                    //'<div class="progress-bar progress-bar-warning page-btn-share-tem-progress" style="width:' + data.process_per + '%"></div>' +
                                '</div>' +*/
                                '<p class="chessboard-title"><a href="page-inner.php?page_id=' + data.page_id + '" title="' + data.title + '">' + title + '</a></p>' +
                            '</div>' +
                        '</div>';
    
                /*return '<div style="margin: 0px; padding: 0 20px 10px;" class="' + bootstrap_class + '">' +
                        '<div id="List_article_icon" page="' + data.page_id + '" class="bg_top pagebg" style="position:relative; width: 100%; cursor: pointer; background-image: url(' + data.article_icon + '); height: 205px;">' +
                            '<div class="cover-black"></div>' +
                            '<div style="position: absolute; color: white; left: 5%; bottom: 4%; text-shadow: 1px 2px 1px black;">' +
                                  '<i class="ace-icon fa fa-eye panel-icon"></i>' + data.num_click +
                                  '<i style="margin-left: 5px" class="ace-icon fa fa-share panel-icon"></i>' + data.share_num +
                            '</div>' +
                        '</div>' +
                        '<div style="" class="pos-rel page-btn-share-tem">' +
                            '<div class="progress-bar progress-bar-warning page-btn-share-tem-progress" style="width:' + data.process_per + '%"></div>' +
                        '</div>' +
                        '<p page="' + data.page_id + '" style="cursor:pointer; color: gray; font-size: 20px; line-height: 26px; height: 50px; overflow: hidden; margin: 5px 0px;" class="pagebg">' +
                            data.title +
                        '</p>' +
                    '</div>';*/
    
    }
    
    function create_manager( data , bootstrap_class ) 
    {
                    if( data.display != "none" )
                    {
                                var display_html = '<button class="btn btn-xs btn-danger red-button" page="' + data.page_id + '" id="page_display" display="上架中">上架中</button>';
                    }else{
                                var display_html = '<button class="btn btn-xs btn-danger green-button" page="' + data.page_id + '" id="page_display" display="下架中">下架中</button>';
                    }
                    
                    
                    
                
                    return '<hr>' + 
                            '<label class="pos-rel" style="float: left; margin-left: 40px; margin-top: 40px;">' + 
                            '        <input type="checkbox" class="ace">' + 
                            '        <span class="lbl"></span>' + 
                            '</label>' + 
                            '<div class="' + bootstrap_class + ' cover-text1" style="padding-right: 0px; padding-left: 35px;">' + 
                            '        <div style="padding: 0px;margin: 0" class="col-xs-6 col-sm-6 col-md-3 col-lg-3">' +
                            '                <a href="page-inner.php?page_id=' + data.page_id + '">' +
                            '                    <div id="list_article_icon" class="bg_top" style="cursor: pointer; background-image: url(' + data.article_icon + '); width: 105%; height: 105px;"></div>' + 
                            '                </a>' +
                            '        </div>' + 
                            '        <div class="col-xs-6 col-sm-6 col-md-9 col-lg-9" style="padding: 0px; margin: 0px;">' + 
                            '                <a href="page-inner.php?page_id=' + data.page_id + '"><p class="title" page="' + data.page_id + '">' + data.title + '</p></a>' + 
                            '                <br>' + 
                            '                <div class="description">' + 
                            '                        <i class="ace-icon fa fa-tag panel-icon fa-flip-horizontal"></i>' + 
                            '                        <span>影片</span>' + 
                            '                        <i class="ace-icon glyphicon glyphicon-time"></i>' + 
                            '                        <span id="List_date">' + data.date + '</span>' + 
                            '                        <i class="ace-icon fa fa-eye panel-icon"></i>' + 
                            '                        <span>' + data.num_click + '</span>' + 
                            '                        <i class="ace-icon fa fa-share panel-icon"></i>' + 
                            '                        <span>' + data.share_num + '</span>' + 
                            '                </div>' + 
                            '        </div>' + 
                            '</div>' + 
                            '<div class="col-xs-4 col-sm-4 col-md-4 col-lg-2 new-btn-group">' + 
                            '        <div class="hidden-xs">' + 
                                            display_html +
                            '                <button id="page_chart" page="' + data.page_id + '" class="btn btn-xs btn-info blue-button">' + 
                            '                        <i class="ace-icon fa fa-line-chart bigger-120"></i>' + 
                            '                </button>' + 
                            '                <button id="page_modity" page="' + data.page_id + '" class="btn btn-xs btn-info blue-button">' + 
                            '                        <i class="ace-icon fa fa-pencil bigger-120"></i>' + 
                            '                </button>' + 
                            '                <button id="page_delete" page="' + data.page_id + '" class="btn btn-xs btn-info blue-button">' + 
                            '                        <i class="ace-icon fa fa-trash-o bigger-120"></i>' + 
                            '                </button>' + 
                            '        </div>' + 
                            '</div>' + 
                            '<div class="clearfix"></div>' ;
                
                
    }
    
    function getInterceptedStr(sSource, iLen)
    {
        if(sSource.replace(/[^\x00-\xff]/g,"xx").length <= iLen)
        {
                return sSource;
        }

        var str = "";
        var l = 0;
        var schar;
        for(var i=0; schar=sSource.charAt(i); i++)
        {
                str += schar;
                l += (schar.match(/[^\x00-\xff]/) != null ? 2 : 1);
                if(l >= iLen)
                {
                    break;
                }
        }

        return str;
    }
    
    function getStrLength( str ) {
        
        return str.replace(/[^\x00-\xff]/g,"xx").length;
        
    }
        
    function collect_subscribe_event() {

        $( ".collect" ).unbind( "click" ).bind( "click", function(e) {

                    if( getCookie("ttshow") )
                    {
                            if( $( this ).hasClass( "already" ) )
                            {
                                    var tmp_location = $( this );
                                    var page_id = $( this ).attr("article");

                                    $.ajax({
                                                type: "POST",
                                                url: "php/collect.php?func=action",
                                                data: {
                                                            email    : $.member.email ,
                                                            page_id   : page_id ,
                                                            collect   : "cancel"
                                                },
                                                //dataType: "json",
                                                success: function(data) {

                                                        if( data === "already" )
                                                        {
                                                            $( ".collect[article=" + page_id + "]" ).addClass("already");
                                                            $( ".collect[article=" + page_id + "]" ).html('<i class="ace-icon fa fa-lg"><span style="margin-left: 7px">已收藏</span></i>');
                                                        }
                                                        else if( data === "yet" )
                                                        {
                                                            $( ".collect[article=" + page_id + "]" ).removeClass("already");
                                                            $( ".collect[article=" + page_id + "]" ).html('<i class="ace-icon fa fa-heart fa-lg"><span style="margin-left: 7px">收藏</span></i>');
                                                        }

                                                }
                                    });
                            }
                            else
                            {
                                    var tmp_location = $( this );
                                    var page_id = $( this ).attr("article");
                                    console.log( page_id );

                                    $.ajax({
                                                type: "POST",
                                                url: "php/collect.php?func=action",
                                                data: {
                                                            email    : $.member.email ,
                                                            page_id   : page_id ,
                                                            collect   : "collect"
                                                },
                                                //dataType: "json",
                                                success: function(data) {

                                                        if( data === "already" )
                                                        {
                                                            $( ".collect[article=" + page_id + "]" ).addClass("already");
                                                            $( ".collect[article=" + page_id + "]" ).html('<i class="ace-icon fa fa-lg"><span style="margin-left: 7px">已收藏</span></i>');
                                                        }
                                                        else if( data === "yet" )
                                                        {
                                                            $( ".collect[article=" + page_id + "]" ).removeClass("already");
                                                            $( ".collect[article=" + page_id + "]" ).html('<i class="ace-icon fa fa-heart fa-lg"><span style="margin-left: 7px">收藏</span></i>');
                                                        }
                                                }
                                    });
                            }
                    
                    }
                    else
                    {
                            Login_Popup_show();
                    }
        });

        $( ".subscribe" ).unbind( "click" ).bind( "click", function(e) {
                    
                    if( getCookie("ttshow") )
                    {
                            if( $( this ).hasClass( "already" ) )
                            {
                                    console.log( "already" );
                                    var tmp_location = $( this );
                                    var channel_id = $( this ).attr("channel");

                                    $.ajax({
                                                type: "POST",
                                                url: "php/subscribe.php",
                                                data: {
                                                            email    : $.member.email ,
                                                            user_id   : channel_id ,
                                                            subscribe : "cancel"
                                                },
                                                //dataType: "json",
                                                success: function(data) {

                                                        if( data === "already" )
                                                        {
                                                            $( "[channel=" + channel_id + "].subscribe" ).addClass("already");
                                                            $( "[channel=" + channel_id + "].subscribe" ).html("已訂閱");
                                                        }
                                                        else if( data === "yet" )
                                                        {
                                                            $( "[channel=" + channel_id + "].subscribe" ).removeClass("already");
                                                            $( "[channel=" + channel_id + "].subscribe" ).html("訂閱");
                                                        }

                                                }
                                    });
                            }
                            else
                            {
                                    console.log( "yet" );
                                    var tmp_location = $( this );
                                    var channel_id = $( this ).attr("channel");
                                    $.ajax({
                                                type: "POST",
                                                url: "php/subscribe.php",
                                                data: {
                                                            email    : $.member.email ,
                                                            user_id   : channel_id ,
                                                            subscribe : "subscribe"
                                                },
                                                //dataType: "json",
                                                success: function(data) {

                                                        if( data === "already" )
                                                        {
                                                            $( "[channel=" + channel_id + "].subscribe" ).addClass("already");
                                                            $( "[channel=" + channel_id + "].subscribe" ).html("已訂閱");
                                                        }
                                                        else if( data === "yet" )
                                                        {
                                                            $( "[channel=" + channel_id + "].subscribe" ).removeClass("already");
                                                            $( "[channel=" + channel_id + "].subscribe" ).html("訂閱");
                                                        }

                                                }
                                    });
                            }
                    }
                    else
                    {
                            Login_Popup_show();
                    }
        });

    }
    
    function create_breaking_news( data ) {
            
            var title = getStrLength(data.title) <= 55 ? data.title : getInterceptedStr( data.title , 52 ) + "...";
            var channel_name = getStrLength(data.channel_name) <= 24 ? data.channel_name : getInterceptedStr( data.channel_name , 21 ) + "...";
            
            if( data.channel_icon == "" )
            {
                    data.channel_icon = "images/profileimg.png" ;
            }
            
            return '<div class="list">' +
                '<div class="list-author">' +
                    '<div class="photo">' +
                        //'<img src="' + data.channel_icon + '">' +
                        '<div class="bg_img" style="background-image:url(\'' + data.channel_icon + '\')"></div>' +
                    '</div>' +
                    '<div class="list-info">' +
                        '<div class="author-name" author_id="' + data.channel_id + '">' + data.channel_name + '</div>' +
                        '<div class="date">' +
                            '<img src="template_new/images/breaking_news/time.png">' +
                            '<span>' + data.date + '</span>' +
                        '</div>' +
                    '</div>' +
                '</div>' +
                '<a href="inner.php?page_id=' + data.page_id + '">' +
                    '<div name="responsive_div">' +
                        '<div style="background-image: url(\'' + data.article_icon + '\'); "></div>' +
                    '</div>' +
                '</a>' +
                '<div class="info">' +
                    '<h1 class="list-title">' +
                            '<a href="inner.php?page_id=' + data.page_id + '" title="' + data.title + '">' + data.title + '</a>' +
                    '</h1>' +
                    '<h3>' +
                            '<a href="inner.php?page_id=' + data.page_id + '" title="' + data.title + '">' + data.title + '</a>' +
                    '</h3>' +
                '</div>' +
                '<p class="view">' +
                    '<img src="template_new/images/inner/view.png">' +
                    '<span>' + data.num_click + '</span>' +
                '</p>' +
                '<p class="share">分享：' + data.share_num + '</p>' +
            '</div>';
            
            
    }
    
    function create_upright_new( data , width , row , fontsize ) {
            
            console.log( data );
            width = width || 200;
            row = row || 2;
            fontsize = fontsize || 15;
            var length = parseInt( ( width/fontsize*row - 2 )*3 );
            
            var title = getStrLength(data.title) <= length ? data.title : getInterceptedStr( data.title , length-3 ) + "...";
            var channel_name = getStrLength(data.channel_name) <= 24 ? data.channel_name : getInterceptedStr( data.channel_name , 21 ) + "...";
            
            if( parseInt( data.share_num ) >= 100000 )
                var specialtag = '<a><img src="images/100k.png"></a>' ;
            else if( parseInt( data.share_num ) >= 50000 )
                var specialtag = '<img src="images/50k.png">' ;
            else if( parseInt( data.share_num ) >= 20000 )
                var specialtag = '<img src="images/20k.png">' ;
            else if( parseInt( data.share_num ) >= 10000 )
                var specialtag = '<img src="images/10k.png">' ;
            else
                var specialtag = '' ;
            
            return '<div class="list">' +
                    '<div class="list-author">' +
                            '<div class="photo">' +
                                '<div class="bg_img" style="background-image:url(\'' + data.channel_icon + '\')"></div>' +
                            '</div>' +
                            '<div class="list-info">' +
                                    '<div class="author-name">' + data.channel_name + '</div>' +
                                    '<div class="date">' +
                                            '<img src="template_new/images/breaking_news/time.png">' +
                                            '<span>' + data.date + '</span>' +
                                    '</div>' +
                            '</div>' +
                    '</div>' +
                    '<a href="inner.php?page_id=' + data.page_id + '">' +
                            '<div name="responsive_div">' +
                                    '<div style="background-image: url(\'' + data.article_icon + '\')"></div>' +
                            '</div>' +
                    '</a>' +
                    '<div class="info">' +
                            '<h1 class="list-title">' +
                                    '<a href="inner.php?page_id=' + data.page_id + '" title="' + data.title + '">' + title + '</a>' +
                            '</h1>' +
                    '</div>' +
                    '<p class="view">' +
                            '<img src="template_new/images/inner/view.png">' +
                            '<span>' + data.num_click + '</span>' +
                    '</p>' +
                    '<p class="share">' +
                            '<img src="template_new/images/inner/share.png">' +
                            '<span>' + data.share_num + '</span>' +
                    '</p>' +
            '</div>';
            
    }
    
    function create_chessboard_hot( data , click_num , width , row , fontsize ) {
                    
                    width = width || 200;
                    row = row || 2;
                    fontsize = fontsize || 15;
                    var length = parseInt( ( width/fontsize*2 - 2 )*row );
                    
                    console.log( width + " " + length );
                    
                    click_num = click_num || "true";
                    if( click_num === "true" )
                        var view = '                <p class="view">' +
                                    '                        <img src="template_new/images/inner/view.png">' +
                                    '                        <span>' + data.num_click + '</span>' +
                                    '                </p>';
                    else if( click_num === "false" )
                        var view = "" ;
        
                    if( parseInt( data.share_num ) > 100000 )
                        var specialtag = '<img src="images/100k.png" onclick="location.href=\'specialtag.php?specialtag=1\'">' ;
                    else if( parseInt( data.share_num ) > 50000 )
                        var specialtag = '<img src="images/50k.png" onclick="location.href=\'specialtag.php?specialtag=1\'">' ;
                    else if( parseInt( data.share_num ) > 20000 )
                        var specialtag = '<img src="images/20k.png" onclick="location.href=\'specialtag.php?specialtag=1\'">' ;
                    else if( parseInt( data.share_num ) > 10000 )
                        var specialtag = '<img src="images/10k.png" onclick="location.href=\'specialtag.php?specialtag=1\'">' ;
                    else
                        var specialtag = '' ;
                    
                    var title = getStrLength(data.title) <= length ? data.title : getInterceptedStr( data.title , length-3 ) + "...";
                    
                    return      '<div class="list">' +
                                '        <a href="inner.php?page_id=' + data.page_id + '" >' +
                                                '<div name="responsive_div">' +
                                                        '<div style="background-image: url(\'' + data.article_icon + '\'); "></div>' +
                                                '</div>' +
                                '                <div class="info">' +
                                '                        <h3 title="' + data.title + '">' + title + '</h3>' +
                                                        view +
                                '                </div>' +
                                '                <div class="list-icon">' +
                                                        specialtag +
                                '                </div>' +
                                '        </a>' +
                                '</div>' ;
                
    
    }
    
    
    function getInterceptedStr(sSource, iLen)
    {
        if(sSource.replace(/[^\x00-\xff]/g,"xx").length <= iLen)
        {
                return sSource;
        }

        var str = "";
        var l = 0;
        var schar;
        for( var i=0; schar=sSource.charAt(i); i++ )
        {
                str += schar;
                l += (schar.match(/[^\x00-\xff]/) != null ? 2 : 1);
                if(l >= iLen)
                {
                    break;
                }
        }

        return str;
    }
        
    function collect_subscribe_event_1() {
        $( ".love" ).unbind( "click" ).bind( "click", function(e) {

                    if( getCookie("ttshow") )
                    {
                            if( $( this ).hasClass( "already" ) )
                            {
                                    var tmp_location = $( this );
                                    var page_id = $( this ).attr("article");
                                    
                                    $.ajax({
                                                type: "POST",
                                                url: "php/collect.php?func=action",
                                                data: {
                                                            email    : $.member.email ,
                                                            page_id   : page_id ,
                                                            collect   : "cancel"
                                                },
                                                //dataType: "json",
                                                success: function(data) {

                                                        if( data === "already" )
                                                        {
                                                            $( ".love[article=" + page_id + "]" ).addClass("already");
                                                            $( ".love[article=" + page_id + "] span" ).html('已收藏');
                                                        }
                                                        else if( data === "yet" )
                                                        {
                                                            $( ".love[article=" + page_id + "]" ).removeClass("already");
                                                            $( ".love[article=" + page_id + "] span" ).html('收藏');
                                                        }

                                                }
                                    });
                            }
                            else
                            {
                                    var tmp_location = $( this );
                                    var page_id = $( this ).attr("article");
                                    console.log( page_id );

                                    $.ajax({
                                                type: "POST",
                                                url: "php/collect.php?func=action",
                                                data: {
                                                            email    : $.member.email ,
                                                            page_id   : page_id ,
                                                            collect   : "collect"
                                                },
                                                //dataType: "json",
                                                success: function(data) {

                                                        if( data === "already" )
                                                        {
                                                            $( ".love[article=" + page_id + "]" ).addClass("already");
                                                            $( ".love[article=" + page_id + "] span" ).html('已收藏');
                                                        }
                                                        else if( data === "yet" )
                                                        {
                                                            $( ".love[article=" + page_id + "]" ).removeClass("already");
                                                            $( ".love[article=" + page_id + "] span" ).html('收藏');
                                                        }
                                                }
                                    });
                            }
                    
                    }
                    else
                    {
                            if( typeof Login_Popup_show != "undefined" )
                                    Login_Popup_show();
                    }
        });

        $( ".subscribe" ).unbind( "click" ).bind( "click", function(e) {
                    
                    if( getCookie("ttshow") )
                    {
                            if( $( this ).hasClass( "already" ) )
                            {
                                    console.log( "already" );
                                    var tmp_location = $( this );
                                    var channel_id = $( this ).attr("channel");

                                    $.ajax({
                                                type: "POST",
                                                url: "php/subscribe.php",
                                                data: {
                                                            email    : $.member.email ,
                                                            user_id   : channel_id ,
                                                            subscribe : "cancel"
                                                },
                                                //dataType: "json",
                                                success: function(data) {

                                                        if( data === "already" )
                                                        {
                                                            $( "[channel=" + channel_id + "].subscribe" ).addClass("already");
                                                            $( "[channel=" + channel_id + "].subscribe" ).html("撌脰���");
                                                        }
                                                        else if( data === "yet" )
                                                        {
                                                            $( "[channel=" + channel_id + "].subscribe" ).removeClass("already");
                                                            $( "[channel=" + channel_id + "].subscribe" ).html("閮彑啉");
                                                        }

                                                }
                                    });
                            }
                            else
                            {
                                    console.log( "yet" );
                                    var tmp_location = $( this );
                                    var channel_id = $( this ).attr("channel");
                                    $.ajax({
                                                type: "POST",
                                                url: "php/subscribe.php",
                                                data: {
                                                            email    : $.member.email ,
                                                            user_id   : channel_id ,
                                                            subscribe : "subscribe"
                                                },
                                                //dataType: "json",
                                                success: function(data) {

                                                        if( data === "already" )
                                                        {
                                                            $( "[channel=" + channel_id + "].subscribe" ).addClass("already");
                                                            $( "[channel=" + channel_id + "].subscribe" ).html("撌脰���");
                                                        }
                                                        else if( data === "yet" )
                                                        {
                                                            $( "[channel=" + channel_id + "].subscribe" ).removeClass("already");
                                                            $( "[channel=" + channel_id + "].subscribe" ).html("閮彑啉");
                                                        }

                                                }
                                    });
                            }
                    }
                    else
                    {
                            Login_Popup_show();
                    }
        });

    }
    
    function getStrLength( str ) {
        
        return str.replace(/[^\x00-\xff]/g,"xx").length;
        
    }
    
    function getParameterByName(name) {
        name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
        var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
            results = regex.exec(location.search);
        return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
    }
                        
    function active_event( pos ) {

            pos.parent().children( "._active" ).removeClass( "_active" );
            pos.addClass( "_active" );

    }
    
    if( location.host === "ttshow.tw" )
    window.console.log = function() {
        return false;
    }
    
    function ios_statusbar() {
        //alert("123");
    }