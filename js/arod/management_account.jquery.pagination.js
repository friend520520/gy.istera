/*
            jQuery jclock - jquery.rotate.bala plugin - v 0.0.1
*/
(function($) {
            $.view_getOptionsFromForm = $.view_getOptionsFromForm || {version:'0.1.1'};
            var view_getOptionsFromForm = function(dom,opts) { //[--plugin define
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
                    
                    // opts.focus_2 = $("#Searchresult") ;
                    
                    function pageselectCallback(page_index, jq)
                    {
                            // 从表单获取每页的显示的列表项数目
                            var items_per_page = $("#items_per_page").val();
                            var max_elem = Math.min((page_index+1) * items_per_page, $("#hiddenresult .showing").length);

                            opts.focus_2.html("");
                            // 获取加载元素
                            for(var i=page_index*items_per_page;i<max_elem;i++){
                                    opts.focus_2.append($("#hiddenresult .showing:eq("+i+")").clone());
                            }
                            //阻止单击事件
                            return false;
                    }
                    
                    function getOptionsFromForm()
                    {
                            var opt = {callback: pageselectCallback};
                            // 从文本域中收集参数 - 这些空间名与参数名相对应
                            $("[name=paginationoptions] input:text").each(function(){
                                    opt[this.name] = this.className.match(/numeric/) ? parseInt(this.value) : this.value;
                            });
                            //避免demo重引入HTML
                            var htmlspecialchars ={ "&":"&amp;", "<":"&lt;", ">":"&gt;", '"':"&quot;"}
                            $.each(htmlspecialchars, function(k,v){
                                    opt.prev_text = opt.prev_text.replace(k,v);
                                    opt.next_text = opt.next_text.replace(k,v);
                                    opt.first_text = opt.first_text.replace(k,v);
                                    opt.last_text = opt.last_text.replace(k,v);
                            })
                            return opt;
                    }
                    
                    opts.focus = $( ".padding-content" ) ;
                    
                    function init()
                    {
                                var page_num = opts.page_num ? opts.page_num : "5";
                                opts.focus
                                        .append(
                                        
                                                    '<form name="paginationoptions" style="display: none;">' +
                                                    '        <p><label for="items_per_page">每页显示的列表数：</label><input type="text" value="' + page_num + '" name="items_per_page" id="items_per_page" class="numeric"/></p>' +
                                                    '        <p><label for="num_display_entries">分页链接显示数：</label><input type="text" value="3" name="num_display_entries" id="num_display_entries" class="numeric"/></p>' +
                                                    '        <p><label for="num">起始与结束点的数目：</label><input type="text" value="2" name="num_edge_entries" id="num_edge_entries" class="numeric"/></p>' +
                                                    ///AL0227
                                                    '        <p><label for="first_text">“上一页”标签：</label><input type="text" value="First" name="first_text" id="first_text"/></p>' +
                                                    '        <p><label for="prev_text">“上一页”标签：</label><input type="text" value="Prev" name="prev_text" id="prev_text"/></p>' +
                                                    '        <p><label for="next_text">“下一页”标签：</label><input type="text" value="Next" name="next_text" id="next_text"/></p>' +
                                                    '        <p><label for="last_text">“下一页”标签：</label><input type="text" value="Last" name="last_text" id="last_text"/></p>' +
                                                    '        <input type="button" id="setoptions" value="设置选项" />' +
                                                    '</form>'
                                        
                                        );
                                
                                opts.focus_3.html( '<div id="Pagination" class="pagination"></div>' );
                                opts.focus_1 = $( "[id=Pagination]" ) ;
                                
                                //总数目
                                var length = $("#hiddenresult .showing").length;
                                
                                //如果只有一頁，則不call頁面
                                if( length <= page_num ){
                                        opts.focus_2.html( $("#hiddenresult").html() );
                                }
                                else{
                                        //从表单获取分页元素参数
                                        var optInit = getOptionsFromForm();
                                        opts.focus_1.pagination(length, optInit);
                                        opts.focus_1.after( '<form>\n\
                                                                <input id="Pagination_input" onkeypress="return ( event.charCode >= 48 && event.charCode <= 57 ) || ( event.keyCode == 8 || event.keyCode == 46 )" placeholder="輸入頁碼" class="txt">\n\
                                                                <input id="Pagination_search" type="button" class="button" value="前往">\n\
                                                        </form>' );
                                        
                                        bind();
                                }
                    }
                    
                    
                    function bind()
                    {
                                $("[id=Pagination_search]").click(function(){
                                            
                                            var val = $( this ).prev("[id=Pagination_input]").val();
                                            if( val !== "" ){
                                                    $("[id=Pagination]").trigger('setPage', [parseInt( val )-1]);
                                            }
                                            /*$("#News-Pagination").trigger('setPage', [4]);
                                            $("#News-Pagination").trigger('nextPage');
                                            $("#News-Pagination").trigger('prevPage');
                                            $("#News-Pagination").trigger('currentPage');*/
                                });
                                // 按钮事件
                                $("#setoptions").click(function(){
                                            var opt = getOptionsFromForm();
                                            // 重新创建分页参数
                                            opts.focus_1.pagination(length, opt);
                                });

                    }
                    
                    
                    function destroy()
                    {
                                opts.focus.children( "#Pagination" ).remove();
 opts.focus.children( "#page-switch" ).children().remove();
                    }
                    
            };//--view_getOptionsFromForm
            
            

            // jQuery plugin implementation
            $.fn.view_getOptionsFromForm = function(conf) {

                    // return existing instance
                    var el = this.eq(typeof conf === 'number' ? conf : 0).data("view_getOptionsFromForm");
                    if (el) {return el;}

                    // setup options
                    var opts = {
                                pep         : true ,
                                map_id      : 0,
                                alarm_state : "",
                                create_:function(e,m,o){}
                    };

                    $.extend(opts, conf);

                    // install the plugin for each items in jQuery
                    this.each(function() {
                            el = new view_getOptionsFromForm(this, opts);
                            $(this).data("view_getOptionsFromForm", el);
                    });

                    return opts.api ? el: this;
            };
////////////////////////////////////////////////////////////////////////////////////////////////
})(jQuery);
