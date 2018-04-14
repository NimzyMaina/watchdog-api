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
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Active</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th class="type-filter">First Name</th>
                    <th class="type-filter">Last Name</th>
                    <th class="type-filter">Email</th>
                    <th class="type-filter">Phone</th>
                    <th class="select-filter">Active</th>
                    <th class="non_searchable">Action</th>
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
                ajax: '{!! route('users.data') !!}',
                columns: [
                    { data: 'first_name', name: 'first_name' },
                    { data: 'last_name', name: 'last_name' },
                    { data: 'email', name: 'email' },
                    { data: 'phone', name: 'phone' },
                    { data: 'activated', name: 'activated',
                        "fnCreatedCell":  function (nTd, sData, oData, iRow, iCol) {
                            $(nTd).attr('data-val',$(nTd).text());
                            $(nTd).replaceWith('<td>'+user_status(sData+'__'+oData.id)+'</td>');
                        }
                    },
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
        });

    </script>
@endpush