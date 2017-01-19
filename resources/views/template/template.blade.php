<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title> ELECTRO COMPU - {{ $titulo or 'ELECTRO COMPU'}}</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.5 -->
        {!!Html::style('assets/bootstrap/css/bootstrap.min.css')!!}
        <!-- Font Awesome -->
        {!!Html::style('https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css')!!}

        <!-- Ionicons -->
        {!!Html::style('https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css')!!}
        <!-- daterange picker -->
        {!!Html::style('assets/plugins/daterangepicker/daterangepicker-bs3.css')!!}
        <!-- iCheck for checkboxes and radio inputs -->
        {!!Html::style('assets/plugins/iCheck/all.css')!!}
        <!-- Bootstrap Color Picker -->
        {!!Html::style('assets/plugins/colorpicker/bootstrap-colorpicker.min.css')!!}
        <!-- Bootstrap time Picker -->
        {!!Html::style('assets/plugins/timepicker/bootstrap-timepicker.min.css')!!}
        <!-- Select2 -->
        {!!Html::style('assets/plugins/select2/select2.min.css')!!}
        <!-- Theme style -->
        {!!Html::style('assets/dist/css/AdminLTE.min.css')!!}
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        {!!Html::style('assets/dist/css/skins/_all-skins.min.css')!!}
        {!!Html::style('assets/validadores/estilos.css')!!}

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <header class="main-header">
                <!-- Logo -->
                <a href="{!!URL::to('/home')!!}" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><img src="{!!URL::to('assets/dist/img/miniLogo.png')!!}" class="responsive"></span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><img src="{!!URL::to('assets/dist/img/logoGrande.png')!!}" class="responsive"></span>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top" role="navigation">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <!-- User Account: style can be found in dropdown.less -->
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <span class="hidden-xs">{!!Auth::user()->nombredeusuario(Auth::user()->usuario)!!}</span>
                                </a>
                                <ul class="dropdown-menu">

                                    <!-- Menu Body -->
                                    <li class="user-body">
                                        <div class="col-xs-12 with-border">
                                            <a href="#">Perfil</a>
                                        </div>
                                        <div class="col-xs-12">
                                            <a href="{!!URL::to('/salir')!!}">Salir</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <!-- Control Sidebar Toggle Button -->
                            <li>
                                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li class="header">MENÚ DE NAVEGACIÓN</li>
                        <li>
                            <a href="{!!URL::to('/home')!!}">
                                <i class="fa fa-home"></i> <span>HOME</span>
                            </a>
                        </li>
                        @if (Auth::user()->ObtenerRol(Auth::user()->usuario)=='Administrador')
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-dashboard"></i> <span>ADMINISTRAR</span> <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="{!!URL::to('/equipo')!!}"><i class="fa fa-laptop"></i> Equipos</a></li>
                                <li><a href="{!!URL::to('/marca')!!}"><i class="fa fa-laptop"></i> Marcas</a></li>
                                <li><a href="{!!URL::to('/modelo')!!}"><i class="fa fa-circle-o"></i> Modelos</a></li>
                                <li><a href="{!!URL::to('/servicio')!!}"><i class="fa fa-plus-circle"></i> Servicios</a></li>
                                <li><a href="{!!URL::to('/usuario')!!}"><i class="fa fa-user"></i> Usuarios</a></li>
                                <li><a href="{!!URL::to('/cliente')!!}"><i class="fa fa-child"></i> Clientes</a></li>
                            </ul>
                        </li>
                        @endif
                        
                        @if (Auth::user()->ObtenerRol(Auth::user()->usuario)=='Administrador' || Auth::user()->ObtenerRol(Auth::user()->usuario)=="Recepcion" )
                        <li>
                            <a href="{!!URL::to('/orden')!!}">
                                <i class="fa fa-clone"></i> <span>ORDEN DE REPARACIÓN</span>
                            </a>
                        </li>
                        @endif
                        
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        {{$titulo or ''}}
                    </h1>
                </section>
                @yield('contenido')
            </div><!-- /.content-wrapper -->
            <footer class="main-footer">
                <div class="pull-right hidden-xs">
                    <b>Version</b> 2.3.0
                </div>
                <strong>Copyright &copy; 2014-2015 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights reserved.
            </footer>

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Create the tabs -->
                <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
                    <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
                    <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <!-- Home tab content -->
                    <div class="tab-pane" id="control-sidebar-home-tab">
                        <h3 class="control-sidebar-heading">Recent Activity</h3>
                        <ul class="control-sidebar-menu">
                            <li>
                                <a href="javascript::;">
                                    <i class="menu-icon fa fa-birthday-cake bg-red"></i>
                                    <div class="menu-info">
                                        <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>
                                        <p>Will be 23 on April 24th</p>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript::;">
                                    <i class="menu-icon fa fa-user bg-yellow"></i>
                                    <div class="menu-info">
                                        <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>
                                        <p>New phone +1(800)555-1234</p>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript::;">
                                    <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>
                                    <div class="menu-info">
                                        <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>
                                        <p>nora@example.com</p>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript::;">
                                    <i class="menu-icon fa fa-file-code-o bg-green"></i>
                                    <div class="menu-info">
                                        <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>
                                        <p>Execution time 5 seconds</p>
                                    </div>
                                </a>
                            </li>
                        </ul><!-- /.control-sidebar-menu -->

                        <h3 class="control-sidebar-heading">Tasks Progress</h3>
                        <ul class="control-sidebar-menu">
                            <li>
                                <a href="javascript::;">
                                    <h4 class="control-sidebar-subheading">
                                        Custom Template Design
                                        <span class="label label-danger pull-right">70%</span>
                                    </h4>
                                    <div class="progress progress-xxs">
                                        <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript::;">
                                    <h4 class="control-sidebar-subheading">
                                        Update Resume
                                        <span class="label label-success pull-right">95%</span>
                                    </h4>
                                    <div class="progress progress-xxs">
                                        <div class="progress-bar progress-bar-success" style="width: 95%"></div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript::;">
                                    <h4 class="control-sidebar-subheading">
                                        Laravel Integration
                                        <span class="label label-warning pull-right">50%</span>
                                    </h4>
                                    <div class="progress progress-xxs">
                                        <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript::;">
                                    <h4 class="control-sidebar-subheading">
                                        Back End Framework
                                        <span class="label label-primary pull-right">68%</span>
                                    </h4>
                                    <div class="progress progress-xxs">
                                        <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
                                    </div>
                                </a>
                            </li>
                        </ul><!-- /.control-sidebar-menu -->

                    </div><!-- /.tab-pane -->
                    <!-- Stats tab content -->
                    <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div><!-- /.tab-pane -->
                    <!-- Settings tab content -->
                    <div class="tab-pane" id="control-sidebar-settings-tab">
                        <form method="post">
                            <h3 class="control-sidebar-heading">General Settings</h3>
                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                    Report panel usage
                                    <input type="checkbox" class="pull-right" checked>
                                </label>
                                <p>
                                    Some information about this general settings option
                                </p>
                            </div><!-- /.form-group -->

                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                    Allow mail redirect
                                    <input type="checkbox" class="pull-right" checked>
                                </label>
                                <p>
                                    Other sets of options are available
                                </p>
                            </div><!-- /.form-group -->

                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                    Expose author name in posts
                                    <input type="checkbox" class="pull-right" checked>
                                </label>
                                <p>
                                    Allow the user to show his name in blog posts
                                </p>
                            </div><!-- /.form-group -->

                            <h3 class="control-sidebar-heading">Chat Settings</h3>

                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                    Show me as online
                                    <input type="checkbox" class="pull-right" checked>
                                </label>
                            </div><!-- /.form-group -->

                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                    Turn off notifications
                                    <input type="checkbox" class="pull-right">
                                </label>
                            </div><!-- /.form-group -->

                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                    Delete chat history
                                    <a href="javascript::;" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
                                </label>
                            </div><!-- /.form-group -->
                        </form>
                    </div><!-- /.tab-pane -->
                </div>
            </aside><!-- /.control-sidebar -->
            <!-- Add the sidebar's background. This div must be placed
                 immediately after the control sidebar -->
            <div class="control-sidebar-bg"></div>
        </div><!-- ./wrapper -->

        <!-- jQuery 2.1.4 -->
        {!!Html::script('assets/plugins/jQuery/jQuery-2.1.4.min.js')!!}
        <!-- Bootstrap 3.3.5 -->
        {!!Html::script('assets/bootstrap/js/bootstrap.min.js')!!}
        <!-- Select2 -->
        {!!Html::script('assets/plugins/select2/select2.full.min.js')!!}
        <!-- InputMask -->
        {!!Html::script('assets/plugins/input-mask/jquery.inputmask.js')!!}
        {!!Html::script('assets/plugins/input-mask/jquery.inputmask.date.extensions.js')!!}
        {!!Html::script('assets/plugins/input-mask/jquery.inputmask.extensions.js')!!}
        <!-- date-range-picker -->
        {!!Html::script('https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js')!!}
        {!!Html::script('assets/plugins/daterangepicker/daterangepicker.js')!!}
        <!-- bootstrap color picker -->
        {!!Html::script('assets/plugins/colorpicker/bootstrap-colorpicker.min.js')!!}
        <!-- bootstrap time picker -->
        {!!Html::script('assets/plugins/timepicker/bootstrap-timepicker.min.js')!!}
        <!-- SlimScroll 1.3.0 -->
        {!!Html::script('assets/plugins/slimScroll/jquery.slimscroll.min.js')!!}
        <!-- iCheck 1.0.1 -->
        {!!Html::script('assets/plugins/iCheck/icheck.min.js')!!}
        <!-- FastClick -->
        {!!Html::script('assets/plugins/fastclick/fastclick.min.js')!!}
        <!-- AdminLTE App -->
        {!!Html::script('assets/dist/js/app.min.js')!!}
        <!-- AdminLTE for demo purposes -->
        {!!Html::script('assets/dist/js/demo.js')!!}
        <!-- Page script -->
        <script>
            $(function() {
                //Initialize Select2 Elements
                $(".select2").select2();

                //Datemask dd/mm/yyyy
                $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
                //Datemask2 mm/dd/yyyy
                $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
                //Money Euro
                $("[data-mask]").inputmask();

                //Date range picker
                $('#reservation').daterangepicker();
                //Date range picker with time picker
                $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
                //Date range as a button
                $('#daterange-btn').daterangepicker(
                        {
                            ranges: {
                                'Today': [moment(), moment()],
                                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                                'This Month': [moment().startOf('month'), moment().endOf('month')],
                                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                            },
                            startDate: moment().subtract(29, 'days'),
                            endDate: moment()
                        },
                function(start, end) {
                    $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                }
                );

                //iCheck for checkbox and radio inputs
                $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                    checkboxClass: 'icheckbox_minimal-blue',
                    radioClass: 'iradio_minimal-blue'
                });
                //Red color scheme for iCheck
                $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
                    checkboxClass: 'icheckbox_minimal-red',
                    radioClass: 'iradio_minimal-red'
                });
                //Flat red color scheme for iCheck
                $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                    checkboxClass: 'icheckbox_flat-green',
                    radioClass: 'iradio_flat-green'
                });

                //Colorpicker
                $(".my-colorpicker1").colorpicker();
                //color picker with addon
                $(".my-colorpicker2").colorpicker();

                //Timepicker
                $(".timepicker").timepicker({
                    showInputs: false
                });
            });
        </script>
        <!-- form validation -->
        {!!Html::script('assets/validadores/validator.js')!!}
        {!!Html::script('assets/validadores/validar.js')!!}
        <script>
            // initialize the validator function
            validator.message['date'] = 'not a real date';

            // validate a field on "blur" event, a 'select' on 'change' event & a '.reuired' classed multifield on 'keyup':
            $('form')
                    .on('blur', 'input[required], input.optional, select.required', validator.checkField)
                    .on('change', 'select.required', validator.checkField)
                    .on('keypress', 'input[required][pattern]', validator.keypress);

            $('.multi.required')
                    .on('keyup blur', 'input', function() {
                        validator.checkField.apply($(this).siblings().last()[0]);
                    });

            // bind the validation to the form submit event
            //$('#send').click('submit');//.prop('disabled', true);

            $('form').submit(function(e) {
                e.preventDefault();
                var submit = true;
                // evaluate the form using generic validaing
                if (!validator.checkAll($(this))) {
                    submit = false;
                }

                if (submit)
                    this.submit();
                return false;
            });

            /* FOR DEMO ONLY */
            $('#vfields').change(function() {
                $('form').toggleClass('mode2');
            }).prop('checked', false);

            $('#alerts').change(function() {
                validator.defaults.alerts = (this.checked) ? false : true;
                if (this.checked)
                    $('form .alert').remove();
            }).prop('checked', false);
        </script>
        @section('scripts')
        @show
    </body>
</html>
