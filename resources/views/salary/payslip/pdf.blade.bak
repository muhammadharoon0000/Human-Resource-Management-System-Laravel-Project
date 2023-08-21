<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>{{config('app.name')}}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>


    <link rel="stylesheet" href="<?php echo asset('public/vendor/bootstrap/css/bootstrap.min.css') ?>" type="text/css">
</head>

<style>
    h4 {
        font-size: 80%;
    }
    h5 {
        font-size: 80%;
    }
    h6 {
        font-size: 80%;
    }

    tbody {
        font-size: 80%;
        margin:0px;
        padding: 5px;
    }

    .table thead tr th, {
        border: 1px solid #000;
        font-size: 80%;
        margin:0px;
        padding: 5px;

    }
    .table tr td {
        border: 1px solid #000;
        font-size: 80%;
        margin:0px;
        padding: 5px;
    }
    #heading{
        font-size: 80%;
        color: #CE7749;
        text-align: center;
    }
    #normal-heading{
        font-size: 70%;
        color: #000
    }
    /* * { font-family: DejaVu Sans, sans-serif; } */
</style>

<body onload="window.print()">

<h5>{{$company['company_name']}}</h5>
<h6>{{$company['location']['address1']}}</h6>
<h6>{{$company['location']['city']}},{{$company['location']['country']['name']}}-{{$company['location']['zip']}}</h6>
<h6>Phone: {{$company['contact_no']}}| {{trans('file.Email')}}: {{$company['email']}}</h6>
<hr>

<div class="center">
    <h5>{{trans('file.Payslip')}}: {{$month_year}}</h5>
</div>
<br>
<div class="table-responsive">
    <table class="table table-bordered">
        <tbody>
        <tr>
            <td><strong class="help-split">{{__('Employee ID')}}: </strong>{{$user['username'] ?? ''}}</td>
            <td><strong class="help-split">{{__('Employee Name')}}: </strong>{{$first_name}} {{$last_name}}</td>
            <td><strong class="help-split">{{__('Payslip NO')}}: </strong>{{$id}}</td>
        </tr>
        <tr>
            <td><strong class="help-split">{{trans('file.Phone')}}: </strong>{{$contact_no}}</td>
            <td><strong class="help-split">{{__('Joining Date')}}: </strong>{{$joining_date}}</td>
            <td><strong class="help-split">{{__('Payslip Type')}}: </strong>{{$payment_type}}</td>

        </tr>
        <tr>
            <td><strong class="help-split">{{trans('file.Company')}}: </strong>{{$company['company_name']}}</td>
            <td><strong class="help-split">{{trans('file.Department')}}: </strong>{{$department['department_name']}}
            </td>
            <td><strong class="help-split">{{trans('file.Designation')}}: </strong>{{$designation['designation_name']}}
            </td>
        </tr>
        </tbody>
    </table>
</div>

<hr>


