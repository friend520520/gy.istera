/*
 * a bin ++ 2014.5.4.1300
*/
(function($) {
            $.process_table = $.process_table || {version:'0.0.1'};
            var process_table = function(dom,opts) { //[--plugin define
                    var me=$(dom);
                    // public methods
                    $.extend(this, {
                                init: function() {
                                        init();
                                },
                                destroy: function() {
                                        destroy();
                                },
                                static_web : function() {
                                        static_web();
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
                            $("#abin_TableData [data-target=save]").unbind('click').bind( 'click' , function() {
                                    Save();
                            });
                            preinstall();
                    }
                    
                    function destroy() 
                    {
                    }
                    
                    function Save()
                    {
                            var projectname = $("#abin_TableData [data-input=projectname]").val();
                            opts.target.attr( "projectname" , projectname);
                            console.log(opts.target);
                            if($.uid == "") {
                                    opts.target.attr( "uid" , "" );
                            }
                            else {
                                    opts.target.attr( "uid" , $.uid);
                            }
                            ajax_get_table_data();
                    }
                    
                    function preinstall()
                    {
                            var projectname = opts.target.attr( "projectname" );
                            $("#abin_TableData [data-input=projectname]").val( projectname );
                    }
                    
                    function static_web() 
                    {
                            if( opts.target.attr("uid") != undefined ){
                                    ajax_get_table_data();
                            }
                            else
                            {
                                    $.View.view_table()._SetOpts({  ChooseTable : opts.target , Content : JSON.parse( opts.mmobj ) });
                                    $.View.view_table().CreateDataTable();
                                    $.View.view_table().CreateDataTableEvent();
                            }
                            //need  view_table   destory
                                
                            //need  view_table   create
                    }
                    
                    function ajax_get_table_data()
                    {
                            var data = {
                                    projectname : opts.target.attr("projectname"),
                                    uid         : opts.target.attr("uid"),
                            };
                            var data2 = {};
                            var callback = function(data) {
                                    if( data != "" ) { 
                                            opts.jsondata = data;
                                            $.View.view_table()._SetOpts({  ChooseTable : this.data2.target , JSON : opts.jsondata});
                                            //$.View.view_table().destroy();
                                            $.View.view_table().transformJSON();
                                    }
                                    else {
                                            this.data2.target.removeAttr("uid");
                                            alert("path error!!");
                                    }
                            }
                            var callback_error = function(xhr, ajaxOptions, thrownError) {
                                    console.log("error");
                            }
                            data2.target = opts.target;
                            $.CGI_proxy( "POST" , "jsk/FormJSON.JSK?func=Get" , data , data2 , callback , callback_error);
                    }
            };

            // jQuery plugin implementation
            $.fn.process_table = function(conf) {

                    // return existing instance
                    var el = this.eq(typeof conf == 'number' ? conf : 0).data("process_table");
                    if (el) {return el;}

                    // setup options
                    var opts = {
                            Form : "" ,
                            create_:function(e,m,o){} ,
                    };

                    $.extend(opts, conf);

                    // install the plugin for each items in jQuery
                    this.each(function() {
                            el = new process_table(this, opts);
                            $(this).data("process_table", el);
                    });

                    return opts.api ? el: this;
            };
////////////////////////////////////////////////////////////////////////////////////////////////
})(jQuery);
