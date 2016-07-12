<!DOCTYPE HTML>
<html>
    <head>  
                
                <script src="js/google_analytics.js"></script>
                
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
        <meta http-equiv="x-ua-compatible" content="IE=9">
        <link href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.2.2/css/bootstrap-combined.min.css" rel="stylesheet">
        <link href="http://twitter.github.com/bootstrap/assets/js/google-code-prettify/prettify.css" rel="stylesheet" />
        <link href="css/main.css" type="text/css" rel="stylesheet" />
        
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        <script type="text/javascript" src="https://google-code-prettify.googlecode.com/svn/loader/run_prettify.js"></script>
        <script type="text/javascript" src="js/jquery.touchSwipe.js"></script>
        <script>
            
            String.prototype.trim = function() {
                return this.replace(/^\s+|\s+$/g,"");
            }
            String.prototype.trimLeft = function() {
                return this.replace(/^\s+/,"");
            }
            String.prototype.trimRight = function() {
                return this.replace(/\s+$/,"");
            }


            //Demos file list (in order of presentation)
            //THe page name is formed from the file name.
            var fileList = [
                    'Basic_swipe.html',
                    'Single_swipe.html',
                    'Any_finger_swipe.html',
                    'Finger_swipe.html',
                    'Swipe_status.html',
                    'Pinch.html',
                    'Pinch_status.html',
                    'Pinch_and_Swipe.html',
                    'Trigger_handlers.html',
                    'Stop_propegation.html',
                    'Handlers_and_events.html',
                    'Tap_vs_swipe.html',
                    'Hold.html',
                    'Excluded_children.html',
                    'Page_zoom.html',
                    'Thresholds.html',
                    'Enable_and_destroy.html',
                    'Page_scrolling.html',
                    'Options.html',
                    'Image_gallery_example.html'
            ];


            /**
             * Builds the demo page
             */
            function init() {
                    buildTitle();
                    buildCodeExample();
                    buildNavigation();
            }

            /**
             * Creates the navigation components
             */
            function buildNavigation() {
                    $('.navigation').each(function( index ) {
                            $(this).html( getNavigation() );
                    });

                    $('.navigation_menu').each(function( index ) {
                            $(this).html( getNavigationMenu() );
                    })

                    $('.navigation_list').each(function( index ) {
                            $(this).html( getNavigationList() );
                    })


                    $('#menu').change( function() {
                            location.href=$(this).val();
                    });

                    $('#menu li').click( function() {
                            location.href=$(this).val();
                    });

                    $('.example_btn').click( function() {
                            $(document).scrollTop( $("#test").offset().top );
                    });

                    $('.events code').click( function() {
                            location.href = '../docs/symbols/%24.fn.swipe.html#event:' + $(this).text();	
                    });

                    $('.properties code').click( function() {
                            location.href = '../docs/symbols/%24.fn.swipe.defaults.html#' + $(this).text();	
                    });

                    $('.methods code').click( function() {
                            location.href = '../docs/symbols/%24.fn.swipe.html#' + $(this).text();	
                    });
            }

            /**
             * Builds the title element
             */
            function buildTitle() {
                    $('.title').each(function( index ) {
                            $(this).html( getTitle() );
                    })
            }

            /**
             * Copies the <script> tag contents, and populates the demo pretty print div to display the 
             * code example.
             */
            function buildCodeExample() {

                    $('.prettyprint').each(function( index ) {

                            //$(this).text( $("#"+$(this).attr('data-src')).html() );

                            var src = $("#"+$(this).attr('data-src')).html();
                            if(src) {
                                    var lines = src.split("\n");
                                    var trimedLines=[];
                                    var trimIndex=null;
                                    for (var i=0; i<lines.length; i++) {
                                            var line = lines[i];
                                            if(trimIndex===null) {
                                                    var trimmed = line.trimLeft();
                                                    if(line.length>0) {
                                                            trimIndex = line.length - trimmed.length;
                                                    }
                                            }

                                            if(line.length>0) {	
                                                    //Tabs to spaces
                                                    line = line.replace(/\t/g, '  '); //not using $nbsp; as we want to display HTML tags, so we set the text value, not html
                                                    trimedLines.push( line.substr(trimIndex) );
                                            }

                                    };

                                    var html = trimedLines.join("\n");


                                     $(this).text( html );
                            }		

                    });


                    //prettyPrint();
            }

            /**
             * Returns the current file being viewed.
             */
            function getCurrentFile() {
                    var url = window.location.pathname;
                var file = url.substring(url.lastIndexOf('/')+1);

                return file;
            }

            /**
             * Returns the current page name
             */
            function getPageName( file ) {

                if(!file)
                    file=getCurrentFile();

                var fileTokens = file.split("_");
                var fileName = fileTokens.join(" ");
                var nameTokens = fileName.split(".");
                nameTokens.pop();    

                var name = nameTokens.join(" ");

                return name;
            }



            /**
             * Writes out the page title template 
             */            
            function getTitle() {
                    var html =  "<h2><a href=\"http://labs.rampinteractive.co.uk/touchSwipe/\">TouchSwipe</a> Demo</h2>";
                    html += "<h3>to be viewed on touch based devices</h3>";
                    html += "<h1>"+getPageName()+"<span class='navigation_menu pull-right'></span></h1>";

                return html;        
            }

            /**
             * Returns HTML mark up for the pagination buttons
             */
            function getNavigation() {
                    var index = fileList.indexOf( getCurrentFile() );
                    var html ="<div class='pagination'>";

                    if(index>0) {
                            html += "<a class='pull-left btn' href='"+fileList[index-1]+"'><< "+getPageName(fileList[index-1])+"</a>";	
                    }

                    if(index<fileList.length-1) {
                            html += "<a class='pull-right btn' href='"+fileList[index+1]+"'>"+getPageName(fileList[index+1])+" >></a>";	
                    } 

                    html += "</div><div class='clear'></div>"
                    return html;
            }

            /**
             * Returns HTML mark up for the drop down menu
             */
            function getNavigationMenu() {

                    var html = "<select id='menu' class='pull_right'>";

                    for(var i=0; i<fileList.length; i++) {
                            var selected="";
                            if(fileList[i] == getCurrentFile()) {
                                    selected=' selected ';
                            }
                            html+="<option value='"+fileList[i]+"'"+selected+">"+getPageName(fileList[i])+"</option>";
                    }

                    html += "</select>";

                    return html;
            }

            /**
             * Returns HTML mark up for the list menu
             */
            function getNavigationList() {

                    var html = "<ul>";

                    for(var i=0; i<fileList.length; i++) {
                            html+="<li><a href='"+fileList[i]+"'>"+getPageName(fileList[i])+"</a></li>";
                    }

                    html += "</ul>";

                    return html;
            }

            $(function() {
                    init();
            });
            
        </script>
        
        <!-- use the jquery.ui.ipad.js plugin to translate touch events to mouse events -->
		<script type="text/javascript" src="js/jquery.ui.ipad.js"></script>
		
        <title>touchSwipe</title>
    </head>
    <body>
		<a href="https://github.com/mattbryson"><img style="position: absolute; top: 0; right: 0; border: 0;" src="https://s3.amazonaws.com/github/ribbons/forkme_right_white_ffffff.png" alt="Fork me on GitHub"></a>
		<div class="container">
			
			<script id='code_1'>
				$(function() {	
					var tapCount=0;
					var doubleTapCount=0;
					var longTapCount=0;
					var swipeCount=0;
					var blackCount=0;
					//Enable swiping...
					$("#test").swipe( {
						tap:function(event, target) {
							tapCount++;
							msg(target);
						},
						doubleTap:function(event, target) {
							doubleTapCount++;
							msg(target);
						},
						longTap:function(event, target) {
							longTapCount++;
							msg(target);
						},
						swipe:function() {
							swipeCount++;
							$("#textText").html("You swiped " + swipeCount + " times");
						},
						threshold:50
					});
					
					//Assign a click handler to a child of the touchSwipe object
					//This will require the jquery.ui.ipad.js to be picked up correctly.
					$("#another_div").click( function(){
						blackCount++;
						$("#another_div").html("<h3 id='div text'>jQuery click handler fired on the black div : you clicked the black div "+ 
						blackCount + " times</h3>");
					});
					
					function msg(target) {
					    $("#textText").html("You tapped " + tapCount +", double tapped " +  doubleTapCount + " and long tapped " +  longTapCount + " times on " +  $(target).attr("id"));
					}
				});
			</script>
			
			<span class='title'></span>
			<h4>events:  <span class='events'><code>tap</code>, <code>doubleTap</code>, <code>longTap</code>, <code>swipe</code></span></h4>
			<h4>properties: <span class='properties'><code>longTapThreshold</code>, <code>doubleTapThreshold</code></span></h4>
			<p>You can also detect if the user simply taps and does not swipe with the <code>tap</code> handler<br/><br/>
				The <code>tap</code>, <code>doubleTap</code> and <code>longTap</code> handler are passed the original event object and the target that was clicked.
				<br/><br/>
				<b>See also the <a href="Hold.html"><code>hold</code></a> event for when a long tap reaches the <code>longTapThreshold</code></b>
				<br/>
				</p>
				<p class="muted">If you use the jquery.ui.ipad.js plugin (http://code.google.com/p/jquery-ui-for-ipad-and-iphone/) you can then also pickup
				standard jQuery mouse events on children of the touchSwipe object.</p>
				
				<p>You can set the delay between taps which defines a double tap, and the length of a long tap with the <code>doubleTapThreshold</code> and <code>longTapThreshold</code> properties.</p>
				
				<p>Note: If you assign both tap and double tap, you tap events will be delayed by the length of <code>doubleTapThreshold</code> as it waits to see if its a double before trigger the event</p>				
				
				<p class="muted"><code>tap</code> replaces the old <code>click</code> handler for naming consistency. Since the introduction of event 
				triggering as well as callbacks, the plugin cannot trigger a <code>click</code> event as it clashes with the jQ click event, 
				so both the event and callback are called <code>tap</code>. For backwards compatibility, the <code>click</code> callback will still work
				but there is no click event. You must use the <code>tap</code> event when binding with <code>on</code> or <code>bind</code></p>
				
			
			<button class='btn btn-small btn-info example_btn'>Jump to Example</button>
			<pre class="prettyprint lang-js" data-src='code_1'></pre>
			<span class='navigation'></span>
			
			<div id="test" class="box">
				<div id="textText">Swipe, Tap, Double Tap or Long Tap me</div><br/>
				<div id="a_div" class="box" style="width:150px;height:50px;background:#666"><h3 id='a_div_text'>Im just a child div</h3></div>
				<div id="another_div" class="box" style="width:200px;height:100px;background:#000"><h3>Im a child div with my own jQuery click handler</h3></div>
			</div>
			
			<span class='navigation'></span>
		</div>
   </body>
</html>