@if( Session::has('success'))
    <div id="infoMessage" class="alert alert-success">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {!! Session::get('success') !!}
    </div>
@endif
@if( Session::has('error'))
    <div id="infoMessage" class="alert alert-danger">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {!! Session::get('error') !!}
    </div>
@endif