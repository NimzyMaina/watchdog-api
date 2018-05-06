@extends('layouts.dashboard')

@section('css')

    <link rel="stylesheet" type="text/css" href="{{asset('plugins/select2/select2.css')}}">

@stop

@section('js')

    <script type="text/javascript" src="{{asset('plugins/select2/select2.min.js')}}"></script>

@stop

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
                <div>
                    @include('layouts.alert')
                    <form id="user" method="post" action="{{route('settings')}}">
                        <input type="hidden" name="_method" value="PUT">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-md-12">
                                <h4>Calling Tariffs</h4>
                                <div class="form-group col-md-4 has-feedback{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                    <label for="first_name">Local Call (On net)</label>
                                    <input type="text" name="first_name" class="form-control" value="{{old('first_name',isset($user->first_name)?$user->first_name:'')}}">
                                    @if ($errors->has('first_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('first_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group col-md-4 has-feedback{{ $errors->has('last_name') ? ' has-error' : '' }}">
                                    <label for="first_name">Local Call (Off net)</label>
                                    <input type="text" name="last_name" class="form-control" value="{{old('last_name',isset($user->last_name)?$user->last_name:'')}}">
                                    @if ($errors->has('last_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('last_name') }}</strong>
                                        </span>
                                    @endif

                                </div>
                                <div class="form-group col-md-4 has-feedback{{ $errors->has('last_name') ? ' has-error' : '' }}">
                                    <label for="first_name">International Call</label>
                                    <input type="text" name="last_name" class="form-control" value="{{old('last_name',isset($user->last_name)?$user->last_name:'')}}">
                                    @if ($errors->has('last_name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6 has-feedback{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" value="{{old('email',isset($user->email)?$user->email:'')}}">
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group col-md-6 has-feedback{{ $errors->has('phone') ? ' has-error' : ''}}">
                                <label for="phone">Phone</label>
                                <input type="text" name="phone" class="form-control" value="{{old('phone',isset($user->phone) ? localphone($user->phone) : '')}}">
                                @if($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif

                            </div>
                        </div>

                        <div class="row">
                                <div class="form-group col-md-6 has-feedback{{ $errors->has('password') ? ' has-error' : ''}}">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" class="form-control" value="{{old('password')}}">
                                    @if($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group col-md-6 has-feedback{{ $errors->has('password_confirmation') ? ' has-error' : ''}}">
                                    <label for="confirm">Confirm Password</label>
                                    <input type="password" class="form-control" name="password_confirmation" value="{{old('password_confirmation')}}">
                                    @if($errors->has('password_confirmation'))
                                        <span class="help-block">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                                    @endif

                                </div>
                </div>

                        <div class="form-group">
                            <div class="pull-right">
                                <button type="submit" class="btn btn-md btn-flat btn-primary">Submit</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div><!-- /.box-body -->
            <div class="box-footer">
                Manage System Settings
            </div><!-- /.box-footer-->
        </div><!-- /.box -->
    </section><!-- /.content -->
@stop