@extends('base')

@section('content')
    <style>
        .dataTables_info {
            display: none;
        }
    </style>
    <h1 class="mt-5">OMDb API</h1>
    <div class="row">
        <div class="col-md-8 text-right">Type at least 3 characters to start searching</div>
        <div class="col-md-4 input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">Search</span>
            </div>
            <input type="text" id="search" class="form-control">
        </div>
    </div>
    <div class="mt-1"></div>
    <div class="row">
        <div class="col-lg-12">
            <table id="data_table" class="table table-striped table-bordered" style="width:100%">
                <thead>
                <tr>
                    <td>Title</td>
                    <td>Year</td>
                    <td>imdbID</td>
                    <td>Type</td>
                    <td></td>
                </tr>
                </thead>
                <tbody></tbody>
                <tfoot></tfoot>
            </table>
        </div>
    </div>

    <div class="mt-5"></div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            var table = $('#data_table')
                .dataTable({
                    serverSide: true,
                    processing: true,
                    searching: false,
                    bSort: false,
                    bPaginate: false,
                    ajax: {
                        url: '{{ url('data') }}',
                        type: 'GET',
                        dataType: 'json',
                        data: function (d) {
                            console.log(d);
                            d.filter = $("#search").val();
                        }
                    },
                    columns :[
                        {data: 'Title', className: "col-md-4"},
                        {data: 'Year', className: "col-md-2"},
                        {data: 'imdbID', className: "col-md-2"},
                        {data: 'Type', className: "col-md-2"},
                        {data: 'action', className: "col-md-2"},
                    ],
                });

            $('#search').keyup(function () {
                if ($(this).val().length >= 3) {
                    table.fnDraw();
                }
            });
        });
    </script>
@endsection
