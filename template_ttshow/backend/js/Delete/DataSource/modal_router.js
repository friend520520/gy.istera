/*
 * a bin ++ 2014.5.4.1300
*/
(function($) {
            $.modal_router = $.modal_router || {version:'0.0.1'};
            var modal_router = function(dom,opts) { //[--plugin define
                    var me=$(dom);
                    // public methods
                    $.extend(this, {
                                init: function() {
                                        init();
                                },
                                destroy: function() {
                                        destroy();
                                },
                                JSON_click : function() {
                                        JSON_click();
                                },
                                options: function() {
                                        return opts;
                                },
                                _SetOpts: function( options ) {
                                        $.extend(opts,options);
                                }
                    });
                    
                    function init()
                    {       
                            separate_item();
                    }
                    
                    function separate_item()
                    {
                            var type = eval(opts.mmtype);  
                            var callback = "";
                            if( type == undefined) {
                                    return;
                            }
                            if( type[0] == "dashboard" )
                            {
                                    if( type[1] == "pie" )
                                    {
                                            if( opts.button != "") {
                                                    $.View.process_pie()._SetOpts({ mmtype : opts.mmtype , mmobj : opts.mmobj});
                                                    $.View.process_pie().init2();
                                                    opts.button = "";
                                            }
                                            else {
                                                    callback = function(data){
                                                                    opts.destroy = "$.View.process_pie().destroy()";
                                                                    var callback = function(data) {
                                                                            $.View.process_pie()._SetOpts({ Form : data , mmtype : opts.mmtype , mmobj : opts.mmobj});
                                                                            $.View.process_pie().init();
                                                                    }
                                                                    $.CGI_proxy( "POST" , eval('['+data+']')[0].url , "" , "", callback );
                                                              };
                                                    $.CGI_proxy( "POST" , "json/form/Pie.json" , "" , "" , callback);
                                            }
                                    }
                                    else if( type[1] == "column" )
                                    {
                                            $.View.process_column()._SetOpts({ mmtype : opts.mmtype , mmobj : opts.mmobj});
                                            $.View.process_column().init();
                                    }
                                    else if( type[1] == "line" )
                                    {
                                            $.View.process_line()._SetOpts({ mmtype : opts.mmtype , mmobj : opts.mmobj});
                                            $.View.process_line().init();
                                    }
                            }     
                            
                            else if( type[0] == "iot" )
                            {
                                    if( type[1] == "fan" )
                                    {
                                            $.View.process_panel_fan()._SetOpts({ target : opts.target , mmtype : opts.mmtype , mmobj : opts.mmobj});
                                            $.View.process_panel_fan().init();
                                    }
                            }        
                            
                            else if( type[0] == "timeline" )
                            {
                                    $.View.process_timeline()._SetOpts({ mmtype : opts.mmtype , mmobj : opts.mmobj});
                                    $.View.process_timeline().init();
                            }
                            else if( type[0] == "google_map" )
                            {
                                    callback = function(data){
                                                    opts.destroy = "$.View.process_google_map().destroy()";
                                                    var callback = function(data) {
                                                            $.View.process_google_map()._SetOpts({ Form : data , mmtype : opts.mmtype , mmobj : opts.mmobj});
                                                            $.View.process_google_map().init();
                                                    }
                                                    $.CGI_proxy( "POST" , eval('['+data+']')[0].url , "" , "", callback );
                                              };
                                    $.CGI_proxy( "POST" , "json/form/GoogleMap.json" , "" , "" , callback);
                            }
                            /*
                            else if( type[0] == "image" ) {
                                    callback = function(data){
                                                    opts.destroy = "$.View.process_image().destroy()";
                                                    var callback = function(data) {
                                                            $.View.process_image()._SetOpts({ Form : data , mmtype : opts.mmtype , mmobj : opts.mmobj});
                                                            $.View.process_image().init();
                                                    }
                                                    $.CGI_proxy( "POST" , eval('['+data+']')[0].url , "" , "", callback );
                                              };
                                    $.CGI_proxy( "POST" , "json/form/Image.json" , "" , "" , callback);
                            }*/
                            else if( type[0] == "image_text_H" ) {
                                    callback = function(data){
                                                    opts.destroy = "$.View.process_image_text_H().destroy()";
                                                    var callback = function(data) {
                                                            $.View.process_image_text_H()._SetOpts({ Form : data , mmtype : opts.mmtype , mmobj : opts.mmobj });
                                                            $.View.process_image_text_H().init();
                                                    }
                                                    $.CGI_proxy( "POST" , eval('['+data+']')[0].url , "" , "", callback );
                                              };
                                    $.CGI_proxy( "POST" , "json/form/Image_text.json" , "" , "" , callback);
                            }
                            else if( type[0] == "image_text_V" ) {
                                    callback = function(data){
                                                    opts.destroy = "$.View.process_image_text_V().destroy()";
                                                    var callback = function(data) {
                                                            $.View.process_image_text_V()._SetOpts({ Form : data , mmtype : opts.mmtype , mmobj : opts.mmobj });
                                                            $.View.process_image_text_V().init();
                                                    }
                                                    $.CGI_proxy( "POST" , eval('['+data+']')[0].url , "" , "", callback );
                                              };
                                    $.CGI_proxy( "POST" , "json/form/Image_text.json" , "" , "" , callback);
                            }
                            else if( type[0] == "image_slider" ) {
                                    callback = function(data){
                                                    opts.destroy = "$.View.process_image_slider().destroy()";
                                                    var callback = function(data) {
                                                            $.View.process_image_slider()._SetOpts({ Form : data , mmtype : opts.mmtype , mmobj : opts.mmobj });
                                                            $.View.process_image_slider().init();
                                                    }
                                                    $.CGI_proxy( "POST" , eval('['+data+']')[0].url , "" , "", callback );
                                              };
                                    $.CGI_proxy( "POST" , "json/form/ImageSlider.json" , "" , "" , callback);
                            }
                            else if( type[0] == "image_slider_tv" ) {
                                    callback = function(data){
                                                    opts.destroy = "$.View.process_image_slider_tv().destroy()";
                                                    var callback = function(data) {
                                                            $.View.process_image_slider_tv()._SetOpts({ Form : data , mmtype : opts.mmtype , mmobj : opts.mmobj });
                                                            $.View.process_image_slider_tv().init();
                                                    }
                                                    $.CGI_proxy( "POST" , eval('['+data+']')[0].url , "" , "", callback );
                                              };
                                    $.CGI_proxy( "POST" , "json/form/ImageSlider_TV.json" , "" , "" , callback);
                            }
                            else if( type[0] == "thumbnails" ) {
                                    callback = function(data){
                                                    opts.destroy = "$.View.process_thumbnails().destroy()";
                                                    var callback = function(data) {
                                                            $.View.process_thumbnails()._SetOpts({ Form : data , mmtype : opts.mmtype , mmobj : opts.mmobj });
                                                            $.View.process_thumbnails().init();
                                                    }
                                                    $.CGI_proxy( "POST" , eval('['+data+']')[0].url , "" , "", callback );
                                              };
                                    $.CGI_proxy( "POST" , "json/form/Thumbnails.json" , "" , "" , callback);
                            }
                            
                            
                            

                            else if( type[0] == "description" || type[0] == "title" ) {
                                    callback = function(data){
                                                    opts.destroy = "$.View.process_description().destroy()";
                                                    var callback = function(data) {
                                                            $.View.process_description()._SetOpts({ Form : data , mmtype : opts.mmtype , mmobj : opts.mmobj });
                                                            $.View.process_description().init();
                                                    }
                                                    $.CGI_proxy( "POST" , eval('['+data+']')[0].url , "" , "", callback );
                                              };
                                    $.CGI_proxy( "POST" , "json/form/Description.json" , "" , "" , callback);
                            }
                            else if( type[0] == "video" || type[0] == "audio" ) {
                                    callback = function(data){
                                                    opts.destroy = "$.View.process_video_audio().destroy()";
                                                    var callback = function(data) {
                                                            $.View.process_video_audio()._SetOpts({ Form : data , mmtype : opts.mmtype , mmobj : opts.mmobj });
                                                            $.View.process_video_audio().init();
                                                    }
                                                    $.CGI_proxy( "POST" , eval('['+data+']')[0].url , "" , "", callback );
                                              };
                                    $.CGI_proxy( "POST" , "json/form/Video&Audio.json" , "" , "" , callback);
                            }
                    }

                    function destroy()
                    {
                            $("#myModalaaa .modal-body").html("");
                            opts.mmtype = "";
                            opts.mmobj  = "";
                            opts.target = "";
                            opts.data = "";
                            opts.destroy = "";
                    }
                    
                    function JSON_click() 
                    {
                            $("#JSON_Edit").html("");
                            $("#JSON_Edit").append('<div style="display:none"></div>');
                            $("#JSON_Edit").children().eq(0);
                            
                            var options = {
                                    mode: 'text',
                                            error: function (err) {
                                                    alert(err.toString());
                                    }
                            };
                            
                            var editor = new jsoneditor.JSONEditor($("#JSON_Edit").children().eq(0).get(0) , options, opts.data);
                            var textarea_string = $("#JSON_Edit textarea").val();
                            delete editor;
                            
                            $("#JSON_Edit").html("");
                            $("#JSON_Edit").append('<textarea style=" width:100% ; height:350px ; overflow-y:auto ; cursor:auto; resize: none;" ></textarea>');
                            $("#JSON_Edit textarea").val(textarea_string);
                            $("#JSON_Edit textarea").removeAttr('class');
                    }
            
            };

            // jQuery plugin implementation
            $.fn.modal_router = function(conf) {

                    // return existing instance
                    var el = this.eq(typeof conf == 'number' ? conf : 0).data("modal_router");
                    if (el) {return el;}

                    // setup options
                    var opts = {
                            aaa                    : "aaa",
                            button                 : "",
                            create_:function(e,m,o){}
                    };

                    $.extend(opts, conf);

                    // install the plugin for each items in jQuery
                    this.each(function() {
                            el = new modal_router(this, opts);
                            $(this).data("modal_router", el);
                    });

                    return opts.api ? el: this;
            };
////////////////////////////////////////////////////////////////////////////////////////////////
})(jQuery);

/*
$.CGI_proxy = function CGI_proxy( _page , vars , cb_success) 
{
           var bala      = {      
                               page    :   _page,
                               vars    :   vars,
                               timeout :   '10000'
                             };

           $.motion_cgi_error_code_box_index.motion_cgi_error_code_box()._SetOpts({ cgi : bala } );
           $.motion_cgi_error_code_box_index.motion_cgi_error_code_box().append_loading_to_tabs();
           
           var params      = {      
                               page    :   _page,
                               timeout :   '10000'
                             };
           
           var get_vars    =   $.param(params) +   '&vars=[' +    $.param(vars)  +']';

           $.ajax({
                       type : 'POST',
                       url : '/cgi-bin/viewer/proxy.cgi',
                       async: true,
                       data : get_vars,
                       
                       bala : bala,
                       
                       params : params,
                       success : cb_success,
                       error : function(xhr, ajaxOptions, thrownError) {
                                   //console.log( "error" , xhr , ajaxOptions, window.location.href );
                       },
                       beforeSend: function(xhr, ajaxOptions, thrownError) {
                                   //console.log( "beforeSend" , xhr , ajaxOptions.url , window.location.href );
                       }
           });
}
*/
