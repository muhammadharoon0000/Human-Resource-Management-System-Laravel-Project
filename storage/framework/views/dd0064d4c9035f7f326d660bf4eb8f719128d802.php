<div id="taskModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title"><?php echo e(__('Add Task')); ?></h5>
                <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><span
                            aria-hidden="true">×</span></button>
            </div>

            <div class="modal-body">
                <span id="task_form_result"></span>
                <form method="post" id="task_sample_form" class="form-horizontal" >

                    <?php echo csrf_field(); ?>
                    <div class="row">

                        <div class="col-md-6 form-group">
                            <label for="task_name"><?php echo e(trans('file.Title')); ?> *</label>
                            <input type="text" name="task_name" id="task_name" required class="form-control"
                                   placeholder="<?php echo e(trans('file.Title')); ?>">
                        </div>

                        <div class="col-md-6">
                            <div class="form-group hide-edit">
                                <label for="task_company_id"><?php echo e(trans('file.Company')); ?></label>
                                <select name="company_id" id="task_company_id" class="form-control selectpicker get_employee"
                                        data-live-search="true" data-live-search-style="contains"
                                        data-first_name="first_name" data-last_name="last_name"
                                        title='<?php echo e(__('Selecting',['key'=>trans('file.Company')])); ?>...'>
                                    <?php $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($company->id); ?>"><?php echo e($company->company_name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    
                                </select>
                            </div>
                        </div>


                        <div class="col-md-6 form-group">
                            <label for="task_start_date"><?php echo e(__('Start Date')); ?> *</label>
                            <input type="text" name="start_date" id="task_start_date" autocomplete="off" required
                                   class="form-control date"
                                   value="">
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="start_end_date"><?php echo e(__('End Date')); ?> *</label>
                            <input type="text" name="end_date" id="start_end_date" autocomplete="off" required
                                   class="form-control date"
                                   value="">
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="task_project_id"><?php echo e(trans('file.Project')); ?></label>
                            <select name="project_id" id="task_project_id" class="form-control selectpicker "
                                    data-live-search="true" data-live-search-style="contains"
                                    title='<?php echo e(__('Selecting',['key'=>trans('file.Project')])); ?>...'>
                                <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($project->id); ?>"><?php echo e($project->title); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div class="col-md-6 form-group">
                            <label><?php echo e(__('Estimated Hour')); ?> *</label>
                            <input type="text" name="task_hour" id="task_hour" required class="form-control"
                                   placeholder="<?php echo e(__('Estimated Hour')); ?>">
                        </div>

                        <div class="col-md-4 form-group">
                            <label for="task_employee_id"><?php echo e(__('Task Users')); ?> *</label>
                            <select name="employee_id[]" id="task_employee_id" class="js-example-responsive employee w-100" multiple="multiple">
                            </select>
                        </div>


                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="task_description"><?php echo e(trans('file.Description')); ?></label>
                                <textarea class="form-control des-editor" id="task_description" name="description"
                                          rows="3"></textarea>
                            </div>
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

<?php /**PATH H:\peoplepro\resources\views/calendarable/task.blade.php ENDPATH**/ ?>