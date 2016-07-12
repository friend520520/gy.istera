// AjaxQ jQuery Plugin
// Copyright (c) 2012 Foliotek Inc.
// MIT License
// https://github.com/Foliotek/ajaxq

(function($) {

    var queues = {};
    var activeReqs = {};
    //console.log("123");

    // Register an $.ajaxq_upload function, which follows the $.ajax interface, but allows a queue name which will force only one request per queue to fire.
    $.ajaxq_upload = function(qname, opts) {

        if (typeof opts === "undefined") {
            throw ("AjaxQ: queue name is not provided");
        }

        // Will return a Deferred promise object extended with success/error/callback, so that this function matches the interface of $.ajax
        var deferred = $.Deferred(),
            promise = deferred.promise();

        promise.success = promise.done;
        promise.error = promise.fail;
        promise.complete = promise.always;

        // Create a deep copy of the arguments, and enqueue this request.
        var clonedOptions = $.extend(true, {}, opts);
        enqueue(function() {
            // Send off the ajax request now that the item has been removed from the queue
            var jqXHR = $.ajax.apply(window, [clonedOptions]);
            //console.log("2");
            //deferred.resolve.apply(clonedOptions, arguments);
            //deferred.resolve.apply(clonedOptions, arguments);
            
            // Notify the returned deferred object with the correct context when the jqXHR is done or fails
            // Note that 'always' will automatically be fired once one of these are called: http://api.jquery.com/category/deferred-object/.
            jqXHR.done(function() {
                deferred.resolve.apply(this, arguments);
                //console.log("7");
            });
            jqXHR.fail(function() {
                deferred.reject.apply(this, arguments);
                //console.log("fail");
            });
            //console.log("3")
            jqXHR.always(dequeue); // make sure to dequeue the next request AFTER the done and fail callbacks are fired
            return jqXHR;
        });

        return promise;


        // If there is no queue, create an empty one and instantly process this item.
        // Otherwise, just add this item onto it for later processing.
        
        function enqueue(cb) {
            //if (!queues[qname]) {
            //bohan ++
            //console.log( "0.5" );
            if (!queues[qname]) {
                //console.log( "0.7" );
                $.ajaxqqq = 3;
            }
            //bohan--
            if ($.ajaxqqq) {
                $.ajaxqqq --;
                //console.log( "1" );
                queues[qname] = [];
                var xhr = cb();
                //console.log( "4" );
                activeReqs[qname] = xhr;
            }
            else {
                //console.log( "5" );
                //console.log( queues[qname] );
                queues[qname].push(cb);
                //console.log( queues[qname] );
            }
        }

        // Remove the next callback from the queue and fire it off.
        // If the queue was empty (this was the last item), delete it from memory so the next one can be instantly processed.
        function dequeue() {
            //console.log( "8" );
            if (!queues[qname]) {
                return;
                //console.log( "return" );
            }
            
            //console.log( "9" );
            var nextCallback = queues[qname].shift();
            if (nextCallback) {
                //console.log("10");
                var xhr = nextCallback();
                activeReqs[qname] = xhr;
                //console.log( "11" );
            }
            else {
                //console.log( "12" );
                delete queues[qname];
            }
        }
    };

    // Register a $.postq and $.getq method to provide shortcuts for $.get and $.post
    // Copied from jQuery source to make sure the functions share the same defaults as $.get and $.post.
    $.each( [ "getq", "postq" ], function( i, method ) {
        $[ method ] = function( qname, url, data, callback, type ) {

            if ( $.isFunction( data ) ) {
                type = type || callback;
                callback = data;
                data = undefined;
            }

            return $.ajaxq_upload(qname, {
                type: method === "postq" ? "post" : "get",
                url: url,
                data: data,
                success: callback,
                dataType: type
            });
        };
    });

    var isQueueRunning = function(qname) {
        return queues.hasOwnProperty(qname);
    }

    var isAnyQueueRunning = function() {
        for (var i in queues) {
            if (isQueueRunning(i)) return true;
        }
        return false;
    }

    $.ajaxq_upload.isRunning = function(qname) {
        if (qname) return isQueueRunning(qname);
        else return isAnyQueueRunning();
    };

    $.ajaxq_upload.getActiveRequest = function(qname) {
        if (!qname) throw ("AjaxQ: queue name is required");

        return activeReqs[qname];
    };

    $.ajaxq_upload.abort = function(qname) {
        if (!qname) throw ("AjaxQ: queue name is required");
        
        $.ajaxq_upload.clear(qname);
        var current = $.ajaxq_upload.getActiveRequest(qname);
        if (current) current.abort();
    }
    
    $.ajaxq_upload.clear = function(qname) {
        if (!qname) {
            for (var i in queues) {
                if (queues.hasOwnProperty(i)) {
                    delete queues[i];
                }
            }
        }
        else {
            if (queues[qname]) {
                delete queues[qname];
            }
        }
    };
    
})(jQuery);