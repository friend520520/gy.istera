var createTable = function(div_id, table_id, row) {
        var th = "";
        for(var i=0;i<row.length;i++) {
            th += '<th>'+row[i]+'</th>';
        }
        var table = '<table id="'+table_id.replace("#","")+'" class="display select" width="100%" cellspacing="0">\n\
                        <thead>\n\
                            <tr>\n\
                                <th></th>'
                                + th +
                            '</tr>\n\
                        </thead>\n\
                        <tfoot>\n\
                            <tr>\n\
                                <th colspan="'+row.length+'" style="text-align:right">Total:</th>\n\
                                <th></th>\n\
                            </tr>\n\
                        </tfoot>\n\
                    </table>';
        $(div_id).append(table);
        /*
        var table = '<table id="'+table_id.replace("#","")+'" class="display select" width="100%" cellspacing="0">\n\
                        <thead>\n\
                            <tr>\n\
                                <th><input name="select_all" value="1" type="checkbox"></th>'
                                + th +
                            '</tr>\n\
                        </thead>\n\
                        <tfoot>\n\
                            <tr>\n\
                                <th colspan="'+row.length+'" style="text-align:right">Total:</th>\n\
                                <th></th>\n\
                            </tr>\n\
                        </tfoot>\n\
                    </table>';
        $(div_id).append(table);*/
};

var createSearchTable = function(div_id, table_id, row) {
        var tr = "";
        
        
        for( var i=0 ; i<row.length ; i++ )
        {
                if( row[i] != "操作" )
                tr += '<tr id="filter_col'+(i+2)+'" data-column="'+(i+1)+'">'
                        + '<td>' + row[i].replace( /<br>/g , "" ) + '</td>\n\
                        <td align="left">\n\
                            <input type="text" class="column_filter" id="col'+(i+1)+'_filter">\n\
                        </td>\n\
                    <tr>';
        }
        var table = '<table id="'+table_id.replace("#","")+'_search" cellpadding="3" cellspacing="0" border="0" style="width: 50%; margin: 2em auto; " >\n\
                        <tbody>'
                            + tr +
                        '</tbody>\n\
                    </table>';
        $(div_id).html(table);
};

var createDataTable = function(table_id, ajax,  order,  lengthMenu) {
    
        if( lengthMenu )
        {
                    var tmp_lengthMenu = lengthMenu  ;
        }else{
                    var tmp_lengthMenu = [[10, 25, 50, -1], [10, 25, 50, "All"]]  ;
        }
        
        $('#example').dataTable( {
                "ajax": function (data, callback, settings) {
                            callback( 
                                        ajax 
                            );
                },
                'columnDefs': [{
                        'targets': 0,
                        'searchable': false,
                        'orderable': false,
                        'width': '0%',
                        'className': 'dt-body-center',
                        'render': function (data, type, full, meta){
                                //return '<input type="checkbox">';
                                return '';
                        }
                }],
                "pageLength": 5 ,
                "lengthMenu": tmp_lengthMenu ,
                'order': 1, // [[4, 'desc']]
                'rowCallback': function(row, data, dataIndex){
                        // Get row ID
                        var rowId = data[0];
                        // If row ID is in the list of selected row IDs
                        if($.inArray(rowId, $(table_id).data("rows_selected")) !== -1){
                                $(row).find('input[type="checkbox"]').prop('checked', true);
                                $(row).addClass('selected');
                        }
                },
                'footerCallback': function ( row, data, start, end, display ) {

                    var api = this.api(), data;

                    fn_footerCallback( this , api , data );

                }
        });
        
        /*
        $(table_id).DataTable({
            "ajax": ajax, // 'examples/ajax/data/ids-arrays.txt
            'columnDefs': [{
                    'targets': 0,
                    'searchable': false,
                    'orderable': false,
                    'width': '1%',
                    'className': 'dt-body-center',
                    'render': function (data, type, full, meta){
                            return '<input type="checkbox">';
                    }
            }],
            "lengthMenu": tmp_lengthMenu ,
            'order': order, // [[4, 'desc']]
            'rowCallback': function(row, data, dataIndex){
                    // Get row ID
                    var rowId = data[0];
                    // If row ID is in the list of selected row IDs
                    if($.inArray(rowId, $(table_id).data("rows_selected")) !== -1){
                            $(row).find('input[type="checkbox"]').prop('checked', true);
                            $(row).addClass('selected');
                    }
            },
            'footerCallback': function ( row, data, start, end, display ) {
                
                var api = this.api(), data;
                
                fn_footerCallback( this , api , data );
                
            }
        });*/
}


