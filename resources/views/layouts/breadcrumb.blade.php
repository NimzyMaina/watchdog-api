<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        {{$title or ''}}
        <small>{{$subtitle or ''}}</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        @if(seg(2))
            <li><a href="{{url(seg(2))}}">{{ucfirst(seg(2))}}</a></li>
        @endif
        @if(seg(3))
            <li class="active">{{ucfirst(seg(3))}}</li>
        @endif
    </ol>
</section>