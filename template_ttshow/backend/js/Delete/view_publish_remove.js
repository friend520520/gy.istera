/*
            jQuery jclock - jquery.rotate.bala plugin - v 0.0.1
*/
(function($) {
            $.view_publish_remove = $.view_publish_remove || {version:'0.0.1'};
            var view_publish_remove = function(dom,opts) { //[--plugin define
                    var me=$(dom);
                    // public methods
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
                                part_publish();
                    }
                    function destroy()
                    {
                                $( "#" + $(opts.this).parent().children(".view").attr( "tmp_id" ) ).html("");
                    }
                    function part_publish() 
                    {
                                alert("!!!");
                                var mmobj_json = eval('[' + opts.value.attr("mmobj") + ']')[0];
                                
                                if( opts.mmtype[0] == "dashboard" )
                                {
                                            opts.value.html( "" );
                                }
                                else if( opts.mmtype[0] == "kline" )
                                {
                                            opts.value.html( "" );
                                }                        
                                else if( opts.mmtype[0] == "google_map" )
                                {
                                            opts.value.html( "" );
                                }
                                else if( opts.mmtype[0] == "timeline" )
                                {
                                            opts.value.html( "" );
                                }
                                //bohan++ 20140718
                                else if( opts.mmtype[0] == "table" )
                                {           
                                            
                                            $.View.view_table()._SetOpts({ Focus : opts.value });
                                            $.View.view_table().TransformJSONSave();
                                            opts.TableId = opts.value.attr("id");
                                            opts.TableMMtype = opts.value.attr("mmtype");
                                            opts.TableMMid = opts.value.attr("mmid");
                                            opts.TableProjectName = opts.value.attr("projectname");
                                            opts.TableUid = opts.value.attr("uid");
                                            opts.TemporaryPosition = opts.value.parent().parent();
                                            opts.value.parent().remove();
                                            opts.TemporaryPosition.append( '<table id="" mmid="" mmtype=""></table>' );
                                            opts.TemporaryPosition.children("table")
                                                    .attr( "id" , opts.TableId )
                                                    .attr( "mmtype" , opts.TableMMtype )
                                                    .attr( "mmid" , opts.TableMMid )
                                                    .attr( "mmobj" , JSON.stringify( $.View.view_table().options().TJSON ) )
                                                    .attr( "projectname" , opts.TableProjectName )
                                                    .attr( "uid" , opts.TableUid );
                                }
                                //bohan-- 20140718
                                
                                
                                else if( opts.mmtype[0] == "description" || opts.mmtype[0] == "title")
                                {
                                        if( mmobj_json.dropme != undefined || opts.value.attr("changeimage") == 1 ) {
                                        }
                                        else {
                                                opts.value.html( "" );
                                        }
                                }
                                
                                
                                else if( opts.mmtype[0] == "image" && opts.value.attr("changeimage") != 1 )
                                {
                                            opts.value.find("img").attr("src","");
                                }
                                else if( opts.mmtype[0] == "image_slider" )
                                {
                                            opts.value.html( "" );
                                }
                                else if( opts.mmtype[0] == "image_text_H" )
                                {
                                        if( mmobj_json.dropme != undefined || opts.value.attr("changeimage") == 1 ) {
                                        }
                                        else {
                                                opts.value.html( "" );
                                        }
                                }
                                else if( opts.mmtype[0] == "image_text_V" )
                                {
                                        if( mmobj_json.dropme != undefined || opts.value.attr("changeimage") == 1 ) {
                                        }
                                        else {
                                                opts.value.html( "" );
                                        }
                                }
                                else if( opts.mmtype[0] == "thumbnails" )
                                {
                                        if( mmobj_json.dropme != undefined || opts.value.attr("changeimage") == 1 ) {
                                        }
                                        else {
                                                opts.value.html( "" );
                                        }
                                }
                                else if( opts.mmtype[0] == "video" || opts.mmtype[0] == "audio" )
                                {
                                        if( mmobj_json.dropme != undefined || opts.value.attr("changeimage") == 1 ) {
                                        }
                                        else {
                                                opts.value.find("source").attr("src","");
                                        }
                                }
                    }
                };
                    


            // jQuery plugin implementation
            $.fn.view_publish_remove = function(conf) {

                    // return existing instance
                    var el = this.eq(typeof conf == 'number' ? conf : 0).data("view_publish_remove");
                    if (el) {return el;}

                    // setup options
                    var opts = {
                            aaa                    : "aaa",
                            timeline_id            : 0,
                            alarm_state             : "",
                            create_:function(e,m,o){}
                    };

                    $.extend(opts, conf);

                    // install the plugin for each items in jQuery
                    this.each(function() {
                            el = new view_publish_remove(this, opts);
                            $(this).data("view_publish_remove", el);
                    });

                    return opts.api ? el: this;
            };
////////////////////////////////////////////////////////////////////////////////////////////////
})(jQuery);