<div id="leaveModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title"><?php echo e(__('Add Leave')); ?></h5>
                <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><span
                            aria-hidden="true">×</span></button>
            </div>

            <div class="modal-body">
                <span id="leave_form_result"></span>
                <form method="post" id="leave_sample_form" class="form-horizontal" >

                    <?php echo csrf_field(); ?>
                    <div class="row">

                        <div class="col-md-6 form-group">
                            <label><?php echo e(__('Leave Type')); ?></label>
                            <select name="leave_type" id="leave_type" class="form-control selectpicker "
                                    data-live-search="true" data-live-search-style="contains"
                                    title='<?php echo e(__('Selecting',['key'=>__('Leave Type')])); ?>...'>
                                <?php $__currentLoopData = $leave_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $leave_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($leave_type->id); ?>"><?php echo e($leave_type->leave_type); ?> (<?php echo e($leave_type->allocated_day); ?> Days)</option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label><?php echo e(trans('file.Company')); ?></label>
                                <select name="company_id" id="leave_company_id" class="form-control selectpicker dynamic"
                                        data-live-search="true" data-live-search-style="contains"
                                        data-dependent="department_name"
                                        title='<?php echo e(__('Selecting',['key'=>trans('file.Company')])); ?>...'>
                                    <?php $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($company->id); ?>"><?php echo e($company->company_name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label><?php echo e(trans('file.Department')); ?></label>
                                <select name="department_id"  class="selectpicker form-control department"
                                        data-live-search="true" data-live-search-style="contains"
                                        data-first_name="first_name" data-last_name="last_name"
                                        title='<?php echo e(__('Selecting',['key'=>trans('file.Department')])); ?>...'>
                                    
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 form-group">
                            <label><?php echo e(trans('file.Employee')); ?></label>
                            <select name="employee_id"  class="selectpicker form-control employee"
                                    data-live-search="true" data-live-search-style="contains"
                                    title='<?php echo e(__('Selecting',['key'=>trans('file.Employee')])); ?>...'>
                            </select>
                        </div>


                        <div class="col-md-6 form-group">
                            <label><?php echo e(__('Start Date')); ?></label>
                            <input type="text" name="start_date" id="leave_start_date" class="form-control date" value="" required>
                        </div>

                        <div class="col-md-6 form-group">
                            <label><?php echo e(__('End Date')); ?></label>
                            <input type="text" name="end_date" id="leave_end_date" class="form-control date" value="" required>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="leave_reason"><?php echo e(trans('file.Description')); ?></label>
                                <textarea class="form-control" id="leave_reason" name="leave_reason" rows="3"></textarea>
                            </div>
                        </div>


                        <div class="col-md-6 form-group">
                            <label for="leave_remarks"><?php echo e(trans('file.Remarks')); ?></label>
                            <textarea class="form-control" id="leave_remarks" name="remarks"
                                      rows="3"></textarea>
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="leave_status"><?php echo e(trans('file.Status')); ?></label>
                            <select name="status" id="leave_status" class="form-control selectpicker "
                                    data-live-search="true" data-live-search-style="contains"
                                    title='<?php echo e(__('Selecting',['key'=>trans('file.Status')])); ?>...'>
                                <option value="pending"><?php echo e(trans('file.Pending')); ?></option>
                                <option value="first level approval"><?php echo e(__('First Level Approval')); ?></option>
                                <option value="approved"><?php echo e(trans('file.Approved')); ?></option>
                                <option value="rejected"><?php echo e(trans('file.Rejected')); ?></option>
                            </select>
                        </div>

                        <div class="col-md-6 form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="is_half" id="leave_is_half" value="1"  >
                                <label for="leave_is_half" class="custom-control-label" ><?php echo e(__('Half Day')); ?></label>

                            </div>
                        </div>

                        <div class="col-md-6 form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="is_notify" id="leave_is_notify" value="1" >
                                <label class="custom-control-label" for="leave_is_notify"><?php echo e(trans('file.Notification')); ?></label>
                            </div>
                        </div>


                        <div class="container">
                            <div class="form-group" align="center">
                                <input type="hidden" name="diff_date_hidden" id="diff_date_hidden"/>
                                <input type="submit" name="action_button" class="btn btn-warning" value=<?php echo e(trans('file.Add')); ?> />
                            </div>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>

<?php /**PATH C:\xampp\htdocs\peoplepro\resources\views/calendarable/leave.blade.php ENDPATH**/ ?>