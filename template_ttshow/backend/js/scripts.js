function supportstorage() 
{
	if (typeof window.localStorage=='object') 
		return true;
	else
		return false;		
}

function handleSaveLayout() {
        console.log( 'handleSaveLayout' );
        var e = $(".demo").html();
        if (!stopsave && e != window.demoHtml) {
                    stopsave++;
                    window.demoHtml = e;
                    saveLayout();
                    stopsave--;
        }
}

var layouthistory; 
function saveLayout(){
            var data = layouthistory;
            if (!data) {
                        data={};
                        data.count = 0;
                        data.list = [];
            }
            if (data.list.length>data.count) {
                        for (i=data.count;i<data.list.length;i++)
                                data.list[i]=null;
            }
            data.list[data.count] = window.demoHtml;
            data.count++;
            if (supportstorage()) {
                        localStorage.setItem("layoutdata",JSON.stringify(data));
            }
            layouthistory = data;
            //console.log(data);
            /*$.ajax({  
                        type: "POST",  
                        url: "/build/saveLayout",  
                        data: { layout: $('.demo').html() },  
                        success: function(data) {
                                //updateButtonsVisibility();
                        }
            });*/
}

function downloadLayout(){
	
            $.ajax({  
                        type: "POST",  
                        url: "/build/downloadLayout",  
                        data: { layout: $('#download-layout').html() },  
                        success: function(data) { window.location.href = '/build/download'; }
            });
}

function downloadHtmlLayout(){
            $.ajax({  
                        type: "POST",  
                        url: "/build/downloadLayout",  
                        data: { layout: $('#download-layout').html() },  
                        success: function(data) { window.location.href = '/build/downloadHtml'; }
            });
}

function undoLayout() {
            var data = layouthistory;
            //console.log(data);
            if (data) {
                        if (data.count<2) return false;
                        window.demoHtml = data.list[data.count-2];
                        data.count--;
                        $('.demo').html(window.demoHtml);
                        if (supportstorage()) {
                                    localStorage.setItem("layoutdata",JSON.stringify(data));
                        }
                        return true;
            }
            return false;
            /*$.ajax({
                        type: "POST",
                        url: "/build/getPreviousLayout",  
                        data: { },  
                        success: function(data) {
                                    undoOperation(data);
                        }
            });*/
}

function redoLayout() {
            var data = layouthistory;
            if (data) {
                    if (data.list[data.count]) {
                            window.demoHtml = data.list[data.count];
                            data.count++;
                            $('.demo').html(window.demoHtml);
                            if (supportstorage()) {
                                    localStorage.setItem("layoutdata",JSON.stringify(data));
                            }
                            return true;
                    }
            }
            return false;
            /*
            $.ajax({  
                    type: "POST",  
                    url: "/build/getPreviousLayout",  
                    data: { },  
                    success: function(data) {
                            redoOperation(data);
                    }
            });*/
}

function handleJsIds() {
            handleModalIds();
            handleAccordionIds();
            handleCarouselIds();
            //handleTabsIds()
}
function handleAccordionIds() {
            var e = $(".demo #myAccordion");
            var t = randomNumber();
            var n = "accordion-" + t;
            var r;
            e.attr("id", n);
            e.find(".accordion-group").each(function(e, t) {
                        r = "accordion-element-" + randomNumber();
                        $(t).find(".accordion-toggle").each(function(e, t) {
                                $(t).attr("data-parent", "#" + n);
                                $(t).attr("href", "#" + r)
                        });
                        $(t).find(".accordion-body").each(function(e, t) {
                                $(t).attr("id", r)
                        })
            })
}
function handleCarouselIds() {
            var e = $(".demo #myCarousel");
            var t = randomNumber();
            var n = "carousel-" + t;
            e.attr("id", n);
            e.find(".carousel-indicators li").each(function(e, t) {
                    $(t).attr("data-target", "#" + n)
            });
            e.find(".left").attr("href", "#" + n);
            e.find(".right").attr("href", "#" + n)
}
/*  */
function handleModalIds() {
            var e = $(".demo #myModalLink");
            var t = randomNumber();
            var n = "modal-container-" + t ;
            var r = "modal-" + t ;
            e.attr("id", r );
            e.attr("href", "#" + n );
            e.next().attr("id", n );
}
function handleTabsIds() {
            var e = $(".demo #myTabs");
            var t = randomNumber();
            var n = "tabs-" + t;
            e.attr("id", n);
            e.find(".tab-pane").each(function(e, t) {
                        var n = $(t).attr("id");
                        var r = "panel-" + randomNumber();
                        $(t).attr("id", r);
                        $(t).parent().parent().find("a[href=#" + n + "]").attr("href", "#" + r)
            });
}

function randomNumber() {
	return randomFromInterval(1, 1e6)
}

function randomFromInterval(e, t) {
	return Math.floor(Math.random() * (t - e + 1) + e)
}

