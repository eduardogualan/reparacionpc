@extends('../../template.template')
@section('contenido')
<!-- Main content -->
<section class="content">
    <!-- SELECT2 EXAMPLE -->
    <div class="box box-primary">
        <div class="box-header with-border">
             <span class="section">Personal Info</span>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
            </div>
        </div><!-- /.box-header -->
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Minimal</label>
                        <select class="form-control select2" style="width: 100%;">
                            <option selected="selected">Alabama</option>
                            <option>Alaska</option>
                            <option>California</option>
                            <option>Delaware</option>
                            <option>Tennessee</option>
                            <option>Texas</option>
                            <option>Washington</option>
                        </select>
                    </div><!-- /.form-group -->
                    <div class="form-group">
                        <label>Disabled</label>
                        <select class="form-control select2" disabled="disabled" style="width: 100%;">
                            <option selected="selected">Alabama</option>
                            <option>Alaska</option>
                            <option>California</option>
                            <option>Delaware</option>
                            <option>Tennessee</option>
                            <option>Texas</option>
                            <option>Washington</option>
                        </select>
                    </div><!-- /.form-group -->
                </div><!-- /.col -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Multiple</label>
                        <select class="form-control select2" multiple="multiple" data-placeholder="Select a State" style="width: 100%;">
                            <option>Alabama</option>
                            <option>Alaska</option>
                            <option>California</option>
                            <option>Delaware</option>
                            <option>Tennessee</option>
                            <option>Texas</option>
                            <option>Washington</option>
                        </select>
                    </div><!-- /.form-group -->
                    <div class="form-group">
                        <label>Disabled Result</label>
                        <select class="form-control select2" style="width: 100%;">
                            <option selected="selected">Alabama</option>
                            <option>Alaska</option>
                            <option disabled="disabled">California (disabled)</option>
                            <option>Delaware</option>
                            <option>Tennessee</option>
                            <option>Texas</option>
                            <option>Washington</option>
                        </select>
                    </div><!-- /.form-group -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.box-body -->
        <div class="box-footer">
            Visit <a href="https://select2.github.io/">Select2 documentation</a> for more examples and information about the plugin.
        </div>
    </div><!-- /.box -->

    <div class="row">
        <div class="col-md-6">

            <div class="box box-danger">
                <div class="box-header">
                    <h3 class="box-title">Input masks</h3>
                </div>
                <div class="box-body">
                    <!-- Date dd/mm/yyyy -->
                    <div class="form-group">
                        <label>Date masks:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
                        </div><!-- /.input group -->
                    </div><!-- /.form group -->

                    <!-- Date mm/dd/yyyy -->
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask>
                        </div><!-- /.input group -->
                    </div><!-- /.form group -->

                    <!-- phone mask -->
                    <div class="form-group">
                        <label>US phone mask:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <input type="text" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask>
                        </div><!-- /.input group -->
                    </div><!-- /.form group -->

                    <!-- phone mask -->
                    <div class="form-group">
                        <label>Intl US phone mask:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <input type="text" class="form-control" data-inputmask="'mask': ['999-999-9999 [x99999]', '+099 99 99 9999[9]-9999']" data-mask>
                        </div><!-- /.input group -->
                    </div><!-- /.form group -->

                    <!-- IP mask -->
                    <div class="form-group">
                        <label>IP mask:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-laptop"></i>
                            </div>
                            <input type="text" class="form-control" data-inputmask="'alias': 'ip'" data-mask>
                        </div><!-- /.input group -->
                    </div><!-- /.form group -->

                </div><!-- /.box-body -->
            </div><!-- /.box -->

            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title">Color & Time Picker</h3>
                </div>
                <div class="box-body">
                    <!-- Color Picker -->
                    <div class="form-group">
                        <label>Color picker:</label>
                        <input type="text" class="form-control my-colorpicker1">
                    </div><!-- /.form group -->

                    <!-- Color Picker -->
                    <div class="form-group">
                        <label>Color picker with addon:</label>
                        <div class="input-group my-colorpicker2">
                            <input type="text" class="form-control">
                            <div class="input-group-addon">
                                <i></i>
                            </div>
                        </div><!-- /.input group -->
                    </div><!-- /.form group -->

                    <!-- time Picker -->
                    <div class="bootstrap-timepicker">
                        <div class="form-group">
                            <label>Time picker:</label>
                            <div class="input-group">
                                <input type="text" class="form-control timepicker">
                                <div class="input-group-addon">
                                    <i class="fa fa-clock-o"></i>
                                </div>
                            </div><!-- /.input group -->
                        </div><!-- /.form group -->
                    </div>


                    <form class="form-horizontal form-label-left" novalidate>

                        <p>For alternative validation library <code>parsleyJS</code> check out in the <a href="form.html">form page</a>
                        </p>
                        <span class="section">Personal Info</span>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Name <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="name" placeholder="both name(s) e.g Jon Doe" required="required" type="text">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="email" id="email" name="email" required="required" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Confirm Email <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="email" id="email2" name="confirm_email" data-validate-linked="email" required="required" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Number <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="number" id="number" name="number" required="required" data-validate-minmax="10,100" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="website">Website URL <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="url" id="website" name="website" required="required" placeholder="www.website.com" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="occupation">Occupation <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="occupation" type="text" name="occupation" data-validate-length-range="5,20" class="optional form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label for="password" class="control-label col-md-3">Password</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="password" type="password" name="password" data-validate-length="6,8" class="form-control col-md-7 col-xs-12" required="required">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label for="password2" class="control-label col-md-3 col-sm-3 col-xs-12">Repeat Password</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="password2" type="password" name="password2" data-validate-linked="password" class="form-control col-md-7 col-xs-12" required="required">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="textarea">Textarea <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea id="textarea" required="required" name="textarea" class="form-control col-md-7 col-xs-12"></textarea>
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                                <button type="submit" class="btn btn-primary">Cancel</button>
                                <button id="send" type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>
                    </form>

                </div><!-- /.box-body -->
            </div><!-- /.box -->

        </div><!-- /.col (left) -->
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Date picker</h3>
                </div>
                <div class="box-body">
                    <!-- Date range -->
                    <div class="form-group">
                        <label>Date range:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control pull-right" id="reservation">
                        </div><!-- /.input group -->
                    </div><!-- /.form group -->

                    <!-- Date and time range -->
                    <div class="form-group">
                        <label>Date and time range:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-clock-o"></i>
                            </div>
                            <input type="text" class="form-control pull-right" id="reservationtime">
                        </div><!-- /.input group -->
                    </div><!-- /.form group -->

                    <!-- Date and time range -->
                    <div class="form-group">
                        <label>Date range button:</label>
                        <div class="input-group">
                            <button class="btn btn-default pull-right" id="daterange-btn">
                                <i class="fa fa-calendar"></i> Date range picker
                                <i class="fa fa-caret-down"></i>
                            </button>
                        </div>
                    </div><!-- /.form group -->

                </div><!-- /.box-body -->
            </div><!-- /.box -->

            <!-- iCheck -->
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">iCheck - Checkbox &amp; Radio Inputs</h3>
                </div>
                <div class="box-body">
                    <!-- Minimal style -->

                    <!-- checkbox -->
                    <div class="form-group">
                        <label>
                            <input type="checkbox" class="minimal" checked>
                        </label>
                        <label>
                            <input type="checkbox" class="minimal">
                        </label>
                        <label>
                            <input type="checkbox" class="minimal" disabled>
                            Minimal skin checkbox
                        </label>
                    </div>

                    <!-- radio -->
                    <div class="form-group">
                        <label>
                            <input type="radio" name="r1" class="minimal" checked>
                        </label>
                        <label>
                            <input type="radio" name="r1" class="minimal">
                        </label>
                        <label>
                            <input type="radio" name="r1" class="minimal" disabled>
                            Minimal skin radio
                        </label>
                    </div>

                    <!-- Minimal red style -->

                    <!-- checkbox -->
                    <div class="form-group">
                        <label>
                            <input type="checkbox" class="minimal-red" checked>
                        </label>
                        <label>
                            <input type="checkbox" class="minimal-red">
                        </label>
                        <label>
                            <input type="checkbox" class="minimal-red" disabled>
                            Minimal red skin checkbox
                        </label>
                    </div>

                    <!-- radio -->
                    <div class="form-group">
                        <label>
                            <input type="radio" name="r2" class="minimal-red" checked>
                        </label>
                        <label>
                            <input type="radio" name="r2" class="minimal-red">
                        </label>
                        <label>
                            <input type="radio" name="r2" class="minimal-red" disabled>
                            Minimal red skin radio
                        </label>
                    </div>

                    <!-- Minimal red style -->

                    <!-- checkbox -->
                    <div class="form-group">
                        <label>
                            <input type="checkbox" class="flat-red" checked>
                        </label>
                        <label>
                            <input type="checkbox" class="flat-red">
                        </label>
                        <label>
                            <input type="checkbox" class="flat-red" disabled>
                            Flat green skin checkbox
                        </label>
                    </div>

                    <!-- radio -->
                    <div class="form-group">
                        <label>
                            <input type="radio" name="r3" class="flat-red" checked>
                        </label>
                        <label>
                            <input type="radio" name="r3" class="flat-red">
                        </label>
                        <label>
                            <input type="radio" name="r3" class="flat-red" disabled>
                            Flat green skin radio
                        </label>
                    </div>
                </div><!-- /.box-body -->
                <div class="box-footer">
                    Many more skins available. <a href="http://fronteed.com/iCheck/">Documentation</a>
                </div>
            </div><!-- /.box -->
        </div><!-- /.col (right) -->
    </div><!-- /.row -->
</section><!-- /.content -->
@stop

