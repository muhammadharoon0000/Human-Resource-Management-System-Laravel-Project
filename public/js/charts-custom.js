$(document).ready(function () {

    'use strict';


    // ------------------------------------------------------- //
    // Line Chart
    // ------------------------------------------------------ //

    var PaymentLastSix    = $('#payment_last_six');

    if (PaymentLastSix.length > 0) {
        var last_six_month_payment = PaymentLastSix.data('last_six_month_payment');
        var label1 = PaymentLastSix.data('label1');
        var payment_last_six = new Chart(PaymentLastSix, {
            type: 'bar',
            data: {
                labels: PaymentLastSix.data('months') ,
                datasets: [
                    {
                        label: label1,
                        backgroundColor: [
                            'rgba(137, 196, 244, 1)',
                            'rgba(137, 196, 244, 1)',
                            'rgba(137, 196, 244, 1)',
                            'rgba(137, 196, 244, 1)',
                            'rgba(137, 196, 244, 1)',
                            'rgba(137, 196, 244, 1)',
                            'rgba(137, 196, 244, 1)',
                            'rgba(137, 196, 244, 1)',
                            'rgba(137, 196, 244, 1)',
                            'rgba(137, 196, 244, 1)',
                            'rgba(137, 196, 244, 1)',
                            'rgba(137, 196, 244, 1)',
                        ],
                        borderColor: [
                            'rgba(34, 49, 63, 1)',
                            'rgba(34, 49, 63, 1)',
                            'rgba(34, 49, 63, 1)',
                            'rgba(34, 49, 63, 1)',
                            'rgba(34, 49, 63, 1)',
                            'rgba(34, 49, 63, 1)',
                            'rgba(34, 49, 63, 1)',
                            'rgba(34, 49, 63, 1)',
                            'rgba(34, 49, 63, 1)',
                            'rgba(34, 49, 63, 1)',
                            'rgba(34, 49, 63, 1)',
                            'rgba(34, 49, 63, 1)',
                        ],
                        borderWidth: 2,
                        data: [ last_six_month_payment[0], last_six_month_payment[1],
                            last_six_month_payment[2], last_six_month_payment[3],
                            last_six_month_payment[4], last_six_month_payment[5]
                            ]
                    },
                ]
            }
        });
    };


    var PIECHART = $('#pieChart');
    if (PIECHART.length > 0) {
        var brandPrimary = PIECHART.data('color');
        var brandPrimaryRgba = PIECHART.data('color_rgba');
        var price = PIECHART.data('price');
        var cost = PIECHART.data('cost');
        var label1 = PIECHART.data('label1');
        var label2 = PIECHART.data('label2');
        var label3 = PIECHART.data('label3');
        var myPieChart = new Chart(PIECHART, {
            type: 'pie',
            data: {
                labels: [
                    label1,
                    label2,
                    label3
                ],
                datasets: [
                    {
                        data: [price, cost, price-cost],
                        borderWidth: [1, 1, 1],
                        backgroundColor: [
                            brandPrimary,
                            "#ff8952",
                            "#858c85"
                        ],
                        hoverBackgroundColor: [
                            brandPrimaryRgba,
                            "rgba(255, 137, 82, 0.8)",
                            "rgb(133, 140, 133, 0.8)"
                        ],
                        hoverBorderWidth: [4, 4, 4],
                        hoverBorderColor: [
                            brandPrimaryRgba,
                            "rgba(255, 137, 82, 0.8)",
                            "rgb(133, 140, 133, 0.8)",
                            
                        ],
                    }]
            },
            options: {
                //rotation: -0.7*Math.PI
            }
        });
    }

    var DepartmentDoughnutChart = $('#department_chart');
    if (DepartmentDoughnutChart.length > 0) {
        var dept_bgcolor = DepartmentDoughnutChart.data('dept_bgcolor');
        var hover_dept_bgcolor = DepartmentDoughnutChart.data('hover_dept_bgcolor');
        var dept_emp_count = DepartmentDoughnutChart.data('dept_emp_count');
        var dept_label = DepartmentDoughnutChart.data('dept_label');


        var myDepartmetnDoughnutChart = new Chart(DepartmentDoughnutChart, {
            type: 'doughnut',
            data: {
                labels: dept_label,
                datasets:[
                    {
                        data: dept_emp_count,
                        backgroundColor: dept_bgcolor,
                        hoverBackgroundColor: hover_dept_bgcolor,
                    }
                    ]
            }
        });
    }

    var DesignationDoughnutChart = $('#designation_chart');
    if (DesignationDoughnutChart.length > 0) {
        var desig_bgcolor = DesignationDoughnutChart.data('desig_bgcolor');
        var hover_desig_bgcolor = DesignationDoughnutChart.data('hover_desig_bgcolor');
        var desig_emp_count = DesignationDoughnutChart.data('desig_emp_count');
        var desig_label = DesignationDoughnutChart.data('desig_label');


        var myDesignationDoughnutChart = new Chart(DesignationDoughnutChart, {
            type: 'pie',
            data: {
                labels: desig_label,
                datasets:[
                    {
                        data: desig_emp_count,
                        backgroundColor: desig_bgcolor,
                        hoverBackgroundColor: hover_desig_bgcolor,
                    }
                ]
            }
        });
    }

    var AttendanceDoughnutChart = $('#attendance_chart');
    if (AttendanceDoughnutChart.length > 0) {
        var present_count = AttendanceDoughnutChart.data('present_count');
        var absent_count = AttendanceDoughnutChart.data('absent_count');

        var label11 = AttendanceDoughnutChart.data('present_level');
        var label22 =AttendanceDoughnutChart.data('absent_level');

        var myAttendanceDoughnutChart = new Chart(AttendanceDoughnutChart, {
            type: 'doughnut',
            data: {
                labels: [label11,label22],
                datasets:[
                    {
                        data: [present_count,absent_count],
                        backgroundColor:[ "rgb(163,186,255)",
                            "rgb(133, 140, 133)"],
                        hoverBackgroundColor:  [
                            "rgba(163,186,255,0.8)",
                            "rgb(133, 140, 133, 0.8)"
                        ],
                    }
                ]
            }
        });
    }

    var ExpenseDepositDoughnutChart = $('#expense_deposit_chart');
    if (ExpenseDepositDoughnutChart.length > 0) {
        var expense_count = ExpenseDepositDoughnutChart.data('expense_count');
        var deposit_count = ExpenseDepositDoughnutChart.data('deposit_count');

        var label111 = ExpenseDepositDoughnutChart.data('expense_level');
        var label222 =ExpenseDepositDoughnutChart.data('deposit_level');

        var myExpenseDepositDoughnutChart = new Chart(ExpenseDepositDoughnutChart, {
            type: 'pie',
            data: {
                labels: [label111,label222],
                datasets:[
                    {
                        data: [expense_count,deposit_count],
                        backgroundColor:[  "rgba(39,217,177)",
                            "rgb(133, 140, 133)"],
                        hoverBackgroundColor:  [
                            "rgba(39,217,177, 0.8)",
                            "rgb(133, 140, 133, 0.8)"
                        ],
                    }
                ]
            }
        });
    }

    var ProjectDoughnutChart = $('#project_chart');
    if (ProjectDoughnutChart.length > 0) {
        var project_status = ProjectDoughnutChart.data('project_status');
        var project_label = ProjectDoughnutChart.data('project_label');
        var myProjectDoughnutChart = new Chart(ProjectDoughnutChart, {
            type: 'doughnut',
            data: {
                labels: project_label,
                datasets:[
                    {
                        data: project_status,
                        backgroundColor:[  "rgb(25,174,217)",
                            "rgb(55,32,91)","rgb(191,140,255)",
                            "rgb(244,96,91)"],
                        hoverBackgroundColor:  [
                            "rgba(25,174,217, 0.8)",
                            "rgb(55,32,91, 0.8)",
                            "rgba(191,140,255,0.8)",
                            "rgb(244,96,91, 0.8)"]
                    }
                ]
            }
        });
    }

});
