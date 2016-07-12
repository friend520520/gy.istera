<html>
    <head>
        <meta charset="utf-8">
        <title>remote_getpage_json</title>

        <script src="js/jquery.js"></script>
        
        <script>
            $( document ).ready(function() {
                    $.ajax({
                                type : "POST" ,
                                url  : "php/json_list_insidepagehead.php" ,
                                data : {
                                } ,
                                success : function(data) {
                                        
                                        data = JSON.parse( data );
                                        
                                        console.log(data);
                                        
                                }
                    });
            });
        </script>
    </head>
    <body>

    </body>
</html>