var fn_footerCallback = function( foucs , api , table_id ) {
        
        //console.log( foucs , api , table_id );
        console.log( "fn_footerCallback" );
        
        // Remove the formatting to get integer data for summation
        var intVal = function ( i ) {
            return typeof i === 'string' ?
                i.replace(/[\$,]/g, '')*1 :
                typeof i === 'number' ?
                    i : 0;
        };
        
        var tmp_focus = foucs.parent().parent() ;
        var tmp_condition = $( '[target-dt=' + tmp_focus.attr( "id" ) + ']' ) ;
        if( tmp_condition.length > 0 && tmp_focus.attr( "target-pro" ) == "1" )
        {
                    tmp_focus.attr( "target-pro" , "0" );
                    $.each( tmp_condition , function(index, value) {
                            
                                $( this ).trigger( "change" );
                                $( this ).trigger( "keyup" );
                            
                    });
                    
        }
        
        if( location.pathname.split( "mgm_accessories_download_list.php" ).length > 1 )
        {
                    var count_row1 = parseInt($(foucs).find("thead th").length) - 2;
                    var count_row2 = parseInt($(foucs).find("thead th").length) - 3;
                    
                    // Total over all pages
                    if( count_row1 )
                    var total = api
                        .column( count_row1 )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );

                    // Total over foucs page
                    if( count_row1 )
                    var pageTotal = api
                        .column( count_row1, { page: 'current'} )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );


                    // Total over all pages
                    if( count_row2 )
                    var ctotal = api
                        .column( count_row2 )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );

                    // Total over foucs page
                    if( count_row2 )
                    var cpageTotal = api
                        .column( count_row2, { page: 'current'} )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );

                    var num = new Number(cpageTotal);
                    cpageTotal = num.toFixed(2) ;
                    var num = new Number(ctotal);
                    ctotal = num.toFixed(2) ;
                    var num = new Number(pageTotal);
                    pageTotal = num.toFixed(2) ;
                    var num = new Number(total);
                    total = num.toFixed(2) ;

                    var count_html = '本頁面 G 幣 ' + pageTotal + ' <br>( 總計 G 幣 ' + total + ' ) ' ;
                    // var count_html = '本頁面已驗證數 ' + cpageTotal + ' <br>( 總計已驗證數 ' + ctotal + ' ) <br>本頁面未驗證數 $'+pageTotal +' <br>( 總計未驗證數 $'+ total +' )' ;
                    
                    
        }
        
        else if( location.pathname.split( "mgm_articles_list_manage.php" ).length > 1 )
        {
                    var count_row1 = parseInt($(foucs).find("thead th").length) - 4;
                    var count_row2 = parseInt($(foucs).find("thead th").length) - 6;
                    
                    // Total over all pages
                    if( count_row1 )
                    var total = api
                        .column( count_row1 )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );

                    // Total over foucs page
                    if( count_row1 )
                    var pageTotal = api
                        .column( count_row1, { page: 'current'} )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );


                    // Total over all pages
                    if( count_row2 )
                    var ctotal = api
                        .column( count_row2 )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );

                    // Total over foucs page
                    if( count_row2 )
                    var cpageTotal = api
                        .column( count_row2, { page: 'current'} )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );

                    var num = new Number(cpageTotal);
                    cpageTotal = num.toFixed(2) ;
                    var num = new Number(ctotal);
                    ctotal = num.toFixed(2) ;
                    var num = new Number(pageTotal);
                    pageTotal = num.toFixed(2) ;
                    var num = new Number(total);
                    total = num.toFixed(2) ;

                    var count_html = '本頁面點閱數 ' + cpageTotal + ' <br>( 總計點閱數 ' + ctotal + ' ) <br>共推收益金額 $'+pageTotal +' <br>( 總計金額 $'+ total +' )' ;
        }
        else if( location.pathname.split( "mgm_statistics_member_growUp.php" ).length > 1 )
        {
                    var count_row1 = parseInt($(foucs).find("thead th").length) - 2;
                    var count_row2 = parseInt($(foucs).find("thead th").length) - 3;
                    
                    // Total over all pages
                    if( count_row1 )
                    var total = api
                        .column( count_row1 )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );

                    // Total over foucs page
                    if( count_row1 )
                    var pageTotal = api
                        .column( count_row1, { page: 'current'} )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );


                    // Total over all pages
                    if( count_row2 )
                    var ctotal = api
                        .column( count_row2 )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );

                    // Total over foucs page
                    if( count_row2 )
                    var cpageTotal = api
                        .column( count_row2, { page: 'current'} )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );

                    var num = new Number(cpageTotal);
                    cpageTotal = num.toFixed(2) ;
                    var num = new Number(ctotal);
                    ctotal = num.toFixed(2) ;
                    var num = new Number(pageTotal);
                    pageTotal = num.toFixed(2) ;
                    var num = new Number(total);
                    total = num.toFixed(2) ;

                    var count_html = '本頁面已驗證數 ' + cpageTotal + ' <br>( 總計已驗證數 ' + ctotal + ' ) <br>本頁面未驗證數 $'+pageTotal +' <br>( 總計未驗證數 $'+ total +' )' ;
        }
        
        else if( location.pathname.split( "mgm_statistics_network.php" ).length > 1 )
        {
                    var count_row1 = parseInt($(foucs).find("thead th").length) - 1;
                    var count_row2 = parseInt($(foucs).find("thead th").length) - 2;

                    // Total over all pages
                    if( count_row1 )
                    var total = api
                        .column( count_row1 )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );

                    // Total over foucs page
                    if( count_row1 )
                    var pageTotal = api
                        .column( count_row1, { page: 'current'} )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );


                    // Total over all pages
                    if( count_row2 )
                    var ctotal = api
                        .column( count_row2 )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );

                    // Total over foucs page
                    if( count_row2 )
                    var cpageTotal = api
                        .column( count_row2, { page: 'current'} )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );

                    var num = new Number(cpageTotal);
                    cpageTotal = num.toFixed(2) ;
                    var num = new Number(ctotal);
                    ctotal = num.toFixed(2) ;
                    var num = new Number(pageTotal);
                    pageTotal = num.toFixed(2) ;
                    var num = new Number(total);
                    total = num.toFixed(2) ;

                    var count_html = '本頁面文章流量 ' + cpageTotal + ' <br>( 總計文章流量 ' + ctotal + ' ) <br>本頁面附件流量 $'+pageTotal +' <br>( 總計附件流量 $'+ total +' )' ;
        }
        
        else if( location.pathname.split( "mgm_statistics_support.php" ).length > 1 )
        {
                    var count_row1 = parseInt($(foucs).find("thead th").length) - 2;
                    var count_row2 = parseInt($(foucs).find("thead th").length) - 3;

                    // Total over all pages
                    if( count_row1 )
                    var total = api
                        .column( count_row1 )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );

                    // Total over foucs page
                    if( count_row1 )
                    var pageTotal = api
                        .column( count_row1, { page: 'current'} )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );


                    // Total over all pages
                    if( count_row2 )
                    var ctotal = api
                        .column( count_row2 )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );

                    // Total over foucs page
                    if( count_row2 )
                    var cpageTotal = api
                        .column( count_row2, { page: 'current'} )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );

                    var num = new Number(cpageTotal);
                    cpageTotal = num.toFixed(2) ;
                    var num = new Number(ctotal);
                    ctotal = num.toFixed(2) ;
                    var num = new Number(pageTotal);
                    pageTotal = num.toFixed(2) ;
                    var num = new Number(total);
                    total = num.toFixed(2) ;

                    var count_html = '本頁面總計筆數 ' + cpageTotal + ' <br>( 總計筆數 ' + ctotal + ' ) <br>本頁面總計金額 $'+pageTotal +' <br>( 總計金額 $'+ total +' )' ;
        }
        
        else if( location.pathname.split( "mgm_statistics_support.php" ).length > 1 )
        {
                    var count_row1 = parseInt($(foucs).find("thead th").length) - 2;

                    // Total over all pages
                    if( count_row1 )
                    var total = api
                        .column( count_row1 )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );

                    // Total over foucs page
                    if( count_row1 )
                    var pageTotal = api
                        .column( count_row1, { page: 'current'} )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );


                    // Total over all pages
                    if( count_row2 )
                    var ctotal = api
                        .column( count_row2 )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );

                    // Total over foucs page
                    if( count_row2 )
                    var cpageTotal = api
                        .column( count_row2, { page: 'current'} )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );

                    var num = new Number(cpageTotal);
                    cpageTotal = num.toFixed(2) ;
                    var num = new Number(ctotal);
                    ctotal = num.toFixed(2) ;
                    var num = new Number(pageTotal);
                    pageTotal = num.toFixed(2) ;
                    var num = new Number(total);
                    total = num.toFixed(2) ;

                    var count_html = '本頁面總計網址 $'+pageTotal +' <br>( 總計網址 $'+ total +' )' ;
        }
        
        else
        {
            
                    var count_html = "" ;
        
        }
    
        // Update footer
        if( count_html == "" )
        {
                    $( "#datatable" ).find( "tfoot" ).remove();
        }else{
                    $(foucs).find("tfoot th:last").html( count_html );
                    $( "#datatable_result" ).html( count_html );
        }
        
        
}

