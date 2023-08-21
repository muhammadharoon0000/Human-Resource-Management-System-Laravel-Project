@extends('layout.main')
@section('content')


    <section>

        <div class="container-fluid"><span id="general_result"></span></div>


        <div class="container-fluid">
            @can('store-deposit')
                <button type="button" class="btn btn-info" name="create_record" id="create_record"><i
                            class="fa fa-plus"></i> {{__('Add Deposit')}}</button>
            @endcan
        </div>


        <div class="table-responsive">
            <table id="deposit-table" class="table ">
                <thead>
                <tr>
                    <th class="not-exported"></th>
                    <th>{{trans('file.Account')}}</th>
                    <th>{{trans('file.Payer')}}</th>
                    @if(config('variable.currency_format')=='suffix')
                        <th>{{trans('file.Amount')}} ({{config('variable.currency')}})</th>
                    @else
                        <th>({{config('variable.currency')}}) {{trans('file.Amount')}}</th>
                    @endif
                    <th>{{trans('file.Category')}}</th>
                    <th>{{__('Reference No')}}</th>
                    <th>{{trans('file.Payment')}}</th>
                    <th>{{trans('file.Date')}}</th>
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
                    <h5 id="exampleModalLabel" class="modal-title">{{__('Add Deposit')}}</h5>
                    <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><i class="dripicons-cross"></i></button>
                </div>

                <div class="modal-body">
                    <span id="form_result"></span>
                    <form method="post" id="sample_form" class="form-horizontal" enctype="multipart/form-data">

                        @csrf
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('file.Account')}}*</label>
                                    <select name="account_id" id="account_id" class="form-control selectpicker"
                                            data-live-search="true" data-live-search-style="contains"
                                            title='{{__('Selecting',['key'=>trans('file.Account')])}}...'>
                                        @foreach($accounts as $account)
                                            <option value="{{$account->id}}">{{$account->account_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6 form-group">
                                <label>{{trans('file.category')}} *</label>
                                <select name="category" id="category" class="form-control selectpicker "
                                        data-live-search="true" data-live-search-style="contains"
                                        title='{{__('Selecting',['key'=>trans('file.Category')])}}...'>
                                    <option value="Envato">{{trans('file.Envato')}}</option>
                                    <option value="salary">{{trans('file.Salary')}}</option>
                                    <option value="interest income">{{__('Interest Income')}}</option>
                                    <option value="regular income">{{__('Regular Income')}}</option>
                                    <option value="part time work">{{__('Part Time Work')}}</option>
                                    <option value="other income">{{__('Other Income')}}</option>
                                </select>
                            </div>

                            <div class="col-md-6 form-group">
                                @if(config('variable.currency_format')=='suffix')
                                    <label>{{trans('file.Amount')}} ({{config('variable.currency')}}) *</label>
                                @else
                                    <label>({{config('variable.currency')}}) {{trans('file.Amount')}} *</label>
                                @endif
                                <input type="text" name="amount" id="amount" required class="form-control"
                                       placeholder="{{trans('file.Amount')}}">
                            </div>


                            <div class="col-md-6 form-group">
                                <label>{{trans('file.Date')}} *</label>
                                <input type="text" name="deposit_date" id="deposit_date" required
                                       class="form-control date"
                                       autocomplete="off"
                                       value="">
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{__('Payment Mode')}} </label>
                                    <select name="payment_method_id" id="payment_method_id"
                                            class="form-control selectpicker"
                                            data-live-search="true" data-live-search-style="contains"
                                            title='{{__('Selecting',['key'=>__('Payment Mode')])}}...'>
                                        @foreach($payment_methods as $payment_method)
                                            <option value="{{$payment_method->id}}">{{$payment_method->method_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('file.Payer')}} </label>
                                    <select name="payer_id" id="payer_id"  class="form-control selectpicker"
                                            data-live-search="true" data-live-search-style="contains"
                                            title='{{__('Selecting',['key'=>trans('file.Payer')])}}...'>
                                        @foreach($payers as $payer)
                                            <option value="{{$payer->id}}">{{$payer->payer_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6 form-group">
                                <label>{{__('Reference No')}} *</label>
                                <input type="text" name="deposit_reference" id="deposit_reference" required
                                       class="form-control"
                                       placeholder="{{__('Reference No')}}">
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('file.Description')}}</label>
                                    <textarea class="form-control" id="description" name="description"
                                              rows="3"></textarea>
                                </div>
                            </div>

                            <div class="col-md-6 form-group">
                                <label>{{trans('file.Attach')}} {{trans('file.File')}}</label>
                                <input type="file" name="deposit_file" id="deposit_file" class="form-control"
                                       placeholder={{trans("file.Optional")}}>
                                <span id="stored_file"></span>
                            </div>


                            <div class="container">
                                <div class="form-group" align="center">
                                    <input type="hidden" name="action" id="action"/>
                                    <input type="hidden" name="hidden_id" id="hidden_id"/>
                                    <input type="hidden" name="hidden_amount" id="hidden_amount"/>
                                    <input type="hidden" name="hidden_account_id" id="hidden_account_id"/>
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

    <div class="modal fade" id="deposit_modal" tabindex="-1" role="dialog" aria-labelledby="basicModal"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">{{__('Deposit Info')}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-12">

                            <div class="table-responsive">

                                <table class="table  table-bordered">

                                    <tr>
                                        <th>{{trans('file.Account')}}</th>
                                        <td id="account_id_show"></td>
                                    </tr>

                                    <tr>
                                        <th>{{trans('file.Category')}}</th>
                                        <td id="category_show"></td>
                                    </tr>

                                    <tr>
                                        @if(config('variable.currency_format')=='suffix')
                                            <th>{{trans('file.Amount')}} ({{config('variable.currency')}})</th>
                                        @else
                                            <th>({{config('variable.currency')}}) {{trans('file.Amount')}}</th>
                                        @endif
                                        <td id="amount_show"></td>
                                    </tr>

                                    <tr>
                                        <th>{{__('Deposit Date')}}</th>
                                        <td id="deposit_date_show"></td>
                                    </tr>

                                    <tr>
                                        <th>{{__('Payment Mode')}}</th>
                                        <td id="payment_method_id_show"></td>
                                    </tr>

                                    <tr>
                                        <th>{{trans('file.Payer')}}</th>
                                        <td id="payer_id_show"></td>
                                    </tr>

                                    <tr>
                                        <th>{{__('Reference No')}}</th>
                                        <td id="deposit_reference_show"></td>
                                    </tr>

                                    <tr>
                                        <th>{{trans('file.Description')}}</th>
                                        <td id="description_show"></td>
                                    </tr>

                                    <tr>
                                        <th>{{trans('file.Deposit')}} {{trans('file.File')}}</th>
                                        <td id="deposit_file_show"></td>
                                    </tr>


                                </table>

                            </div>

                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('file.Close')}}</button>
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

            var date = $('.date');
            date.datepicker({
                format: '{{ env('Date_Format_JS')}}',
                autoclose: true,
                todayHighlight: true
            });


            var table_table = $('#deposit-table').DataTable({
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
                    url: "{{ route('deposit.index') }}",
                },

                columns: [
                    {
                        data: 'id',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'account',
                        name: 'account',
                    },
                    {
                        data: 'payer',
                        name: 'payer',
                    },
                    {
                        data: 'amount',
                        name: 'amount',
                        render: function (data) {
                            if ('{{config('variable.currency_format') =='suffix'}}') {
                                return data + ' {{config('variable.currency')}}';
                            } else {
                                return '{{config('variable.currency')}} ' + data;

                            }
                        }
                    },
                    {
                        data: 'category',
                        name: 'category',

                    },
                    {
                        data: 'deposit_reference',
                        name: 'deposit_reference',
                    },
                    {
                        data: 'payment_method',
                        name: 'payment_method',
                    },
                    {
                        data: 'deposit_date',
                        name: 'deposit_date',

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
                        'targets': [0, 8],
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

            $('.modal-title').text('{{__('Add Deposit')}}');
            $('#stored_file').html('');
            $('#action_button').val('{{trans("file.Add")}}');
            $('#action').val('{{trans("file.Add")}}');
            $('#formModal').modal('show');
        });

        $('#sample_form').on('submit', function (event) {
            event.preventDefault();
            if ($('#action').val() == '{{trans('file.Add')}}') {

                $.ajax({
                    url: "{{ route('deposit.store') }}",
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
                            html = '<div class="alert alert-danger">' + data.error + '</div>';
                        }
                        if (data.success) {
                            html = '<div class="alert alert-success">' + data.success + '</div>';
                            $('#sample_form')[0].reset();
                            $('select').selectpicker('refresh');
                            $('.date').datepicker('update');
                            $('#deposit-table').DataTable().ajax.reload();
                        }
                        $('#form_result').html(html).slideDown(300).delay(5000).slideUp(300);
                    }
                })
            }

            if ($('#action').val() == '{{trans('file.Edit')}}') {
                $.ajax({
                    url: "{{ route('deposit.update') }}",
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
                            html = '<div class="alert alert-danger">' + data.error + '</div>';
                        }
                        if (data.success) {
                            html = '<div class="alert alert-success">' + data.success + '</div>';
                            setTimeout(function () {
                                $('#formModal').modal('hide');
                                $('.date').datepicker('update');
                                $('select').selectpicker('refresh');
                                $('#deposit-table').DataTable().ajax.reload();
                                $('#sample_form')[0].reset();
                            }, 2000);

                        }
                        $('#form_result').html(html).slideDown(300).delay(5000).slideUp(300);
                    }
                });
            }
        });

        $(document).on('click', '.show_new', function () {

            var id = $(this).attr('id');
            $('#form_result').html('');

            var target = '{{route('deposit.index')}}/' + id;

            $.ajax({
                url: target,
                dataType: "json",
                success: function (result) {
                    let id = result.data.id;


                    $('#description_show').html(result.data.description);
                    $('#account_id_show').html(result.account_name);
                    $('#payer_id_show').html(result.payer_name);
                    $('#payment_method_id_show').html(result.payment_name);
                    $('#deposit_date_show').html(result.deposit_date_name);
                    $('#amount_show').html(result.data.amount);
                    $('#category_show').html(result.data.category);
                    $('#deposit_reference_show').html(result.data.deposit_reference);
                    if (result.data.deposit_file) {
                        let d_link = '{{ route('deposit.download')}}/' + id;
                        $('#deposit_file_show').html('<a href="' + d_link + '"><strong>{{ __('Download') }}</strong></a>');
                    }

                    $('#deposit_modal').modal('show');
                    $('.modal-title').text("{{__('Deposit Info')}}");
                }
            });
        });


        $(document).on('click', '.edit', function () {

            var id = $(this).attr('id');
            $('#form_result').html('');

            var target = "{{ route('deposit.index') }}/" + id + '/edit';


            $.ajax({
                url: target,
                dataType: "json",
                success: function (html) {

                    let id = html.data.id;

                    $('#description').val(html.data.description);
                    $('#deposit_date').val(html.data.deposit_date);
                    $('#amount').val(html.data.amount);
                    $('#category').selectpicker('val', html.data.category);
                    $('#account_id').selectpicker('val', html.data.account_id);
                    $('#payer_id').selectpicker('val', html.data.payer_id);
                    $('#payment_method_id').selectpicker('val', html.data.payment_method_id);
                    $('#deposit_reference').val(html.data.deposit_reference);

                    if (html.data.deposit_file) {
                        let d_link = '{{ route('deposit.download')}}/' + id;
                        $('#stored_file').html('<a href="' + d_link + '"><strong>{{ __('Download') }}</strong></a>');
                    }

                    $('#hidden_id').val(html.data.id);
                    $('#hidden_amount').val(html.data.amount);
                    $('#hidden_account_id').val(html.data.account_id);
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


        $('.close').on('click', function () {
            $('#sample_form')[0].reset();
            $('select').selectpicker('refresh');
            $('.date').datepicker('update');
            $('#deposit-table').DataTable().ajax.reload();
        });

        $('#ok_button').on('click', function () {
            let target = "{{ route('deposit.index') }}/" + delete_id + '/delete';
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
                        $('#deposit-table').DataTable().ajax.reload();
                    }, 2000);
                }
            })
        });

    })(jQuery);
</script>

@endpush
