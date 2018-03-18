@extends('layouts.dashboard')

@push('css')

    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('plugins/datatables/dataTables.bootstrap.css')}}">

@endpush


@section('content')

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{$title or ''}}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="users-table" class="table table-bordered table-striped display" cellpadding="0" cellspacing="0" border="0" width="100%">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Type</th>
                    <th>Duration</th>
                    <th>Phone</th>
                    <th>Reference</th>
                    <th>Charge Code</th>
                    <th>Date</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Type</th>
                    <th>Duration</th>
                    <th>Phone</th>
                    <th>Reference</th>
                    <th>Charge Code</th>
                    <th>Date</th>
                </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->

    @endsection



@push('js')

    <!-- DataTables -->
    <script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
    <script>

        $(function () {


            $("#users-table").DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: '{!! route('calls.get') !!}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'type', name: 'type' },
                    { data: 'duration', name: 'duration' },
                    { data: 'phone', name: 'phone' },
                    { data: 'reference', name: 'reference'},
                    { data: 'charge_code', name: 'charge_code'},
                    { data: 'start', name: 'start'}
                ],
                lengthMenu: [[10, 25, 50,100, -1], [10, 25, 50, 100, 'All']]
            });
        });

    </script>
@endpush