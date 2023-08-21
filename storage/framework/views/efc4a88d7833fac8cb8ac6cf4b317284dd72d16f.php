<div id="trainingModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title"><?php echo e(__('Add Training')); ?></h5>
                <button type="button" data-dismiss="modal"  aria-label="Close" class="close"><span
                            aria-hidden="true">×</span></button>
            </div>

            <div class="modal-body">
                <span id="training_form_result"></span>
                <form method="post" id="training_sample_form" class="form-horizontal" >

                    <?php echo csrf_field(); ?>
                    <div class="row">


                        <div class="col-md-6">
                            <div class="form-group">
                                <label><?php echo e(trans('file.Company')); ?> *</label>
                                <select name="company_id" id="training_company_id"  class="form-control selectpicker get_employee"
                                        data-live-search="true" data-live-search-style="contains"  data-first_name="first_name" data-last_name="last_name"
                                        title='<?php echo e(__('Selecting',['key'=>trans('file.Company')])); ?>...'>
                                    <?php $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($company->id); ?>"><?php echo e($company->company_name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    
                                </select>
                            </div>
                        </div>


                        <div class="col-md-6 form-group">
                            <label><?php echo e(__('Training Type')); ?> *</label>
                            <select name="training_type" id="training_type_new"  class="form-control selectpicker "
                                    data-live-search="true" data-live-search-style="contains"
                                    title='<?php echo e(__('Selecting',['key'=>__('Training Type')])); ?>...'>
                                <?php $__currentLoopData = $training_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $training_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($training_type->id); ?>"><?php echo e($training_type->type); ?> </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div class="col-md-6 form-group">
                            <label><?php echo e(trans('file.Trainer')); ?> *</label>
                            <select name="trainer_id" id="trainer_id"  class="form-control selectpicker "
                                    data-live-search="true" data-live-search-style="contains"
                                    title='<?php echo e(__('Selecting',['key'=>trans('file.Trainer')])); ?>...'>
                                <?php $__currentLoopData = $trainers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trainer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($trainer->id); ?>"><?php echo e($trainer->first_name); ?> <?php echo e($trainer->last_name); ?> </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>



                        <div class="col-md-6 form-group">
                            <label><?php echo e(trans('file.Employee')); ?> *</label>
                            <select name="employee_id[]" id="training_employee_id"  class="selectpicker form-control employee"
                                    data-live-search="true" data-live-search-style="contains" multiple
                                    title='<?php echo e(__('Selecting',['key'=>trans('file.Employee')])); ?>...'>
                            </select>
                        </div>


                        <div class="col-md-6 form-group">
                            <label><?php echo e(__('Start Date')); ?> *</label>
                            <input type="text" name="start_date" id="training_start_date" required class="form-control date" value="">
                        </div>

                        <div class="col-md-6 form-group">
                            <label><?php echo e(__('End Date')); ?> *</label>
                            <input type="text" name="end_date" id="training_end_date" required class="form-control date" value="">
                        </div>

                        <div class="col-md-6 form-group">
                            <label><?php echo e(__('Training Cost.')); ?> *</label>
                            <input type="text" name="training_cost" id="training_cost" required class="form-control"
                                   placeholder="<?php echo e(__('Training Cost.')); ?>">
                        </div>

                        <div class="col-md-6 form-group">
                            <label><?php echo e(trans('file.Description')); ?></label>
                            <textarea class="form-control" id="training_description" name="description"
                                      rows="3"></textarea>
                        </div>

                        <div class="container">
                            <div class="form-group" align="center">
                                <input type="submit" name="action_button" class="btn btn-warning" value=<?php echo e(trans('file.Add')); ?> />
                            </div>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>

<?php /**PATH H:\SHRS(project copied to xammp server)\peoplepro\resources\views/calendarable/training.blade.php ENDPATH**/ ?>