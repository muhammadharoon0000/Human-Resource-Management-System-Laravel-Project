@extends('layout.main')
@section('content')



    <section>

        <div class="container-fluid"><span id="general_result"></span></div>


        <div class="container-fluid">
            @can('store-client')
                <button type="button" class="btn btn-info" name="create_record" id="create_record"><i
                            class="fa fa-plus"></i> {{__('Add Client')}}</button>
            @endcan
            @can('delete-client')
                <button type="button" class="btn btn-danger" name="bulk_delete" id="bulk_delete"><i
                            class="fa fa-minus-circle"></i> {{__('Bulk delete')}}</button>
            @endcan
        </div>


        <div class="table-responsive">
            <table id="client-table" class="table ">
                <thead>
                <tr>
                    <th class="not-exported"></th>
                    <th>{{__('Name')}}</th>
                    <th>{{trans('file.Company')}}</th>
                    <th>{{trans('file.Website')}}</th>
                    <th>{{trans('file.Phone')}}</th>
                    <th>{{trans('file.Email')}}</th>
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
                    <h5 id="exampleModalLabel" class="modal-title">{{__('Add Client')}}</h5>
                    <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><i class="dripicons-cross"></i></button>
                </div>

                <div class="modal-body">
                    <span id="form_result"></span>
                    <span id="store_profile_photo"></span>

                    <form method="post" id="sample_form" class="form-horizontal">

                        @csrf
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>{{__('First Name')}} <span class="text-danger">*</span></label>
                                <input type="text" name="first_name" id="first_name" placeholder={{__('First Name')}}
                                        required class="form-control">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>{{__('Last Name')}} <span class="text-danger">*</span></label>
                                <input type="text" name="last_name" id="last_name" placeholder={{__('Last Name')}}
                                        required class="form-control">
                            </div>
                            {{-- <div class="col-md-6 form-group">
                                <label>{{__('Name')}} <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="name" placeholder={{__('Name')}}
                                        required class="form-control">
                            </div> --}}
                            <div class="col-md-6 form-group">
                                <label>{{trans('file.Company')}} <span class="text-danger">*</span></label>
                                <input type="text" name="company_name" id="company_name"
                                       placeholder={{trans('file.Company')}}
                                               required class="form-control">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>{{trans('file.Username')}} <span class="text-danger">*</span></label>
                                <input type="text" name="username" id="username"
                                       placeholder="{{trans('file.Username')}}"
                                       required class="form-control">
                            </div>

                            <div class="col-md-6 form-group">
                                <label>{{trans('file.Email')}} <span class="text-danger">*</span></label>
                                <input type="email" name="email" id="email" placeholder='example@example.com' required
                                       class="form-control">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>{{trans('file.Phone')}}<span class="text-danger">*</span></label>
                                <input type="text" name="contact_no" id="contact_no"
                                       placeholder="{{trans('file.Phone')}}"
                                       class="form-control" value="{{ old('contact_no') }}">
                            </div>

                            <div class="col-md-6 form-group ">
                                <label>{{trans('file.Website')}} </label>
                                <input type="text" name="website" id="website" placeholder="Website"
                                       class="form-control">
                            </div>

                            <div class="col-md-6 form-group hide-edit">
                                <label>{{trans('file.Password')}} <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="password" name="password" id="password"
                                           placeholder="{{trans('file.Password')}}"
                                           class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6 form-group">
                                <label>{{__('Address Line 1')}} </label>
                                <input type="text" name="address1" id="address1" placeholder="{{__('Address Line 1')}}"
                                       class="form-control">
                            </div>

                            <div class="col-md-6 form-group">
                                <label>{{__('Address Line 2')}} </label>
                                <input type="text" name="address2" id="address2" placeholder="{{__('Address Line 2')}}"
                                       class="form-control">
                            </div>

                            <div class="col-md-6 form-group">
                                <label>{{trans('file.City')}} </label>
                                <input type="text" name="city" id="city" placeholder="{{trans('file.City')}}"
                                       class="form-control">
                            </div>

                            <div class="col-md-6 form-group">
                                <label>{{trans('file.State/Province')}} </label>
                                <input type="text" name="state" id="state"
                                       placeholder="{{trans('file.State/Province')}}"
                                       class="form-control">
                            </div>

                            <div class="col-md-6 form-group">
                                <label>{{trans('file.ZIP')}} </label>
                                <input type="text" name="zip" id="zip" placeholder="{{trans('file.ZIP')}}"
                                       class="form-control">
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('file.Country')}}</label>
                                    <select name="country" id="country" required class="form-control selectpicker"
                                            data-live-search="true" data-live-search-style="contains"
                                            title='{{__('Selecting',['key'=>trans('file.Country')])}}...'>
                                        @foreach($countries as $country)
                                            <option value="{{$country->id}}">{{$country->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="Photo"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Image') }}</label>
                                <input type="file" id="profile_photo"
                                       class="form-control @error('photo') is-invalid @enderror"
                                       name="profile_photo"
                                       placeholder={{trans('file.Upload')}} {{trans('file.Photo')}}>
                            </div>

                            <div class="col-md-6 form-group custom-control custom-checkbox hide-add">
                                <input type="checkbox" class="custom-control-input" name="is_active" id="is_active"
                                       value="1" checked>
                                <label class="custom-control-label" for="is_active">{{trans('file.Active')}}</label>
                            </div>


                            <div class="container">
                                <div class="form-group" align="center">
                                    <input type="hidden" name="action" id="action"/>
                                    <input type="hidden" name="hidden_id" id="hidden_id"/>
                                    <input type="submit" name="action_button" id="action_button" class="btn btn-warning"
                                           value={{trans('file.Add')}}>
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

            if (window.location.href.indexOf('#formModal') != -1) {
                $('#formModal').modal('show');
            }

            let table_table = $('#client-table').DataTable({
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
                    url: "{{ route('clients.index') }}",
                },

                columns: [

                    {
                        data: 'id',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name',
                        name: 'name',

                    },
                    {
                        data: 'company_name',
                        name: 'company_name',
                    },
                    {
                        data: 'website',
                        name: 'website',
                    },
                    {
                        data: 'contact_no',
                        name: 'contact_no',
                    },
                    {
                        data: 'email',
                        name: 'email',
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
                        'targets': [0, 6],
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

            $('.modal-title').text('{{__('Add Client')}}');
            $('#store_profile_photo').html('');
            $('#action_button').val('{{trans("file.Add")}}');
            $('#action').val('{{trans("file.Add")}}');
            $('.hide-add').hide();
            $('.hide-edit').show();
            $('#formModal').modal('show');
        });

        $('#sample_form').on('submit', function (event) {

            event.preventDefault();
            if ($('#action').val() == '{{trans('file.Add')}}') {
                $.ajax({
                    url: "{{ route('clients.store') }}",
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
                            $('#client-table').DataTable().ajax.reload();
                        }
                        $('#form_result').html(html).slideDown(300).delay(5000).slideUp(300);
                    }
                });
            }

            if ($('#action').val() == '{{trans('file.Edit')}}') {
                $.ajax({
                    url: "{{ route('clients.update') }}",
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
                        if (data.error) {
                            html = '<div class="alert alert-success">' + data.error + '</div>';
                        }
                        if (data.success) {
                            html = '<div class="alert alert-success">' + data.success + '</div>';
                            setTimeout(function () {
                                $('#formModal').modal('hide');
                                $('select').selectpicker('refresh');
                                $('#client-table').DataTable().ajax.reload();
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
            $('.hide-edit').hide();
            $('.hide-add').show();
            $('#store_profile_photo').html('');

            var target = "{{ route('clients.index') }}/" + id + '/edit';

            $.ajax({
                url: target,
                dataType: "json",
                success: function (html) {

                    $('#company_name').val(html.data.company_name);
                    $('#username').val(html.data.username);
                    $('#first_name').val(html.data.first_name);
                    $('#last_name').val(html.data.last_name);
                    $('#contact_no').val(html.data.contact_no);
                    $('#email').val(html.data.email);
                    $('#website').val(html.data.website);
                    $('#address1').val(html.data.address1);
                    $('#address2').val(html.data.address2);
                    $('#city').val(html.data.city);
                    $('#state').val(html.data.state);
                    $('#country').selectpicker('val', html.data.country);
                    $('#zip').val(html.data.zip);
                    if (html.data.is_active == 1) {
                        $('#is_active').prop('checked', true);
                    } else {
                        $('#is_active').prop('checked', false);
                    }
                    if (html.data.profile) {
                        $('#store_profile_photo').html("<img src={{ URL::to('/public') }}/uploads/profile_photos/" + html.data.profile + " width='70'  class='img-thumbnail' />");
                        $('#store_profile_photo').append("<input type='hidden' name='hidden_image' value='" + html.data.profile + "'  />");
                    }

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
            let table = $('#client-table').DataTable();
            id = table.rows({selected: true}).ids().toArray();
            if (id.length > 0) {
                if (confirm('{{__('Delete Selection',['key'=>trans('file.Client')])}}')) {
                    $.ajax({
                        url: '{{route('mass_delete_clients')}}',
                        method: 'POST',
                        data: {
                            clientIdArray: id
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


        $('.close').on('click', function () {
            $('#sample_form')[0].reset();
            $('select').selectpicker('refresh');
            $('#client-table').DataTable().ajax.reload();
        });

        $('#ok_button').on('click', function () {
            let target = "{{ route('clients.index') }}/" + delete_id + '/delete';
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
                        $('#client-table').DataTable().ajax.reload();
                    }, 2000);
                }
            })
        });
    })(jQuery);

</script>
@endpush
