(function($) {
            $.view_sidebar = $.view_sidebar || {version:'0.0.1'};
            var view_sidebar = function(dom,opts) { //[--plugin define
                    var me=$(dom);
                    
                    $.extend(this, {
                                init_sidebar_from_id: function() {
                                        init_sidebar_from_id();
                                },
                                init_sidebar: function() {
                                        init_sidebar();
                                },
                                init_bind: function() {
                                        //init_bind_image();
                                        init_bind_TTShow_image();
                                },
                                options: function() {
                                        return opts;
                                },
                                _SetOpts: function( options ) {
                                        $.extend(opts,options);
                                }
                    });
                    /*
                                $.View.view_sidebar()._SetOpts({ id : "1" });
                                $.View.view_sidebar().init_sidebar_from_id();
                    */
                   
                    function init_sidebar_from_id()
                    {
                                var tmp_focus = $( ".sidebar-nav[layer_id=" + opts.id.toString() + "]" ) ;
                                
                                if( tmp_focus.length != 0 )
                                {
                                            if( tmp_focus.attr( "hasload" ) != "1" )
                                            {

                                                        tmp_focus.attr( "hasload" , "1" )
                                                        opts.focus_sidebar = tmp_focus.attr( "layer_html" );
                                                        
                                                        if( opts.focus_sidebar == "template" )
                                                        {
                                                                    init_sidebar_template();
                                                        }else{
                                                                    init_sidebar();
                                                        }

                                            }
                                }
                    }
                   
                   
                    function init_sidebar_template()
                    {
                                $.ajaxq (   "init_sidebar" ,{
                                            url         : 'backend/sidebar/' + opts.focus_sidebar + '.php' ,
                                            type        : 'post' ,
                                            layer_html  : opts.focus_sidebar ,
                                            success      : function(data) {
                                                        console.log( data );
                                                        var tmp_focus = $( ".sidebar-nav[layer_html=" + this.layer_html + "]" );
                                                        tmp_focus.append( data );
                                                        
                                                        $.View.motion_system_language().fnchangelang();
                                                        
                                            }
                                });
                                        
                                $.ajaxq (   "init_sidebar" ,{
                                            url         : "backend/jsk/TemplateBuy.JSK?func=ListTemplate" ,
                                            type        : 'post' ,
                                            success      : function(data) {
                                                        console.log( data );
                                                        var tmp_data = eval( '[' + data + ']' )[0] ;
                                                        
                                                        if( tmp_data.status == "false" )
                                                        {

                                                                    opts.tmp_layer_html = "template" ;
                                                                    bind_left_right();
                                                        }
                                                        else
                                                        {
                                                                    console.log( eval( tmp_data.list ) );
                                                                    $.each( eval( tmp_data.list ), function(index, value) {
                                                                                console.log( value );
                                                                                var tmp_value = value ;

                                                                                $.ajax({  

                                                                                            type    : "POST",  
                                                                                            url     : "backend/jsk/TemplateBuy.JSK?func=GetTemplate" ,  
                                                                                            data     : 
                                                                                            {
                                                                                                        projectname    : tmp_value  
                                                                                            },
                                                                                            success: function(data) {
                                                                                                        console.log( data );
                                                                                                        $( "#TemplateBox" ).append( data );

                                                                                                        var tmp_focus = $( ".sidebar-nav[layer_html=" + "template" + "]" ) ;

                                                                                                        opts.tmp_layer_html = "template" ;
                                                                                                        bind_left_right();

                                                                                                        tmp_focus.find( ".lyrow" ).draggable({
                                                                                                                    connectToSortable: ".demo",
                                                                                                                    helper: "clone",
                                                                                                                    handle: ".drag",
                                                                                                                    start: function(e,t) {
                                                                                                                                if (!startdrag) stopsave++;
                                                                                                                                startdrag = 1;
                                                                                                                    },
                                                                                                                    drag: function(e, t) {
                                                                                                                                t.helper.width(400);
                                                                                                                    },
                                                                                                                    stop: function(e, t) {
                                                                                                                                $(".demo .column").sortable({
                                                                                                                                            opacity: .35,
                                                                                                                                            connectWith: ".column",
                                                                                                                                            start: function(e,t) {
                                                                                                                                                    if (!startdrag) stopsave++;
                                                                                                                                                    startdrag = 1;
                                                                                                                                            },
                                                                                                                                            stop: function(e,t) {
                                                                                                                                                    if(stopsave>0) stopsave--;
                                                                                                                                                    startdrag = 0;
                                                                                                                                            }
                                                                                                                                });
                                                                                                                                if(stopsave>0) stopsave--;
                                                                                                                                startdrag = 0;
                                                                                                                    }
                                                                                                        });

                                                                                                        tmp_focus.find( ".box" ).draggable({
                                                                                                                    connectToSortable: ".column",
                                                                                                                    helper: "clone",
                                                                                                                    handle: ".drag",
                                                                                                                    start: function(e,t) {
                                                                                                                                        if (!startdrag) stopsave++;
                                                                                                                                        startdrag = 1;
                                                                                                                    },
                                                                                                                    drag: function(e, t) {
                                                                                                                                        t.helper.width(400)
                                                                                                                    },
                                                                                                                    stop: function(e, t) {

                                                                                                                                        console.log( this );

                                                                                                                                        opts.this = this ;
                                                                                                                                        init_sidebar_1();

                                                                                                                                        handleJsIds();

                                                                                                                                        if( stopsave > 0 ) stopsave--;
                                                                                                                                        startdrag = 0;
                                                                                                                    }
                                                                                                        });
                                                                                            }
                                                                                });

                                                                    });

                                                        }
                                            }
                                });

                    }
                   
                    function bind_left_right()
                    {
                                var tmp_focus = $( ".sidebar-nav[layer_html=" + opts.tmp_layer_html + "]" ) ;

                                $(".nav-header").unbind('click').bind( 'click' , function() {

                                                    if( $(this).attr( "slideDown-status" ) == undefined || $(this).attr( "slideDown-status" ) == "0" )
                                                    {
                                                                $( ".nav-header" ).attr( "slideDown-status" , "0" );
                                                                $(this).attr( "slideDown-status" , "1" );

                                                                $(".sidebar-nav .boxes, .sidebar-nav .rows").hide();
                                                                $(this).next().slideDown();
                                                    }else{
                                                                $(this).attr( "slideDown-status" , "0" );
                                                                $(".sidebar-nav .boxes, .sidebar-nav .rows").hide();
                                                    }

                                });



                                tmp_focus.find( ".icon-prev" ).parent().unbind('mousedown').bind( 'mousedown' , function() {

                                            //console.log( $( this ).parent().parent().parent().parent().parent().attr( "layer_id" ) );
                                            var tmp_focus = $( this ).parent().parent().parent().parent() ;

                                            var tmp_num = parseInt(tmp_focus.attr( "layer_id" ) ) - 1 ;

                                            tmp_focus.hide();

                                            var tmp_next_focus = $( ".sidebar-nav[layer_id=" + tmp_num.toString() + "]" ) ;
                                            if( tmp_next_focus.length != 0 )
                                            {
                                                        tmp_next_focus.show();
                                                        console.log( tmp_next_focus );

                                                        $.View.view_sidebar()._SetOpts({ id : tmp_num });
                                                        $.View.view_sidebar().init_sidebar_from_id();
                                            }else{
                                                        var tmp_next_focus = $( ".sidebar-nav[layer_id=" + $( ".sidebar-nav" ).length.toString() + "]" ) ;
                                                        tmp_next_focus.show();
                                                        console.log( tmp_next_focus );

                                                        $.View.view_sidebar()._SetOpts({ id : $( ".sidebar-nav" ).length.toString() });
                                                        $.View.view_sidebar().init_sidebar_from_id();
                                            }
                                });

                                tmp_focus.find( ".icon-next" ).parent().unbind('mousedown').bind( 'mousedown' , function() {

                                            //console.log( $( this ).parent().parent().parent().parent().attr( "layer_id" ) );
                                            var tmp_focus = $( this ).parent().parent().parent().parent() ;

                                            var tmp_num = parseInt(tmp_focus.attr( "layer_id" ) ) + 1 ;

                                            tmp_focus.hide();
                                            var tmp_next_focus = $( ".sidebar-nav[layer_id=" + tmp_num.toString() + "]" ) ;
                                            if( tmp_next_focus.length != 0 )
                                            {
                                                        tmp_next_focus.show();
                                                        console.log( tmp_next_focus );

                                                        $.View.view_sidebar()._SetOpts({ id : tmp_num });
                                                        $.View.view_sidebar().init_sidebar_from_id();

                                            }else{
                                                        var tmp_next_focus = $( ".sidebar-nav[layer_id=" + "1" + "]" ) ;
                                                        tmp_next_focus.show();
                                                        console.log( tmp_next_focus );

                                                        $.View.view_sidebar()._SetOpts({ id : "1" });
                                                        $.View.view_sidebar().init_sidebar_from_id();
                                            }
                                });

                                tmp_focus.find( ".icon-next" ).parent().prev().unbind('mousedown').bind( 'mousedown' , function() {

                                            //console.log( $( this ).parent().parent().parent().parent().parent().attr( "layer_id" ) );
                                            var tmp_focus = $( this ).parent().parent().parent().parent() ;

                                            var tmp_num = parseInt(tmp_focus.attr( "layer_id" ) ) + 1 ;

                                            tmp_focus.hide();
                                            var tmp_next_focus = $( ".sidebar-nav[layer_id=" + tmp_num.toString() + "]" ) ;
                                            if( tmp_next_focus.length != 0 )
                                            {
                                                        tmp_next_focus.show();
                                                        console.log( tmp_next_focus );

                                                        $.View.view_sidebar()._SetOpts({ id : tmp_num });
                                                        $.View.view_sidebar().init_sidebar_from_id();

                                            }else{
                                                        var tmp_next_focus = $( ".sidebar-nav[layer_id=" + "1" + "]" ) ;
                                                        tmp_next_focus.show();
                                                        console.log( tmp_next_focus );

                                                        $.View.view_sidebar()._SetOpts({ id : "1" });
                                                        $.View.view_sidebar().init_sidebar_from_id();
                                            }
                                });
                    }
                   
                   
                    function init_sidebar_1()
                    {
                                if( $( opts.this ).attr( "id" ) == "fb_movie" )
                                {
                                            //window.fbAsyncInit();
                                }                            
                                else if( $( opts.this ).attr( "id" ) == "pie" )
                                {
                                            if( $( ".demo #pie_localhost" ).length == 1 )
                                            {
                                                        $.View.view_pie().init();
                                            }
                                }
                                else if( $( opts.this ).attr( "id" ) == "column" )
                                {
                                            if( $( ".demo #column_localhost" ).length == 1 )
                                            {
                                                        $.View.view_column().init();
                                            }
                                }
                                else if( $( opts.this ).attr( "id" ) == "line" )
                                {
                                            if( $( ".demo #line_localhost" ).length == 1 )
                                            {
                                                        $.View.view_line().init();
                                            }
                                }
                                else if( $( opts.this ).attr( "id" ) == "timeline" )
                                {
                                            if( $( ".demo #timeline_localhost" ).length == 1 )
                                            {
                                                        $.View.view_timeline_h().init();
                                            }
                                }
                                else if( $( opts.this ).attr( "id" ) == "map" )
                                {
                                            if( $( ".demo #map_localhost" ).length == 1 )
                                            {
                                                        $.View.view_google_map().init();
                                            }
                                }
                                //bohan getout
                                /*else if( $( opts.this ).attr( "id" ) == "slides" )
                                {
                                            if( $( ".demo #slides_localhost" ).length == 1 )
                                            {
                                                        $.View.view_slides().init();
                                            }

                                }*/
                                /*  2014.6.3 abin ++  */
                                /*
                                else if( $( opts.this ).attr( "id" ) == "description" )
                                {
                                            $.View.view_description().init();
                                }
                                else if( $( opts.this ).attr( "id" ) == "description_2" )
                                {
                                            $.View.view_description().init_2();
                                }
                                else if( $( opts.this ).attr( "id" ) == "title" )
                                {
                                            $.View.view_description().init_title();
                                }
                                else if( $( opts.this ).attr( "id" ) == "title_2" )
                                {
                                            $.View.view_description().init_title_2();
                                }
                                
                                
                                
                                else if( $( opts.this ).attr( "id" ) == "image" )
                                {
                                            $.View.view_image().init();

                                } 
                                //  20140609HAO --

                                else if( $( opts.this ).attr( "id" ) == "image_text_H" )
                                {
                                                        $.View.view_image_text_H().init();
                                }
                                else if( $( opts.this ).attr( "id" ) == "image_text_V" )
                                {
                                                        $.View.view_image_text_V().init();
                                }
                                else if( $( opts.this ).attr( "id" ) == "image_slider" )
                                {
                                                        $.View.view_image_slider().init();
                                }
                                else if( $( opts.this ).attr( "id" ) == "image_slider_tv" )
                                {
                                                        $.View.view_image_slider_tv().init();
                                }
                                else if( $( opts.this ).attr( "id" ) == "thumbnails" )
                                {
                                                        $.View.view_thumbnails().init();
                                }
                                else if( $( opts.this ).attr( "id" ) == "video" )
                                {
                                        $.View.view_video_audio().init_video();
                                            //$( ".demo #video_localhost_1" ).attr( "src" , "http://cdn.ypcall.com/Builder/PD/video/video01.mp4" );
                                }
                                else if( $( opts.this ).attr( "id" ) == "audio" )
                                {
                                        $.View.view_video_audio().init_audio();
                                            //$( ".demo #video_localhost_1" ).attr( "src" , "http://cdn.ypcall.com/Builder/PD/video/video01.mp4" );
                                }
                                else if( $( opts.this ).attr( "id" ) === "DrinkFormButton" )
                                {
                                        $.View.view_Drinkform().Drinkform_button_init();
                                }
                                else if( $( opts.this ).attr( "id" ) === "DrinkForm_localhost_" )
                                {
                                        $.View.view_Drinkform().Drinkform_init();
                                }
                                */
                                /*  2014.6.3 abin --  */
                                else if( $( opts.this ).attr( "id" ) == "kline" )
                                {
                                            if( $( ".demo #kline_localhost" ).length == 1 )
                                            {
                                                        $.View.view_kline().init();
                                            }

                                }
                                else if( $( opts.this ).attr( "id" ) == "nestable" )
                                {
                                            if( $( ".demo #nestable_localhost" ).length == 1 )
                                            {           
                                                        $.View.view_nestable().init();
                                            }

                                }
                                //bohan++ 20140331
                                else if( $( opts.this ).attr( "id" ) == "parallax" )
                                {
                                            if( $( ".demo #parallax_localhost" ).length == 1 )
                                            {           
                                                        $.View.view_parallax().init();
                                            }

                                }
                                else if( $( opts.this ).attr( "id" ) === "timeliner" )
                                {
                                            if( $( ".demo #timeliner_localhost" ).length === 1 )
                                            {
                                                        $.View.view_timeline_v().init();
                                            }
                                }
                                else if( $( opts.this ).attr( "id" ) === "table" )
                                {
                                            if( $( ".demo #table_localhost" ).length === 1 )
                                            {
                                                        $.View.view_table().init();
                                            }
                                }
                                //bohan-- 20140331
                                else if( $( opts.this ).attr( "id" ) === "navbar" )
                                {
                                            if( $( ".demo #navbar_localhost" ).length === 1 )
                                            {
                                                        $.View.view_navbar().init();
                                            }
                                }
                                else if( $( opts.this ).attr( "id" ) === "Form" )
                                {
                                            if( $( ".demo #Form_localhost" ).length === 1 )
                                            {
                                                        $.View.view_form()._SetOpts({ Init_Number : $( opts.this ).children(".view").children().attr("formnumber") });
                                                        $.View.view_form().init();
                                            }
                                }
                                else if( $( opts.this ).attr( "id" ) === "FormButton" )
                                {
                                            if( $( ".demo #FormButton_localhost" ).length === 1 )
                                            {
                                                        $.View.view_form().button_init();
                                            }
                                }
                                else if( $( opts.this ).attr( "id" ) === "tabs" )
                                {
                                            if( $( ".demo #myTabs" ).length === 1 )
                                            {
                                                        $.View.view_tabs().init();
                                            }
                                }
                                else if( $( opts.this ).attr( "id" ) === "camera" )
                                {
                                            if( $( ".demo #camera_localhost" ).length === 1 )
                                            {
                                                        $.View.view_camera().init();
                                            }
                                }
                                else if( $( opts.this ).attr( "id" ) === "widget_upload" )
                                {
                                            if( $( ".demo #widget_upload_localhost" ).length === 1 )
                                            {
                                                        $.View.view_widget_upload().init();
                                            }
                                }
                                else if( $( opts.this ).parent().attr( "id" ) == "elmJS" )
                                {


                                }
                                else if( $( opts.this ).parent().attr( "id" ) == "widget_htmliframe" )
                                {
                                            console.log( $( opts.this ).parent().attr( "id" ) );
                                }
                                else if( $( opts.this ).attr( "id" ) == "tabs" )
                                {
                                            // ++ jack

                                            console.log( 'first destroy' );
                                            $(".demo, .demo .column").sortable({
                                                        connectWith: ".column",
                                                        opacity: .35,
                                                        handle: ".drag",
                                                        start: function(e,t) {
                                                                    if (!startdrag) stopsave++;
                                                                    startdrag = 1;
                                                        },
                                                        stop: function(e,t) {
                                                                    if(stopsave>0) stopsave--;
                                                                    startdrag = 0;
                                                        }
                                            });
                                            $(".demo, .demo .column").sortable( "destroy" );
                                            $(".demo, .demo .column").sortable({
                                                        connectWith: ".column",
                                                        opacity: .35,
                                                        handle: ".drag",
                                                        start: function(e,t) {
                                                                    if (!startdrag) stopsave++;
                                                                    startdrag = 1;
                                                        },
                                                        stop: function(e,t) {
                                                                    if(stopsave>0) stopsave--;
                                                                    startdrag = 0;
                                                        }
                                            });

                                            // --
                                }
                                else if( $( opts.this ).attr( "id" ) == "collapse" )
                                {
                                            $.View.view_collapse().init();
                                }
                                //20140729 Bohan++
                                else if( $( opts.this ).attr( "id" ) === "Copy" )
                                {
                                            $( ".demo #Copy_localhost" ).addClass( "myclassfor" + $.focus_projectname );
                                            $( ".demo #Copy_localhost" ).attr("id","");
                                }
                                //20140729 Bohan--
                                else if( $( opts.this ).attr( "id" ) === "FontSizeChangeCom" )
                                {
                                    
                                            $("[id=FontSizeChangeComPlus]").unbind('click').bind( 'click' , function() {
                                                        var tmp_focus = $( this ) ;
                                                        
                                                        var tmp = tmp_focus.attr( "fontsizeindex" ) ;
                                                        if( tmp == undefined )
                                                        {
                                                                    tmp_focus.attr( "fontsizeindex" , "14" );
                                                                    FontSizeChange('main_container','','fontSize','14pt','DIV');
                                                        }else{
                                                                    console.log( ( parseInt( tmp_focus.attr( "fontsizeindex" ) ) + 4 ) );
                                                                    tmp_focus.attr( "fontsizeindex" , ( parseInt( tmp_focus.attr( "fontsizeindex" ) ) + 4 ) );
                                                                    FontSizeChange('main_container','','fontSize', ( parseInt( tmp_focus.attr( "fontsizeindex" ) ) + 4 ).toString() + "px" ,'DIV');
                                                        }
                                            });
                                            
                                            $("[id=FontSizeChangeComMinus]").unbind('click').bind( 'click' , function() {
                                                        var tmp_focus = $( this ).prev() ;
                                                
                                                        var tmp = tmp_focus.attr( "fontsizeindex" ) ;
                                                        if( tmp == undefined )
                                                        {
                                                                    tmp_focus.attr( "fontsizeindex" , "14" );
                                                                    FontSizeChange('main_container','','fontSize','14pt','DIV');
                                                        }else{
                                                                    console.log( ( parseInt( tmp_focus.attr( "fontsizeindex" ) ) - 4 ) );
                                                                    tmp_focus.attr( "fontsizeindex" , ( parseInt( tmp_focus.attr( "fontsizeindex" ) ) - 4 ) );
                                                                    FontSizeChange('main_container','','fontSize', ( parseInt( tmp_focus.attr( "fontsizeindex" ) ) - 4 ).toString() + "px" ,'DIV');
                                                        }
                                            });
                                            

                                }
                                else if( $( opts.this ).attr( "id" ) == "qrcode" )
                                {
                                            //qrcode_body
                                            //qrcode_url
                                            if( $( ".demo #qrcode_localhost" ).length === 1 )
                                            {
                                                        $.View.view_qrcode().init();
                                                        
                                                        $("[id=myModalforQRcodeYes]").unbind('click').bind( 'click' , function() {
                                                                    
                                                                    $.View.view_qrcode().options().position.parent().children("[type=title]").html( $("#ImputQrcodeTitle").val() )
                                                                    $.View.view_qrcode().options().position.parent().attr( "mmobj" , $("#ImputQrcodeUrl").val() );
                                                                    $.View.view_qrcode()._SetOpts({ Url : $("#ImputQrcodeUrl").val() });
                                                                    $.View.view_qrcode().update_qrcode();
                                                                    
                                                        });

                                                        $("[id=myModalforQRcodeNo]").unbind('click').bind( 'click' , function() {
                                                                    var tmp = $( "body" ).attr( "qrcodeindex" ) ;
                                                                    if( tmp == undefined )
                                                                    {
                                                                                $( "body" ).attr( "fontsizeindex" , "14" );
                                                                                FontSizeChange('main_container','','fontSize','14pt','DIV');
                                                                    }else{
                                                                                console.log( ( parseInt( $( "body" ).attr( "fontsizeindex" ) ) - 4 ) );
                                                                                $( "body" ).attr( "fontsizeindex" , ( parseInt( $( "body" ).attr( "fontsizeindex" ) ) - 4 ) );
                                                                                FontSizeChange('main_container','','fontSize', ( parseInt( $( "body" ).attr( "fontsizeindex" ) ) - 4 ).toString() + "px" ,'DIV');
                                                                    }
                                                        });
                                            }
                                            

                                }
                                else if( $( opts.this ).attr( "id" ) == "widget_htmliframe" )
                                {
                                                        
                                            $("[id=myModalforiframeYes]").unbind('click').bind( 'click' , function() {
                                                        $( "#widget_htmliframe iframe" )[0].src = $( "#Inputiframe" ).val() ;
                                            });

                                            $("[id=myModalforiframeNo]").unbind('click').bind( 'click' , function() {
                                            });
                                            
                                }
                                
                                else
                                {

                                }
                                

                                //init_bind_image();
                                init_bind_TTShow_image();
                    }
                   
                    /*

                                $.View.view_sidebar()._SetOpts({ focus_sidebar : "layout" });
                                $.View.view_sidebar().init_sidebar();
                    
                    */
                    function init_sidebar()
                    {

                                $.ajaxq (   "init_sidebar" ,{
                                        url         : 'backend/sidebar/' + opts.focus_sidebar + '.php' ,
                                        type        : 'post' ,
                                        layer_html  : opts.focus_sidebar ,
                                        success      : function(data) {
                                                    //console.log( data );
                                                    var tmp_focus = $( ".sidebar-nav[layer_html=" + this.layer_html + "]" ) ;

                                                    tmp_focus.append( data );

                                                    //$.View.motion_system_language().fnchangelang();

                                                    if( tmp_focus.find( "[haschangelanguage=1]" ).length == 0 )
                                                    {
                                                                var tmp = $( "#dropdownMenu1" ).attr( "selectlang" );
                                                                $( "#dropdownMenu1" ).next().find( "[tabindex=" + tmp + "]" ).parent().trigger( "click" );
                                                    }
                                                    

                                                    $(".nav-header").unbind('click').bind( 'click' , function() {

                                                                if( $(this).attr( "slideDown-status" ) == undefined || $(this).attr( "slideDown-status" ) == "0" )
                                                                {
                                                                            $( ".nav-header" ).attr( "slideDown-status" , "0" );
                                                                            $(this).attr( "slideDown-status" , "1" );

                                                                            $(".sidebar-nav .boxes, .sidebar-nav .rows").hide();
                                                                            $(this).next().slideDown();
                                                                }else{
                                                                            $(this).attr( "slideDown-status" , "0" );
                                                                            $(".sidebar-nav .boxes, .sidebar-nav .rows").hide();
                                                                }

                                                    });



                                                    tmp_focus.find( ".icon-prev" ).parent().unbind('mousedown').bind( 'mousedown' , function() {

                                                                //console.log( $( this ).parent().parent().parent().parent().parent().attr( "layer_id" ) );
                                                                var tmp_focus = $( this ).parent().parent().parent().parent() ;

                                                                var tmp_num = parseInt(tmp_focus.attr( "layer_id" ) ) - 1 ;

                                                                tmp_focus.hide();

                                                                var tmp_next_focus = $( ".sidebar-nav[layer_id=" + tmp_num.toString() + "]" ) ;
                                                                if( tmp_next_focus.length != 0 )
                                                                {
                                                                            tmp_next_focus.show();
                                                                            console.log( tmp_next_focus );

                                                                            $.View.view_sidebar()._SetOpts({ id : tmp_num });
                                                                            $.View.view_sidebar().init_sidebar_from_id();
                                                                }else{
                                                                            var tmp_next_focus = $( ".sidebar-nav[layer_id=" + $( ".sidebar-nav" ).length.toString() + "]" ) ;
                                                                            tmp_next_focus.show();
                                                                            console.log( tmp_next_focus );

                                                                            $.View.view_sidebar()._SetOpts({ id : $( ".sidebar-nav" ).length.toString() });
                                                                            $.View.view_sidebar().init_sidebar_from_id();
                                                                }
                                                    });

                                                    tmp_focus.find( ".icon-next" ).parent().unbind('mousedown').bind( 'mousedown' , function() {

                                                                //console.log( $( this ).parent().parent().parent().parent().attr( "layer_id" ) );
                                                                var tmp_focus = $( this ).parent().parent().parent().parent() ;

                                                                var tmp_num = parseInt(tmp_focus.attr( "layer_id" ) ) + 1 ;

                                                                tmp_focus.hide();
                                                                var tmp_next_focus = $( ".sidebar-nav[layer_id=" + tmp_num.toString() + "]" ) ;
                                                                if( tmp_next_focus.length != 0 )
                                                                {
                                                                            tmp_next_focus.show();
                                                                            console.log( tmp_next_focus );

                                                                            $.View.view_sidebar()._SetOpts({ id : tmp_num });
                                                                            $.View.view_sidebar().init_sidebar_from_id();
                                                                            
                                                                }else{
                                                                            var tmp_next_focus = $( ".sidebar-nav[layer_id=" + "1" + "]" ) ;
                                                                            tmp_next_focus.show();
                                                                            console.log( tmp_next_focus );

                                                                            $.View.view_sidebar()._SetOpts({ id : "1" });
                                                                            $.View.view_sidebar().init_sidebar_from_id();
                                                                }

                                                    });

                                                    tmp_focus.find( ".icon-next" ).parent().prev().unbind('mousedown').bind( 'mousedown' , function() {

                                                                //console.log( $( this ).parent().parent().parent().parent().parent().attr( "layer_id" ) );
                                                                var tmp_focus = $( this ).parent().parent().parent().parent() ;

                                                                var tmp_num = parseInt(tmp_focus.attr( "layer_id" ) ) + 1 ;

                                                                tmp_focus.hide();
                                                                var tmp_next_focus = $( ".sidebar-nav[layer_id=" + tmp_num.toString() + "]" ) ;
                                                                if( tmp_next_focus.length != 0 )
                                                                {
                                                                            tmp_next_focus.show();
                                                                            console.log( tmp_next_focus );
                                                                            
                                                                            $.View.view_sidebar()._SetOpts({ id : tmp_num });
                                                                            $.View.view_sidebar().init_sidebar_from_id();
                                                                            
                                                                }else{
                                                                            var tmp_next_focus = $( ".sidebar-nav[layer_id=" + "1" + "]" ) ;
                                                                            tmp_next_focus.show();
                                                                            console.log( tmp_next_focus );
                                                                            
                                                                            $.View.view_sidebar()._SetOpts({ id : "1" });
                                                                            $.View.view_sidebar().init_sidebar_from_id();
                                                                            
                                                                }


                                                    });

                                                    tmp_focus.find( ".lyrow" ).draggable({
                                                                connectToSortable: ".demo",
                                                                helper: "clone",
                                                                handle: ".drag",
                                                                start: function(e,t) {
                                                                            if (!startdrag) stopsave++;
                                                                            startdrag = 1;
                                                                },
                                                                drag: function(e, t) {
                                                                            t.helper.width(400);
                                                                },
                                                                stop: function(e, t) {
                                                                            $(".demo .column").sortable({
                                                                                        opacity: .35,
                                                                                        connectWith: ".column",
                                                                                        start: function(e,t) {
                                                                                                if (!startdrag) stopsave++;
                                                                                                startdrag = 1;
                                                                                        },
                                                                                        stop: function(e,t) {
                                                                                                if(stopsave>0) stopsave--;
                                                                                                startdrag = 0;
                                                                                        }
                                                                            });
                                                                            if(stopsave>0) stopsave--;
                                                                            startdrag = 0;
                                                                            
                                                                            //bohan++ 20140430
                                                                            $(".demo, .demo .column").sortable({
                                                                                        connectWith: ".column",
                                                                                        opacity: .35,
                                                                                        handle: ".drag",
                                                                                        start: function(e,t) {
                                                                                                    if (!startdrag) stopsave++;
                                                                                                    startdrag = 1;
                                                                                        },
                                                                                        stop: function(e,t) {
                                                                                                    if(stopsave>0) stopsave--;
                                                                                                    startdrag = 0;
                                                                                        }
                                                                            });
                                                                            $(".demo, .demo .column").sortable( "destroy" );
                                                                            $(".demo, .demo .column").sortable({
                                                                                        connectWith: ".column",
                                                                                        opacity: .35,
                                                                                        handle: ".drag",
                                                                                        start: function(e,t) {
                                                                                                    if (!startdrag) stopsave++;
                                                                                                    startdrag = 1;
                                                                                        },
                                                                                        stop: function(e,t) {
                                                                                                    if(stopsave>0) stopsave--;
                                                                                                    startdrag = 0;
                                                                                        }
                                                                            });
                                                                            //bohan-- 20140430
                                                                }
                                                    });

                                                    tmp_focus.find( ".box" ).draggable({
                                                                connectToSortable: ".column",
                                                                helper: "clone",
                                                                handle: ".drag",
                                                                start: function(e,t) {
                                                                                    if (!startdrag) stopsave++;
                                                                                    startdrag = 1;
                                                                },
                                                                drag: function(e, t) {
                                                                                    t.helper.width(400)
                                                                },
                                                                stop: function(e, t) {

                                                                                    console.log( this );
                                                                                    
                                                                                    if( $( this ).children( ".view" ).children( ".youtobe_video" ).length == 1 )
                                                                                    {
                                                                                                $( ".demo" ).find( 'iframe[src=""]' ).attr( "src" , "//www.youtube.com/embed/oVduJ_y0IRM" );
                                                                                                //$( this ).children( ".view" ).children( ".youtobe_video" ).find( "iframe" ).attr( "src" , "//www.youtube.com/embed/oVduJ_y0IRM" );
                                                                                    }
                                                                                    
                                                                                    
                                                                                    opts.this = this ;
                                                                                    init_sidebar_1();


                                                                                    handleJsIds();



                                                                                    if( stopsave > 0 ) stopsave--;
                                                                                    startdrag = 0;
                                                                }
                                                    });
                                                    //2014.8.1 abin edit ++
                                                    $("[abin_mms=false]").css("display","none");
                                                    //2014.8.1 abin edit --    
                                            }
                                });
                    }
                   
                    /*

                                $.View.view_sidebar()._SetOpts({ focus_sidebar : "layout" });
                                $.View.view_sidebar().init_sidebar();
                    
                    */
                    /* abin edit 2014.6.27 ++ */
                    function init_bind_TTShow_image()
                    {
                            $( ".demo .view [mmid=1]" )
                            .unbind('click').bind( 'click' , function(e) {
                                    if( e.target.tagName == "IMG" ) {
                                            opts.click_img = $(e.target);
                                            $("#change_img_select_modal").modal("show");
                                    }
                            });
                    }
                    /* abin edit 2014.6.27 -- */
                    
                    
                    /* abin edit 2014.6.27 ++ */
                    function init_bind_image()
                    {
                                var target = "";
                                var img = "";
                                var mmtype = "";
                                if( $.focus_projectname != undefined )
                                {
                                            $( ".demo .view [mmid=1]" )
                                            .unbind('click').bind( 'click' , function(e) {
                                                
                                                        console.log( e.target );
                                                
                                                        mmtype = $(this).attr("mmtype");
                                                
                                                        if( e.target.tagName == "IMG" ) {
                                                                    if( mmtype != "['image_slider']" && mmtype != "['image_slider_tv']" && mmtype != "[ 'google_map' , '' ]") {
                                                                                
                                                                                
                                                                                $( "#myModalupload" ).modal( "show" );
                                                                                
                                                                                var tmp_profile_name = 'appbuilder' ;
                                                                                u_getprofile( tmp_profile_name , function( msg ){
                                                                                            console.log( msg );
                                                                                            if( msg.ErrCode == 0 )
                                                                                            {
                                                                                                        $.View.view_dropme()._SetOpts({ PutMediaDropmeVal : msg });
                                                                                                        $.View.view_dropme().PutMediaDropme();

                                                                                            }
                                                                                });
                                                                                /*

                                                                                                        u_setprofile( tmp_profile_name , JSON.stringify( tmp ) , function( msg ){
                                                                                                                    console.log( msg );
                                                                                                                    if( msg.ErrCode == 0 ) {}
                                                                                                        });
                                                                                 */
                                                                                
                                                                                $( this ).find("img").attr( "changeimage" , "1" );
                                                                                target = this;
                                                                                img = e.target;
                                                                                
                                                                                // start
                                                                                // window.open( "../dropme" );

                                                                                //$.View.view_dropme()._SetOpts({ mode : 1 });
                                                                                //$.View.view_dropme().init();

                                                                                // end
                
                                                                                //console.log( $( "#DropMe_Page_1_Project" ).children( ".selected" ).attr( "fileurl" ) );
                                                                                //var tmp = $( "#DropMe_Page_1_Project" ).children( ".selected" ).attr( "fileurl" ) ;
                                                                                //$(".demo img").attr( "changeimage" , "0" ).attr( "src" , tmp );
                                                                    }
                                                        }
                                                        else if( mmtype == "['thumbnails']" ) {
                                                                    //if( $(this).attr("changeimage") == 1 &&  $(e.target).attr("class") == "photo img-responsive" ) {
                                                                    if( $(e.target).attr("class") == "photo img-responsive" ) {
                                                                                $( "#myModalupload" ).modal( "show" );
                                                                                //$( this ).attr( "changeimage" , "1" );
                                                                                target = this;
                                                                                img = e.target;
                                                                                $(img).attr( "changeimage" , "1" );
                                                                    }
                                                        }
                                            })
                                            .unbind('changeimage').bind( 'changeimage' , function(e) {
                                                        if( mmtype == "['thumbnails']" ) {
                                                                $(img).css( "background-image" , "url('" + $("#DropMe_Page_1_Project").children( "li.selected" ).attr( "fileURL" ) + "')" );
                                                                $(img).removeAttr("changeimage");
                                                                /*
                                                                var json = JSON.parse($(target).attr("mmobj"));
                                                                json.source = "none";
                                                                json.value = $("#DropMe_Page_1_Project").children( "li.selected" ).attr( "fileURL" );

                                                                $(target).attr("mmobj",JSON.stringify(json));
                                                                */
                                                                //$(img).attr( "changeimage" , "0" );
                                                        }
                                                        else {
                                                                //$( "#myModalupload" ).modal( "hide" );
                                                                //$(img).attr( "width"  , "300"   );
                                                                //$(img).attr( "height" , "auto"  );
                                                                $(img).attr( "src" , $("#DropMe_Page_1_Project").children( "li.selected" ).attr( "fileURL" )  );                                                                                   
                                                                //$(target).attr("mmobj",JSON.stringify(json));
                                                                //$(img).attr( "changeimage" , "0" );
                                                        }
                                                        var json = JSON.parse($(target).attr("mmobj"));
                                                        json.source = "none";
                                                        json.value = $("#DropMe_Page_1_Project").children( "li.selected" ).attr( "fileURL" );
                                                        json.dropme = true;
                                                        $(target).attr("mmobj",JSON.stringify(json));
 
                                                        if( mmtype == "['image_text_H']" || mmtype == "['image_text_V']" ) {
                                                                $(target).find(".media-body").attr("contenteditable",true);
                                                        }
                                                        else if( mmtype == "['thumbnails']" ) {
                                                                $(target).find(".caption").attr("contenteditable",true);
                                                        }
                                            });
                                            
                                            // Bohan edit 2014.7.29 ++ 
                                            $(".demo [class^='myclassfor'] img")
                                            .unbind('click').bind( 'click' , function(e) {
                                                
                                                        if( e.target.tagName == "IMG" ) {
                                                                            $( "#myModalupload" ).modal( "show" );
                                                                            $( this ).attr( "changeimage" , "1" );
                                                                            target = this;
                                                                            img = e.target;
                                                        }
                                            })
                                            .unbind('changeimage').bind( 'changeimage' , function(e) {
                                                                $( "#myModalupload" ).modal( "hide" );
                                                                $(img).attr( "width"  , "300"   );
                                                                $(img).attr( "height" , "auto"  );
                                                                $(img).attr( "src" , $("#DropMe_Page_1_Project").children( "li.selected" ).attr( "fileURL" )  );  
                                                                //$(img).attr( "changeimage" , "0" );
                                            });
                                            // Bohan edit 2014.7.29 -- 
                                }
                    }
                    /* abin edit 2014.6.27 -- */
                    
            };//--view_sidebar


            // jQuery plugin implementation
            $.fn.view_sidebar = function(conf) {

                    // return existing instance
                    var el = this.eq(typeof conf == 'number' ? conf : 0).data("view_sidebar");
                    if (el) {return el;}

                    // setup options
                    var opts = {
                            aaa                    : "aaa",
                            trigger_id             : 0,
                            alarm_state            : "",
                            
                            create_:function(e,m,o){}
                    };

                    $.extend(opts, conf);

                    // install the plugin for each items in jQuery
                    this.each(function() {
                            el = new view_sidebar(this, opts);
                            $(this).data("view_sidebar", el);
                    });

                    return opts.api ? el: this;
            };
////////////////////////////////////////////////////////////////////////////////////////////////
})(jQuery);