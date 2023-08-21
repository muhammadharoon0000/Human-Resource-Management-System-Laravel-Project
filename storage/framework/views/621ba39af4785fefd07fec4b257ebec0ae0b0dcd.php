<div id="eventModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title"><?php echo e(__('Add Event')); ?></h5>
                <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><span
                            aria-hidden="true">×</span></button>
            </div>

            <div class="modal-body">
                <span id="event_form_result"></span>
                <form method="post" id="event_sample_form" class="form-horizontal" >

                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="event_company_id"><?php echo e(trans('file.Company')); ?></label>
                                <select name="company_id" id="event_company_id" class="form-control selectpicker dynamic"
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
                                        title='<?php echo e(__('Selecting',['key'=>trans('file.Department')])); ?>...'>
                                </select>
                            </div>
                        </div>


                        <div class="col-md-6 form-group">
                            <label><?php echo e(__('Event Title')); ?> *</label>
                            <input type="text" name="event_title" id="event_title" required class="form-control"
                                   placeholder="<?php echo e(__('Event Title')); ?>">
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="event_note"><?php echo e(__('Event Note')); ?></label>
                            <textarea class="form-control" id="event_note" name="event_note"
                                      rows="3"></textarea>
                        </div>

                        <div class="col-md-6 form-group">
                            <label><?php echo e(__('Event Date')); ?> *</label>
                            <input type="text" name="event_date" id="event_date" autocomplete="off" required class="form-control date"
                                   value="">
                        </div>

                        <div class="col-md-6">
                            <label><?php echo e(__('Event Time')); ?></label>
                            <div class="col-md-8 row">
                                <input type="text" name="event_time" id="event_time" required class="form-control time"
                                       autocomplete="off" value="" placeholder="Event Time">
                            </div>
                        </div>


                        <div class="col-md-6 form-group">
                            <label><?php echo e(trans('file.Status')); ?></label>
                            <select name="status" id="event_status" class="form-control selectpicker "
                                    data-live-search="true" data-live-search-style="contains"
                                    title='<?php echo e(__('Selecting',['key'=>trans('file.Status')])); ?>...'>
                                <option value="pending"><?php echo e(trans('file.Pending')); ?></option>
                                <option value="approved"><?php echo e(trans('file.Approved')); ?></option>
                                <option value="postponed"><?php echo e(trans('file.Postponed')); ?></option>
                            </select>
                        </div>

                        <div class="col-md-6 form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="is_notify" id="event_is_notify"
                                       value="1">
                                <label class="custom-control-label"
                                       for="event_is_notify"><?php echo e(trans('file.Notification')); ?></label>
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

<?php /**PATH H:\SHRS(project copied to xammp server)\peoplepro\resources\views/calendarable/event.blade.php ENDPATH**/ ?>