function gridSystemGenerator() {
    
            $(".lyrow .preview input").bind("keyup", function() {
                        var e = 0;
                        var t = "";
                        var n = $(this).val().split(" ", 12);
                        $.each(n, function(n, r) {
                                    e = e + parseInt(r);
                                    t += '<div class="col-md-' + r + ' column"></div>'
                        });
                        if (e == 12) {
                                    $(this).parent().next().children().html(t);
                                    $(this).parent().prev().prev().show()
                        } else {
                                    $(this).parent().prev().prev().hide();
                        }
            })
}
function configurationElm(e, t) {

            $(".demo").delegate(".configuration > a", "click", function(e) {
                        e.preventDefault();
                        var t = $(this).parent().next().next().children();
                        $(this).toggleClass("active");
                        t.toggleClass($(this).attr("rel"))
            });
            
            //abin 20140616 edit ++ 
            //++bohan // image Thumbnails
            //++HAO  //20140609 thumbnail html+-
            $('body.edit .demo').on("click","[data-target=#add_quantities]",function(e) {
                        e.preventDefault();
                        $.View.view_thumbnails()._SetOpts({ target : $(this).parent().parent().find(".view .row") });
                        $.View.view_thumbnails().add_thumbnails();
            });
            $('body.edit .demo').on("click","[data-target=#sub_quantities]",function(e) {
                        e.preventDefault();
                        $.View.view_thumbnails()._SetOpts({ target : $(this).parent().parent().find(".view .row") });
                        $.View.view_thumbnails().delete_thumbnails();
            });
            //--bohan
            //++HAO  //20140609 thumbnail html+-
            //abin 20140616 edit --
            
            // menu
            $(".demo").delegate(".configuration .dropdown-menu a", "click", function(e) {
                        e.preventDefault();
                        var t = $(this).parent().parent(); // not-class="audio-type"
                        var n = t.parent().parent().next().next().children();
                        
                                    console.log( t.attr( "not-class" ) );
                                    var tmp_select_index = this.rel ;
                                    if( tmp_select_index == "h1" )
                                    {
                                                n.html( '<h1 contenteditable="true" style="font-size: 36px;">' + n.children().html() + '</h1>' );
                                    }
                                    else if( tmp_select_index == "h2" )
                                    {
                                                n.html( '<h2 contenteditable="true" >' + n.children().html() + '</h2>' );
                                    }
                                    else if( tmp_select_index == "h3" )
                                    {
                                                n.html( '<h3 contenteditable="true" >' + n.children().html() + '</h3>' );
                                    }
                                    else if( tmp_select_index == "h4" )
                                    {
                                                n.html( '<h4 contenteditable="true" >' + n.children().html() + '</h4>' );
                                    }
                                    else if( tmp_select_index == "h5" )
                                    {
                                                n.html( '<h5 contenteditable="true" >' + n.children().html() + '</h5>' );
                                    }
                                    else if( tmp_select_index == "h6" )
                                    {
                                                n.html( '<h6 contenteditable="true" >' + n.children().html() + '</h6>' );
                                    }
                                    
                                    
                                    //++ bohan 2014.3.19 audio_dropdown
                                    else if ( $(this).html() == "Ogg")
                                    {
                                                n.attr("src","http://www.hmes.kh.edu.tw/~jona/infoteach/multimedia/audiosample/sample1.ogg");
                                                n.attr("type","audio/ogg");
                                    }
                                    else if ( $(this).html() == "Mp3")
                                    {
                                                n.attr("src","http://www.hmes.kh.edu.tw/~jona/infoteach/multimedia/audiosample/sample2.mp3");
                                                n.attr("type","audio/mpeg");
                                    }
                                    else if ( $(this).html() == "Wav")
                                    {
                                                n.attr("src","http://billor.chsh.chc.edu.tw/sound/ccheer.wav");
                                                n.attr("type","audio/wav");
                                    }
                                    //++ bohan 2014.3.21 thumbnails_dropdown
                                    if ( $(this).parent().parent().attr("dropdown-type") == "thumbnails_quantities" )
                                    {
                                                var addlength = parseInt($(this).html()) - n.find("li").length;
                                                var addarray = new Array(parseInt($(this).html()));
                                                var minusarray = new Array(parseInt(Math.abs(addlength)));

                                                if (addlength>=0)
                                                {
                                                        $.each( addarray , function(index, value) {
                                                            if (index >= n.find("li").length){ 
                                                                //n.append("<li class=span4>" + 
                                                                n.append("<li class=col-md-12>" + // modify by jack
                                                                         "<div class=thumbnail> <img alt=300x200 src='http://cdn.ypcall.com/Builder/PD/Thumbnails/Thumbnails01.jpg'>" +
                                                                         "<div class=caption contenteditable=true>" +
                                                                         "<h3>Title</h3>" +
                                                                         "<p>This is a text.</p>" +
                                                                         "<p><a class='btn btn-primary' href=#>Action</a> <a class=btn href=#>Share</a></p>" +
                                                                         "</div>" +
                                                                         "</div>" +
                                                                         "</li>"
                                                                         );
                                                                }
                                                        });
                                                }
                                                else
                                                {   
                                                            var removearray = n.find("li").length - 1 ;
                                                            $.each( minusarray , function(index, value) {
                                                                        n.find("li")[removearray].remove();
                                                                        removearray--;
                                                            });
                                                }
                                                //remove size .active
                                                t.parent().prev().find("li").removeClass("active");
                                                var x = parseInt($(this).html())-1
                                                t.parent().prev().find("li:eq(" + x + ")").addClass("active"); 
                                                //change all cssloadsize
                                                n.find("li").removeClass();
                                                n.find("li").addClass("span_thumbnails" + parseInt($(this).html()));
                                    }
                                    if ($(this).parent().parent().attr("dropdown-type")=="thumbnails_size")
                                    {
                                                n.find("li").removeClass();
                                                n.find("li").addClass("span_thumbnails" + parseInt($(this).html()));
                                    }
                                    //-- bohan 2014.3.21
                                    
                                    //++ bohan 2014.3.21 tabs_dropdown
                                    if ($(this).parent().parent().attr("dropdown-type")=="tabs_quantities")
                                    {
                                                $.View.view_tabs()._SetOpts({ n : n , focus : $(this) });
                                                $.View.view_tabs().quantities();
                                    }
                                    //-- bohan 2014.3.21
                        
                                    //++ bohan 2014.3.21 Image Slider_dropdown
                                    if ($(this).parent().parent().attr("dropdown-type")=="images slider_quantities")
                                    {
                                                var addlength = parseInt($(this).html()) - n.find("li").length;
                                                var addarray = new Array(parseInt($(this).html()));
                                                var minusarray = new Array(parseInt(Math.abs(addlength)));

                                                if (addlength>=0)
                                                {
                                                            $.each( addarray , function(index, value) {
                                                                        if (index >= n.find("li").length){ 
                                                                                    n.children("ol").append(
                                                                                    "<li data-slide-to='" + index + "' data-target='#myCarousel' class=''></li>"
                                                                                    );
                                                                                    n.children("div").append(
                                                                                    "<div class='item'> <img alt='' src='img/1.jpg'>" +
                                                                                    "<div class='carousel-caption' contenteditable='true'>" +
                                                                                    "<h4>Baseball</h4>" +
                                                                                    "<p>Baseball is a kind of stick to play as the main features of the collective, confrontational strong ball games in the United States, Japan is particularly prevalent. </p>" +
                                                                                    "</div>" +
                                                                                    "</div>"
                                                                                    );
                                                                        }
                                                            });
                                                }
                                                else
                                                {   
                                                            var removearray = n.children("ul").children("li").length - 1 ;
                                                            $.each( minusarray , function(index, value) {
                                                                        n.children("ol").children()[removearray].remove();
                                                                        n.children("div").children()[removearray].remove();
                                                                        removearray--;
                                                            });
                                                }
                                                //add restart p1
                                                n.children("ol").children().removeClass();
                                                n.children("ol").children(":eq(0)").addClass("active");
                                                n.children("div").children().attr("class","item");
                                                n.children("div").children(":eq(0)").addClass("active");
                                    }
                                    //-- bohan 2014.3.21
                        
                                    //++ bohan 2014.3.21 Collapse_dropdown
                                   if ($(this).parent().parent().attr("dropdown-type")=="collapse_quantities")
                                   {
                                                var addlength = parseInt($(this).html()) - n.children().length;
                                                var addarray = new Array(parseInt($(this).html()));
                                                var minusarray = new Array(parseInt(Math.abs(addlength)));


                                                if (addlength>=0)
                                                {   
                                                    $.each( addarray , function(index, value) {
                                                        var r = randomNumber();
                                                        if (index >= n.children().length){ 
                                                            n.append(
                                                            "<div class='accordion-group'>"+
                                                            "<div class='accordion-heading'> <a class='accordion-toggle' data-toggle='collapse' data-parent=#" + n.attr("id") + " href='#accordion-element-" + r + "' contenteditable='true'> Collapsible Group Item #" + (index+1) + " </a> </div>" +
                                                            "<div id='accordion-element-" + r + "' class='accordion-body collapse'>" +
                                                            "<div class='accordion-inner' contenteditable='true'> Function Block </div>" +
                                                            "</div>" +
                                                            "</div>"
                                                            );
                                                        }
                                                    });
                                                }
                                                else
                                                {   
                                                    var removearray = n.children().length - 1 ;
                                                    $.each( minusarray , function(index, value) {
                                                                n.children("div")[removearray].remove();
                                                                removearray--;
                                                    });
                                                }
                                   }
                                    if ($(this).parent().parent().attr("dropdown-type")==="Alert_Button")
                                    {
                                                if( $(this).attr("value") === "" )
                                                            n.parent().find(".modal-dialog").removeClass( "modal-" + t.children("li.active").children().attr("value") );
                                                else
                                                {
                                                            n.parent().find(".modal-dialog").removeClass( "modal-" + t.children("li.active").children().attr("value") );
                                                            n.parent().find(".modal-dialog").addClass( "modal-" + $(this).attr("value") );
                                                }
                                    }
                                   //-- bohan 2014.3.21
                                   //++ bohan 2014.7.15
                                    if ( $(this).parent().parent().attr("dropdown-type") === "NavbarAlign" )
                                    {
                                                if( $(this).attr("value") === "Left" )
                                                {
                                                            n.removeClass( "navbar-right" );
                                                            n.addClass( "navbar-left" );
                                                }
                                                else if( $(this).attr("value") === "Right" )
                                                {
                                                            n.removeClass( "navbar-left" );
                                                            n.addClass( "navbar-right" );
                                                }
                                    }
                                    //-- bohan 2014.7.15
                                    //++ bohan 2014.7.16
                                    if ( $(this).parent().parent().attr("dropdown-type") === "Form4_Permutation" )
                                    {
                                                if( $(this).attr("value") === "vertical" )
                                                {
                                                    n.children("label").css("display","block");
                                                }
                                                else if( $(this).attr("value") === "horizon" )
                                                {
                                                    n.children("label").css("display","inline-block");
                                                }
                                    }
                                    if ( $(this).parent().parent().attr("dropdown-type") === "Form7_Type" )
                                    {
                                                if( $(this).attr("value") === "Basic" )
                                                {
                                                    n.find("select").attr( "size" , 0 );
                                                }
                                                else if( $(this).attr("value") === "Multiple" )
                                                {
                                                    n.find("select").attr( "size" , n.find("select option").length );
                                                }
                                    }
                                    if ( $(this).parent().parent().attr("dropdown-type") === "FormButtonAlign" )
                                    {
                                                if( $(this).attr("value") === "Left" )
                                                {
                                                    n.removeClass("pull-right");
                                                    n.addClass("pull-left");
                                                }
                                                else if( $(this).attr("value") === "Right" )
                                                {
                                                    n.removeClass("pull-left");
                                                    n.addClass("pull-right");
                                                }
                                    }
                                    //-- bohan 2014.7.16
                        //-- bohan 2014.3.19
                        
                        t.find("li").removeClass("active");
                        $(this).parent().addClass("active");
                        
                        var r = "";
                        t.find("a").each(function() {
                                    r += $(this).attr("rel") + " "
                        });
                        
                        t.parent().removeClass("open");
                        // a bin edit 2014.6.10 ++         edit style button
                        var view = $(this).parent().parent().parent().parent().nextAll(".view");
                        if( view.find("[mmtype]")[0] != undefined ) {
                                view.find("img").removeClass(r);
                                view.find("img").addClass($(this).attr("rel"));
                        }
                        else {
                                view.find("[data-div=img]").removeClass(r);
                                view.find("[data-div=img]").addClass("button-3D " + $(this).attr("rel"));
                        }
                        // a bin edit 2014.6.10 --
                        //++ HAO 20140609
                        //bohan++20140729
                        if ( $(this).parent().parent().attr("dropdown-type") === "default" )
                        {
                                n.removeClass(r);
                                n.addClass($(this).attr("rel"));
                        }
                        //bohan--20140729
            });
            
}
function removeElm() {
                
            $(".demo").delegate(".remove", "click", function(e) {
                        
                        //$.View.view_destroy_determine()._SetOpts({  this :  this } );
                        //$.View.view_destroy_determine().action_destroy_determine();

                        e.preventDefault();
                        $(this).parent().remove();
                        if (!$(".demo .lyrow").length > 0) {
                                    clearDemo()
                        }
            });
}

function clearDemo() {
            $(".demo").empty();
            layouthistory = null;
            if (supportstorage())
                        localStorage.removeItem("layoutdata");
}

function removeMenuClasses() {
            $("#menu_layoutit li button").removeClass("active")
}

function changeStructure(e, t) {
            $("#download-layout ." + e).removeClass(e).addClass(t)
}

