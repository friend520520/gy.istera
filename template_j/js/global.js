
            
                $.Ajax = function(type, url, data, data2, back, error_back) {
                        if (error_back == "") {
                                error_back = function(e) {
                                        console.log(e);
                                };
                        }
                        $.ajax({
                                type: type,
                                url: url,
                                async: true,
                                data: data,
                                data2: data2,
                                success: back,
                                error: error_back
                        });
                }
