<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>{{ $titulo or 'Acceso al Sistema' }}</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.5 -->
        {!!Html::style('assets/bootstrap/css/bootstrap.min.css')!!}
        <!-- Font Awesome -->
        {!!Html::style('https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css')!!}
        <!-- Ionicons -->
        {!!Html::style('https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css')!!}
        <!-- Theme style -->
        {!!Html::style('assets/dist/css/AdminLTE.min.css')!!}

        <!-- iCheck -->
        {!!Html::style('assets/plugins/iCheck/square/blue.css')!!}
        {!!Html::style('assets/validadores/estilos.css')!!}

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">

            <div class="login-box-body">
                <div class="login-logo">
                    <img src="{!!URL::to('assets/dist/img/logo.png')!!}" class="responsive">
                </div><!-- /.login-logo -->
                <p class="login-box-msg">INICIAR SESIÓN</p>
                {!!Form::open(['route'=>'login.store','method'=>'POST', 'class'=>'form control','novalidate','autocomplete'=>'off'])!!}
                @include('template.alertas.mensajeError')
                <div class=" item form-group has-feedback">
                        <input type="text" class="form-control" placeholder="Cédula o ruc" name="cedula" required="required">
                        <span class="glyphicon glyphicon-credit-card form-control-feedback"></span>
                </div>
                <div class="item form-group has-feedback">
                    <input type="password" class="form-control" placeholder="Password" required="required" name="password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        <button type="submit" class="btn btn-primary btn-block btn-flat"><i class="fa fa-key"></i> ACCEDER</button>
                    </div><!-- /.col -->
                    <div class="col-xs-6">
                        <a href="#" class="btn btn-danger btn-block btn-flat"><i class="fa fa-close"></i> CANCELAR</a>
                    </div><!-- /.col -->
                </div>
                {!!Form::close()!!}
                <div class="social-auth-links text-center">

                </div><!-- /.social-auth-links -->


                <a href="#">I forgot my password</a><br>
                <a href="register.html" class="text-center">Register a new membership</a>

            </div><!-- /.login-box-body -->
        </div><!-- /.login-box -->

        <!-- jQuery 2.1.4 -->
        {!!Html::script('assets/plugins/jQuery/jQuery-2.1.4.min.js')!!}
        <!-- Bootstrap 3.3.5 -->
        {!!Html::script('assets/bootstrap/js/bootstrap.min.js')!!}
        <!-- iCheck -->
        {!!Html::script('assets/plugins/iCheck/icheck.min.js')!!}
        <script>
            $(function() {
                $('input').iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue',
                    increaseArea: '20%' // optional
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
    </body>
</html>
