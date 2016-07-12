/*
            jQuery jclock - jquery.rotate.bala plugin - v 0.0.1

            a bin ++ 2014.7.8
*/
(function($) {
            $.init_project = $.init_project || {version:'0.0.1'};
            var init_project = function(dom,opts) { //[--plugin define
                    $.extend(this, {
                                init: function() {
                                        init();
                                },
                                destroy: function() {
                                        destroy();
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
                        
                        $.each( $( "#main_container [mmid=1]" ) , function( index , value ) {
                                    console.log(value);
                                    var Tag = $(value);
                                    var mmtype = eval(Tag.attr("mmtype"));
                                    var mmobj = Tag.attr("mmobj");
                                    var mmobj_json = eval('[' + mmobj + ']')[0];
                                    if( mmtype[0] == "dashboard" )
                                    {
                                            if( mmtype[1] == "pie" )
                                            {
                                                    $.View.process_pie()._SetOpts({ 
                                                                                    target : Tag ,
                                                                                    mmtype : mmtype ,
                                                                                    mmobj : mmobj 
                                                                           });
                                                    $.View.process_pie().static_web();
                                            }
                                            else if( mmtype[1] == "column" )
                                            {
                                                    $.View.process_column()._SetOpts({ 
                                                                                    target : Tag ,
                                                                                    mmtype : mmtype ,
                                                                                    mmobj : mmobj 
                                                                           });
                                                    $.View.process_column().static_web();
                                            }
                                            else if( mmtype[1] == "line" )
                                            {
                                                    $.View.process_line()._SetOpts({ 
                                                                                    target : Tag ,
                                                                                    mmtype : mmtype ,
                                                                                    mmobj : mmobj 
                                                                           });
                                                    $.View.process_line().static_web();
                                            }
                                    }
                                    else if( mmtype[0] == "iot" )
                                    {
                                            if( mmtype[1] == "fan" )
                                            {
                                                    $.View.process_panel_fan()._SetOpts({ 
                                                                                    target : Tag ,
                                                                                    mmtype : mmtype ,
                                                                                    mmobj : mmobj 
                                                                           });
                                                    $.View.process_panel_fan().static_web();
                                            }
                                    }    
                                    else if( mmtype[0] == "google_map" )
                                    {
                                            $.View.process_google_map()._SetOpts({ 
                                                                            target : Tag ,
                                                                            mmtype : mmtype ,
                                                                            mmobj : mmobj 
                                                                   });
                                            $.View.process_google_map().static_web();
                                    }
                                    else if( mmtype[0] == "timeline" )
                                    {
                                            $.View.process_timeline()._SetOpts({ 
                                                                            target : Tag ,
                                                                            mmtype : mmtype ,
                                                                            mmobj : mmobj 
                                                                   });
                                            $.View.process_timeline().static_web();
                                    }


                                    else if( mmtype[0] == "description" || mmtype[0] == "title" ) {
                                            if( Tag.attr("changeimage") == 1 || mmobj_json.dropme !=  undefined ) {
                                            }
                                            else {
                                                    $.View.process_description()._SetOpts({ 
                                                                                    target : Tag ,
                                                                                    mmtype : mmtype ,
                                                                                    mmobj : mmobj 
                                                                           });
                                                    $.View.process_description().static_web();
                                            }
                                    }


                                    else if( mmtype[0] == "image" && Tag.attr("changeimage") != 1 ) {
                                            $.View.process_image()._SetOpts({ 
                                                                            target : Tag ,
                                                                            mmtype : mmtype ,
                                                                            mmobj : mmobj 
                                                                   });
                                            $.View.process_image().static_web();
                                    }
                                    else if( mmtype[0] == "image_text_H" ) {
                                            if( Tag.attr("changeimage") == 1 || mmobj_json.dropme !=  undefined ) {
                                            }
                                            else {
                                                    $.View.process_image_text_H()._SetOpts({ 
                                                                                    target : Tag ,
                                                                                    mmtype : mmtype ,
                                                                                    mmobj : mmobj 
                                                                           });
                                                    $.View.process_image_text_H().static_web();
                                            }
                                    }
                                    else if( mmtype[0] == "image_text_V" ) {
                                            if( Tag.attr("changeimage") == 1 || mmobj_json.dropme !=  undefined ) {
                                            }
                                            else {
                                                    $.View.process_image_text_V()._SetOpts({ 
                                                                                    target : Tag ,
                                                                                    mmtype : mmtype ,
                                                                                    mmobj : mmobj 
                                                                           });
                                                    $.View.process_image_text_V().static_web();
                                            }
                                    }
                                    else if( mmtype[0] == "image_slider") {
                                            $.View.process_image_slider()._SetOpts({ 
                                                                            target : Tag ,
                                                                            mmtype : mmtype ,
                                                                            mmobj : mmobj 
                                                                   });
                                            $.View.process_image_slider().static_web();
                                    }
                                    /*
                                    else if( mmtype[0] == "image_slider_tv") {
                                            $.View.process_image_slider_tv()._SetOpts({ 
                                                                            target : Tag ,
                                                                            mmtype : mmtype ,
                                                                            mmobj : mmobj 
                                                                   });
                                            $.View.process_image_slider_tv().static_web();
                                    }
                                    */
                                    else if( mmtype[0] == "thumbnails" ) {
                                            if( Tag.attr("changeimage") == 1 || mmobj_json.dropme !=  undefined ) {
                                            }
                                            else {
                                                    $.View.process_thumbnails()._SetOpts({ 
                                                                                    target : Tag ,
                                                                                    mmtype : mmtype ,
                                                                                    mmobj : mmobj 
                                                                           });
                                                    $.View.process_thumbnails().static_web();
                                            }
                                    }
                                    else if( mmtype[0] == "video" || mmtype[0] == "audio" ) {
                                            if( Tag.attr("changeimage") == 1 || mmobj_json.dropme !=  undefined ) {
                                            }
                                            else {
                                                    $.View.process_video_audio()._SetOpts({ 
                                                                                    target : Tag ,
                                                                                    mmtype : mmtype ,
                                                                                    mmobj : mmobj 
                                                                           });
                                                    $.View.process_video_audio().static_web();
                                            }
                                    }
                                    /*
                                    else if( mmtype[0] == "switch_button") {
                                            $.View.MMA()._SetOpts({ 
                                                                            target : Tag ,
                                                                            mmtype : mmtype ,
                                                                   });
                                            $.View.MMA().static_bind_click();
                                    }
                                    */
                                    else if( mmtype[0] == "timeliner") {
                                            $.View.view_timeline_v()._SetOpts({ 
                                                                            id : Tag.attr("id") ,
                                                                   });
                                            $.View.view_timeline_v().eventinit();
                                    }
                                    else if( mmtype[0] == "table") {
                                        $.View.process_table()._SetOpts({ 
                                                                   target : Tag ,
                                                                   mmtype : mmtype ,
                                                                   mmobj : mmobj 
                                                          });
                                        $.View.process_table().static_web();
                                    }
                        });
                        
                        $.each( $( "#main_container [mmid=2]" ) , function( index , value ) {
                                    console.log(value);
                                    var Tag = $(value);
                                    var mmtype = eval(Tag.attr("mmtype"));
                                    var mmobj = Tag.attr("mmobj");
                        
                                    if( mmtype[0] == "camera") {
                                            $.View.view_camera()._SetOpts({ 
                                                                            tmp_id : Tag.attr("id") ,
                                                                   });
                                            $.View.view_camera().event();
                                    }
                                    else if( mmtype[0] == "widget_upload") {
                                            $.View.view_widget_upload()._SetOpts({
                                                                            tmp_id : Tag.attr("id") ,
                                                                   });
                                            $.View.view_widget_upload().eventinit();
                                    }
                        });
                        
                        //$.View.view_Drinkform().builder_button_event_init();
                    }
                    function destroy()
                    {
                    }
            };


            // jQuery plugin implementation
            $.fn.init_project = function(conf) {

                    // return existing instance
                    var el = this.eq(typeof conf == 'number' ? conf : 0).data("init_project");
                    if (el) {return el;}

                    // setup options
                    var opts = {
                            aaa                    : "aaa",
                            pie_id                 : 0,
                            alarm_state             : "",
                            create_:function(e,m,o){}
                    };

                    $.extend(opts, conf);

                    // install the plugin for each items in jQuery
                    this.each(function() {
                            el = new init_project(this, opts);
                            $(this).data("init_project", el);
                    });

                    return opts.api ? el: this;
            };
////////////////////////////////////////////////////////////////////////////////////////////////
})(jQuery);