<div class="row">
    <div class="col-xs-12 table-responsive">
        <table class="table table-bordered text-center">

            <thead>
            <tr>
                <th id="heading" colspan="2">{{trans('file.Earnings')}}</th>
            </tr>
            </thead>
            <thead>
            <tr>
                <th id="normal-heading">{{trans('file.Description')}}</th>
                <th id="normal-heading">{{trans('file.Amount')}}</th>
            </tr>
            </thead>
            @php
                if ($payment_type == 'Monthly')
                {
                    $total_earnings = $basic_salary;
                }
                else
                {
                    $total_earnings = $hours_amount;
                }
            @endphp
            <tr>
                @if($payment_type == 'Monthly')
                    <td class="py-3">{{__('Basic Salary')}}</td>
                    <td>{{$basic_salary}}</td>
                @else
                    <td class="py-3">{{__('Basic Salary')}} ({{__('Total')}})</td>
                    <td>{{$total_earnings}}</td>
                @endif
            </tr>
            @if($allowances)
                @foreach($allowances as $allowance)
                    <tr>
                        <td class="py-3">{{$allowance['allowance_title']}}</td>
                        <td>{{$allowance['allowance_amount']}}</td>
                    </tr>
                    @php
                        $total_earnings = $total_earnings + $allowance['allowance_amount'] ;
                    @endphp
                @endforeach
            @endif

            @if($commissions)
                @foreach($commissions as $commission)
                    <tr>
                        <td class="py-3">{{$commission['commission_title']}}</td>
                        <td>{{$commission['commission_amount']}}</td>
                    </tr>
                    @php
                        $total_earnings = $total_earnings + $commission['commission_amount'] ;
                    @endphp
                @endforeach
            @endif

            @if($other_payments)
                @foreach($other_payments as $other_payment)
                    <tr>
                        <td class="py-3">{{$other_payment['other_payment_title']}}</td>
                        <td>{{$other_payment['other_payment_amount']}}</td>
                    </tr>
                    @php
                        $total_earnings = $total_earnings + $other_payment['other_payment_amount'] ;
                    @endphp
                @endforeach
            @endif

            @if($overtimes)
                @foreach($overtimes as $overtime)
                    <tr>
                        <td class="py-3">{{$overtime['overtime_title']}}</td>
                        <td>{{$overtime['overtime_amount']}}</td>
                    </tr>
                    @php
                        $total_earnings = $total_earnings + $overtime['overtime_amount'] ;
                    @endphp
                @endforeach
            @endif

            <tr>
                <td class="py-3">Total</td>
                @if(config('variable.currency_format') =='suffix')
                    <td id="total_earnings">{{$total_earnings}} <span style="font-family: DejaVu Sans; sans-serif;">{{config('variable.currency')}}</span></td>
                @else
                    <td id="total_earnings"><span style="font-family: DejaVu Sans; sans-serif;">{{config('variable.currency')}}</span> {{$total_earnings}} </td>
                @endif
            </tr>


        </table>
    </div>
    <!-- /.col -->
</div>

<hr>
<div class="row">
    <div class="col-xs-12 table-responsive">
        <table class="table table-bordered text-center">

            <thead>
            <tr>
                <th id="heading" colspan="2">{{trans('file.Deductions')}}</th>
            </tr>
            </thead>
            <thead>
            <tr>
                <th id="normal-heading">{{trans('file.Description')}}</th>
                <th id="normal-heading">{{trans('file.Amount')}}</th>
            </tr>
            </thead>

            @php
                $total_deductions = 0;
            @endphp

            @if($loans)
                @foreach($loans as $loan)
                    <tr>
                        <td class="py-3">{{$loan['loan_title']}}</td>
                        <td>{{$loan['monthly_payable']}}</td>
                    </tr>
                    @php
                        $total_deductions = $total_deductions + $loan['monthly_payable'] ;
                    @endphp
                @endforeach
            @endif

            @if($deductions)
                @foreach($deductions as $deduction)
                    <tr>
                        <td class="py-3">{{$deduction['deduction_title']}}</td>
                        <td>{{$deduction['deduction_amount']}}</td>
                    </tr>
                    @php
                        $total_deductions = $total_deductions + $deduction['deduction_amount'] ;
                    @endphp
                @endforeach
            @endif

                <tr>
                    <td class="py-3">{{__('Pension Amount')}}</td>
                    <td>{{$pension_amount}}</td>
                </tr>

				@php
                    $total_deductions = $total_deductions + $pension_amount;
                @endphp



            <tr>
                <td class="py-3">{{trans('file.Total')}}</td>
                @if(config('variable.currency_format') =='suffix')
                    <td id="total_deductions">{{$total_deductions}} <span style="font-family: DejaVu Sans; sans-serif;">{{config('variable.currency')}}</span></td>
                @else
                    <td id="total_deductions"><span style="font-family: DejaVu Sans; sans-serif;">{{config('variable.currency')}}</span> {{$total_deductions}} </td>
                @endif
            </tr>


        </table>
    </div>
    <!-- /.col -->
</div>
@if(config('variable.currency_format') =='suffix')
    <p class="text-danger">{{__('Total Paid')}} : <strong>{{$net_salary}} <span style="font-family: DejaVu Sans; sans-serif;">{{config('variable.currency')}}</span></strong></p>
@else
    <p class="text-danger">{{__('Total Paid')}} :<span style="font-family: DejaVu Sans; sans-serif;">{{config('variable.currency')}}</span> <strong>{{$net_salary}}</strong></p>
@endif


</body>
</html>
