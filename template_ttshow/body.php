
                            <div class="main-content-inner">
                                        <!-- #section:basics/content.breadcrumbs -->
                                        <div class="breadcrumbs" id="breadcrumbs">
                                            <script type="text/javascript">
                                                try {
                                                    ace.settings.check('breadcrumbs', 'fixed')
                                                } catch (e) {}
                                            </script>

                                            <ul class="breadcrumb">
                                                <li>
                                                    <i class="ace-icon fa fa-home home-icon"></i>
                                                    <a href="#">Home</a>
                                                </li>
                                                <li class="active">Dashboard</li>
                                            </ul>
                                            <!-- /.breadcrumb -->

                                            <!-- #section:basics/content.searchbox -->
                                            <div class="nav-search" id="nav-search">
                                                <form class="form-search">
                                                    <span class="input-icon">
                                                                                                <input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
                                                                                                <i class="ace-icon fa fa-search nav-search-icon"></i>
                                                                                        </span>
                                                </form>
                                            </div>
                                            <!-- /.nav-search -->

                                            <!-- /section:basics/content.searchbox -->
                                        </div>
                                        <!-- /section:basics/content.breadcrumbs -->
                                        <div class="page-content">
                                            <!-- #section:settings.box -->
                                            <div class="ace-settings-container" id="ace-settings-container">
                                                <div class="btn btn-app btn-xs btn-warning ace-settings-btn" id="ace-settings-btn">
                                                    <i class="ace-icon fa fa-cog bigger-130"></i>
                                                </div>

                                                <div class="ace-settings-box clearfix" id="ace-settings-box">
                                                    <div class="pull-left width-50">
                                                        <!-- #section:settings.skins -->
                                                        <div class="ace-settings-item">
                                                            <div class="pull-left">
                                                                <select id="skin-colorpicker" class="hide">
                                                                    <option data-skin="no-skin" value="#438EB9">#438EB9</option>
                                                                    <option data-skin="skin-1" value="#222A2D">#222A2D</option>
                                                                    <option data-skin="skin-2" value="#C6487E">#C6487E</option>
                                                                    <option data-skin="skin-3" value="#D0D0D0">#D0D0D0</option>
                                                                </select>
                                                            </div>
                                                            <span>&nbsp; Choose Skin</span>
                                                        </div>

                                                        <!-- /section:settings.skins -->

                                                        <!-- #section:settings.navbar -->
                                                        <div class="ace-settings-item">
                                                            <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-navbar" />
                                                            <label class="lbl" for="ace-settings-navbar"> Fixed Navbar</label>
                                                        </div>

                                                        <!-- /section:settings.navbar -->

                                                        <!-- #section:settings.sidebar -->
                                                        <div class="ace-settings-item">
                                                            <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-sidebar" />
                                                            <label class="lbl" for="ace-settings-sidebar"> Fixed Sidebar</label>
                                                        </div>

                                                        <!-- /section:settings.sidebar -->

                                                        <!-- #section:settings.breadcrumbs -->
                                                        <div class="ace-settings-item">
                                                            <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-breadcrumbs" />
                                                            <label class="lbl" for="ace-settings-breadcrumbs"> Fixed Breadcrumbs</label>
                                                        </div>

                                                        <!-- /section:settings.breadcrumbs -->

                                                        <!-- #section:settings.rtl -->
                                                        <div class="ace-settings-item">
                                                            <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-rtl" />
                                                            <label class="lbl" for="ace-settings-rtl"> Right To Left (rtl)</label>
                                                        </div>

                                                        <!-- /section:settings.rtl -->

                                                        <!-- #section:settings.container -->
                                                        <div class="ace-settings-item">
                                                            <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-add-container" />
                                                            <label class="lbl" for="ace-settings-add-container">
                                                                Inside
                                                                <b>.container</b>
                                                            </label>
                                                        </div>

                                                        <!-- /section:settings.container -->
                                                    </div>
                                                    <!-- /.pull-left -->

                                                    <div class="pull-left width-50">
                                                        <!-- #section:basics/sidebar.options -->
                                                        <div class="ace-settings-item">
                                                            <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-hover" />
                                                            <label class="lbl" for="ace-settings-hover"> Submenu on Hover</label>
                                                        </div>

                                                        <div class="ace-settings-item">
                                                            <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-compact" />
                                                            <label class="lbl" for="ace-settings-compact"> Compact Sidebar</label>
                                                        </div>

                                                        <div class="ace-settings-item">
                                                            <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-highlight" />
                                                            <label class="lbl" for="ace-settings-highlight"> Alt. Active Item</label>
                                                        </div>

                                                        <!-- /section:basics/sidebar.options -->
                                                    </div>
                                                    <!-- /.pull-left -->
                                                </div>
                                                <!-- /.ace-settings-box -->
                                            </div>
                                            <!-- /.ace-settings-container -->

                                            <!-- /section:settings.box -->
                                            <div class="page-header">
                                                <h1>
                                                                                        我的創作 	
                                                                                </h1>
                                            </div>
                                            <!-- /.page-header -->

                                            <div class="row">
                                                <div>
                                                    <div class="dataTables_wrapper form-inline no-footer" id="dynamic-table_wrapper">
                                                        <div class="row">
                                                            <div class="col-xs-4" style="padding-left: 0">
                                                                <div id="dynamic-table_length" class="dataTables_length">
                                                                    <label>
                                                                        <select class="form-control input-sm" aria-controls="dynamic-table" name="dynamic-table_length">
                                                                            <option value="10">
                                                                                全部日期
                                                                            </option>
                                                                            <option value="25">
                                                                                25
                                                                            </option>
                                                                            <option value="50">
                                                                                50
                                                                            </option>
                                                                            <option value="100">
                                                                                100
                                                                            </option>
                                                                        </select>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-4" style="padding-left: 0">
                                                                <div class="dataTables_length" id="dynamic-table_length">
                                                                    <label>
                                                                        <select name="dynamic-table_length" aria-controls="dynamic-table" class="form-control input-sm">
                                                                            <option value="10">
                                                                                所有分類
                                                                            </option>
                                                                            <option value="25">
                                                                                25
                                                                            </option>
                                                                            <option value="50">
                                                                                50
                                                                            </option>
                                                                            <option value="100">
                                                                                100
                                                                            </option>
                                                                        </select>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-4" style="padding-left: 0px;">
                                                                <button type="button" class="btn btn-white btn-primary">
                                                                    篩選
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <table aria-describedby="dynamic-table_info" role="grid" id="dynamic-table" class="table table-striped table-bordered table-hover dataTable no-footer DTTT_selectable">
                                                            <thead>
                                                                <tr role="row">
                                                                    <th aria-label="




                        " colspan="1" rowspan="1" class="center sorting_disabled">
                                                                        <label class="pos-rel">
                                                                            <input type="checkbox" class="ace">
                                                                            <span class="lbl">
                            </span>
                                                                        </label>
                                                                    </th>
                                                                    <th aria-label="Domain: activate to sort column ascending" colspan="1" rowspan="1" aria-controls="dynamic-table" tabindex="0" class="sorting">
                                                                        標題
                                                                    </th>
                                                                    <th aria-label="" colspan="1" rowspan="1" class="sorting_disabled">
                                                                    </th>
                                                                </tr>
                                                            </thead>

                                                            <tbody>





                                                                <tr class="odd" role="row">
                                                                    <td class="center">
                                                                        <label class="pos-rel">
                                                                            <input type="checkbox" class="ace">
                                                                            <span class="lbl">
                                        </span>
                                                                        </label>
                                                                    </td>




                                                                    <td>
                                                                        <a href="#">
                                        base.com
                                      </a>
                                                                    </td>



                                                                    <td>
                                                                        <div class="hidden-sm hidden-xs action-buttons">
                                                                            <a class="blue" href="#">
                                                                                <i class="ace-icon fa fa-search-plus bigger-130">
                                          </i>
                                                                            </a>

                                                                            <a class="green" href="#">
                                                                                <i class="ace-icon fa fa-pencil bigger-130">
                                          </i>
                                                                            </a>

                                                                            <a class="red" href="#">
                                                                                <i class="ace-icon fa fa-trash-o bigger-130">
                                          </i>
                                                                            </a>
                                                                        </div>

                                                                        <div class="hidden-md hidden-lg">
                                                                            <div class="inline pos-rel">
                                                                                <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto" aria-expanded="false">
                                                                                    <i class="ace-icon fa fa-caret-down icon-only bigger-120">
                                            </i>
                                                                                </button>

                                                                                <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close" style="">
                                                                                    <li>
                                                                                        <a data-original-title="View" href="#" class="tooltip-info" data-rel="tooltip" title="">
                                                                                            <span class="blue">
                                                  <i class="ace-icon fa fa-search-plus bigger-120">
                                                  </i>
                                                </span>
                                                                                        </a>
                                                                                    </li>

                                                                                    <li>
                                                                                        <a data-original-title="Edit" href="#" class="tooltip-success" data-rel="tooltip" title="">
                                                                                            <span class="green">
                                                  <i class="ace-icon fa fa-pencil-square-o bigger-120">
                                                  </i>
                                                </span>
                                                                                        </a>
                                                                                    </li>

                                                                                    <li>
                                                                                        <a data-original-title="Delete" href="#" class="tooltip-error" data-rel="tooltip" title="">
                                                                                            <span class="red">
                                                  <i class="ace-icon fa fa-trash-o bigger-120">
                                                  </i>
                                                </span>
                                                                                        </a>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr class="even" role="row">
                                                                    <td class="center">
                                                                        <label class="pos-rel">
                                                                            <input type="checkbox" class="ace">
                                                                            <span class="lbl">
                                        </span>
                                                                        </label>
                                                                    </td>

                                                                    <td>
                                                                        <a href="#">
                                        base.com
                                      </a>
                                                                    </td>





                                                                    <td>
                                                                        <div class="hidden-sm hidden-xs action-buttons">
                                                                            <a class="blue" href="#">
                                                                                <i class="ace-icon fa fa-search-plus bigger-130">
                                          </i>
                                                                            </a>

                                                                            <a class="green" href="#">
                                                                                <i class="ace-icon fa fa-pencil bigger-130">
                                          </i>
                                                                            </a>

                                                                            <a class="red" href="#">
                                                                                <i class="ace-icon fa fa-trash-o bigger-130">
                                          </i>
                                                                            </a>
                                                                        </div>

                                                                        <div class="hidden-md hidden-lg">
                                                                            <div class="inline pos-rel">
                                                                                <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                                                                    <i class="ace-icon fa fa-caret-down icon-only bigger-120">
                                            </i>
                                                                                </button>

                                                                                <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                                                                    <li>
                                                                                        <a data-original-title="View" href="#" class="tooltip-info" data-rel="tooltip" title="">
                                                                                            <span class="blue">
                                                  <i class="ace-icon fa fa-search-plus bigger-120">
                                                  </i>
                                                </span>
                                                                                        </a>
                                                                                    </li>

                                                                                    <li>
                                                                                        <a data-original-title="Edit" href="#" class="tooltip-success" data-rel="tooltip" title="">
                                                                                            <span class="green">
                                                  <i class="ace-icon fa fa-pencil-square-o bigger-120">
                                                  </i>
                                                </span>
                                                                                        </a>
                                                                                    </li>

                                                                                    <li>
                                                                                        <a data-original-title="Delete" href="#" class="tooltip-error" data-rel="tooltip" title="">
                                                                                            <span class="red">
                                                  <i class="ace-icon fa fa-trash-o bigger-120">
                                                  </i>
                                                </span>
                                                                                        </a>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr class="odd" role="row">
                                                                    <td class="center">
                                                                        <label class="pos-rel">
                                                                            <input type="checkbox" class="ace">
                                                                            <span class="lbl">
                                        </span>
                                                                        </label>
                                                                    </td>





                                                                    <td>
                                                                        <a href="#">
                                        base.com
                                      </a>
                                                                    </td>

                                                                    <td>
                                                                        <div class="hidden-sm hidden-xs action-buttons">
                                                                            <a class="blue" href="#">
                                                                                <i class="ace-icon fa fa-search-plus bigger-130">
                                          </i>
                                                                            </a>

                                                                            <a class="green" href="#">
                                                                                <i class="ace-icon fa fa-pencil bigger-130">
                                          </i>
                                                                            </a>

                                                                            <a class="red" href="#">
                                                                                <i class="ace-icon fa fa-trash-o bigger-130">
                                          </i>
                                                                            </a>
                                                                        </div>

                                                                        <div class="hidden-md hidden-lg">
                                                                            <div class="inline pos-rel">
                                                                                <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                                                                    <i class="ace-icon fa fa-caret-down icon-only bigger-120">
                                            </i>
                                                                                </button>

                                                                                <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                                                                    <li>
                                                                                        <a data-original-title="View" href="#" class="tooltip-info" data-rel="tooltip" title="">
                                                                                            <span class="blue">
                                                  <i class="ace-icon fa fa-search-plus bigger-120">
                                                  </i>
                                                </span>
                                                                                        </a>
                                                                                    </li>

                                                                                    <li>
                                                                                        <a data-original-title="Edit" href="#" class="tooltip-success" data-rel="tooltip" title="">
                                                                                            <span class="green">
                                                  <i class="ace-icon fa fa-pencil-square-o bigger-120">
                                                  </i>
                                                </span>
                                                                                        </a>
                                                                                    </li>

                                                                                    <li>
                                                                                        <a data-original-title="Delete" href="#" class="tooltip-error" data-rel="tooltip" title="">
                                                                                            <span class="red">
                                                  <i class="ace-icon fa fa-trash-o bigger-120">
                                                  </i>
                                                </span>
                                                                                        </a>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr class="even" role="row">
                                                                    <td class="center">
                                                                        <label class="pos-rel">
                                                                            <input type="checkbox" class="ace">
                                                                            <span class="lbl">
                                        </span>
                                                                        </label>
                                                                    </td>

                                                                    <td>
                                                                        <a href="#">
                                        best.com
                                      </a>
                                                                    </td>





                                                                    <td>
                                                                        <div class="hidden-sm hidden-xs action-buttons">
                                                                            <a class="blue" href="#">
                                                                                <i class="ace-icon fa fa-search-plus bigger-130">
                                          </i>
                                                                            </a>

                                                                            <a class="green" href="#">
                                                                                <i class="ace-icon fa fa-pencil bigger-130">
                                          </i>
                                                                            </a>

                                                                            <a class="red" href="#">
                                                                                <i class="ace-icon fa fa-trash-o bigger-130">
                                          </i>
                                                                            </a>
                                                                        </div>

                                                                        <div class="hidden-md hidden-lg">
                                                                            <div class="inline pos-rel">
                                                                                <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                                                                    <i class="ace-icon fa fa-caret-down icon-only bigger-120">
                                            </i>
                                                                                </button>

                                                                                <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                                                                    <li>
                                                                                        <a data-original-title="View" href="#" class="tooltip-info" data-rel="tooltip" title="">
                                                                                            <span class="blue">
                                                  <i class="ace-icon fa fa-search-plus bigger-120">
                                                  </i>
                                                </span>
                                                                                        </a>
                                                                                    </li>

                                                                                    <li>
                                                                                        <a data-original-title="Edit" href="#" class="tooltip-success" data-rel="tooltip" title="">
                                                                                            <span class="green">
                                                  <i class="ace-icon fa fa-pencil-square-o bigger-120">
                                                  </i>
                                                </span>
                                                                                        </a>
                                                                                    </li>

                                                                                    <li>
                                                                                        <a data-original-title="Delete" href="#" class="tooltip-error" data-rel="tooltip" title="">
                                                                                            <span class="red">
                                                  <i class="ace-icon fa fa-trash-o bigger-120">
                                                  </i>
                                                </span>
                                                                                        </a>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr class="odd" role="row">
                                                                    <td class="center">
                                                                        <label class="pos-rel">
                                                                            <input type="checkbox" class="ace">
                                                                            <span class="lbl">
                                        </span>
                                                                        </label>
                                                                    </td>

                                                                    <td>
                                                                        <a href="#">
                                        pro.com
                                      </a>
                                                                    </td>





                                                                    <td>
                                                                        <div class="hidden-sm hidden-xs action-buttons">
                                                                            <a class="blue" href="#">
                                                                                <i class="ace-icon fa fa-search-plus bigger-130">
                                          </i>
                                                                            </a>

                                                                            <a class="green" href="#">
                                                                                <i class="ace-icon fa fa-pencil bigger-130">
                                          </i>
                                                                            </a>

                                                                            <a class="red" href="#">
                                                                                <i class="ace-icon fa fa-trash-o bigger-130">
                                          </i>
                                                                            </a>
                                                                        </div>

                                                                        <div class="hidden-md hidden-lg">
                                                                            <div class="inline pos-rel">
                                                                                <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                                                                    <i class="ace-icon fa fa-caret-down icon-only bigger-120">
                                            </i>
                                                                                </button>

                                                                                <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                                                                    <li>
                                                                                        <a data-original-title="View" href="#" class="tooltip-info" data-rel="tooltip" title="">
                                                                                            <span class="blue">
                                                  <i class="ace-icon fa fa-search-plus bigger-120">
                                                  </i>
                                                </span>
                                                                                        </a>
                                                                                    </li>

                                                                                    <li>
                                                                                        <a data-original-title="Edit" href="#" class="tooltip-success" data-rel="tooltip" title="">
                                                                                            <span class="green">
                                                  <i class="ace-icon fa fa-pencil-square-o bigger-120">
                                                  </i>
                                                </span>
                                                                                        </a>
                                                                                    </li>

                                                                                    <li>
                                                                                        <a data-original-title="Delete" href="#" class="tooltip-error" data-rel="tooltip" title="">
                                                                                            <span class="red">
                                                  <i class="ace-icon fa fa-trash-o bigger-120">
                                                  </i>
                                                </span>
                                                                                        </a>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr class="even" role="row">
                                                                    <td class="center">
                                                                        <label class="pos-rel">
                                                                            <input type="checkbox" class="ace">
                                                                            <span class="lbl">
                                        </span>
                                                                        </label>
                                                                    </td>





                                                                    <td>
                                                                        <a href="#">
                                        pro.com
                                      </a>
                                                                    </td>

                                                                    <td>
                                                                        <div class="hidden-sm hidden-xs action-buttons">
                                                                            <a class="blue" href="#">
                                                                                <i class="ace-icon fa fa-search-plus bigger-130">
                                          </i>
                                                                            </a>

                                                                            <a class="green" href="#">
                                                                                <i class="ace-icon fa fa-pencil bigger-130">
                                          </i>
                                                                            </a>

                                                                            <a class="red" href="#">
                                                                                <i class="ace-icon fa fa-trash-o bigger-130">
                                          </i>
                                                                            </a>
                                                                        </div>

                                                                        <div class="hidden-md hidden-lg">
                                                                            <div class="inline pos-rel">
                                                                                <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                                                                    <i class="ace-icon fa fa-caret-down icon-only bigger-120">
                                            </i>
                                                                                </button>

                                                                                <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                                                                    <li>
                                                                                        <a data-original-title="View" href="#" class="tooltip-info" data-rel="tooltip" title="">
                                                                                            <span class="blue">
                                                  <i class="ace-icon fa fa-search-plus bigger-120">
                                                  </i>
                                                </span>
                                                                                        </a>
                                                                                    </li>

                                                                                    <li>
                                                                                        <a data-original-title="Edit" href="#" class="tooltip-success" data-rel="tooltip" title="">
                                                                                            <span class="green">
                                                  <i class="ace-icon fa fa-pencil-square-o bigger-120">
                                                  </i>
                                                </span>
                                                                                        </a>
                                                                                    </li>

                                                                                    <li>
                                                                                        <a data-original-title="Delete" href="#" class="tooltip-error" data-rel="tooltip" title="">
                                                                                            <span class="red">
                                                  <i class="ace-icon fa fa-trash-o bigger-120">
                                                  </i>
                                                </span>
                                                                                        </a>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr class="odd" role="row">
                                                                    <td class="center">
                                                                        <label class="pos-rel">
                                                                            <input type="checkbox" class="ace">
                                                                            <span class="lbl">
                                        </span>
                                                                        </label>
                                                                    </td>

                                                                    <td>
                                                                        <a href="#">
                                        up.com
                                      </a>
                                                                    </td>





                                                                    <td>
                                                                        <div class="hidden-sm hidden-xs action-buttons">
                                                                            <a class="blue" href="#">
                                                                                <i class="ace-icon fa fa-search-plus bigger-130">
                                          </i>
                                                                            </a>

                                                                            <a class="green" href="#">
                                                                                <i class="ace-icon fa fa-pencil bigger-130">
                                          </i>
                                                                            </a>

                                                                            <a class="red" href="#">
                                                                                <i class="ace-icon fa fa-trash-o bigger-130">
                                          </i>
                                                                            </a>
                                                                        </div>

                                                                        <div class="hidden-md hidden-lg">
                                                                            <div class="inline pos-rel">
                                                                                <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                                                                    <i class="ace-icon fa fa-caret-down icon-only bigger-120">
                                            </i>
                                                                                </button>

                                                                                <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                                                                    <li>
                                                                                        <a data-original-title="View" href="#" class="tooltip-info" data-rel="tooltip" title="">
                                                                                            <span class="blue">
                                                  <i class="ace-icon fa fa-search-plus bigger-120">
                                                  </i>
                                                </span>
                                                                                        </a>
                                                                                    </li>

                                                                                    <li>
                                                                                        <a data-original-title="Edit" href="#" class="tooltip-success" data-rel="tooltip" title="">
                                                                                            <span class="green">
                                                  <i class="ace-icon fa fa-pencil-square-o bigger-120">
                                                  </i>
                                                </span>
                                                                                        </a>
                                                                                    </li>

                                                                                    <li>
                                                                                        <a data-original-title="Delete" href="#" class="tooltip-error" data-rel="tooltip" title="">
                                                                                            <span class="red">
                                                  <i class="ace-icon fa fa-trash-o bigger-120">
                                                  </i>
                                                </span>
                                                                                        </a>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr class="even" role="row">
                                                                    <td class="center">
                                                                        <label class="pos-rel">
                                                                            <input type="checkbox" class="ace">
                                                                            <span class="lbl">
                                        </span>
                                                                        </label>
                                                                    </td>

                                                                    <td>
                                                                        <a href="#">
                                        view.com
                                      </a>
                                                                    </td>





                                                                    <td>
                                                                        <div class="hidden-sm hidden-xs action-buttons">
                                                                            <a class="blue" href="#">
                                                                                <i class="ace-icon fa fa-search-plus bigger-130">
                                          </i>
                                                                            </a>

                                                                            <a class="green" href="#">
                                                                                <i class="ace-icon fa fa-pencil bigger-130">
                                          </i>
                                                                            </a>

                                                                            <a class="red" href="#">
                                                                                <i class="ace-icon fa fa-trash-o bigger-130">
                                          </i>
                                                                            </a>
                                                                        </div>

                                                                        <div class="hidden-md hidden-lg">
                                                                            <div class="inline pos-rel">
                                                                                <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                                                                    <i class="ace-icon fa fa-caret-down icon-only bigger-120">
                                            </i>
                                                                                </button>

                                                                                <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                                                                    <li>
                                                                                        <a data-original-title="View" href="#" class="tooltip-info" data-rel="tooltip" title="">
                                                                                            <span class="blue">
                                                  <i class="ace-icon fa fa-search-plus bigger-120">
                                                  </i>
                                                </span>
                                                                                        </a>
                                                                                    </li>

                                                                                    <li>
                                                                                        <a data-original-title="Edit" href="#" class="tooltip-success" data-rel="tooltip" title="">
                                                                                            <span class="green">
                                                  <i class="ace-icon fa fa-pencil-square-o bigger-120">
                                                  </i>
                                                </span>
                                                                                        </a>
                                                                                    </li>

                                                                                    <li>
                                                                                        <a data-original-title="Delete" href="#" class="tooltip-error" data-rel="tooltip" title="">
                                                                                            <span class="red">
                                                  <i class="ace-icon fa fa-trash-o bigger-120">
                                                  </i>
                                                </span>
                                                                                        </a>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr class="odd" role="row">
                                                                    <td class="center">
                                                                        <label class="pos-rel">
                                                                            <input type="checkbox" class="ace">
                                                                            <span class="lbl">
                                        </span>
                                                                        </label>
                                                                    </td>

                                                                    <td>
                                                                        <a href="#">
                                        nice.com
                                      </a>
                                                                    </td>





                                                                    <td>
                                                                        <div class="hidden-sm hidden-xs action-buttons">
                                                                            <a class="blue" href="#">
                                                                                <i class="ace-icon fa fa-search-plus bigger-130">
                                          </i>
                                                                            </a>

                                                                            <a class="green" href="#">
                                                                                <i class="ace-icon fa fa-pencil bigger-130">
                                          </i>
                                                                            </a>

                                                                            <a class="red" href="#">
                                                                                <i class="ace-icon fa fa-trash-o bigger-130">
                                          </i>
                                                                            </a>
                                                                        </div>

                                                                        <div class="hidden-md hidden-lg">
                                                                            <div class="inline pos-rel">
                                                                                <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                                                                    <i class="ace-icon fa fa-caret-down icon-only bigger-120">
                                            </i>
                                                                                </button>

                                                                                <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                                                                    <li>
                                                                                        <a data-original-title="View" href="#" class="tooltip-info" data-rel="tooltip" title="">
                                                                                            <span class="blue">
                                                  <i class="ace-icon fa fa-search-plus bigger-120">
                                                  </i>
                                                </span>
                                                                                        </a>
                                                                                    </li>

                                                                                    <li>
                                                                                        <a data-original-title="Edit" href="#" class="tooltip-success" data-rel="tooltip" title="">
                                                                                            <span class="green">
                                                  <i class="ace-icon fa fa-pencil-square-o bigger-120">
                                                  </i>
                                                </span>
                                                                                        </a>
                                                                                    </li>

                                                                                    <li>
                                                                                        <a data-original-title="Delete" href="#" class="tooltip-error" data-rel="tooltip" title="">
                                                                                            <span class="red">
                                                  <i class="ace-icon fa fa-trash-o bigger-120">
                                                  </i>
                                                </span>
                                                                                        </a>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr class="even" role="row">
                                                                    <td class="center">
                                                                        <label class="pos-rel">
                                                                            <input type="checkbox" class="ace">
                                                                            <span class="lbl">
                                        </span>
                                                                        </label>
                                                                    </td>

                                                                    <td>
                                                                        <a href="#">
                                        fine.com
                                      </a>
                                                                    </td>





                                                                    <td>
                                                                        <div class="hidden-sm hidden-xs action-buttons">
                                                                            <a class="blue" href="#">
                                                                                <i class="ace-icon fa fa-search-plus bigger-130">
                                          </i>
                                                                            </a>

                                                                            <a class="green" href="#">
                                                                                <i class="ace-icon fa fa-pencil bigger-130">
                                          </i>
                                                                            </a>

                                                                            <a class="red" href="#">
                                                                                <i class="ace-icon fa fa-trash-o bigger-130">
                                          </i>
                                                                            </a>
                                                                        </div>

                                                                        <div class="hidden-md hidden-lg">
                                                                            <div class="inline pos-rel">
                                                                                <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                                                                    <i class="ace-icon fa fa-caret-down icon-only bigger-120">
                                            </i>
                                                                                </button>

                                                                                <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                                                                    <li>
                                                                                        <a data-original-title="View" href="#" class="tooltip-info" data-rel="tooltip" title="">
                                                                                            <span class="blue">
                                                  <i class="ace-icon fa fa-search-plus bigger-120">
                                                  </i>
                                                </span>
                                                                                        </a>
                                                                                    </li>

                                                                                    <li>
                                                                                        <a data-original-title="Edit" href="#" class="tooltip-success" data-rel="tooltip" title="">
                                                                                            <span class="green">
                                                  <i class="ace-icon fa fa-pencil-square-o bigger-120">
                                                  </i>
                                                </span>
                                                                                        </a>
                                                                                    </li>

                                                                                    <li>
                                                                                        <a data-original-title="Delete" href="#" class="tooltip-error" data-rel="tooltip" title="">
                                                                                            <span class="red">
                                                  <i class="ace-icon fa fa-trash-o bigger-120">
                                                  </i>
                                                </span>
                                                                                        </a>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <div class="row">
                                                            <div class="col-xs-7">
                                                                <div class="dataTables_paginate paging_simple_numbers" id="dynamic-table_paginate">
                                                                    <ul class="pagination">
                                                                        <li class="paginate_button active" aria-controls="dynamic-table" tabindex="0">
                                                                            <a href="#">
                                          1
                                        </a>
                                                                        </li>
                                                                        <li class="paginate_button " aria-controls="dynamic-table" tabindex="0">
                                                                            <a href="#">
                                          2
                                        </a>
                                                                        </li>
                                                                        <li class="paginate_button " aria-controls="dynamic-table" tabindex="0">
                                                                            <a href="#">
                                          3
                                        </a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-5">
                                                                <div aria-live="polite" role="status" id="dynamic-table_info" class="dataTables_info">
                                                                    共 99 個項目
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /.col -->
                                            </div>

                                        </div>
                                        <!-- /.page-content -->
                            </div>
                