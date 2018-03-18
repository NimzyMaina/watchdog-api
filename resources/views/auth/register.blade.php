@extends('layouts.auth')

@section('content')
    <div class="register-box">
        <div class="register-logo">
            <a href="{{url('/')}}"><b>{{config('app.name')}}</b> Platform</a>
        </div>

        <div class="register-box-body">
            <p class="login-box-msg">Create a new Account</p>

            <form action="{{route('register')}}" method="post">
                @include('layouts.alert')
                {{csrf_field()}}
                <div class="form-group has-feedback{{ $errors->has('fullname') ? ' has-error' : '' }}">
                    <input type="text" name="fullname" value="{{old('fullname')}}" class="form-control" placeholder="Full name">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    @if ($errors->has('fullname'))
                        <span class="help-block">
                <strong>{{ $errors->first('fullname') }}</strong>
            </span>
                    @endif
                </div>
                <div class="form-group has-feedback{{ $errors->has('email') ? ' has-error' : '' }}">
                    <input type="email" name="email" value="{{old('email')}}" class="form-control" placeholder="Email">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    @if ($errors->has('email'))
                        <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
                    @endif
                </div>
                <div class="form-group has-feedback{{ $errors->has('phone') ? ' has-error' : '' }}">
                    <input type="text" name="phone" value="{{old('phone')}}" class="form-control" placeholder="Phone">
                    <span class="glyphicon glyphicon-phone form-control-feedback"></span>
                    @if ($errors->has('phone'))
                        <span class="help-block">
                <strong>{{ $errors->first('phone') }}</strong>
            </span>
                    @endif
                </div>
                <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
                    <input type="password" name="password" class="form-control" placeholder="Password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    @if ($errors->has('password'))
                        <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
                    @endif
                </div>
                <div class="form-group has-feedback{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Retype password">
                    <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                <strong>{{ $errors->first('password_confirmation') }}</strong>
            </span>
                    @endif
                </div>
                <div class="row">
                    <div class="col-xs-8">
                        <!--           <div class="checkbox icheck">
                                    <label>
                                      <input type="checkbox"> I agree to the <a href="#">terms</a>
                                    </label>
                                  </div> -->
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <a href="{{route('login')}}" class="text-center">I already have a account</a>
        </div>
        <!-- /.form-box -->
    </div>
    <!-- /.register-box -->

@stop