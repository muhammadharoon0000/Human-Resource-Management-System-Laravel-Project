@extends('layout.main')
@section('content')



    <section>

        <div class="container-fluid"><span id="general_result"></span></div>


        <div class="container-fluid mb-3">
            @can('store-department')
                <button type="button" class="btn btn-info" name="create_record" id="create_record"><i
                            class="fa fa-plus"></i> {{__('Add Department')}}</button>
            @endcan
            @can('delete-department')
                <button type="button" class="btn btn-danger" name="bulk_delete" id="bulk_delete"><i
                            class="fa fa-minus-circle"></i> {{__('Bulk delete')}}</button>
            @endcan
        </div>


        <div class="table-responsive">
            <table id="department-table" class="table ">
                <thead>
                <tr>
                    <th class="not-exported"></th>
                    <th>{{trans('file.Department')}}</th>
                    <th>{{__('Department Head')}}</th>
                    <th>{{trans('file.Company')}}</th>
                    <th class="not-exported">{{trans('file.action')}}</th>
                </tr>
                </thead>

            </table>
        </div>
    </section>



    <div id="formModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 id="exampleModalLabel" class="modal-title">{{__('Add Department')}}</h5>
                    <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><i class="dripicons-cross"></i></button>
                </div>

                <div class="modal-body">
                    <span id="form_result"></span>
                    <form method="post" id="sample_form" class="form-horizontal">

                        @csrf
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>{{trans('file.Department')}} *</label>
                                <input type="text" name="department_name" id="department_name" required
                                       class="form-control"
                                       placeholder="{{__('Unique Value',['key'=>trans('file.Department')])}}">
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('file.Company')}}</label>
                                    <select name="company_id" id="company_id" class="form-control selectpicker dynamic"
                                            data-live-search="true" data-live-search-style="contains"
                                            data-first_name="first_name" data-last_name="last_name"
                                            title='{{__('Selecting',['key'=>trans('file.Company')])}}...'>
                                        @foreach($companies as $company)
                                            <option value="{{$company->id}}">{{$company->company_name}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{__('Department Head')}}</label>
                                    <select name="employee_id" id="employee_id" class="selectpicker form-control"
                                            data-live-search="true" data-live-search-style="contains"
                                            title='{{__('Selecting',['key'=>trans('file.Employee')])}}...'>
                                    </select>
                                </div>
                            </div>


                            <div class="container">
                                <div class="form-group" align="center">
                                    <input type="hidden" name="action" id="action"/>
                                    <input type="hidden" name="hidden_id" id="hidden_id"/>
                                    <input type="submit" name="action_button" id="action_button" class="btn btn-warning"
                                           value={{trans('file.Add')}} />
                                </div>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>








    <div id="confirmModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title">{{trans('file.Confirmation')}}</h2>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <h4 align="center">{{__('Are you sure you want to remove this data?')}}</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">{{trans('file.OK')}}'
                    </button>
                    <button type="button" class="close btn-default"
                            data-dismiss="modal">{{trans('file.Cancel')}}</button>
                </div>
            </div>
        </div>
    </div>


@endsection

