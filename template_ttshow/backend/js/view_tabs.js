/*
            jQuery jclock - jquery.rotate.bala plugin - v 0.0.1
*/
(function($) {
            $.view_tabs = $.view_tabs || {version:'0.0.1'};
            var view_tabs = function(dom,opts) { //[--plugin define
                    var me=$(dom);
                    // public methods
                    $.extend(this, {
                                init: function() {
                                        init();
                                },
                                sortable: function() {
                                        sortable();
                                },
                                quantities: function() {
                                        quantities();
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
                            opts.tabs_id++ ;

                            var tmp_id = "myTabls_" + opts.tabs_id.toString();
                            while(true) {
                                if($("#"+tmp_id)[0] == undefined) {
                                        break;
                                }
                                opts.tabs_id++ ;
                                tmp_id = "myTabls_" + opts.tabs_id.toString();
                            }

                            $( ".demo #myTabs" ).parent().attr( "tmp_id" , tmp_id )

                            $( ".demo #myTabs" ).attr( "id" , tmp_id );
                            
                            opts.ChooseTab = $( ".demo #" + tmp_id );
                            opts.Content = [ "Section 1" , "Section 2"];
                            
                            CreateTabs();
                    }
                    
                    function CreateTabs()
                    {       
                            opts.id = opts.ChooseTab.attr("id");
                            
                            opts.ChooseTab.append(
                                    '<ul class="nav nav-tabs"></ul>' +
                                    '<div class="tab-content"></div>'   );
                            
                            $.each( opts.Content , function( index , value ){
                                    
                                    opts.ChooseTab.children("ul").append(
                                        '<li class=""><a href="#' + opts.id + '_' + (index+1) + '" data-toggle="tab" contenteditable="true">' + value + '</a></li>');
                                        
                                    opts.ChooseTab.children("div").append(
                                        '<div class="tab-pane" id="' + opts.id + '_' + (index+1) + '" >' +
                                        '<div class="row-fluid clearfix" style="background: none;">' +
                                        '<div class="col-md-12 column ui-sortable" style="background: none;"></div>' +
                                        '</div>' +
                                        '</div>');
                            });
                            
                            opts.ChooseTab.children("ul").children("li:eq(0)").addClass("active");
                            opts.ChooseTab.children("div").children("div:eq(0)").addClass("active");
                            
                            sortable();
                            
                    }
                    
                    function sortable()
                    {
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
                    }
                    
                    function quantities()
                    {
                            var n = opts.n;
                            
                            var addlength = parseInt(opts.focus.html()) - n.children("ul").children("li").length;
                            var addarray = new Array(parseInt(opts.focus.html()));
                            var minusarray = new Array(parseInt(Math.abs(addlength)));

                            if (addlength>=0)
                            {
                                        $.each( addarray , function(index, value) {
                                                    if (index >= n.children("ul").children("li").length){
                                                                n.children("ul").append(
                                                                            "<li class=''><a href='#" + n.attr("id") + "_" + (index+1) + "' data-toggle='tab' contenteditable='true'>Section " + (index+1) + "</a></li>"
                                                                );
                                                                n.children("div").append(
                                                                "<div class='tab-pane' id='" + n.attr("id") + "_" + (index+1) + "' contenteditable='false'>" +
                                                                "<div class='row-fluid clearfix' style='background: none;'>" +
                                                                "<div class='col-md-12 column ui-sortable' style='background: none;'></div>" +
                                                                "<div class='col-md-12 column ui-sortable' style='background: none;'></div>" +
                                                                // "<div class='span12 column ui-sortable' style='background: none;'></div>" + // modify by jack
                                                                // "<div class='span12 column ui-sortable' style='background: none;'></div>" + // modify by jack
                                                                "</div>" +
                                                                "</div>"
                                                                );
                                                    }
                                                    
                                                    sortable();
                                        });
                            }
                            else
                            {
                                        var removearray = n.children("ul").children("li").length - 1 ;
                                        $.each( minusarray , function(index, value) {
                                                    n.children("ul").children()[removearray].remove();
                                                    n.children("div").children()[removearray].remove();
                                                    removearray--;
                                        });
                                        //booo if()
                            }

                            //add restart p1
                            n.children("ul").children().removeClass();
                            n.children("ul").children(":eq(0)").addClass("active");
                            n.children("div").children().attr("class","tab-pane");
                            n.children("div").children(":eq(0)").attr("class","tab-pane active");
                    }
                    
            };//--view_tabs


            // jQuery plugin implementation
            $.fn.view_tabs = function(conf) {

                    // return existing instance
                    var el = this.eq(typeof conf == 'number' ? conf : 0).data("view_tabs");
                    if (el) {return el;}

                    // setup options
                    var opts = {
                            aaa                    : "aaa",
                            tabs_id                : 0,
                            alarm_state            : "",
                            create_:function(e,m,o){}
                    };

                    $.extend(opts, conf);

                    // install the plugin for each items in jQuery
                    this.each(function() {
                            el = new view_tabs(this, opts);
                            $(this).data("view_tabs", el);
                    });

                    return opts.api ? el: this;
            };
////////////////////////////////////////////////////////////////////////////////////////////////
})(jQuery);