function cleanHtml(e) {
            //console.log( e );
            $(e).parent().append( $(e).children().html() );
}
function downloadLayoutSrc() {

            $(".demo").children().attr( 'focus_templatename' , $.focus_templatename );
            $("#download-layout").children().html( $(".demo").html() ); // **************
            
    
            // ++ jack destroy
            $.all_data_inEdit.img = {};
            $.all_data_inEdit.movie = {};
            var img_index = 0;
            var ifame_index = 0;
            $.each( $( "#download-layout [mmid=1]" ) , function( index , value ) {
                        /* a bin ++ 2014.0408.1500 */
                        //$.View.view_publish_remove()._SetOpts({ value : $( value ), mmtype : eval( $( value ).attr( "mmtype" ) ) });
                        //$.View.view_publish_remove().init();
                        console.log( value );
                        console.log($(value).prop("tagName"));
                        var tag = $( value );
                        if( tag.prop("tagName") == "IMG" ) {
                                var src = tag.attr("src");
                                src = src.substr(src.lastIndexOf("/")+1,src.length);
                                var src_type = src.split(".")[1];///bohan++
                                tag.attr("img_index", img_index );

                                var tag_count = 0;
                                var tag_src = "";
                                var tag_http = "";
                                var get_ = function( src , count ) {
                                    if( src.indexOf("../") != -1 ) {
                                        src = src.replace("../","");
                                        count++;
                                        get_( src , count );
                                    } else {
                                        tag_src = src;
                                        tag_count = count;
                                        return 0;
                                    }
                                };
                                var release_get_ = function( src , count ) {
                                    if( count != -1 ) {
                                        src = src.substr( 0 , src.lastIndexOf("/") );
                                        count--;
                                        release_get_( src , count );
                                    } else {
                                        tag_http = src + "/";
                                        return 0;
                                    }
                                }
                                if( tag.attr("src").indexOf("../") != -1 ) {
                                    var img_src = get_( tag.attr("src") , 0 );
                                    var http = release_get_( window.location.href  , tag_count );
                                    tag_src = tag_http + tag_src;
                                    console.log("!!!");
                                    console.log( tag_src );
                                } else {
                                    tag_src = tag.attr("src");
                                }

                                $.all_data_inEdit.img[img_index] = tag_src;
                                //tag.attr("src" , "image_" + img_index );
                                tag.attr("src" , "image_" + img_index + "." + src_type );//bohan++
                                tag.css("max-width","100%");
                                img_index++;
                        } else if( tag.prop("tagName") == "IFRAME" ) {
                                $.all_data_inEdit.movie[ifame_index] = tag.attr("src");
                                ifame_index++;
                        }
                        //$.all_data_inEdit.img = [];
                        //$.all_data_inEdit.movie = [];
                        /* a bin -- 2014.0408.1500 */
            });
            
            console.log( $.all_data_inEdit );
            // --
            
            var e = "";
            var t = $("#download-layout").children();
            
            t.find( "[contenteditable=true]" ).attr( "contenteditable" , "false" );
            
            // ++ jack 20140331 tab
            t.find( "input[type=text]" ).each(function() {
                        console.log( $(this).attr( "id" ) );
                        $(this).val( $(this).val() );
            });
            t.find( ".box-element" ).addClass( "lyrow" );
            
            // --
            
            // ++ jack 20140710 event timeline destory
            t.find( ".timelineContainer" ).find( ".open" ).removeClass( "open" );
            // --
            
            
            
            
            t.find(".preview, .configuration, .drag, .remove").remove();
            t.find(".lyrow").addClass("removeClean");
            t.find(".box-element").addClass("removeClean");
            
            t.find(".lyrow .lyrow .lyrow .lyrow .lyrow .removeClean").each(function() {
                        cleanHtml(this)
            });
            t.find(".lyrow .lyrow .lyrow .lyrow .removeClean").each(function() {
                        cleanHtml(this)
            });
            t.find(".lyrow .lyrow .lyrow .removeClean").each(function() {
                        cleanHtml(this)
            });
            t.find(".lyrow .lyrow .removeClean").each(function() {
                        cleanHtml(this)
            });
            t.find(".lyrow .removeClean").each(function() {
                        cleanHtml(this)
            });
            t.find(".removeClean").each(function() {
                        cleanHtml(this)
            });
            
            console.log( $(".demo").find(".removeClean") );
            t.find(".removeClean").remove();
            
            $("#download-layout .column").removeClass("ui-sortable");
            $("#download-layout .row").removeClass("clearfix").children().removeClass("column");
            $("#download-layout .row-fluid").removeClass("clearfix").children().removeClass("column");
            /* hao 0520 row-fluid */
            
            /*bohan++ 20140825*/
            $.each( $("#download-layout .row-fluid") , function( index , value ){
                    
                    if( $(value).children().attr("style") !== undefined && $(value).children().attr("style") !== "" )
                    {
                            $(value).attr( "style" , $(value).children().attr("style") );
                            $(value).children().attr( "style" , "" );
                    }
                    
            });
            /*bohan-- 20140825*/
            
            if ( $("#download-layout .container-full").length > 0 )
            {
                        changeStructure("row-fluid", "row");
            }
            
            /*var a = $("#download-layout").html();
            a = a.split("col-md-12");
            a[0] = a[0] + a[1];
            a.splice(1,1);
            a = a.join("col-md-12");
            console.log( a );*/
            
            formatSrc = $("#download-layout").html() ;
            
            /*
            formatSrc = $.htmlClean( $("#download-layout").html() , {
                        format      : true,
                        allowedAttributes: 
                        [
                                    ["id"],
                                    ["class"],
                                    ["data-toggle"],
                                    ["data-target"],
                                    ["data-parent"],
                                    ["role"],
                                    ["data-dismiss"],
                                    ["aria-labelledby"],
                                    ["aria-hidden"],
                                    ["data-slide-to"],
                                    ["data-slide"],
                                    
                                    ["mmtype"],                     // mmtype         jack
                                    ["mmid"],                       // mmid           jack
                                    ["mmobj"],                      // mmobj          jack
                                    ["mmmark"]                      // mmmark         jack
                        ]
            });
            */
           
            $("#download-layout").html( formatSrc );
            $("#publishModal textarea").empty();
            // ++ jack
            
            
            if( $.focus_projectname == undefined )
            {
                    var tmp_projectname = '' ;
            }else{
                    var tmp_projectname = $.focus_projectname ;
            }
            //bohan20140729 Annotation
            /*
            if( $.focus_cssname == undefined )
            {
                        var tmp_cssname = '' ;
            }else{
                        var tmp_cssname = $.focus_cssname ;
            }*/
            
            
            //var tmp_url = 'http://la32.ypcall.com/designermarket/appbuilder/';
            //var tmp_url = 'http://ypcloud.com/appbuilder/';
            var tmp_url = 'http://203.66.57.146/ttshow/include_file/';
            var tmp_url_css = tmp_url;
            /*
            if( location.host == "la32.ypcall.com" )
            {
                        var tmp_url_css = 'http://la32.ypcall.com/designermarket/appbuilder/';
            }else{
                        var tmp_url_css = 'http://ypcloud.com/appbuilder/';
            }
            */  
            
            var tmp_html =
            '<html>\n' +
            '<head>\n' +
            '       <meta charset="utf-8">\n' +

            '       <meta name="viewport" content="width=device-width, initial-scale=1.0">\n' +
            '       <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">\n'   +
            '       <meta name = "viewport" content="width=device-width, initial-scale=1, maximum-scale = 1.0, user-scalable = 0" />\n' +
            '       <meta name="apple-mobile-web-app-capable" content="yes" />\n' +
            '       <meta name="app-mobile-web-app-capable" content="yes" />\n' +
            '       <meta name="apple-mobile-web-app-status-bar-style" content="black" />\n' +
            '       <meta name="apple-touch-fullscreen" content="yes" />\n' +
            '       <link class="icon" href="appprofile/main.png" rel="apple-touch-icon-precomposed" />\n' +
            '       <link class="icon" href="appprofile/main.png" rel="SHORTCUT ICON" />\n' +
            '       <link rel="shortcut icon" href="appprofile/main.png">\n' +
            '       \n' +

            '       <title> ' + tmp_projectname + ' </title>\n' +
            '       \n' +
/*
            '        <link href="http://' + $.publish_domain + '/' + $.uid + '/builder/' + tmp_projectname + '/css/extent.css" rel="stylesheet">\n' +
            '        <link href="http://' + $.publish_domain + '/' + $.uid + '/builder/@DesignerTemplate/' + $.focus_templatename + '/css/extent.css" rel="stylesheet">\n' +
*/
            '        <link href="' + tmp_url_css + 'css/all.css" rel="stylesheet">\n' +
        
            '        <script type="text/javascript" src="' + tmp_url + 'js/jquery-2.0.0.min.js"></script>\n' +
            '        <script type="text/javascript" src="' + tmp_url + 'js/all_s.js"></script>\n' +
//            '        <script type="text/javascript" src="' + tmp_url + 'js/jquery.htmlClean.js"></script>\n' +
            // a bin ++ 2014.0423.1200
            //'        <script type="text/javascript" src="' + tmp_url + 'ckeditor/ckeditor.js"></script>\n' +
            //'        <script type="text/javascript" src="' + tmp_url + 'ckeditor/config.js"></script>\n' +
            //'        <script type="text/javascript" src="' + tmp_url + 'js/DataSource/process_image_slider_tv.js"></script>\n' +
            //'        <script type="text/javascript" src="' + tmp_url + 'js/DataSource/view_image_slider_tv.js"></script>\n' +
            // a bin -- 2014.0423.1200
            //'        <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?libraries=places&sensor=false&libraries=visualization"></script>\n' +
/*            
            '        <script type="text/javascript" src="' + tmp_url + 'js/all_ypcloud_layer_org.js"></script>\n' +
            '        <script type="text/javascript" src="' + tmp_url + 'js/all_ypcloud_layer_fliper.js"></script>\n' +
            '        <script type="text/javascript" src="' + tmp_url + 'js/destroy_determine.js"></script>\n' +

            '        <script type="text/javascript" src="' + tmp_url + 'js/view_flipper.js"></script>\n' +
            '        <script type="text/javascript" src="' + tmp_url + 'js/view_create_app.js"></script>\n' +
            // a bin ++ 2014.0423.1200 
            '        <script type="text/javascript" src="' + tmp_url + 'js/Widget_Map/view_google_map.js"></script>\n' +
            '        <script type="text/javascript" src="' + tmp_url + 'js/Widget_Map/process_google_map.js"></script>\n' +
            '        <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?libraries=places&sensor=false&libraries=visualization"></script>\n' +
    
            '        <script type="text/javascript" src="' + tmp_url + 'js/view_kline.js"></script>\n' +
            '        <script type="text/javascript" src="' + tmp_url + 'js/ajaxq.js"></script>\n' +
*/    
            //'        <script type="text/javascript" src="' + tmp_url + 'js/view_plugin_demo.js"></script>\n' +
            //'        <script type="text/javascript" src="' + tmp_url + 'js/jPK/jPK_1.js"></script>\n' +
/*            
            '        <script type="text/javascript" src="' + tmp_url + 'js/DataSource/modal_router.js"></script>\n' +

            '        <script type="text/javascript" src="' + tmp_url + 'js/DataSource/view_image.js"></script>\n' +
            '        <script type="text/javascript" src="' + tmp_url + 'js/DataSource/view_image_text_H.js"></script>\n' +
            '        <script type="text/javascript" src="' + tmp_url + 'js/DataSource/view_image_text_V.js"></script>\n' +
            '        <script type="text/javascript" src="' + tmp_url + 'js/DataSource/view_image_slider.js"></script>\n' +
            '        <script type="text/javascript" src="' + tmp_url + 'js/DataSource/view_thumbnails.js"></script>\n' +

            '        <script type="text/javascript" src="' + tmp_url + 'js/DataSource/process_image.js"></script>\n' +
            '        <script type="text/javascript" src="' + tmp_url + 'js/DataSource/process_image_text_H.js"></script>\n' +
            '        <script type="text/javascript" src="' + tmp_url + 'js/DataSource/process_image_text_V.js"></script>\n' +
            '        <script type="text/javascript" src="' + tmp_url + 'js/DataSource/process_thumbnails.js"></script>\n' +
            '        <script type="text/javascript" src="' + tmp_url + 'js/DataSource/process_image_slider.js"></script>\n' +

            '        <script type="text/javascript" src="' + tmp_url + 'js/dashboard/view_pie.js"></script>\n' +
            '        <script type="text/javascript" src="' + tmp_url + 'js/dashboard/view_column.js"></script>\n' +
            '        <script type="text/javascript" src="' + tmp_url + 'js/dashboard/view_line.js"></script>\n' +
            '        <script type="text/javascript" src="' + tmp_url + 'js/timeline/view_timeline_h.js"></script>\n' +
            '        <script type="text/javascript" src="' + tmp_url + 'js/dashboard/process_pie.js"></script>\n' +
            '        <script type="text/javascript" src="' + tmp_url + 'js/dashboard/process_column.js"></script>\n' +
            '        <script type="text/javascript" src="' + tmp_url + 'js/dashboard/process_line.js"></script>\n' +
            '        <script type="text/javascript" src="' + tmp_url + 'js/dashboard/process_timeline.js"></script>\n' +
            
            '        <script type="text/javascript" src="http://code.ypcloud.com/mms/js/mms.js"></script>\n' +
            '        <script type="text/javascript" src="' + tmp_url + 'js/mms/process_mms.js"></script>\n' +
            '        <script type="text/javascript" src="' + tmp_url + 'js/IOTpanel/process_panel_fan.js"></script>\n' +

            '        <script type="text/javascript" src="' + tmp_url + 'js/timeliner/colorbox.js"></script>\n' +
            '        <script type="text/javascript" src="' + tmp_url + 'js/timeliner/timeliner.js"></script>\n' +
            '        <script type="text/javascript" src="' + tmp_url + 'js/timeline/view_timeline_v.js"></script>\n' +


            '        <script type="text/javascript" src="' + tmp_url + 'js/layout/view_texthandover.js"></script>\n' +


            '        <script type="text/javascript" src="' + tmp_url + 'js/Layout/view_description.js"></script>\n' +
            '        <script type="text/javascript" src="' + tmp_url + 'js/Layout/process_description.js"></script>\n' +
            
            '        <script type="text/javascript" src="' + tmp_url + 'js/layout/view_video_audio.js"></script>\n' +
            '        <script type="text/javascript" src="' + tmp_url + 'js/layout/process_video_audio.js"></script>\n' +
*/

            //'        <script type="text/javascript" src="' + tmp_url + 'js/abin_global_call_back_function.js"></script>\n' +
/*            
            '        <script type="text/javascript" src="' + tmp_url + 'js/view_form.js"></script>\n' +
            '        <script type="text/javascript" src="' + tmp_url + 'js/process_table.js"></script>\n' +
            '        <script type="text/javascript" src="' + tmp_url + 'js/view_table.js"></script>\n' +
            
            '        <script type="text/javascript" src="' + tmp_url + 'js/Form/view_Drinkform.js"></script>\n' +
            '        <script type="text/javascript" src="' + tmp_url + 'js/Form/view_Set.js"></script>\n' +
            
            //bohan 7/24 ++
            '        <script type="text/javascript" src="' + tmp_url + 'js/view_camera.js"></script>\n' +
            '        <script type="text/javascript" src="' + tmp_url + 'js/view_widget_upload.js"></script>\n' +
            //bohan 7/24 --
            // a bin -- 2014.0423.1200
            '        <script type="text/javascript" src="' + tmp_url + 'js/document_ready_release.js"></script>\n' +
            '        <script type="text/javascript" src="http://' + $.publish_domain + '/' + $.uid + '/builder/' + $.focus_projectname + '/js/app.js"></script>\n' +
            
            '        <script type="text/javascript" src="http://code.ypcloud.com/comm/receiver.js"></script>\n' +
*/            
            '</head>\n' +
            //bohan20140729 Annotation
            //'<body class="myclassfor' + tmp_projectname.split(" ").join("") + ' myclassfor' + tmp_cssname.toLowerCase() + '" style="min-height: 660px; cursor: auto; background-image:url(' + $( "#backgroundImageBody" ).val() + '); background-color:url(' + $( "#backgroundColorBody" ).val() + '); " class="edit">\n' +
            //'<body class="" style="margin: 0px; overflow-x:hidden; min-height: 660px; cursor: auto; background-image:url(' + $( "#backgroundImageBody" ).val() + '); background-color:url(' + $( "#backgroundColorBody" ).val() + '); " class="edit">\n' +
            '<body class="" style="margin: 0px; overflow-x:hidden; min-height: 660px; cursor: auto;" class="edit">\n' +
            // jack add "overflow-x:hidden;"
            formatSrc + '\n' +
/*                    
            '<footer id="ypcloudfooter" >' +
                        '<p style="text-align:center;"> <br><br>Design by <a href="http://www.ypcloud.com/appbuilder" >@AppBuilder</a> </p>' +
            '</footer>' +
*/            
            '</body>\n' +
            '</html>\n' ;
            
            
            $("#publishModal").data( "tmp_html" , tmp_html );
            //$("#publishModal textarea").val( tmp_html );
            $("#publishModal input:eq(1)").val( $.focus_projectname );
            $("#publishModal textarea").val( 'http://' + $.publish_domain + '/' + $.uid + '/builder/' + $.focus_projectname );
            
            // abin edit 2014.6.24 ++
            $("#shareModal_mms input[data-input='to']").val("");
            $("#shareModal_mms textarea[data-input='body']").val("");
            // abin edit 2014.6.24 --
}

