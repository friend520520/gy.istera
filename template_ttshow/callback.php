<!DOCTYPE html>
<html lang="en">
	<head>
                
                <script src="js/google_analytics.js"></script>
                
                <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
                <meta charset="utf-8" />
                
                <title>ttshow</title>
                <link rel="shortcut icon" href="http://ttshow.tw/images/logo.png">
                
                <meta name="description" content="讓台灣的好作品、好人才被全世界看見" />
                <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

                <!-- bootstrap & fontawesome -->
                <link rel="stylesheet" href="template/assets/css/bootstrap.css" />
                <!--link rel="stylesheet" href="template/assets/css/font-awesome.css" />
                <link rel="stylesheet" href="template/assets/css/jquery-ui.css" />
                <link rel="stylesheet" href="template/assets/css/ace-fonts.css" /-->
                <!-- ace styles 4/9 AL 更換CSS路徑-->
                <link rel="stylesheet" href="template/assets/css/ace.css" class="ace-main-stylesheet" id="main-ace-style" />

                <link href="js/TouchSwipe-Jquery-Plugin-master/demos/css/main.css" type="text/css" rel="stylesheet" />

        
                <script src="template/assets/js/jquery.js"></script>
                <script src="template/assets/js/jquery-ui.js"></script>
                <script src="template/assets/js/bootstrap.js"></script>
                <script src="js/create.js"></script>
                
                <script type="text/javascript">

                    function setCookie(cname, cvalue, exdays) {
                        var d = new Date();
                        d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
                        var expires = "expires=" + d.toUTCString();
                        document.cookie = cname + "=" + cvalue + "; " + expires;
                    }

                    function getCookie(cname) {
                       var name = cname + "=";
                       var ca = document.cookie.split(';');
                       for(var i=0; i<ca.length; i++) {
                           var c = ca[i];
                           while (c.charAt(0)==' ') c = c.substring(1);
                           if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
                       }
                       return "";
                    }
                </script>
                
                
                
	</head>

	<body class="no-skin" style="background-color: #DDDDDD;">
        

        </body>

        <style>
                .zipcode { display: none; }
                .county { margin-right: 10px !important; }
                .district { margin-right: 10px !important; }
        </style>
        
        <script type="text/javascript">

                $("document").ready(function() {
                        
                        if( location.host === "www.ooxxoox.com" )
                            var url = "../gmailsystem/callback.php";
                        else if( location.host === "ttshow.tw" )
                            var url = "ttshow/gmailsystem/callback.php";
                        
                        $.ajax({
                                    type: "POST",
                                    url: url,
                                    //url: "http://www.ggyyggy.com/bohan/gmailsystem/callback.php",
                                    data: { token : getParameterByName("token") },
                                    success: function( data ) {
                                            try {
                                                    console.log( data );
                                                    $.member_data = data;
                                                    if( data !== "false" ) {
                                                            
                                                            setCookie("ttshow", data);
                                                            location.href = "signup_3.php";
                                                            
                                                    }
                                                    else {
                                                            
                                                            alert( "認證失敗" );
                                                            location.href = "index.php";
                                                            
                                                    }
                                            }catch(e) {
                                                    console.log(e);
                                            }
                                    } ,
                                    error: function( data ) { console.log( data ); }
                        }); 
                        
                });
                

        </script>
</html>
