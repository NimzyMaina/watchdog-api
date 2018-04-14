@extends('layouts.dashboard')

@section('content')
    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">{{$title or ''}}</h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <div>@include('layouts.alert')</div>
                <div class="container">
                    <p>Import the users you want in a couple of simple steps: </p>

                    <ol>
                        <li>Download the user upload template below.</li>
                        <li>Fill in the user information.</li>
                        <li>Save the completed user upload template to your desktop.</li>
                        <li>Click <strong>Choose File</strong>, Select your completed user upload template</li>
                        <li>Select the relevant details from the dropdowns</li>
                        <li>Finally click the <strong>Upload</strong>.</li>
                    </ol>

                    <p><strong>NOTE:</strong>the default password is <strong>@KPMG</strong></p>

                    <div class="col-sm-6 col-sm-offset-2 row" style="padding-bottom: 20px;padding-left: 42px">
                        <a href="{{route('users.template')}}" class="btn btn-success col-sm-11 btn-flat btn-lg">Download the User Upload Template</a>
                    </div>

                    <div class="col-sm-6 col-sm-offset-2 row">

                        <form role="form" method="post" action="" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="col-sm-12">
                                <div class="form-group col-sm-12  has-feedback{{ $errors->has('template') ? ' has-error' : ''}}">
                                    <input type="file" name="template" >
                                    @if($errors->has('template'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('template') }}</strong>
                                </span>
                                    @endif
                                </div>
                                <div class="col-sm-12">
                                    <div class="pull-right">
                                        <input type="submit" class="btn btn-success btn-flat btn-file" value="Upload">
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>



                </div>
            </div><!-- /.box-body -->
            <div class="box-footer">
                Import Users Into The System
            </div><!-- /.box-footer-->
        </div><!-- /.box -->
    </section><!-- /.content -->

@stop