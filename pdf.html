<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>{{config('app.name')}}</title>
    <link rel="stylesheet" href="<?php echo asset('public/vendor/bootstrap/css/bootstrap.min.css') ?>" type="text/css">
</head>

<style>
    h6 {
        font-size: 100%;
    }

    tbody {
        font-size: 80%;
    }

    .table th, .table td {
        border: 1px solid #000;
        font-size: smaller;
    }
</style>

<body>
<h5>{{$company['company_name']}}</h5>
<h6>{{$company['location']['address1']}}</h6>
<h6>{{$company['location']['city']}},{{$company['location']['country']['name']}}-{{$company['location']['zip']}}</h6>
<h6>Phone: {{$company['contact_no']}}| {{trans('file.Email')}}: {{$company['email']}}</h6>
<hr>

<div class="center">
    <h4>{{trans('file.Payslip')}}: {{$month_year}}</h4>
</div>
<hr>
<div class="table-responsive">
    <table class="table  table-bordered">
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
        <table class="table  table-bordered">

            <thead>
            <tr>
                <th colspan="2">{{trans('file.Earnings')}}</th>
            </tr>
            </thead>
            <thead>
            <tr>
                <th>{{trans('file.Description')}}</th>
                <th>{{trans('file.Amount')}}</th>
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
                    <td class="py-3"><strong>{{__('Basic Salary')}}</strong></td>
                    <td>{{$basic_salary}}</td>
                @else
                    <td class="py-3"><strong>{{__('Basic Salary')}} ({{__('Total')}})</strong></td>
                    <td>{{$total_earnings}}</td>
                @endif
            </tr>
            @if($allowances)
                @foreach($allowances as $allowance)
                    <tr>
                        <td class="py-3"><strong>{{$allowance['allowance_title']}}</strong></td>
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
                        <td class="py-3"><strong>{{$commission['commission_title']}}</strong></td>
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
                        <td class="py-3"><strong>{{$other_payment['other_payment_title']}}</strong></td>
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
                        <td class="py-3"><strong>{{$overtime['overtime_title']}}</strong></td>
                        <td>{{$overtime['overtime_amount']}}</td>
                    </tr>
                    @php
                        $total_earnings = $total_earnings + $overtime['overtime_amount'] ;
                    @endphp
                @endforeach
            @endif

            <tr>
                <td class="py-3"><strong>Total</strong></td>
                @if(config('variable.currency_format') ==='suffix')
                    <td id="total_earnings">{{$total_earnings}} {{config('variable.currency')}}</td>
                @else
                    <td id="total_earnings">{{config('variable.currency')}} {{$total_earnings}} </td>
                @endif            </tr>


        </table>
    </div>
    <!-- /.col -->
</div>

<div class="row">
    <div class="col-xs-12 table-responsive">
        <table class="table  table-bordered">

            <thead>
            <tr>
                <th colspan="2">{{trans('file.Deductions')}}</th>
            </tr>
            </thead>
            <thead>
            <tr>
                <th>{{trans('file.Description')}}</th>
                <th>{{trans('file.Amount')}}</th>
            </tr>
            </thead>

            @php
                $total_deductions = 0;
            @endphp

            @if($loans)
                @foreach($loans as $loan)
                    <tr>
                        <td class="py-3"><strong>{{$loan['loan_title']}}</strong></td>
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
                        <td class="py-3"><strong>{{$deduction['deduction_title']}}</strong></td>
                        <td>{{$deduction['deduction_amount']}}</td>
                    </tr>
                    @php
                        $total_deductions = $total_deductions + $deduction['deduction_amount'] ;
                    @endphp
                @endforeach
            @endif

            <tr>
                <td class="py-3"><strong>{{trans('file.Total')}}</strong></td>
                @if(config('variable.currency_format') ==='suffix')
                    <td id="total_deductions">{{$total_deductions}} {{config('variable.currency')}}</td>
                @else
                    <td id="total_deductions">{{config('variable.currency')}} {{$total_deductions}} </td>
                @endif
            </tr>


        </table>
    </div>
    <!-- /.col -->
</div>
@if(config('variable.currency_format') ==='suffix')
    <h4>{{__('Total Paid')}} : <strong>{{$net_salary}} {{config('variable.currency')}}</strong></h4>
@else
    <h4>{{__('Total Paid')}} :{{config('variable.currency')}} <strong>{{$net_salary}}</strong></h4>
@endif


</body>
</html>

