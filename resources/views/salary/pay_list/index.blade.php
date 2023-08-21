@extends('layout.main')
@section('content')

    <section>
        <div class="container-fluid">
            <div class="card mb-4">
                <div class="card-header with-border">
                    <h3 class="card-title text-center"> {{__('Generate Payslip')}} </h3>
                </div>
                <span id="bulk_payment_result"></span>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form method="post" id="filter_form" class="form-horizontal" >
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <select class="form-control ss selectpicker dynamic" name="filter_company" id="company_id" data-dependent="department_name" data-placeholder="Company" data-column="1" required tabindex="-1" aria-hidden="true">
                                                <option value="0">{{__('All Companies')}}</option>
                                                @foreach($companies as $company)
                                                    <option value="{{$company->id}}">{{$company->company_name}}</option>
                                                @endforeach
                                                {{ csrf_field() }}
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <select class="form-control selectpicker default_dept" name="filter_department" id="department_id" data-placeholder="Department" required tabindex="-1" aria-hidden="true">
                                                <option value="0">{{__('All Departments')}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input class="form-control month_year date" placeholder="{{__('Select Month')}}" readonly id="month_year" name="month_year" type="text" value="">
                                        </div>
                                    </div>
                                </div>

                                <div class="text-center">
                                    <div class="form-group">
                                        <div class="form-actions">
                                            <button id="payslip_filter" type="submit" class="filtering btn btn-primary"> <i class="fa fa-search"></i> {{trans('file.Search')}} </button>

                                            <button id="bulk_payment" type="submit" class="filtering btn btn-primary"> <i class="fa fa-check-square-o"></i> {{__('BULK PAYMENT')}} </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-title text-center"><h3>{{__('Payment Info')}} <span id="details_month_year"></span></h3></div>
        <div class="container-fluid"><span id="general_result"></span></div>
        <div class="table-responsive">
            <table id="pay_list-table" class="table">
                <thead>
                <tr>
                    <th class="not-exported"></th>
                    <th>{{trans('file.Name')}}</th>
                    <th>{{__('Payslip Type')}}</th>
                    <th>{{__('Basic Salary')}}</th>
                    <th>{{__('Net Salary')}}</th>
                    <th>{{trans('file.Status')}}</th>
                    <th class="not-exported">{{trans('file.action')}}</th>
                </tr>
                </thead>
            </table>
        </div>

        <div class="modal fade" id="salary_model" tabindex="-1" role="dialog" aria-labelledby="basicModal"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">{{__('Salary Info')}}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="d-flex">
                                    <div id="employee_pp"></div>
                                    <div class="ml-3">
                                        <div class="h3 text-bold d-inline" id="employee_full_name"></div> (<span id="employee_username"></span>)
                                        <br>
                                        <span class="text-gray" id="employee_designation"></span>
                                        <span class="text-gray" id="employee_department"></span>
                                        <br>
                                        <a id="employee_id" href="">{{ __('View Profile') }}</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <h3 class="mt-5">{{__('Salary Details')}}</h3>
                                <hr>
                                <div class="card-block">
                                    <div id="accordion">
                                        <div class="card mb-2">
                                            <div class="card-header"> <a class="text-dark" data-toggle="collapse" href="#basic_salary" aria-expanded="true"> <strong><span id="payslip_type"></span></strong> </a> </div>
                                            <div id="basic_salary" class="collapse in" data-parent="#accordion" aria-expanded="true">
                                                <div class="card-body">
                                                    <div class="table-responsive" data-pattern="priority-columns">
                                                        <table class="table table-striped table-bordered dataTable no-footer">
                                                            <tbody>
                                                            <tr>
                                                                <td><strong><span id="monthly_hourly"></span>:</strong><span class="pull-right" id="basic_salary_amount"></span></td>
                                                                <td class="hide-div"><strong><span id="hours_worked"></span>:</strong> <span class="pull-right" id="total_hours_worked"></span></td>
                                                                <td class="hide-div"><strong><span id="hours_worked_amount"></span>:</strong> <span class="pull-right" id="total_hours_worked_amount"></span></td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card mb-2">
                                            <div class="card-header"> <a class="text-dark" data-toggle="collapse" href="#pension" aria-expanded="true"> <strong>{{__('Pension')}}</strong></a> </div>
                                            <div id="pension" class="collapse in" data-parent="#accordion" aria-expanded="true">
                                                <div class="card-body">
                                                    <div class="table-responsive" data-pattern="priority-columns">
                                                        <table class="table table-striped table-bordered dataTable no-footer">
                                                            <tbody>
                                                                <tr>
                                                                    <td><strong>{{__('Pension Type')}}</span>:</strong><span class="pull-right" id="pension_type"></span></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><strong>{{__('Pension Amount')}}</span>:</strong><span class="pull-right" id="pension_amount"></span></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card mb-2">
                                            <div class="card-header"> <a class="text-dark collapsed" data-toggle="collapse" href="#set_allowances" aria-expanded="false"> <strong>{{trans('file.Allowances')}}</strong></a> &nbsp; <a href="#" data-toggle="popover" data-placement="top" data-content="If you don't set this month's amount, the last month's amount will be treated as this month"><i class="fa fa-exclamation-circle text-warning" aria-hidden="true"></i></a></div>
                                            <div id="set_allowances" class="collapse" data-parent="#accordion">
                                                <div class="box-body">
                                                    <div class="table-responsive" data-pattern="priority-columns">
                                                        <table class="table table-striped table-bordered dataTable no-footer">
                                                            <tbody>
                                                            <tr id="allowance_info"></tr>
                                                            <tr>
                                                                <td><strong>{{trans('file.Total')}}:</strong> <span id="total_allowance" class="pull-right"></span></td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card mb-2">
                                            <div class="card-header"> <a class="text-dark collapsed" data-toggle="collapse" href="#set_commissions" aria-expanded="false"> <strong>{{trans('file.Commissions')}}</strong></a> &nbsp; <a href="#" data-toggle="popover" data-placement="top" data-content="If you don't set this month's amount, 0 amount will be treated as this month"><i class="fa fa-exclamation-circle text-warning" aria-hidden="true"></i></a> </div>
                                            <div id="set_commissions" class="collapse" data-parent="#accordion">
                                                <div class="box-body">
                                                    <div class="table-responsive" data-pattern="priority-columns">
                                                        <table class="table table-striped table-bordered dataTable no-footer">
                                                            <tbody>
                                                            <tr id="commission_info"></tr>
                                                            <tr>
                                                                <td><strong>{{trans('file.Total')}}:</strong> <span id="total_commission" class="pull-right"></span></td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card  mb-2">
                                            <div class="card-header"> <a class="text-dark collapsed" data-toggle="collapse" href="#set_loan_deductions" aria-expanded="false"> <strong>{{trans('file.Loan')}}</strong> </a> </div>
                                            <div id="set_loan_deductions" class="collapse" data-parent="#accordion">
                                                <div class="box-body">
                                                    <div class="table-responsive" data-pattern="priority-columns">
                                                        <table class="table table-striped table-bordered dataTable no-footer">
                                                            <tbody>
                                                            <tr id="loan_info">

                                                            </tr>
                                                            <tr>
                                                                <td><strong>{{trans('file.Total')}}:</strong> <span id="total_loan"  class="pull-right"></span></td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card mb-2">
                                            <div class="card-header"> <a class="text-dark collapsed" data-toggle="collapse" href="#statutory_deductions" aria-expanded="false"> <strong>{{__('Statutory deductions')}}</strong></a> &nbsp; <a href="#" data-toggle="popover" data-placement="top" data-content="If you don't set this month's amount, the last month's amount will be treated as this month"><i class="fa fa-exclamation-circle text-warning" aria-hidden="true"></i></a> </div>
                                            <div id="statutory_deductions" class="collapse" data-parent="#accordion">
                                                <div class="box-body">
                                                    <div class="table-responsive" data-pattern="priority-columns">
                                                        <table class="table table-striped table-bordered dataTable no-footer">
                                                            <tbody>
                                                            <tr id="deduction_info"></tr>
                                                            <tr>
                                                                <td><strong>{{trans('file.Total')}}:</strong> <span id="total_deduction" class="pull-right"></span></td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card mb-2">
                                            <div class="card-header"> <a class="text-dark collapsed" data-toggle="collapse" href="#set_other_payments" aria-expanded="false"> <strong>{{__('Other Payment')}}</strong></a> &nbsp; <a href="#" data-toggle="popover" data-placement="top" data-content="If you don't set this month's amount, 0 amount will be treated as this month"><i class="fa fa-exclamation-circle text-warning" aria-hidden="true"></i></a> </div>
                                            <div id="set_other_payments" class="collapse" data-parent="#accordion">
                                                <div class="box-body">
                                                    <div class="table-responsive" data-pattern="priority-columns">
                                                        <table class="table table-striped table-bordered dataTable no-footer">
                                                            <tbody>
                                                            <tr id="other_payment_info"></tr>
                                                            <tr>
                                                                <td><strong>{{trans('file.Total')}}:</strong> <span id="total_other_payment" class="pull-right"></span></td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card mb-2">
                                            <div class="card-header"> <a class="text-dark collapsed" data-toggle="collapse" href="#overtime" aria-expanded="false"> <strong>{{trans('file.Overtime')}}</strong></a> &nbsp; <a href="#" data-toggle="popover" data-placement="top" data-content="If you don't set this month's amount, 0 amount will be treated as this month"><i class="fa fa-exclamation-circle text-warning" aria-hidden="true"></i></a> </div>
                                            <div id="overtime" class="collapse" data-parent="#accordion">
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered mb-0">
                                                            <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>{{__('Overtime Title')}}</th>
                                                                <th>{{__('Number of days')}}</th>
                                                                <th>{{trans('file.Hours')}}</th>
                                                                <th>{{trans('file.Rate')}}</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody id="overtime_info">
                                                            </tbody>
                                                            <tfoot>
                                                            <tr>
                                                                <td colspan="4" align="right"><strong>{{trans('file.Total')}}:</strong></td>
                                                                <td id="total_overtime"></td>
                                                            </tr>
                                                            </tfoot>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-header"> <strong class="text-dark">{{__('Net Salary')}}</strong> <strong class="float-right" id="total_salary"></strong></div>
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

        <div class="modal fade" id="payment_model" tabindex="-1" role="dialog" aria-labelledby="basicModal"
             aria-hidden="true"
            >
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">{{__('Payment Info')}}--- <span id="payment_month_year_show"></span></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <span id="form_result"></span>
                        <form method="get" id="payment_form" class="form-horizontal" >

                               <input type="hidden" name="payslip_type" id="payslip_type_payment">

                               <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name">{{__('Basic Salary')}}</label> &nbsp;&nbsp;&nbsp;&nbsp; <span id="payment_type_error"></span>
                                        <input type="text" name="basic_salary" id="basic_salary_payment" class="form-control" value="0" readonly="readonly">
                                        <input type="hidden" value="0" name="month_year" id="hidden_month_year">
                                        <input type="hidden" value="" name="employee_id" id="employee_id">
                                    </div>
                                </div>

                                   <div class="col-md-6 hide-element">
                                       <div class="form-group">
                                           <label for="worked_hours">{{__('Total Hours(This Month)')}}</label>
                                           <input type="text" readonly="readonly" name="worked_hours" id="worked_hours" class="form-control" value="0">
                                       </div>
                                   </div>

                                   <div class="col-md-6 hide-element">
                                       <div class="form-group">
                                           <label for="worked_amount">{{__('Amount')}}</label> <a href="#" data-toggle="popover" data-placement="top" data-content="If you don't set this month's amount, the last month's amount will be treated as this month"><i class="fa fa-exclamation-circle text-warning" aria-hidden="true"></i></a>
                                           <input type="text" readonly="readonly" name="worked_amount" id="worked_amount" class="form-control" value="0">
                                       </div>
                                   </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">{{__('Total Allowance')}}</label> <a href="#" data-toggle="popover" data-placement="top" data-content="If you don't set this month's amount, the last month's amount will be treated as this month"><i class="fa fa-exclamation-circle text-warning" aria-hidden="true"></i></a>
                                        <input type="text" name="total_allowance" id="total_allowance_payment" class="form-control" value="0" readonly="readonly">
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">{{trans('Commissions')}}</label> <a href="#" data-toggle="popover" data-placement="top" data-content="If you don't set this month's amount, 0 amount will be treated as this month"><i class="fa fa-exclamation-circle text-warning" aria-hidden="true"></i></a>
                                        <input type="text" name="total_commission" id="total_commission_payment" class="form-control" value="0" readonly="readonly">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">{{__('Total Overtime')}}</label> <a href="#" data-toggle="popover" data-placement="top" data-content="If you don't set this month's amount, 0 amount will be treated as this month"><i class="fa fa-exclamation-circle text-warning" aria-hidden="true"></i></a>
                                        <input type="text" name="total_overtime" id="total_overtime_payment" class="form-control" value="0" readonly="readonly">
                                    </div>
                                </div>

                                   <div class="col-md-6">
                                       <div class="form-group">
                                           <label for="name">{{__('Other Payment')}}</label> <a href="#" data-toggle="popover" data-placement="top" data-content="If you don't set this month's amount, 0 amount will be treated as this month"><i class="fa fa-exclamation-circle text-warning" aria-hidden="true"></i></a>
                                           <input type="text" name="total_other_payment" id="total_other_payment_payment" class="form-control" value="0" readonly="readonly">
                                       </div>
                                   </div>

                                   <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">{{__('Statutory deductions')}}</label> <a href="#" data-toggle="popover" data-placement="top" data-content="If you don't set this month's amount, the last month's amount will be treated as this month"><i class="fa fa-exclamation-circle text-warning" aria-hidden="true"></i></a>
                                        <input type="text" name="total_deduction" id="total_deduction_payment" class="form-control" value="0" readonly="readonly">
                                    </div>
                                </div>

                                   <div class="col-md-6">
                                       <div class="form-group">
                                           <label for="name">{{__('Monthly Payable')}}</label>
                                           <input type="text" name="monthly_payable" id="monthly_payable" class="form-control" value="0" readonly="readonly">
                                       </div>
                                   </div>

                                   <div class="col-md-6">
                                       <div class="form-group">
                                           <label for="name">{{__('Loan Remaining')}}</label>
                                           <input type="text" name="amount_remaining" id="amount_remaining" class="form-control" value="0" readonly="readonly">
                                       </div>
                                   </div>

                                   <div class="col-md-6">
                                       <div class="form-group">
                                           <label for="name">{{__('Pension Amount')}}</label>
                                           <input type="text" name="pension_amount" id="pension_amount_payment" class="form-control" value="0" readonly="readonly">
                                       </div>
                                   </div>



                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">{{__('Net Salary')}}</label>
                                        <input type="text" readonly="readonly" name="net_salary" id="net_salary_payment" class="form-control" value="0">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">{{__('Payment Amount')}}</label>
                                        <input type="text" readonly="readonly" name="payment_amount" id="total_salary_payment" class="form-control" >
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <span><strong>{{trans('file.NOTE')}}:</strong> {{__('Total Allowance,Commissions,Total Loan,Total Overtime,Statutory deductions,Other Payment, Pension are not editable.')}}</span>
                                    </div>
                                </div>

                            <div class="form-actions"> <button  type="submit" class="btn btn-primary"><i class="fa fa fa-check-square-o"></i> {{trans('file.Pay')}}</button>
                            </div>
                               </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>



@endsection

@push('scripts')
<script type="text/javascript">
    (function($) {
        "use strict";

        $(document).ready(function () {

            let date = $('.date');
            date.datepicker({
                format: "MM-yyyy",
                startView: "months",
                minViewMode: 1,
                autoclose: true,
            }).datepicker("setDate", new Date());

            fill_datatable();

            function fill_datatable(filter_company = '', filter_department = '',filter_month_year = '') {
                $('#details_month_year').html($('#month_year').val());
                let table_table = $('#pay_list-table').DataTable({
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
                        url: "{{ route('payroll.index') }}",
                        data: {
                            filter_company: filter_company,
                            filter_department: filter_department,
                            filter_month_year: filter_month_year,
                            "_token": "{{ csrf_token()}}"
                        }
                    },

                    columns: [
                        {
                            data: 'id',
                            orderable:false,
                            searchable:false
                        },
                        {
                            data: 'employee_name',
                            name: 'employee_name'
                        },
                        {
                            data: 'payslip_type',
                            name: 'payslip_type'
                        },
                        {
                            data: 'basic_salary',
                            name: 'basic_salary',
                            render: function (data) {
                                if ('{{config('variable.currency_format') =='suffix'}}') {
                                    return data + ' {{config('variable.currency')}}';
                                } else {
                                    return '{{config('variable.currency')}} ' + data;

                                }
                            }
                        },
                        {
                            data: 'net_salary',
                            name: 'net_salary',
                            render: function (data) {
                                if ('{{config('variable.currency_format') =='suffix'}}') {
                                    return data + ' {{config('variable.currency')}}';
                                } else {
                                    return '{{config('variable.currency')}} ' + data;

                                }
                            }
                        },
                        {
                            data: 'status',
                            name: 'status',
                            render: function (data) {
                                if (data == 1) {
                                    return "<td><div class = 'badge badge-success'>{{trans('file.Paid')}}</div>"
                                } else {
                                    return "<td><div class = 'badge badge-danger'>{{trans('file.Unpaid')}}</div>"
                                }
                            }
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
                            'targets': [0],
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
            }

            new $.fn.dataTable.FixedHeader($('#pay_list-table').DataTable());

            $('#filter_form').on('submit',function (e) {
                e.preventDefault();
                var filter_company = $('#company_id').val();
                var filter_department = $('#department_id').val();
                var filter_month_year = $('#month_year').val();
                if (filter_company !== '' && filter_department !== '' && filter_month_year !== '' ) {
                    $('#pay_list-table').DataTable().destroy();
                    fill_datatable(filter_company, filter_department,filter_month_year);
                } else {
                    alert('{{__('Select Both filter option')}}');
                }
            });
        });


        $(document).on('click', '.details', function () {
            //individual salary id from pay_list table
            let id = $(this).attr('id');
            let filter_month_year = $('#month_year').val();
            let currency_format = '{{config('variable.currency_format')}}';

            //target contains payslip.show
            // let target = '{{route('paySlip.index')}}/' + id;
            let target = '{{route('paySlip.show')}}';

            $.ajax({
                url: target,
                // dataType: "json",
                type: "GET",
                data: {id:id, filter_month_year:filter_month_year},
                success: function (result) {
                    console.log(result.data);
                    // console.log(result.data.allowances[0]);

                    $('#employee_username').html(result.data.employee_username);
                    $('#employee_full_name').html(result.data.employee_full_name);
                    if (result.data.employee_designation=='') {
                        $('#employee_designation').html(result.data.employee_designation);
                    }
                    else {
                        $('#employee_designation').html(result.data.employee_designation + ', ');
                    }
                    $('#employee_department').html(result.data.employee_department);
                    $('#employee_join_date').html(result.data.employee_join_date);
                    $('#employee_id').attr("href","{{ url('staff/employees/') }}/"+result.data.employee_id);
                    if (result.data.employee_pp=='') {
                        $('#employee_pp').html("<img src={{ URL::to('/public') }}/uploads/profile_photos/avatar.jpg  width='100'  class='rounded-circle' />");
                    }
                    else {
                        $('#employee_pp').html("<img src={{ URL::to('/public') }}/uploads/profile_photos/" + result.data.employee_pp + " width='100'  class='rounded-circle' />");
                    }
                    $('#pension_type').html(result.data.pension_type);

                    let total_allowance = 0;
                    (result.data.allowances).forEach(function (a) {
                        total_allowance = total_allowance + parseFloat(a.allowance_amount);
                        $('#allowance_info').append('<tr><td><strong>'+ a.allowance_title+ '---</strong><div class="pull-right">'+a.allowance_amount+'</div></td></tr>');
                    });

                    let total_commission = 0;
                    (result.data.commissions).forEach(function (a) {
                        total_commission = total_commission + parseFloat(a.commission_amount);
                        $('#commission_info').append('<tr><td><strong>'+ a.commission_title+'---</strong><span class="pull-right">'+a.commission_amount+'</span></td></tr>');
                    });

                    let total_loan = 0;
                    (result.data.loans).forEach(function (a) {
                        total_loan = total_loan + parseFloat(a.monthly_payable);
                        $('#loan_info').append('<tr>' +
                            '<td><strong>Total Loan---     </strong> <div class="float-right">'+a.loan_amount+'</div></td>' +
                            '<td><strong>Monthly Payable---     </strong> <div class="float-right">'+a.monthly_payable+'</div></td>' +
                            '<td><strong>Installment Remaining---     </strong> <div class="float-right">'+a.time_remaining+'</div></td>' +
                            '<td><strong>Amount Remaining---     </strong> <div class="float-right">'+a.amount_remaining+'</div></td>' +
                            '</tr>');
                    });

                    let count = 0;
                    let total_overtime = 0;
                    (result.data.overtimes).forEach(function (a) {
                        count = count +1;
                        total_overtime = total_overtime + (parseFloat(a.overtime_rate) * parseInt(a.overtime_hours));
                        $('#overtime_info').append(
                            '<tr>'+
                            '<td><strong>'+ count+'</strong></td>' +
                            '<td><strong>'+ a.overtime_title+'</strong></td>' +
                            '<td><strong>'+ a.no_of_days+'</strong></td>' +
                            '<td><strong>'+ a.overtime_hours+'</strong></td>' +
                            '<td><strong>'+ a.overtime_rate+'</strong></td>'+
                                '</tr>'
                            );
                    });

                    let total_deduction = 0;
                    (result.data.deductions).forEach(function (a) {
                        total_deduction = total_deduction + parseFloat(a.deduction_amount);
                        $('#deduction_info').append('<tr><td><strong>'+ a.deduction_title+'---</strong> <span class="float-right">'+a.deduction_amount+'</span></td></tr>');
                    });

                    let total_other_payment = 0;
                    (result.data.other_payments).forEach(function (a) {
                        total_other_payment = total_other_payment + parseFloat(a.other_payment_amount);
                        $('#other_payment_info').append('<tr><td><strong>'+ a.other_payment_title+'---</strong><div class="float-right">'+a.other_payment_amount+'</div></td></tr>');
                    });

                    let total_salary = result.data.basic_total - result.data.pension_amount + total_allowance - total_loan + total_commission
                        - total_deduction + total_other_payment + total_overtime;

                    if (total_salary < 0) {
                        total_salary = 0;
                    }

                    if (result.data.payslip_type == 'Monthly') {

                        $('#payslip_type').html('{{__('Monthly Payslip')}}');
                        $('#monthly_hourly').html('{{__('Basic Salary')}}');
                        $('.hide-div').hide();
                        $('#hours_worked').html('');
                        $('#total_hours_worked').html('');
                        $('#hours_worked_amount').html('');
                        $('#total_hours_worked_amount').html('');
                    }
                    else {
                        $('.hide-div').show();
                        $('#payslip_type').html('{{__('Hourly Payslip')}}');
                        $('#monthly_hourly').html('{{__('Per Hour Salary')}}');
                        $('#hours_worked').html('{{__('Total Hours Worked This Month')}}');
                        $('#total_hours_worked').html(result.data.monthly_worked_hours);
                        $('#hours_worked_amount').html('{{__('Total Amount')}}');
                        $('#total_hours_worked_amount').html(result.data.monthly_worked_amount);
                    }

                    if (currency_format == 'suffix') {

                        $('#basic_salary_amount').html(result.data.basic_salary + ' {{config('variable.currency')}}');
                        $('#pension_amount').html(result.data.pension_amount + ' {{config('variable.currency')}}');
                        $('#total_allowance').html(total_allowance + ' {{config('variable.currency')}}');
                        $('#total_commission').html(total_commission + ' {{config('variable.currency')}}');
                        $('#total_loan').html(total_loan + ' {{config('variable.currency')}}');
                        $('#total_overtime').html(total_overtime + ' {{config('variable.currency')}}');
                        $('#total_deduction').html(total_deduction + ' {{config('variable.currency')}}');
                        $('#total_other_payment').html(total_other_payment + ' {{config('variable.currency')}}');
                        $('#total_salary').html(total_salary + ' {{config('variable.currency')}}');
                    }
                    else {
                        $('#basic_salary_amount').html('{{config('variable.currency')}} ' + result.data.basic_salary);
                        $('#pension_amount').html('{{config('variable.currency')}} ' + result.data.pension_amount);
                        $('#total_allowance').html('{{config('variable.currency')}} '+ total_allowance);
                        $('#total_commission').html('{{config('variable.currency')}} ' + total_commission);
                        $('#total_loan').html('{{config('variable.currency')}} '+ total_loan);
                        $('#total_overtime').html('{{config('variable.currency')}} '+ total_overtime);
                        $('#total_deduction').html('{{config('variable.currency')}} '+ total_deduction);
                        $('#total_other_payment').html('{{config('variable.currency')}} '+ total_other_payment);
                        $('#total_salary').html('{{config('variable.currency')}} '+ total_salary);
                    }

                    $('#salary_model').modal('show');
                }
            });
        });

        $(document).on('click', '.generate_payment', function (event) {
            event.preventDefault();
            //individual salary id from pay_list table
            let id = $(this).attr('id');
            $('#payment_month_year_show').html($('#month_year').val());
            let filter_month_year = $('#month_year').val();

            //target contains payslip.show
            // let target = '{{route('paySlip.index')}}/generate/' + id;
            let target = '{{route('paySlip.generate')}}';

            $.ajax({
                url: target,
                // dataType: "json",
                type: "GET",
                data: {id:id, filter_month_year:filter_month_year},
                success: function (result) {
                    console.log(result.data.total_salary);
                    if (result.data.payslip_type == 'Hourly') {
                            $('.hide-element').show();
                            $('#worked_hours').val(result.data.total_hours);
                            $('#worked_amount').val(result.data.worked_amount);
                    }
                    else
                    {
                        $('.hide-element').hide();
                        $('#worked_hours').val('');
                        $('#worked_amount').val('');
                    }
                    $('#payslip_type_payment').val(result.data.payslip_type);
                    $('#basic_salary_payment').val(result.data.basic_salary);
                    $('#total_allowance_payment').val(result.data.total_allowance);
                    $('#total_commission_payment').val(result.data.total_commission);
                    $('#monthly_payable').val(result.data.monthly_payable);
                    $('#amount_remaining').val(result.data.amount_remaining);
                    $('#total_deduction_payment').val(result.data.total_deduction);
                    $('#total_other_payment_payment').val(result.data.total_other_payment);
                    $('#total_overtime_payment').val(result.data.total_overtime);
                    $('#total_salary_payment').val(result.data.total_salary);
                    $('#net_salary_payment').val(result.data.total_salary);

                    $('#pension_amount_payment').val(result.data.pension_amount);

                    $('#employee_id').val(result.data.employee);

                    $('#payment_model').modal('show');
                }
            });
        });

        $('#payment_form').on('submit', function(event) {
            event.preventDefault();
            //individual salary id from pay_list table
            let id = $('#employee_id').val();

           $('#hidden_month_year').val($('#month_year').val());

            //target contains payslip.pay
            let target = '{{route('paySlip.index')}}/pay/' + id;
            $.ajax({
                url: target,
                method: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (data) {
                    console.log(data);
                    let html = '';
                    if (data.payment_type_error) {
                        html = '<div class="alert alert-danger">' + data.payment_type_error + '</div>';
                        $('#payment_type_error').html(html).slideDown(300).delay(5000).slideUp(300);
                    }
                    if (data.error) {
                        html = '<div class="alert alert-danger">' + data.error + '</div>';
                    }
                    if (data.success) {
                        html = '<div class="alert alert-success">' + data.success + '</div>';
                        $('#pay_list-table').DataTable().ajax.reload();
                        $('#payment_model').modal('hide').delay(3000);
                    }
                    $('#bulk_payment_result').html(html).slideDown(300).delay(5000).slideUp(300);
                }
            });

        });


        $('#bulk_payment').on('click', function(event) {
            event.preventDefault();

            // var filter_company = $("#filter_company").val();
            // var filter_department = $("#filter_department").val();
            var month_year = $("#month_year").val();

            var allCheckboxId = [];
            let table = $('#pay_list-table').DataTable();
            allCheckboxId = table.rows({selected: true}).ids().toArray();

            //console.log(allCheckboxId);

            let target = '{{route('paySlip.bulk_pay')}}' ;

            $.ajax({
                url: target,
                method: "POST",
                data : {all_checkbox_id : allCheckboxId, month_year:month_year},
                // data: new FormData(document.getElementById("filter_form")),
                // contentType: false,
                // cache: false,
                // processData: false,
                // dataType: "json",
                success: function (data) {
                    console.log(data);
                    let html = '';
                    if (data.payment_type_error) {
                        html = '<div class="alert alert-danger">' + data.payment_type_error + '</div>';
                    }
                    if (data.error) {
                        html = '<div class="alert alert-danger">' + data.error + '</div>';
                    }
                    if (data.success) {
                        html = '<div class="alert alert-success">' + data.success + '</div>';
                    }
                    $('#bulk_payment_result').html(html).slideDown(300).delay(5000).slideUp(300);
                    $('#pay_list-table').DataTable().rows('.selected').deselect();
                    $('#pay_list-table').DataTable().ajax.reload();
                }
            });

        });


        $('.dynamic').change(function() {
            if ($(this).val() !== '') {
                let value = $(this).val();
                let dependent = $(this).data('dependent');
                let _token = $('input[name="_token"]').val();
                $.ajax({
                    url:"{{ route('dynamic_department') }}",
                    method:"POST",
                    data:{ value:value, _token:_token, dependent:dependent},
                    success:function(result)
                    {
                        $('select').selectpicker("destroy");
                        $('#department_id').html(result);
                        $('.default_dept').prepend('<option value="0" selected>{{__('All Departments')}}</option>');
                        $('select').selectpicker();
                    }
                });
            }
        });

        $('.payment_dynamic').change(function() {
            if ($(this).val() !== '') {
                let value = $(this).val();
                let dependent = $(this).data('dependent');
                let _token = $('input[name="_token"]').val();
                $.ajax({
                    url:"{{ route('dynamic_department') }}",
                    method:"POST",
                    data:{ value:value, _token:_token, dependent:dependent},
                    success:function(result)
                    {
                        $('select').selectpicker("destroy");
                        $('#payment_department_id').html(result);
                        $('.payment_default_dept').prepend('<option value="0" selected>{{__('All Departments')}}</option>');
                        $('select').selectpicker();
                    }
                });
            }
        });


        $(document).on('click', '.delete', function () {
            //individual salary id from pay_list table
            let id = $(this).attr('id');


            $.ajax({
                url: "{{ route('paySlip.index') }}/delete/" + id,
                success: function (data) {
                    let html = '';
                    if (data.error) {
                        html = '<div class="alert alert-danger">' + data.error + '</div>';
                    }
                    if (data.success) {
                        html = '<div class="alert alert-success">' + data.success + '</div>';
                    }
                    $('#pay_list-table').DataTable().ajax.reload();
                    $('#general_result').html(html).slideDown(300).delay(5000).slideUp(300);
                }
            });
        });



        $('.close').on('click', function () {
            $('#allowance_info').html('');
            $('#commission_info').html('');
            $('#loan_info').html('');
            $('#deduction_info').html('');
            $('#overtime_info').html('');
            $('#other_payment_info').html('');
            $('#total_salary').html('');
            $('#total_deduction').html('');
            $('#total_allowance').html('');
            $('#total_loan').html('');
            $('#total_overtime').html('');
            $('#total_other_payment').html('');
            $('#total_commission').html('');
            $('#pay_list-table').DataTable().ajax.reload();

        });
    })(jQuery);


    $(document).ready(function(){
        $('[data-toggle="popover"]').popover();
    });
</script>
@endpush
