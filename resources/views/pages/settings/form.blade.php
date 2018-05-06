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
                <div>
                    @include('layouts.alert')
                    @if(!$is_edit)
                        <form id="user" method="post" action="{{route('settings.tariffs.create')}}">
                            @else
                                <form id="tariff" method="post" action="{{route('settings.tariffs.update',[$tariff->id])}}">
                                    <input type="hidden" name="_method" value="PUT">
                                    @endif
                                    {{csrf_field()}}
                                    <div class="row">
                                        <div class="form-group col-md-6 has-feedback{{ $errors->has('name') ? ' has-error' : '' }}">
                                            <label for="name">Name</label>
                                            <input type="text" name="name" class="form-control" value="{{old('name',isset($tariff->name)?:'')}}">
                                            @if ($errors->has('name'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-6 has-feedback{{ $errors->has('description') ? ' has-error' : '' }}">
                                            <label for="description">Description</label>
                                            <input type="text" name="description" class="form-control" value="{{old('description',isset($tariff->description)?$tariff->description:'')}}">
                                            @if ($errors->has('description'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                            @endif

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-md-6 has-feedback{{ $errors->has('regex') ? ' has-error' : '' }}">
                                            <label for="regex">Regex</label>
                                            <input type="text" name="regex" class="form-control" value="{{old('regex',isset($tariff->regex)?$tariff->regex:'')}}">
                                            @if ($errors->has('regex'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('regex') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-6 has-feedback{{ $errors->has('priority') ? ' has-error' : ''}}">
                                            <label for="priority">Priority</label>
                                            <input type="text" name="priority" class="form-control" value="{{old('priority',isset($tariff->priority) ? $tariff->priority : '')}}">
                                            @if($errors->has('priority'))
                                                <span class="help-block">
                                    <strong>{{ $errors->first('priority') }}</strong>
                                </span>
                                            @endif

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-md-6 has-feedback{{ $errors->has('charge') ? ' has-error' : ''}}">
                                            <label for="charge">Charge</label>
                                            <input type="text" name="charge" class="form-control" value="{{old('charge')}}">
                                            @if($errors->has('charge'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('charge') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-6 has-feedback{{ $errors->has('unit') ? ' has-error' : ''}}">
                                            <label for="confirm">Unit</label>
                                            <input type="text" class="form-control" name="unit" value="{{old('unit')}}">
                                            @if($errors->has('unit'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('unit') }}</strong>
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
                Manage Call Tariffs
            </div><!-- /.box-footer-->
        </div><!-- /.box -->
    </section><!-- /.content -->

    @endsection