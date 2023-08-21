<div id="meetingModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title"><?php echo e(__('Add Meeting')); ?></h5>
                <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><span
                            aria-hidden="true">×</span></button>
            </div>

            <div class="modal-body">
                <span id="meeting_form_result"></span>
                <form method="post" id="meeting_sample_form" class="form-horizontal" >

                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="meeting_company_id" ><?php echo e(trans('file.Company')); ?> *</label>
                                <select name="company_id" id="meeting_company_id"  class="form-control selectpicker get_employee"
                                        data-live-search="true" data-live-search-style="contains"  data-first_name="first_name" data-last_name="last_name"
                                        title='<?php echo e(__('Selecting',['key'=>trans('file.Company')])); ?>...'>
                                    <?php $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($company->id); ?>"><?php echo e($company->company_name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 form-group">
                            <label><?php echo e(trans('file.Employee')); ?> *</label>
                            <select name="employee_id[]"   class="selectpicker form-control employee"
                                    data-live-search="true" data-live-search-style="contains" multiple
                                    title='<?php echo e(__('Selecting',['key'=>trans('file.Employee')])); ?>...'>
                            </select>
                        </div>


                        <div class="col-md-6 form-group">
                            <label><?php echo e(__('Meeting Title')); ?> *</label>
                            <input type="text" name="meeting_title" id="meeting_title" required class="form-control"
                                   placeholder="<?php echo e(__('Meeting Title')); ?>">
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="meeting_note"><?php echo e(__('Meeting Note')); ?></label>
                            <textarea class="form-control" id="meeting_note" name="meeting_note"
                                      rows="3"></textarea>
                        </div>

                        <div class="col-md-6 form-group">
                            <label><?php echo e(__('Meeting Date')); ?> *</label>
                            <input type="text" name="meeting_date" id="meeting_date" autocomplete="off" required class="form-control date"
                                   value="">
                        </div>

                        <div class="col-md-6">
                            <label><?php echo e(__('Meeting Time')); ?></label>
                            <div class="col-md-8 row">
                                <input type="text" name="meeting_time" id="meeting_time" required class="form-control time"
                                       autocomplete="off" value="" placeholder="Meeting Time">
                            </div>
                        </div>


                        <div class="col-md-6 form-group">
                            <label for="meeting_status"><?php echo e(trans('file.Status')); ?></label>
                            <select name="status" id="meeting_status" class="form-control selectpicker "
                                    data-live-search="true" data-live-search-style="contains"
                                    title='<?php echo e(__('Selecting',['key'=>trans('file.Status')])); ?>...'>
                                <option value="pending"><?php echo e(trans('file.Pending')); ?></option>
                                <option value="ongoing"><?php echo e(trans('file.Ongoing')); ?></option>
                                <option value="completed"><?php echo e(trans('file.Completed')); ?></option>
                                <option value="postponed"><?php echo e(trans('file.Postponed')); ?></option>
                            </select>
                        </div>

                        <div class="col-md-6 form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="is_notify" id="meeting_is_notify"
                                       value="1">
                                <label class="custom-control-label"
                                       for="meeting_is_notify"><?php echo e(trans('file.Notification')); ?></label>
                            </div>
                        </div>


                        <div class="container">
                            <div class="form-group" align="center">
                                <input type="submit" name="action_button"  class="btn btn-warning" value=<?php echo e(trans('file.Add')); ?> />
                            </div>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>

<?php /**PATH H:\SHRS(project copied to xammp server)\peoplepro\resources\views/calendarable/meeting.blade.php ENDPATH**/ ?>