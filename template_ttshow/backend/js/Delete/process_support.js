/*
 * a bin ++ 2014.8.4.1300
*/
(function($) {
            $.process_support = $.process_support || {version:'0.0.1'};
            var process_support = function(dom,opts) { //[--plugin define
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
                            $("#SupportModal textarea[data-input='body']").val("");
                            $("#SupportModal div[div-target=account]").html( $.uid );
                            $("#SupportModal [data-target=submit]").unbind( "click" ).bind( "click", function(e) {
                                    send_message();
                            });
                    }
                    
                    function destroy() 
                    {
                    }
                    
                    function send_message()
                    {
                            var Body = {};
                            Body.command = "support";
                            Body.Browser = {};
                            Body.Browser.version = (function(){
                                        var ua= navigator.userAgent, tem, 
                                        M= ua.match(/(opera|chrome|safari|firefox|msie|trident(?=\/))\/?\s*(\d+)/i) || [];
                                        if(/trident/i.test(M[1])){
                                            tem=  /\brv[ :]+(\d+)/g.exec(ua) || [];
                                            return 'IE '+(tem[1] || '');
                                        }
                                        if(M[1]=== 'Chrome'){
                                            tem= ua.match(/\bOPR\/(\d+)/)
                                            if(tem!= null) return 'Opera '+tem[1];
                                        }
                                        M= M[2]? [M[1], M[2]]: [navigator.appName, navigator.appVersion, '-?'];
                                        if((tem= ua.match(/version\/(\d+)/i))!= null) M.splice(1, 1, tem[1]);
                                        return M.join(' ');
                            })();
                            Body.Browser.screen = screen.width + "x" + screen.height;
                            Body.AppBuilder = {};
                            Body.AppBuilder.version = "Appbuilder v1.07";
                            Body.user = {};
                            Body.user.ppn = $.user_profile_uid;                         
                            //Body.user.mail
                            //Body.user.name
                            Body.message = $("#SupportModal [data-input=body]").val();
                            //Body.mail.to
                            //Body.mail.bbc
                            //Body.mail.cc
                            //Body.mail.subject
                            var time = new Date();
                            Body.ticket = "ab" + time.valueOf();
                            console.log(Body);
                            /*
                            $.View.process_mms()._SetOpts({ to : "notify@ypcloud" ,data : { body : Body } , id : "support" });
                            $.View.process_mms().PutMessage();*/
                                    
                                console.log( "PutMM" );
                                $.mm.PutMsg( "notify@ypcloud" , { body : Body } , function( msg ){
                                            console.log( msg ) ;
                                            console.log( 'PutMsg success' );
                                            $.mm.GetMsg( "5000" , msg.MsgID , function( msg ) {
                                                        console.log( 'GetMsg success' );
                                            }
                                            , function( msg ) {
                                                        console.log( 'GetMsg error' );
                                            });

                                } ,  function( msg ){} );
                    }
                    
            };

            // jQuery plugin implementation
            $.fn.process_support = function(conf) {

                    // return existing instance
                    var el = this.eq(typeof conf == 'number' ? conf : 0).data("process_support");
                    if (el) {return el;}

                    // setup options
                    var opts = {
                            Form : "" ,
                            create_:function(e,m,o){} ,
                    };

                    $.extend(opts, conf);

                    // install the plugin for each items in jQuery
                    this.each(function() {
                            el = new process_support(this, opts);
                            $(this).data("process_support", el);
                    });

                    return opts.api ? el: this;
            };
////////////////////////////////////////////////////////////////////////////////////////////////
})(jQuery);
