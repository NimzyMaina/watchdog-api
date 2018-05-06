@extends('layouts.dashboard')

@push('css')

    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('plugins/datatables/dataTables.bootstrap.css')}}">

@endpush


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

                    <table id="tariff-table" class="table table-bordered table-striped display" cellpadding="0" cellspacing="0" border="0" width="100%">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Regex</th>
                            <th>Priority</th>
                            <th>Charge</th>
                            <th>Unit</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th class="type-filter">Name</th>
                            <th class="type-filter">Description</th>
                            <th class="type-filter">Regex</th>
                            <th class="type-filter">Priority</th>
                            <th class="type-filter">Charge</th>
                            <th class="type-filter">Unit</th>
                            <th class="non_searchable">Action</th>
                        </tr>
                        </tfoot>
                    </table>

                </div>
            </div><!-- /.box-body -->
            <div class="box-footer">
                Manage Call Tariffs
            </div><!-- /.box-footer-->
        </div><!-- /.box -->
    </section><!-- /.content -->

    @endsection

    @push('js')

    <!-- DataTables -->
    <script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
    <script>

        $(function () {


            $("#tariff-table").DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: '{!! route('settings.tariffs.data') !!}',
                columns: [
                    { data: 'name', name: 'name' },
                    { data: 'description', name: 'description' },
                    { data: 'regex', name: 'regex' },
                    { data: 'priority', name: 'priority' },
                    { data: 'charge', name: 'charge' },
                    { data: 'unit', name: 'unit' },
                    { data: 'action', name: 'action', orderable: false, searchable: false}
                ],
                lengthMenu: [[10, 25, 50,100, -1], [10, 25, 50, 100, 'All']],
                initComplete: function () {
                    this.api().columns().every(function () {
                        var column = this;
                        var columnClass = column.footer().className;
                        var placeholder = column.footer().innerText;
                        if(columnClass != 'non_searchable' && columnClass != 'select-filter'){
                            var input = document.createElement("input");
                            input.className = 'col-sm-12';
                            input.placeholder = 'Search ' +placeholder;
                            $(input).appendTo($(column.footer()).empty())
                                .on('change', function () {
                                    column.search($(this).val(), false, false, true).draw();
                                });
                        }
                    });

                    this.api().columns().every( function () {
                        var column = this;
                        var columnClass = column.footer().className;

                        if(columnClass != 'non_searchable' && columnClass != 'type-filter'){

                            var select = $('<select class="col-sm-12"><option value="">--Select--</option></select>')
                                .appendTo( $(column.footer()).empty() )
                                .on( 'change', function () {
                                    var val = $.fn.dataTable.util.escapeRegex(
                                        $(this).val()
                                    );

                                    column
                                        .search( val ? '^'+val+'$' : '', true, false )
                                        .draw();
                                } );

                            column.data().unique().sort().each( function ( d, j ) {
                                if(d == 0){
                                    var opt = 'Inactive';
                                }else{
                                    var opt = 'Active';
                                }
                                select.append( '<option value="'+d+'">'+opt+'</option>' )
                            } );
                        }

                    } );

                }
            });

            $(".dataTables_filter").append(
                '{!! '<a href="'.route('settings.tariffs.create').'" style="margin-left:10px" class="btn btn-success pull-right"><i class="glyphicon glyphicon-plus"></i> Add Tariff</a>' !!}'
            );
        });

    </script>
@endpush