<!doctype html>
<html>
        <head>
                <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
                <meta charset="utf-8">
                <title>忘記密碼 | Funbook19.com</title>
                
                <script src="../template/js/jquery.min.js"></script>
                <script src="../js/ajaxq.js"></script>
                <script src="../js/global.js"></script>
                
        </head>

        <body>
        <script type="text/javascript">
                
                var a = [ "痾.jpg" ];
                var data = { "text" : a , "text2" : [] , "arr" : "[]" };
                var success_back = function( data ) {

                        console.log(data);

                }
                var error_back = function( data ) {
                        console.log(data);
                }
                $.Ajax( "POST" , "bohan.php" , data , "" , success_back , error_back);

        </script>

</body>

</html>