var currentDocument = null;
var timerSave = 1000;
var stopsave = 0;
var startdrag = 0;
var demoHtml = $(".demo").html();
var currenteditor = null;

$(window).resize(function() {
            $("body").css("min-height", $(window).height() - 90);
            $(".demo").css("min-height", $(window).height() - 160)
});

function restoreData(){
            if (supportstorage()) 
            {
                        layouthistory = JSON.parse(localStorage.getItem("layoutdata"));
                        if (!layouthistory) return false;
                        window.demoHtml = layouthistory.list[layouthistory.count-1];
                        if (window.demoHtml) $(".demo").html(window.demoHtml);
            }
}

function initContainer()
{
    
            $(".demo, .demo .column").attr( "hassortable" , "true" );

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
            configurationElm();
            
}




$.builder_container_destroy = function builder_container_destroy()
{
            
            if( $(".demo, .demo .column").attr( "hassortable" ) != undefined || $(".demo, .demo .column").attr( "hassortable" ) == true  )
            {
                        $(".demo, .demo .column").attr( "hassortable" , "false" );
                        $(".demo, .demo .column").sortable( "destroy" );
            }
            
}

$.builder_container_init = function builder_container_init()
{
    
    
        // +++ abin > $.View.view_main_container().init_bind();
        //  this javascript is init event ( always open  project )
        // ---
        $.View.view_sidebar().init_bind();
        //$.View.view_texthandover().init();

	/*CKEDITOR.disableAutoInline = true;
	restoreData();
	var contenthandle = CKEDITOR.replace( 'contenteditor' ,{
                    language: 'en',
                    //contentsCss: ['css/layoutit/bootstrap-combined.min.css'],
                    allowedContent: true

	});*/

	$("body").css("min-height", $(window).height() - 90);
	$(".demo").css("min-height", $(window).height() - 160);
        
        /** test **/
        
	initContainer();
        /* a bin ++ 2014.0612.1500 */
	
	$('body.edit .demo').on("click","[data-target=#3Dbutton_URL]",function(e) {
                            e.preventDefault();
                            currenteditor = $(this).parent().parent().find('.view');
                            $.View.process_3Dbutton()._SetOpts({ target : currenteditor.children().find(".button-3D") });
                            $.View.process_3Dbutton().init();
                            e.preventDefault();
	});
        
	$('body.edit .demo').on("click","[data-target=#abin_TableData]",function(e) {
                            e.preventDefault();
                            currenteditor = $(this).parent().parent().find('.view');
                            $.View.process_table()._SetOpts({ target : currenteditor.find("Table") });
                            $.View.process_table().init();
                            e.preventDefault();
	});
        
	$('body.edit .demo').on("click","[data-target=#myModalforiframe]",function(e) {
                            e.preventDefault();
                            currenteditor = $(this).parent().parent().find('.view');
                            /*
                            if( currenteditor.find("VIDEO").prop("tagName") == "VIDEO") {
                                    $.View.process_media_video()._SetOpts({ target : currenteditor.find("VIDEO") });
                                    $.View.process_media_video().init();
                            }
                            else if( currenteditor.find("audio").prop("tagName") == "AUDIO") {
                                    $.View.process_media_audio()._SetOpts({ target : currenteditor.find("audio") });
                                    $.View.process_media_audio().init();
                            }
                            */
                            if( currenteditor.find("iframe").prop("tagName") == "IFRAME") {
                                    if( currenteditor.find("iframe").attr("mmtype") == "['youtube']" ) {
                                            $("#myModalforiframeTitle").html(" IFRAME ");
                                            $("#myModalforiframeBody .checkbox").html(" IFrame Link Url ");
                                            $("#Inputiframe").val( $(this).parents().parents().parents().eq(0).find(".view iframe").attr("src") );
                                            $.View.process_media_youtube()._SetOpts({ target : currenteditor.find("iframe") });
                                            $.View.process_media_youtube().init();
                                    }
                                    else {
                                            $.View.process_iframe()._SetOpts({ target : currenteditor.find("iframe") });
                                            $.View.process_iframe().init();
                                    }
                            } else if( $(this).parents().parents().parents().eq(0).find(".view img").prop("tagName") == "IMG" ) {
                                    $("#myModalforiframeTitle").html(" IMG ");
                                    $("#myModalforiframeBody .checkbox").html(" Img Link Url ");
                                    $("#Inputiframe").val( $(this).parents().parents().parents().eq(0).find(".view img").attr("src") );
                                    $.View.process_media_youtube()._SetOpts({ target : $(this).parents().parents().parents().eq(0).find(".view img") });
                                    $.View.process_media_youtube().init();
                            }
                            e.preventDefault();
	});
        
	$('body.edit .demo').on("click","[data-target=#myModalforPageNextPrev]",function(e) {
                            e.preventDefault();
                            currenteditor = $(this).parent().parent().find('.view');
                            $.View.process_pagehandover()._SetOpts({ target : currenteditor.children() });
                            $.View.process_pagehandover().init();
                            e.preventDefault();
	});
	
	$('body.edit .demo').on("click","[data-target=#myModalaaa]",function(e) {
                            e.preventDefault();                            
                            currenteditor = $(this).parent().parent().find('.view');
                            $.View.modal_router()._SetOpts({    mmtype : currenteditor.find( "[mmid=1]" ).attr( "mmtype" )  , 
                                                                mmobj  : currenteditor.find( "[mmid=1]" ).attr( "mmobj"  )  ,
                                                                target : currenteditor.children() });
                            $.View.modal_router().init();
                            e.preventDefault();
                            //$.View.modal_router().datasource_dom_reset();
	});
        
        
        
        
        // ++ bohan2014.6.27
        $('body.edit .demo').on("click","[data-target=#myModalData]",function(e) {
                            e.preventDefault();
                            currenteditor = $(this).parent().parent().find('.view');
                            $.View.modal_router()._SetOpts({    mmtype : currenteditor.find( "[mmid=1]" ).attr( "mmtype" )  , 
                                                                mmobj  : currenteditor.find( "[mmid=1]" ).attr( "mmobj"  )  ,
                                                                target : currenteditor.children() ,
                                                                button : "Data"
                                                            });
                            $.View.modal_router().init();
                            e.preventDefault();
                            //$.View.modal_router().datasource_dom_reset();
            /*
                    e.preventDefault();
                    
                    var DataLoad = $(this).parent().parent().find(".view div").attr("mmobj");
                    var StatisticsName = "" ;
                    var StatisticsValue = "" ;
                    
                    if( eval( $(this).parent().parent().children(".view").children().attr("mmtype") )[1] === "pie" ){
                            $("#myModalData .modal-body").html("<div class='row'>" +
                                    "<div class='col-xs-3 col-sm-3 col-md-3 col-lg-3'>" +
                                    "<div>NAME</div>" +
                                    "</div>" +
                                    "<div class='col-xs-9 col-sm-9 col-md-9 col-lg-9'>" +
                                    "<input type='text' placeholder='' class='input-xxlarge' id='DashboardStatisticsName' style='height: 30px; width: 100%'>" +
                                    "</div>" +
                                    "</div>" +
                                    "<div class='row'>" +
                                    "<div class='col-xs-3 col-sm-3 col-md-3 col-lg-3'>" +
                                    "<div>VALUE</div>" +
                                    "</div>" +
                                    "<div class='col-xs-9 col-sm-9 col-md-9 col-lg-9'>" +
                                    "<input type='text' placeholder='' class='input-xxlarge' id='DashboardStatisticsValue' style='height: 30px; width: 100%'>" +
                                    "</div>" +
                                    "</div>" );
                            $.each( eval(DataLoad) , function(index, value) {

                                        console.log( value );
                                        StatisticsName += value[0] + ",";
                                        StatisticsValue += value[1] + ",";
                            });
                    }
                    else if( eval( $(this).parent().parent().children(".view").children().attr("mmtype") )[1] === "column" ){
                        $("#myModalData .modal-body").html("<div class='row'>" +
                                    "<div class='col-xs-3 col-sm-3 col-md-3 col-lg-3'>" +
                                    "<div>NAME</div>" +
                                    "</div>" +
                                    "<div class='col-xs-9 col-sm-9 col-md-9 col-lg-9'>" +
                                    "<input type='text' placeholder='' class='input-xxlarge' id='DashboardStatisticsName' style='height: 30px; width: 100%'>" +
                                    "</div>" +
                                    "</div>" +
                                    "<div class='row'>" +
                                    "<div class='col-xs-3 col-sm-3 col-md-3 col-lg-3'>" +
                                    "<div>VALUE</div>" +
                                    "</div>" +
                                    "<div class='col-xs-9 col-sm-9 col-md-9 col-lg-9'>" +
                                    "<input type='text' placeholder='' class='input-xxlarge' id='DashboardStatisticsValue' style='height: 30px; width: 100%'>" +
                                    "</div>" +
                                    "</div>" +
                                    "<div class='row'>" +
                                    "<div class='col-xs-3 col-sm-3 col-md-3 col-lg-3'>" +
                                    "<div>Name Of Y</div>" +
                                    "</div>" +
                                    "<div class='col-xs-9 col-sm-9 col-md-9 col-lg-9'>" +
                                    "<input type='text' placeholder='' class='input-xxlarge' id='NameOfY' style='height: 30px; width: 100%'>" +
                                    "</div>" +
                                    "</div>" );
                        $.each( jQuery.parseJSON( DataLoad ).x_name , function(index, value) {

                                    console.log( value );
                                    StatisticsName += value + ",";
                                    StatisticsValue += jQuery.parseJSON( DataLoad ).x_value[index] + ",";
                        });
                        
                        $("#NameOfY").val( jQuery.parseJSON( DataLoad ).y );
                    }
                    else if( eval( $(this).parent().parent().children(".view").children().attr("mmtype") )[1] === "line" ){
                        $("#myModalData .modal-body").html("<div class='row'>" +
                                    "<div class='col-xs-3 col-sm-3 col-md-3 col-lg-3'>" +
                                    "<div>NAME</div>" +
                                    "</div>" +
                                    "<div class='col-xs-9 col-sm-9 col-md-9 col-lg-9'>" +
                                    "<input type='text' placeholder='' class='input-xxlarge' id='DashboardStatisticsName' style='height: 30px; width: 100%'>" +
                                    "</div>" +
                                    "</div>" +
                                    "<div class='row'>" +
                                    "<div class='col-xs-3 col-sm-3 col-md-3 col-lg-3'>" +
                                    "<div>VALUE</div>" +
                                    "</div>" +
                                    "<div class='col-xs-9 col-sm-9 col-md-9 col-lg-9'>" +
                                    "<input type='text' placeholder='' class='input-xxlarge' id='DashboardStatisticsValue' style='height: 30px; width: 100%'>" +
                                    "</div>" +
                                    "</div>" +
                                    "<div class='row'>" +
                                    "<div class='col-xs-3 col-sm-3 col-md-3 col-lg-3'>" +
                                    "<div>Name Of Y</div>" +
                                    "</div>" +
                                    "<div class='col-xs-9 col-sm-9 col-md-9 col-lg-9'>" +
                                    "<input type='text' placeholder='' class='input-xxlarge' id='NameOfY' style='height: 30px; width: 100%'>" +
                                    "</div>" +
                                    "</div>" +
                                    "<div class='row'>" +
                                    "<div class='col-xs-3 col-sm-3 col-md-3 col-lg-3'>" +
                                    "<div>Name Of Line</div>" +
                                    "</div>" +
                                    "<div class='col-xs-9 col-sm-9 col-md-9 col-lg-9'>" +
                                    "<input type='text' placeholder='' class='input-xxlarge' id='NameOfLine' style='height: 30px; width: 100%'>" +
                                    "</div>" +
                                    "</div>");
                        $.each( jQuery.parseJSON( DataLoad ).x_name , function(index, value) {

                                    console.log( value );
                                    StatisticsName += value + ",";
                                    StatisticsValue += jQuery.parseJSON( DataLoad ).x_value[index] + ",";
                        });
                        
                        $("#NameOfY").val( jQuery.parseJSON( DataLoad ).y );
                        $("#NameOfLine").val( jQuery.parseJSON( DataLoad ).x );
                    }
                    StatisticsName = StatisticsName.substring(0, StatisticsName.length - 1);
                    StatisticsValue = StatisticsValue.substring(0, StatisticsValue.length - 1);
                    
                    $("#DashboardStatisticsName").val( StatisticsName );
                    $("#DashboardStatisticsValue").val( StatisticsValue );
                    
                    $("#myModalData .modal-content").attr( "type" , eval( $(this).parent().parent().children(".view").children().attr("mmtype") )[1] );
            */
                    
        });         
        // -- bohan2014.6.27
        // 
        // ++ bohan2014.7.04
        $('body.edit .demo').on("click","[data-target=#myModalTimelinerr]",function(e) {
            
                $.View.view_timeline_v()._SetOpts({ ChooseComponent : $(this).parent().parent().children(".view").children() });
                $.View.view_timeline_v().createNestable();
                
                e.preventDefault();
                
        });
        // -- bohan2014.7.04
        
        //bohan++ 20140707
        $('body.edit .demo').on("click","[data-target=#myModalforQRcode]",function(e) {
                
                $("#ImputQrcodeTitle").val( $(this).parent().parent().children(".view").children().children("[type=title]").html() );
                $("#ImputQrcodeUrl").val( $(this).parent().parent().children(".view").children().attr("mmobj") );
                $.View.view_qrcode()._SetOpts({ position : $(this).parent().parent().children(".view").children().children("[type=body]") });
                e.preventDefault();
                
        });
        //bohan-- 20140707
        
        //bohan++ 20140711
        $('body.edit .demo').on("click","[data-target=#myModalTable]",function(e) {
            
                $.View.view_table()._SetOpts({ ChooseTable : $(this).parent().parent().find(".view table") });
                $.View.view_table().SetInnerTable();
                
                
                e.preventDefault();
                
        });
        //bohan-- 20140711
        
        //bohan++ 20140714
        $('body.edit .demo').on("click","[data-target=#myModalNavbar]",function(e) {
            
                $.View.view_navbar()._SetOpts({ ChooseNavbar : $(this).parent().parent().find(".view").children() });
                $.View.view_navbar().SetInnerModal();
                
                e.preventDefault();
                
        });
        
        $('body.edit .demo').on("click","[data-target=#myModalFormCTT]",function(e) {
            
                $.View.view_form()._SetOpts({ ChooseForm : $(this).parent().parent().find(".view").children() });
                $.View.view_form().SetInnerModal();
                
                e.preventDefault();
                
        });
        //bohan-- 20140714
        
        // abin 7/17++
	$('body.edit .demo').on("click","[data-target=#myModalforIOT]",function(e) {
            

                            currenteditor = $(this).parent().parent().find('.view');
                            $.View.modal_router()._SetOpts({    mmtype : currenteditor.find( "[mmid=1]" ).attr( "mmtype" )  , 
                                                                mmobj  : currenteditor.find( "[mmid=1]" ).attr( "mmobj"  )  ,
                                                                target : currenteditor.children() });
                            $.View.modal_router().init();
                            //$.View.modal_router().datasource_dom_reset();
                            e.preventDefault();
                /*
                var currenteditor = $(this).parent().parent().find('.view');
                var mmtype = eval(currenteditor.find( "[mmid=1]" ).attr( "mmtype" ))[0];
                $("#myModalforIOTYes").unbind( "click" );
                $("#myModalforIOTBody input").val("");
                if(mmtype == "switch_button") {
                        $.View.MMA().bind_click();
                        $.View.MMA()._SetOpts({ target : currenteditor.children() });
                        $.View.MMA().preinstall();
                }
                e.preventDefault();
                */
	});
        
	$('body.edit .demo').on("click","[data-target=#myModalFormSetMMS]",function(e) {
                    e.preventDefault();
                    $.View.view_Set().myModalFormSetMMS_Dialog_init();
	});
        //abin 7/17-- 
        /* a bin -- 2014.0612.1500 */
	$('body.edit .demo').on("click","[data-target=#editorModal]",function(e) {
                            e.preventDefault();
                            currenteditor = $(this).parent().parent().find('.view');
                            var eText = currenteditor.html();
                            tinymce.activeEditor.setContent( eText);
                            /*HAO 20140411 tinymce SETcontent*/

                            /*contenthandle.setData(eText);*/
                            $.ajax({  

                                        type    : "POST",  
                                        url     : "jsk/extentCSS.JSK?func=GetCSS" ,  
                                        data    : 
                                        {
                                                    projectname : 'builder/' + $.focus_projectname , 
                                        },
                                        success: function(data) {
                                                    console.log( data );
                                        }
                            });
                            $("#ChangeBox").children("li[val=HTML]").trigger("click");
                            
	});
        
        $("#savecontent").unbind('click').bind( 'click' , function(e) {
            
                        /*
                        if( $("#ChangeBox .active").attr("val") === "HTML"){
                                    e.preventDefault();
                                    //currenteditor.html(contenthandle.getData());
                                    //tinymce.activeEditor.getContent();
                                    currenteditor.html(tinymce.activeEditor.getContent());
                                    //HAO 20140411 tinymce SAVEcontent
                                    
                                    $.View.view_sidebar().init_bind();
                        }
                        else if( $("#ChangeBox .active").attr("val") === "CSS")
                        {
                                    e.preventDefault();
                                    
                                    $.ajax({
                                                type    : "POST",  
                                                url     : "jsk/extentCSS.JSK?func=SetCSS" ,  
                                                data    : 
                                                        {
                                                                projectname : 'builder/' + $.focus_projectname ,
                                                                css         : $.View.CssBeautifier().options().beautified
                                                        },
                                                success: function(data) {
                                                            console.log( data );
                                                            alert( 'save success' );
                                                            removejscssfile( 'http://' + $.publish_domain + '/' + $.uid + '/builder/' + $.focus_projectname + '/css/extent.css', 'css');
                                                            loadjscssfile( 'http://' + $.publish_domain + '/' + $.uid + '/builder/' + $.focus_projectname + '/css/extent.css', 'css');
                                                            
                                                            //$("#main_container").addClass( "myclassfor" + $.focus_projectname.split(" ").join("") );
                                                            
                                                }
                                    });

                        }
                        else if( $("#ChangeBox .active").attr("val") === "JS")
                        {
                                    e.preventDefault();
                                    
                                    $.ajax({
                                                type    : "POST",  
                                                url     : "jsk/Upload2ClooudCmd.JSK?func=PutAppJS", 
                                                data    : 
                                                {
                                                            projectname : 'builder/' + $.focus_projectname ,
                                                            html        : $( "#JSModal textarea" ).val()
                                                }, 
                                                success: function(data) {
                                                            console.log( 'save success' );
                                                }
                                    });

                        }
                        */
                        e.preventDefault();
                        currenteditor.html(tinymce.activeEditor.getContent());
                        $.View.view_sidebar().init_bind();

	});
        
        
        $("#myModalBtEvent .modal-footer a").unbind('click').bind( 'click' , function(e) {
                            
                            $.View.button_event().save_event();
                            
        });
        
        $("#menu_return_save").unbind('click').bind( 'click' , function(e) {

                            //bohan++ 20140630 ClearLink
                            /*$( "#main_container" ).find( "script" ).remove();
                            $( "#main_container" ).find( "a" ).attr( "onclick" , "return false" );*/
                            //bohan-- 20140630 ClearLink
                            e.preventDefault();
                            downloadLayoutSrc();
                            
                            // event initial destory
                            // $( "#main_container" ).html()
                         
                            var Copy = $( "#main_container"  ).clone();
                            $.each( Copy.find("[mmid=1]")  , function( index , value ) {
                                        $.View.view_publish_remove()._SetOpts({ value : $( value ), mmtype : eval( $( value ).attr( "mmtype" ) ) });
                                        $.View.view_publish_remove().init();  
                            });
                        
                            $( "#shareModal_title" ).hide();
                            $( "#shareModal_url" ).hide();
                            $( "#shareModal_qrcode" ).hide();


                            $.ajax({
                                        type    : "POST",  
                                        url     : "jsk/Upload.JSK?func=PushText2myapps", 
                                        data    : 
                                        {
                                                    uid         : $.uid ,
                                                    projectname : 'builder/' + $.focus_projectname ,
                                                    edit        : Copy.html() , //$("#download-layout .container-fluid").html() ,
                                                    html        : $("#publishModal").data( "tmp_html" ) //$("#publishModal #shareModal_debug textarea").val()
                                        }, 
                                        //dataType: 'json' ,
                                        success: function(data) {
                                            
                                                    $( "#shareModal_title" ).show();
                                                    $( "#shareModal_url" ).show();
                                                    $( "#shareModal_qrcode" ).show();
                            
                                                    $( "#myModalforSaveSuccess" ).modal( "show" );
                                        }
                            });
                            

        });

        
        //$("[data-target=#publishModal]").unbind('click').bind( 'click' , function(e) {
        $("#Save_Project").unbind('click').bind( 'click' , function(e) {
                            //bohan++ 20140630 ClearLink
                            /*$( "#main_container" ).find( "script" ).remove();
                            $( "#main_container" ).find( "a" ).attr( "onclick" , "return false" );*/
                            //bohan-- 20140630 ClearLink
                            
                            //abin edit 2015.3.26 ++
                            /*
                            $.ajax({  
                                        type        : "POST",  
                                        url         : "jsk/KeepAlive.jsk?func=aaa_GetAccInfo", 
                                        data        : 
                                        {
                                        }, 
                                        success     : function(data) {
                                                    console.log( "keepalive callback" );
                                                    // var tmp = eval( "[" + data + "]" );
                                                    // $( "#publishModal input:eq(0)" ).val( tmp[0].UserInfo.Email );
                                        }, 
                                        error   : function(data) {
                                                    
                                        }
                            });
                            
                            //abin ++ 20140925 add publish mail function
                            $("#publishModal [data-target=submit]").unbind('click').bind( 'click' , function() {
                                        
                                        $("#publishModal [data-target=submit]").button('loading');
                                        window.setTimeout(function () {
                                                    $("#publishModal [data-target=submit]").button( 'reset' );
                                        }, 3000 );
                                
                                        if( $("#publishModal [data-input=to]").val() == "" ) {
                                                    alert("please input to somebody");
                                                    return;
                                        }
                                        if( $("#publishModal [data-input=sub]").val() == "" ) {
                                                    alert("please input to subject");
                                                    return;
                                        }
                                        if( $("#publishModal [data-input=body]").val() == "" ) {
                                                    alert("please input to msg");
                                                    return;
                                        }
                                        
                                        var Body = {};
                                        Body.to = $("#publishModal [data-input=to]").val();
                                        Body.subj = $("#publishModal [data-input=sub]").val();
                                        Body.msg = $("#publishModal [data-input=body]").val();
                                        Body.request = "mail";
                                    
                                        console.log( "PutMM" );
                                        $.mm.PutMsg( "notify@cloud" , { body : Body } , function( msg ){
                                                    console.log( msg ) ;
                                                    console.log( 'PutMsg success' );
                                                    $.mm.GetMsg( "5000" , msg.MsgID , function( msg ) {
                                                                console.log( 'GetMsg success' );
                                                    }
                                                    , function( msg ) {
                                                                console.log( 'GetMsg error' );
                                                    });

                                        } ,  function( msg ){} );
                                    
                            });
                            $("#publishModal [data-target=reset]").unbind('click').bind( 'click' , function() {
                                    $("#publishModal [data-input=body]").val("");
                                    $("#publishModal [data-input=sub]").val("")
                                    $("#publishModal [data-input=to]").val("");
                            });
                            //abin -- 20140925 add publish mail function
                            e.preventDefault();
                            */
                            //abin edit 2015.3.26 --
                            downloadLayoutSrc();
                            
                            /*
                            $("#shareModal_Sharing").unbind('click').bind( 'click' , function() {
                                            $( "#shareModal_mms" ).show();
                                            $( "#shareModal_debug" ).hide();
                                            $("#shareModal_Sharing").addClass("active");
                                            $("#shareModal_Debug").removeClass("active");
                            });
                            $("#shareModal_Sharing").trigger( "click" );
                            
                            
                            $("#shareModal_Debug").unbind('click').bind( 'click' , function() {
                                            $( "#shareModal_mms" ).hide();
                                            $( "#shareModal_debug" ).show();
                                            $("#shareModal_Sharing").removeClass("active");
                                            $("#shareModal_Debug").addClass("active");
                            });
                            
                            // abin edit 7.8 ++ process project html
                            var Copy = $( "#main_container"  ).clone();
                            $.each( Copy.find("[mmid=1]")  , function( index , value ) {
                                        $.View.view_publish_remove()._SetOpts({ value : $( value ), mmtype : eval( $( value ).attr( "mmtype" ) ) });
                                        $.View.view_publish_remove().init();  
                            });
                            // abin edit 7.8 --
                            
                            $( "#shareModal_title" ).hide();
                            $( "#shareModal_url" ).hide();
                            $( "#shareModal_qrcode" ).hide();
                            */
                            //abin edit 2015.4.17 ++
                            var Copy = $( "#main_container"  ).clone();
                            //copy content
                            var process = $("#download-layout").clone();
                            /*
                            for(var i=0; i< process.find("img[key=img]").length ; i++ ) {
                                    var target = process.find("img[key=img]").eq(i);
                                    var src = target.attr("src");
                                    src = src.substr(src.lastIndexOf("/")+1,src.length);
                                    target.attr("src" , src );
                            }
                            */
                            $.ajax({
                                    type : "POST",
                                    url : "ForTTShow/pageedit_publish_project.php" ,
                                    async: true ,
                                    data : {
                                        user_mail : $.UserMsg.email ,
                                        project : $.ProjectName ,
                                        html : $("#publishModal").data( "tmp_html" ) ,
                                        edit : Copy.html() ,
                                        content : process.html() ,
                                        data : JSON.stringify( $.all_data_inEdit ) ,
                                    },
                                    
                                    success : function(data) { 
                                            if( data != "false" ) {
                                                    //alert("儲存成功");
                                            }
                                    } ,
                                    error : function(data) { console.log(data); }
                            });
                            //abin edit 2015.4.17 --
                            /*              
                            $.ajax({
                                        type : "POST",
                                        url : "ForTTShow/Connect.php" ,
                                        async: true ,
                                        data : {
                                                edit        : Copy.html() , //$("#download-layout .container-fluid").html() ,
                                                html        : $("#publishModal").data( "tmp_html" )  // $("#publishModal #shareModal_debug textarea").val()
                                        },
                                        success : function(data) { 
                                                console.log( data );
                                        } ,
                                        error : function(data) { console.log(data); }
                            });
                            */
                            /*
                            $.ajax({
                                        type    : "POST",  
                                        url     : "jsk/Upload.JSK?func=PushText2myapps", 
                                        data    : 
                                                    {
                                                                uid         : $.uid ,
                                                                projectname : 'builder/' + $.focus_projectname ,
                                                                edit        : Copy.html() , //$("#download-layout .container-fluid").html() ,
                                                                html        : $("#publishModal").data( "tmp_html" )  // $("#publishModal #shareModal_debug textarea").val()
                                                    }, 
                                        //dataType: 'json' ,
                                        success: function(data) {

                                                    console.log( eval( '[' + data + ']' ) );
                                                    var tmp_data = eval( '[' + data + ']' ) ;

                                                    console.log( data );
                                                    if( tmp_data[0].status == "false")
                                                    {
                                                                alert( 'login first ! ' );

                                                                $( "#menu_user_profile_box" ).hide();
                                                                $( "#menu_user_profile_login" ).show();
                                                                $( "#menu_user_profile_logout" ).hide();
                                                                $( ".myclassforBusinessWebsite" ).show();

                                                    }
                                                    else
                                                    {
                                                        
                                                                $( "#shareModal_title" ).show();
                                                                $( "#shareModal_url" ).show();
                                                                $( "#shareModal_qrcode" ).show();

                                                                $( "#shareModal_title" ).html( $.focus_projectname );

                                                                $( "#shareModal_url" ).html( 
                                                                            '<a href="' + 'http://' + $.publish_domain + '/' + $.uid + '/builder/' + $.focus_projectname + '"  target="_blank"> ' + 'http://' + $.publish_domain + '/' + $.uid + '/builder/' + $.focus_projectname  + ' </a>'
                                                                );

                                                                $.View.view_qrcode()._SetOpts({ Url : 'http://' + $.publish_domain + '/' + $.uid + '/builder/' +  $.focus_projectname + '/index.html' , position : $("#shareModal_qrcode")});
                                                                $.View.view_qrcode().update_qrcode();
                                                    }

                                        }
                            });
                            */
                            
	});
	$("[data-target=#shareModal]").click(function(e) {
            
                    // all destroy
                    e.preventDefault();

                    $( "#shareModal_title" ).hide();
                    $( "#shareModal_url" ).hide();
                    $( "#shareModal_qrcode" ).hide();

                    $.ajax({
                                type    : "POST",  
                                url     : "jsk/Upload.JSK?func=PushText2myapps", 
                                data    : 
                                {
                                            uid         : $.uid ,
                                            //func      : 'PutHtml' , 
                                            name        : 'index.html' ,
                                            html        : $("#publishModal").data( "tmp_html" )
                                }, 
                                //dataType: 'json' ,
                                success: function(data) {

                                            console.log( data );
                                            if( data == "false")
                                            {
                                                        alert( 'login first ! ' );

                                                        $( "#menu_user_profile_box" ).hide();
                                                        $( "#menu_user_profile_login" ).show();
                                                        $( "#menu_user_profile_logout" ).hide();
                                                        $( ".myclassforBusinessWebsite" ).show();

                                            }
                                            else
                                            {

                                                        $( "#shareModal_title" ).show();
                                                        $( "#shareModal_url" ).show();
                                                        $( "#shareModal_qrcode" ).show();

                                                        $( "#shareModal_title" ).html( $.focus_projectname );

                                                        $( "#shareModal" ).find( ".modal-body #shareModal_url" ).html( 
                                                                    '<a href="' + 'http://' + $.publish_domain + $.uid + '"  target="_blank">' + 'http://' + $.publish_domain + $.uid  + '</a>'
                                                        );

                                                        update_qrcode( 'http://' + $.publish_domain + $.uid  );
                                            }


                                }
                    });

                    handleSaveLayout();
	});
	$("[data-target=#uploadModal]").click(function(e) {
                    // all destroy
                    e.preventDefault();
	});
        
	$("#download").click(function() {
                    downloadLayout();
                    return false
	});
	$("#downloadhtml").click(function() {
                    downloadHtmlLayout();
                    return false;
	});
        
        $('body.edit .demo').on("click","[data-target=#myModalBtEvent]",function(e) {
                    
                    e.preventDefault();
                    currenteditor = $(this).parent().parent().children('.view');
                    
                    $.View.button_event()._SetOpts({ focus : currenteditor.children()  });
                    $.View.button_event().modal_show();
                        
        });
        
        $('body.edit .demo').on("click","[type=EditDialogBt]",function(e) {
                    
                    e.preventDefault();
                    currenteditor = $(this).parent().parent().children('.view');
                    if( $(this).hasClass( "active" ) )
                    {
                            $(this).removeClass( "active" );
                            $.View.button_event()._SetOpts({ diolog_focus : currenteditor  });
                            $.View.button_event().grid_hide();
                            console.log("close");
                    }
                    else
                    {
                            console.log("open");
                            $(this).addClass( "active" );
                            $.View.button_event()._SetOpts({ diolog_focus : currenteditor  });
                            $.View.button_event().grid_show();
                            
                    }
        });
        
	$('body.edit .demo').on("click","[data-target=#myModalbackground]",function(e) {
                    e.preventDefault();
                    currenteditor = $(this).parent().parent().children('.view');

                    //currenteditor.children().css( "background-color" , "#333" );



                    var tmp_focus_t = currenteditor.children() ;
                    
                    //bohan++ 20140704 Grid Background
                    if ( tmp_focus_t.parent().children(".row-fluid.clearfix")[0] )
                                    tmp_focus_t = tmp_focus_t.children();
                    //bohan-- 20140704 Grid Background
                    if( tmp_focus_t.attr("AutoHeight") == "true" || tmp_focus_t.attr("AutoHeight") == undefined ) //Need change bohan
                        $( "#backgroundHeight" ).val( "auto" );
                    else
                        $( "#backgroundHeight" ).val( tmp_focus_t.css( "height" ) );
                    
                    $( "#backgroundHeight" ).unbind('change').bind( 'change' , function() {
                        
                                if( $(this).val().toLowerCase() == "auto" )
                                    tmp_focus_t.attr("AutoHeight","true");
                                else
                                    tmp_focus_t.attr("AutoHeight","false");
                                
                                $.View.view_builder_background()._SetOpts({ focus : tmp_focus_t , value : $(this).val() });
                                $.View.view_builder_background().background_height();
                    });
                    
                    if( tmp_focus_t.attr("AutoWidth") == "true" || tmp_focus_t.attr("AutoWidth") == undefined ) //Need change bohan
                        $( "#backgroundWidth" ).val( "auto" );
                    else
                        $( "#backgroundWidth" ).val( tmp_focus_t.css( "Width" ) );
                    
                    $( "#backgroundWidth" ).unbind('change').bind( 'change' , function() {
                        
                                if( $(this).val().toLowerCase() == "auto" )
                                    tmp_focus_t.attr("AutoWidth","true");
                                else
                                    tmp_focus_t.attr("AutoWidth","false");
                                
                                $.View.view_builder_background()._SetOpts({ focus : tmp_focus_t , value : $(this).val() });
                                $.View.view_builder_background().background_width();
                    });
                    
                    $( "#backgroundImagethis" )
                    .val( tmp_focus_t.css( "background-image" ) )
                    .unbind('change').bind( 'change' , function() {
                                $.View.view_builder_background()._SetOpts({ focus : tmp_focus_t , value : $(this).val() });
                                $.View.view_builder_background().background_image();
                    });

                    $( "#backgroundColorthis" )
                    .val( tmp_focus_t.css( "background-color" ) )
                    .unbind('change').bind( 'change' , function() {

                                $.View.view_builder_background()._SetOpts({ focus : tmp_focus_t , value : $(this).val() });
                                $.View.view_builder_background().background_color();

                    });
                    
                    if( tmp_focus_t.attr("BackgroundRepeat") == "true" || tmp_focus_t.attr("BackgroundRepeat") == undefined ) //Need change bohan
                        $('#backgroundRepeat')[0].checked = true;
                    else
                        $('#backgroundRepeat')[0].checked = false;
                        
                    $( "#backgroundRepeat" ).unbind('click').bind( 'click' , function() {
                                
                                
                                $.View.view_builder_background()._SetOpts({ focus : tmp_focus_t });
                                $.View.view_builder_background().background_Repeat();
                                
                    });

                    // ------------------------------------------------------------------------------------------------------------------------------------------------

                    var tmp_focus_p = currenteditor.parent().parent().parent() ;

                    $( "#backgroundImageParent" )
                    .val( tmp_focus_p.css( "background-image" ) )
                    .unbind('change').bind( 'change' , function() {
                                $.View.view_builder_background()._SetOpts({ focus : tmp_focus_p , value : $(this).val() });
                                $.View.view_builder_background().background_image();
                    });

                    $( "#backgroundColorParent" )
                    .val( tmp_focus_p.css( "background-color" ) )
                    .unbind('change').bind( 'change' , function() {
                                $.View.view_builder_background()._SetOpts({ focus : tmp_focus_p , value : $(this).val() });
                                $.View.view_builder_background().background_color();
                    });
                    // ------------------------------------------------------------------------------------------------------------------------------------------------
                    /*
                    $( "#backgroundImageBody" ).unbind('change').bind( 'change' , function() {

                                $.View.view_builder_background()._SetOpts({ focus : $( "body" ) , value : $(this).val() });
                                $.View.view_builder_background().background_image();

                    });

                    $( "#backgroundColorBody" ).unbind('change').bind( 'change' , function() {

                                $.View.view_builder_background()._SetOpts({ focus : $( "body" ) , value : $(this).val() });
                                $.View.view_builder_background().background_color();

                    });*/

                    //currenteditor
	});
        
	$('body.edit .demo').on("click","[data-target=#myModalFormMMS]",function(e) {

                    currenteditor = $(this).parent().parent().children('.view');
                    if( currenteditor.find( "label" ).length > 0 )
                    {
                                // $( "#bbb" ).val( "Hidden" )
                                
                                console.log( "label" );
                                var tmp_focus_t = currenteditor.find( "label" ) ;
                                
                                $("#myModalFormMMS").find( "input" ).val( tmp_focus_t.attr( "dataobjectvalue" ) );
                                $("#myModalFormMMSSave").unbind( "click" ).bind( "click" , function() {
                                            tmp_focus_t.attr( "dataobject" , "1" ).attr( "dataobjectvalue" , $( "#myModalFormMMS" ).find( "input" ).val().toString() );
                                });
                        
                    }
                    else if( currenteditor.find( "select" ).length > 0 )
                    {
                                // currenteditor.find( "label" ).children( "input" ).attr( "checked" , true );
                                
                                console.log( "select" );
                                var tmp_focus_t = currenteditor.find( "select" ) ;
                                
                                $("#myModalFormMMS").find( "input" ).val( tmp_focus_t.attr( "dataobjectvalue" ) );
                                $("#myModalFormMMSSave").unbind( "click" ).bind( "click" , function() {
                                            tmp_focus_t.attr( "dataobject" , "1" ).attr( "dataobjectvalue" , $( "#myModalFormMMS" ).find( "input" ).val().toString() );
                                });

                    }
                    else if( currenteditor.find( "input" ).length > 0 )
                    {
                                console.log( "input" );
                                var tmp_focus_t = currenteditor.find( "input" ) ;
                                
                                $("#myModalFormMMS").find( "input" ).val( tmp_focus_t.attr( "dataobjectvalue" ) );
                                $("#myModalFormMMSSave").unbind( "click" ).bind( "click" , function() {
                                            tmp_focus_t.attr( "dataobject" , "1" ).attr( "dataobjectvalue" , $( "#myModalFormMMS" ).find( "input" ).val().toString() );
                                });

                    }
                    
                    e.preventDefault();

	});
        
        /*
	$("#myModalbackgroundImage").change(function(e) {
                            console.log( 'eee' );
                            return false
	});*/
        
        
        
	$("#main_view_small_img").click(function() {
                    // ++ jack
                    console.log( 'already sortable' );
                    $( ".tool" ).show();
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
                    $("body").addClass("edit_body", 0);

                    setTimeout(function() {
                                $(window).trigger('resize');
                    }, 500 );


                    //$( "body, #main_container" ).css( "margin-top"  , "15px" );
                    //$( "body, #main_container" ).css( "padding-top" , "0px" );

                    $( "body, #main_container" ).css( "margin-top"  , "20px" );
                    /*$( "body, #main_container" ).css( "padding-top" , "15px" );*/
                    $( "body, #main_container" ).css( "padding-top" , "30px" );

                    $( "body" ).css( "margin-left" , "230px" );
                    $( "body" ).children( ".navbar" ).fadeIn();



                    $( "#main_view_small_img" ).fadeOut();


                    // -- jack

                    $("body").removeClass("devpreview");
                    $("body").removeClass("sourcepreview");
                    $("body").addClass("edit", 0);

                    //removeMenuClasses();
                    //$(this).addClass("active", 0);

                    return false
	});
            
            
	$("#edit").click(function() {
                    // ++ jack
                    console.log( 'already sortable' );
                    $( ".tool" ).show();
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
                    $("body").addClass("edit_body", 0);

                    setTimeout(function() {
                                $(window).trigger('resize');
                    }, 500 );


                    $( "body, #main_container" ).css( "margin-top" , "15px" );
                    $( "body" ).css( "padding-top" , "0px" );
                    $( "body" ).css( "margin-left" , "230px" );
                    $( "body" ).children( ".navbar" ).fadeIn();
                    $( "#main_view_small_img" ).fadeOut();


                    // -- jack

                    $("body").removeClass("devpreview");
                    $("body").removeClass("sourcepreview");
                    $("body").addClass("edit", 0);

                    //removeMenuClasses();
                    //$(this).addClass("active", 0);

                    return false
	});
        //$("#edit").trigger( "click" );
        
        
	$("#clear").click(function(e) {
                            e.preventDefault();
                            clearDemo();
	});
	$("#devpreview").click(function() {
                            // ++ jack
                            $( ".tool" ).hide();
                            
                            //$( ".demo .box .view" ).css( "padding-top" , "30px" );
                            // -- jack
                            
                            $("body").removeClass("edit sourcepreview");
                            $("body").addClass("devpreview");
                            removeMenuClasses();
                            $(this).addClass("active");
                            return false
	});
	$("#sourcepreview").click(function() {
            
                            // ++ jack 2014.3.19
                            $( "#menu_close_tool" ).attr( "hasopen" , "1" ).trigger( "click" );
                            
                            $( ".tool" ).hide();
                            
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
                            
                            
                            setTimeout(function() {
                                        $(window).trigger('resize');
                            }, 500 );
                            
                            
                            $( "body, #main_container" ).css( "margin-top"  , "0px" );
                            $( "body, #main_container" ).css( "padding-top" , "0px" );
                            
                            $( "body" ).css( "padding-top" , "0px" );
                            $( "body" ).css( "margin-left" , "0px" );
                            $( "body" ).children( ".navbar" ).fadeOut();
                            $( "#main_view_small_img" ).fadeIn();
                            
                            //$( ".demo .box .view" ).css( "padding-top" , "0px" );
    
                            // -- jack 2014.3.19
            
                            $("body").removeClass("edit");
                            $("body").addClass("devpreview sourcepreview");
                            
                            //removeMenuClasses();
                            //$(this).addClass("active");
                            
                            
                            return false
	});
	$("#fluidPage").click(function(e) {
                            e.preventDefault();
                            changeStructure("container", "container-full");
                            $("#fixedPage").removeClass("active");
                            $(this).addClass("active");
                            downloadLayoutSrc()
	});
	$("#fixedPage").click(function(e) {
                            e.preventDefault();
                            changeStructure("container-full", "container");
                            $("#fluidPage").removeClass("active");
                            $(this).addClass("active");
                            downloadLayoutSrc()
	});
        
	$('#undo').click(function(){
                            stopsave++;
                            if (undoLayout()) initContainer();
                            stopsave--;
	});
	$('#redo').click(function(){
                            stopsave++;
                            if (redoLayout()) initContainer();
                            stopsave--;
	});
        // by jack
        // $('#JOBS').trigger( "click" );
	$('#FJOBS').click(function(){
                            $('#JOBS').trigger( "click" );
	});
	$('#JOBS').click(function(){
            
                                if( $( ".sidebar-nav-right" ).attr( "status" ) == undefined )
                                {
                                            console.log( 'init' );
                                            $( ".sidebar-nav-right" ).attr( "status" , "1" );
                                            $.view_motion_view_flip_index.motion_view_flip().init();
                                }
                                else if( $( ".sidebar-nav-right" ).attr( "status" ) == "0"  )
                                {
                                                $( ".sidebar-nav-right" ).attr( "status" , "1" );
                                                $( "body" ).children( "#canvas" ).css({ visibility : 'visible' });

                                }else{

                                                $( ".sidebar-nav-right" ).attr( "status" , "0" );
                                                $( "body" ).children( "#canvas" ).css({ visibility : 'hidden' });


                                }
                                
	});
        
	removeElm();
	gridSystemGenerator();
        
        /*
	setInterval(function() {
                            handleSaveLayout();
	}, timerSave)*/
    
}