var addEvent = function(div_id, table_id) {
        var dataTable = $(table_id).DataTable();

        // -------------

        // $( '[target-dt=' + div_id.split( "#" )[1] + ']' ).attr( "target-pro" , "0" );
        $( '[target-dt=' + div_id.split( "#" )[1] + ']' ).on( 'change', function () {

                console.log( $(this).val() );

                var col = $(this).attr( "target-col" ) ;

                $(table_id).DataTable().column( col ).search( 
                        $(this).val(),
                        $(table_id+"_search").find('#col'+ col +'_regex').prop('checked'), 
                        $(table_id+"_search").find('#col'+ col +'_smart').prop('checked')
                //).draw();
                );

                if( $.swipe_queue )
                clearInterval( $.swipe_queue );
                $.swipe_queue = setTimeout(function(){

                            $(table_id).DataTable().column( col ).draw();
                            
                }, 1000 );
        
        });

        // -------------


        var updateDataTableSelectAllCtrl = function(table){
            var $table             = table.table().node();
            var $chkbox_all        = $('tbody input[type="checkbox"]', $table);
            var $chkbox_checked    = $('tbody input[type="checkbox"]:checked', $table);
            var chkbox_select_all    = $('thead input[name="select_all"]', $table).get(0);

            // If none of the checkboxes are checked
            if($chkbox_checked.length === 0){
               chkbox_select_all.checked = false;
               if('indeterminate' in chkbox_select_all){
                  chkbox_select_all.indeterminate = false;
               }

            // If all of the checkboxes are checked
            } else if ($chkbox_checked.length === $chkbox_all.length){
               chkbox_select_all.checked = true;
               if('indeterminate' in chkbox_select_all){
                  chkbox_select_all.indeterminate = false;
               }

            // If some of the checkboxes are checked
            } else {
               chkbox_select_all.checked = true;
               if('indeterminate' in chkbox_select_all){
                  chkbox_select_all.indeterminate = true;
               }
            }
        }

        var filterGlobal = function() {
                $(table_id).DataTable().search( 
                        $(div_id).find('#global_filter').val(),
                        $(div_id).find('#global_regex').prop('checked'), 
                        $(div_id).find('#global_smart').prop('checked')
                ).draw();
        }

        var filterColumn = function(i) {
            console.log(table_id);
                $(table_id).DataTable().column( i ).search( 
                        $(table_id+"_search").find('#col'+i+'_filter').val(),
                        $(table_id+"_search").find('#col'+i+'_regex').prop('checked'), 
                        $(table_id+"_search").find('#col'+i+'_smart').prop('checked')
                ).draw();
        }

        $(table_id+"_search").find('input.global_filter').on( 'keyup click', function () {
                filterGlobal();
        });

        $(table_id+"_search").find('input.column_filter').on( 'keyup click', function () {
                filterColumn( $(this).parents('tr').attr('data-column') );
                // filterColumn( ( parseInt( $(this).parents('tr').attr('data-column') ) - 1 ).toString() );
        });

        // Handle click on table cells with checkboxes
        $(div_id).on('click', 'tbody td, thead th:first-child', function(e){
           $(this).parent().find('input[type="checkbox"]').trigger('click');
        });

        // Handle click on "Select all" control
        $(div_id).find('thead input[name="select_all"]', dataTable.table().container()).on('click', function(e){
            if(this.checked){
                $(div_id).find('tbody input[type="checkbox"]:not(:checked)').trigger('click');
            } else {
                $(div_id).find('tbody input[type="checkbox"]:checked').trigger('click');
            }
            // Prevent click event from propagating to parent
            e.stopPropagation();
        });

        // Handle table draw event
        dataTable.on('draw', function(){
            // Update state of "Select all" control
            //updateDataTableSelectAllCtrl(dataTable);
        });

        // Handle form submission event 
        $('#frm-example').unbind('click').bind('click', function(e){
            console.log( $(table_id).data("rows_selected") );
        });

        // Handle click on checkbox
        $(div_id).find('tbody').on('click', '[role=row]', function(e){
                var $row = $(this).closest('tr');

                // Get row data
                var data = $(table_id).DataTable().row($row).data();

                // Get row ID
                var rowId = data[0];
                

                // Determine whether row ID is in the list of selected row IDs 
                var index = $.inArray(rowId, $(table_id).data("rows_selected"));

                // If checkbox is checked and row ID is not in list of selected row IDs
                if(this.checked && index === -1){
                   $(table_id).data("rows_selected").push(rowId);

                // Otherwise, if checkbox is not checked and row ID is in list of selected row IDs
                } else if (!this.checked && index !== -1){
                   $(table_id).data("rows_selected").splice(index, 1);
                }

                $(this).parent().children( "tr" ).removeClass('selected');
                $row.addClass('selected');
                
                stockpoint( rowId , 'SHSE' , website_ws_url , $("#container_1") , 1 );
                
                /*
                if(this.checked){
                   $row.addClass('selected');
                } else {
                   $row.removeClass('selected');
                }*/

                // Update state of "Select all" control
                //updateDataTableSelectAllCtrl(dataTable);

                // Prevent click event from propagating to parent
                e.stopPropagation();
         });
         
         /*
        // Handle click on checkbox
        $(div_id).find('tbody').on('click', 'input[type="checkbox"]', function(e){
           var $row = $(this).closest('tr');

           // Get row data
           var data = dataTable.row($row).data();

           // Get row ID
           var rowId = data[0];

           // Determine whether row ID is in the list of selected row IDs 
           var index = $.inArray(rowId, $(table_id).data("rows_selected"));

           // If checkbox is checked and row ID is not in list of selected row IDs
           if(this.checked && index === -1){
              $(table_id).data("rows_selected").push(rowId);

           // Otherwise, if checkbox is not checked and row ID is in list of selected row IDs
           } else if (!this.checked && index !== -1){
              $(table_id).data("rows_selected").splice(index, 1);
           }

           if(this.checked){
              $row.addClass('selected');
           } else {
              $row.removeClass('selected');
           }

           // Update state of "Select all" control
           //updateDataTableSelectAllCtrl(dataTable);

           // Prevent click event from propagating to parent
           e.stopPropagation();
            });    
             */
}

