<?php $__env->startSection('content'); ?>

    <section>
        <div class="container-fluid">
            <div class="d-flex justify-content-between mb-30px">
                <div><h1 class="thin-text"><?php echo e(trans('file.Welcome')); ?> <?php echo e(auth()->user()->username); ?></h1></div>
                <div><h4 class="thin-text"><?php echo e(__('Today is')); ?> <?php echo e(now()->englishDayOfWeek); ?> <?php echo e(now()->format(env('Date_Format'))); ?></h4></div>
            </div>
            <div class="row">
                <div class="col-sm-2">
                    <div class="wrapper count-title text-center">
                        <a href="<?php echo e(route('employees.index')); ?>">
                            <div class="name"><strong class="purple-text"><?php echo e(trans('file.Employees')); ?></strong>
                            </div>
                            <div class="count-number employee-count"><?php echo e($employees->count()); ?></div>
                        </a>
                    </div>
                </div>

                <!-- Count item widget-->
                <div class="col-sm-2">
                    <div class="wrapper count-title text-center">
                        <a href="<?php echo e(route('attendances.index')); ?>">
                            <div class="name"><strong class="orange-text"><?php echo e(trans('file.Attendance')); ?></strong></div>
                            <div class="count-number attendance-count">P:<?php echo e($attendance_count); ?>

                                A:<?php echo e($employees->count() - $attendance_count); ?></div>
                        </a>
                    </div>
                </div>
                <!-- Count item widget-->
                <div class="col-sm-2">
                    <div class="wrapper count-title text-center">
                        <a href="<?php echo e(route('leaves.index')); ?>">
                            <div class="name"><strong class="green-text"><?php echo e(__('Total Leave')); ?></strong></div>
                            <div class="count-number leave-count"><?php echo e($leave_count); ?></div>
                        </a>
                    </div>
                </div>
                <!-- Count item widget-->
                <div class="col-sm-2">
                    <div class="wrapper count-title text-center">
                        <a href="<?php echo e(route('expense.index')); ?>">
                            <div class="name"><strong class="blue-text"><?php echo e(__('Total Expense')); ?></strong></div>
                            <div class="count-number total_expense"> <?php echo e($total_expense); ?></div>
                            
                        </a>
                    </div>
                </div>

                <div class="col-sm-2">
                    <div class="wrapper count-title text-center">
                        <a href="<?php echo e(route('deposit.index')); ?>">
                            <div class="name"><strong class="green-text"><?php echo e(__('Total Deposit')); ?></strong></div>
                            <div class="count-number total_deposit"><?php echo e($total_deposit); ?></div>
                        </a>
                    </div>
                </div>
                <!-- Count item widget-->
                <div class="col-sm-2">
                    <div class="wrapper count-title text-center">
                        <a href="<?php echo e(route('payment_history.index')); ?>">
                            <div class="name"><strong class="blue-text"><?php echo e(__('Total Salaries Paid')); ?></strong>
                            </div>
                            <div class="count-number total_salaries_paid"><?php echo e($total_salaries_paid); ?></div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8 mt-4">
                    <div class="card mb-0">
                        <div class="card-header d-flex align-items-center">
                            <h4><?php echo e(trans('file.Payment')); ?> --- <?php echo e(__('Last 6 Months ')); ?></h4>
                        </div>
                        <div class="card-body">
                            <canvas id="payment_last_six" data-last_six_month_payment = "<?php echo e(json_encode($per_month_payment) ?? ''); ?>" data-months="<?php echo e(json_encode($per_month) ?? ''); ?>"  data-label1="<?php echo e(trans('file.Payment')); ?>" ></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mt-4">
                    <div class="card mb-0">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4><?php echo e(__('Employee Department')); ?></h4>
                        </div>
                        <div class="pie-chart mb-2">
                            <canvas id="department_chart" data-dept_bgcolor='<?php echo json_encode($dept_bgcolor_array, 15, 512) ?>'
                                    data-hover_dept_bgcolor='<?php echo json_encode($dept_hover_bgcolor_array, 15, 512) ?>'
                                    data-dept_emp_count='<?php echo json_encode($dept_count_array, 15, 512) ?>'
                                    data-dept_label='<?php echo json_encode($dept_name_array, 15, 512) ?>' width="100" height="95"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mt-4">
                    <div class="card mb-0">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4><?php echo e(__('Employee Designation')); ?></h4>
                        </div>
                        <div class="pie-chart mb-2">
                            <canvas id="designation_chart" data-desig_bgcolor='<?php echo json_encode($desig_bgcolor_array, 15, 512) ?>'
                                    data-hover_desig_bgcolor='<?php echo json_encode($desig_hover_bgcolor_array, 15, 512) ?>'
                                    data-desig_emp_count='<?php echo json_encode($desig_count_array, 15, 512) ?>'
                                    data-desig_label='<?php echo json_encode($desig_name_array, 15, 512) ?>' width="100" height="95"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mt-4">
                    <div class="card mb-0">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4><?php echo e(__('Expense Vs Deposit')); ?></h4>
                        </div>
                        <div class="pie-chart mb-2">
                            <canvas id="expense_deposit_chart" data-expense_count='<?php echo e($total_expense_raw); ?>'
                                    data-expense_level="<?php echo e(trans('Expense')); ?>"
                                    data-deposit_count='<?php echo e($total_deposit_raw); ?>'
                                    data-deposit_level="<?php echo e(trans('Deposit')); ?>" width="100" height="95"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mt-4">
                    <div class="card mb-0">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4><?php echo e(__('Project Status')); ?></h4>
                        </div>
                        <div class="pie-chart mb-2">
                            <canvas id="project_chart" data-project_status='<?php echo json_encode($project_count_array, 15, 512) ?>'
                                    data-project_label='<?php echo json_encode($project_name_array, 15, 512) ?>' width="100" height="95"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-4 mt-4">
                    <div class="wrapper count-title d-flex">
                        <div class="icon blue-text ml-2 mr-3"><i class="dripicons-volume-medium"></i></div>
                        <a href="<?php echo e(route('announcements.index')); ?>">
                            <h3 class="mt-3"><?php echo e(count($announcements)); ?> <?php echo e(trans('file.Announcement')); ?></h3>
                        </a>
                    </div>
                </div>
                <div class="col-4 mt-4">
                    <div class="wrapper count-title d-flex">
                        <div class="icon green-text ml-2 mr-3"><i class="dripicons-ticket"></i></div>
                        <a href="<?php echo e(route('tickets.index')); ?>">
                            <h3 class="mt-3"><?php echo e($ticket_count); ?> <?php echo e(__('Open Ticket')); ?></h3>
                        </a>
                    </div>
                </div>
                <div class="col-4 mt-4">
                    <div class="wrapper count-title d-flex">
                        <div class="icon orange-text ml-2 mr-3"><i class="dripicons-briefcase"></i></div>
                        <a href="<?php echo e(route('projects.index')); ?>">
                            <h3 class="mt-3"><?php echo e($completed_projects); ?> <?php echo e(__('Completed Projects')); ?></h3>
                        </a>
                    </div>
                </div>
            </div>

            <div class="row">
                <?php echo $__env->make('calendarable.calendar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>

    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH H:\peoplepro\resources\views/dashboard/admin_dashboard.blade.php ENDPATH**/ ?>