@push('scripts')
<script type="text/javascript">
    (function($) {
        "use strict";

        $(document).ready(function () {


            var table_table = $('#department-table').DataTable({
                initComplete: function () {
                    this.api().columns([1]).every(function () {
                        var column = this;
                        var select = $('<select><option value=""></option></select>')
                            .appendTo($(column.footer()).empty())
                            .on('change', function () {
                                var val = $.fn.dataTable.util.escapeRegex(
                                    $(this).val()
                                );

                                column
                                    .search(val ? '^' + val + '$' : '', true, false)
                                    .draw();
                            });

                        column.data().unique().sort().each(function (d, j) {
                            select.append('<option value="' + d + '">' + d + '</option>');
                            $('select').selectpicker('refresh');
                        });
                    });
                },
                responsive: true,
                fixedHeader: {
                    header: true,
                    footer: true
                },
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('departments.index') }}",
                },

                columns: [

                    {
                        data: 'id',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'department_name',
                        name: 'department_name',

                    },
                    {
                        data: 'department_head',
                        name: 'department_head',
                    },
                    {
                        data: 'company',
                        name: 'company',
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false
                    }
                ],


                "order": [],
                'language': {
                    'lengthMenu': '_MENU_ {{__("records per page")}}',
                    "info": '{{trans("file.Showing")}} _START_ - _END_ (_TOTAL_)',
                    "search": '{{trans("file.Search")}}',
                    'paginate': {
                        'previous': '{{trans("file.Previous")}}',
                        'next': '{{trans("file.Next")}}'
                    }
                },
                'columnDefs': [
                    {
                        "orderable": false,
                        'targets': [0, 4],
                    },
                    {
                        'render': function (data, type, row, meta) {
                            if (type == 'display') {
                                data = '<div class="checkbox"><input type="checkbox" class="dt-checkboxes"><label></label></div>';
                            }

                            return data;
                        },
                        'checkboxes': {
                            'selectRow': true,
                            'selectAllRender': '<div class="checkbox"><input type="checkbox" class="dt-checkboxes"><label></label></div>'
                        },
                        'targets': [0]
                    }
                ],


                'select': {style: 'multi', selector: 'td:first-child'},
                'lengthMenu': [[10, 25, 50, -1], [10, 25, 50, "All"]],
                dom: '<"row"lfB>rtip',
                buttons: [
                    {
                        extend: 'pdf',
                        text: '<i title="export to pdf" class="fa fa-file-pdf-o"></i>',
                        exportOptions: {
                            columns: ':visible:Not(.not-exported)',
                            rows: ':visible'
                        },
                    },
                    {
                        extend: 'csv',
                        text: '<i title="export to csv" class="fa fa-file-text-o"></i>',
                        exportOptions: {
                            columns: ':visible:Not(.not-exported)',
                            rows: ':visible'
                        },
                    },
                    {
                        extend: 'print',
                        text: '<i title="print" class="fa fa-print"></i>',
                        exportOptions: {
                            columns: ':visible:Not(.not-exported)',
                            rows: ':visible'
                        },
                    },
                    {
                        extend: 'colvis',
                        text: '<i title="column visibility" class="fa fa-eye"></i>',
                        columns: ':gt(0)'
                    },
                ],
            });
            new $.fn.dataTable.FixedHeader(table_table);
        });


        $('#create_record').on('click', function () {

            $('.modal-title').text('{{__('Add Department')}}');
            $('#action_button').val('{{trans("file.Add")}}');
            $('#action').val('{{trans("file.Add")}}');
            $('#formModal').modal('show');
        });

        $('#sample_form').on('submit', function (event) {
            event.preventDefault();
            if ($('#action').val() == '{{trans('file.Add')}}') {

                $.ajax({
                    url: "{{ route('departments.store') }}",
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "json",
                    success: function (data) {
                        var html = '';
                        if (data.errors) {
                            html = '<div class="alert alert-danger">';
                            for (var count = 0; count < data.errors.length; count++) {
                                html += '<p>' + data.errors[count] + '</p>';
                            }
                            html += '</div>';
                        }
                        if (data.success) {
                            html = '<div class="alert alert-success">' + data.success + '</div>';
                            $('#sample_form')[0].reset();
                            $('select').selectpicker('refresh');
                            $('#department-table').DataTable().ajax.reload();
                        }
                        $('#form_result').html(html).slideDown(300).delay(5000).slideUp(300);
                    }
                })
            }

            if ($('#action').val() == '{{trans('file.Edit')}}') {
                $.ajax({
                    url: "{{ route('departments.update') }}",
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "json",
                    success: function (data) {
                        var html = '';
                        if (data.errors) {
                            html = '<div class="alert alert-danger">';
                            for (var count = 0; count < data.errors.length; count++) {
                                html += '<p>' + data.errors[count] + '</p>';
                            }
                            html += '</div>';
                        }
                        if (data.success) {
                            html = '<div class="alert alert-success">' + data.success + '</div>';
                            setTimeout(function () {
                                $('#formModal').modal('hide');
                                $('#department-table').DataTable().ajax.reload();
                                $('#sample_form')[0].reset();
                            }, 2000);

                        }
                        $('#form_result').html(html).slideDown(300).delay(5000).slideUp(300);
                    }
                });
            }
        });


        $(document).on('click', '.edit', function () {
            var id = $(this).attr('id');
            $('#form_result').html('');

            var target = "{{ route('departments.index') }}/" + id + '/edit';


            $.ajax({
                url: target,
                dataType: "json",
                success: function (html) {

                    $('#department_name').val(html.data.department_name);
                    $('#company_id').selectpicker('val', html.data.company_id);

                    let all_employees = '';
                    $.each(html.employees, function (index, value) {
                        all_employees += '<option value=' + value['id'] + '>' + value['first_name'] + ' ' + value['last_name'] + '</option>';
                    });
                    $('#employee_id').empty().append(all_employees);
                    $('#employee_id').selectpicker('refresh');
                    $('#employee_id').selectpicker('val', html.data.department_head);
                    $('#employee_id').selectpicker('refresh');

                    $('#hidden_id').val(html.data.id);
                    $('.modal-title').text('{{trans('file.Edit')}}');
                    $('#action_button').val('{{trans('file.Edit')}}');
                    $('#action').val('{{trans('file.Edit')}}');
                    $('#formModal').modal('show');
                }
            })

        });


        let delete_id;

        $(document).on('click', '.delete', function () {
            delete_id = $(this).attr('id');
            $('#confirmModal').modal('show');
            $('.modal-title').text('{{__('DELETE Record')}}');
            $('#ok_button').text('{{trans('file.OK')}}');

        });


        $(document).on('click', '#bulk_delete', function () {

            var id = [];
            let table = $('#department-table').DataTable();
            id = table.rows({selected: true}).ids().toArray();
            if (id.length > 0) {
                if (confirm('{{__('Delete Selection',['key'=>trans('file.Department')])}}')) {
                    $.ajax({
                        url: '{{route('mass_delete_departments')}}',
                        method: 'POST',
                        data: {
                            departmentIdArray: id
                        },
                        success: function (data) {
                            let html = '';
                            if (data.success) {
                                html = '<div class="alert alert-success">' + data.success + '</div>';
                            }
                            if (data.error) {
                                html = '<div class="alert alert-danger">' + data.error + '</div>';
                            }
                            table.ajax.reload();
                            table.rows('.selected').deselect();
                            if (data.errors) {
                                html = '<div class="alert alert-danger">' + data.error + '</div>';
                            }
                            $('#general_result').html(html).slideDown(300).delay(5000).slideUp(300);

                        }

                    });
                }
            } else {
                alert('{{__('Please select atleast one checkbox')}}');
            }
        });


        $('#close').on('click', function () {
            $('#sample_form')[0].reset();
            $('select').selectpicker("refresh");
            $('#employee_id').selectpicker('refresh');
            $('#department-table').DataTable().ajax.reload();
        });

        $('#ok_button').on('click', function () {
            let target = "{{ route('departments.index') }}/" + delete_id + '/delete';
            $.ajax({
                url: target,
                beforeSend: function () {
                    $('#ok_button').text('{{trans('file.Deleting...')}}');
                },
                success: function (data) {
                    let html = '';
                    if (data.success) {
                        html = '<div class="alert alert-success">' + data.success + '</div>';
                    }
                    if (data.error) {
                        html = '<div class="alert alert-danger">' + data.error + '</div>';
                    }
                    setTimeout(function () {
                        $('#general_result').html(html).slideDown(300).delay(5000).slideUp(300);
                        $('#confirmModal').modal('hide');
                        $('#department-table').DataTable().ajax.reload();
                    }, 2000);
                }
            })
        });


        $('.dynamic').change(function () {
            if ($(this).val() !== '') {
                let value = $(this).val();
                let first_name = $(this).data('first_name');
                let last_name = $(this).data('last_name');
                let _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{ route('dynamic_employee') }}",
                    method: "POST",
                    data: {value: value, _token: _token, first_name: first_name, last_name: last_name},
                    success: function (result) {
                        $('select').selectpicker("destroy");
                        $('#employee_id').html(result);
                        $('select').selectpicker();

                    }
                });
            }
        });

    })(jQuery);
</script>
@endpush