var plug_in_dataTable_reload = function() {
        jQuery.fn.dataTableExt.oApi.fnReloadAjax = function ( oSettings, sNewSource, fnCallback, bStandingRedraw )
        {
            // DataTables 1.10 compatibility - if 1.10 then `versionCheck` exists.
            // 1.10's API has ajax reloading built in, so we use those abilities
            // directly.
            if ( jQuery.fn.dataTable.versionCheck ) {
                var api = new jQuery.fn.dataTable.Api( oSettings );

                if ( sNewSource ) {
                    api.ajax.url( sNewSource ).load( fnCallback, !bStandingRedraw );
                }
                else {
                    api.ajax.reload( fnCallback, !bStandingRedraw );
                }
                return;
            }

            if ( sNewSource !== undefined && sNewSource !== null ) {
                oSettings.sAjaxSource = sNewSource;
            }

            // Server-side processing should just call fnDraw
            if ( oSettings.oFeatures.bServerSide ) {
                this.fnDraw();
                return;
            }

            this.oApi._fnProcessingDisplay( oSettings, true );
            var that = this;
            var iStart = oSettings._iDisplayStart;
            var aData = [];

            this.oApi._fnServerParams( oSettings, aData );

            oSettings.fnServerData.call( oSettings.oInstance, oSettings.sAjaxSource, aData, function(json) {
                /* Clear the old information from the table */
                that.oApi._fnClearTable( oSettings );

                /* Got the data - add it to the table */
                var aData =  (oSettings.sAjaxDataProp !== "") ?
                    that.oApi._fnGetObjectDataFn( oSettings.sAjaxDataProp )( json ) : json;

                for ( var i=0 ; i<aData.length ; i++ )
                {
                    that.oApi._fnAddData( oSettings, aData[i] );
                }

                oSettings.aiDisplay = oSettings.aiDisplayMaster.slice();

                that.fnDraw();

                if ( bStandingRedraw === true )
                {
                    oSettings._iDisplayStart = iStart;
                    that.oApi._fnCalculateEnd( oSettings );
                    that.fnDraw( false );
                }

                that.oApi._fnProcessingDisplay( oSettings, false );

                /* Callback user function - for event handlers etc */
                if ( typeof fnCallback == 'function' && fnCallback !== null )
                {
                    fnCallback( oSettings );
                }
            }, oSettings );
        };
}
