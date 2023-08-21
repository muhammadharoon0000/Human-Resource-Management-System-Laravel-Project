<div id="projectModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title"><?php echo e(__('Add Project')); ?></h5>
                <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><span
                            aria-hidden="true">×</span></button>
            </div>

            <div class="modal-body">
                <span id="project_form_result"></span>
                <form method="post" id="project_sample_form" class="form-horizontal" >

                    <?php echo csrf_field(); ?>
                    <div class="row">

                        <div class="col-md-6 form-group">
                            <label for="project_title"><?php echo e(trans('file.Title')); ?> *</label>
                            <input type="text" name="title" id="project_title" required class="form-control"
                                   placeholder="<?php echo e(trans('file.Title')); ?>">
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="project_client_id"><?php echo e(trans('file.Client')); ?>*</label>
                                <select name="client_id" id="project_client_id"
                                        class="form-control selectpicker dynamic"
                                        data-live-search="true" data-live-search-style="contains"
                                        title='<?php echo e(__('Selecting',['key'=>trans('file.Client')])); ?>...'>
                                    <?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($client->id); ?>"><?php echo e($client->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>


                        <div class="col-md-6 form-group">
                            <label for="project_start_date" ><?php echo e(__('Start Date')); ?> *</label>
                            <input type="text" name="start_date" id="project_start_date" autocomplete="off" required class="form-control date"
                                   value="">
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="project_end_date"><?php echo e(__('End Date')); ?> *</label>
                            <input type="text" name="end_date" id="project_end_date" autocomplete="off" required class="form-control date"
                                   value="">
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="project_priority" ><?php echo e(trans('file.Priority')); ?></label>
                            <select name="project_priority" id="project_priority" class="form-control selectpicker "
                                    data-live-search="true" data-live-search-style="contains"
                                    title='<?php echo e(__('Selecting',['key'=>trans('file.Priority')])); ?>...'>
                                <option value="low"><?php echo e(trans('file.Low')); ?></option>
                                <option value="medium"><?php echo e(trans('file.Medium')); ?></option>
                                <option value="high"><?php echo e(trans('file.High')); ?></option>
                                <option value="highest"><?php echo e(trans('file.Highest')); ?></option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="project_summary" ><?php echo e(trans('file.Summary')); ?></label>
                                <textarea class="form-control" id="project_summary"
                                          name="summary" rows="3"></textarea>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="project_company_id"><?php echo e(trans('file.Company')); ?></label>
                                <select name="company_id" id="project_company_id" class="form-control selectpicker get_employee"
                                        data-live-search="true" data-live-search-style="contains"  data-first_name="first_name" data-last_name="last_name"
                                        title='<?php echo e(__('Selecting',['key'=>trans('file.Company')])); ?>...'>
                                    <?php $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($company->id); ?>"><?php echo e($company->company_name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    
                                </select>
                            </div>
                        </div>



                        <div class="col-md-4 form-group">
                            <label for="project_employee_id"><?php echo e(__('Project Users')); ?> *</label>
                            <select name="employee_id[]" id="project_employee_id" class="js-example-responsive employee w-100"
                                    multiple="multiple">

                            </select>
                        </div>




                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="project_description"><?php echo e(trans('file.Description')); ?></label>
                                <textarea class="form-control des-editor" id="project_description" name="description"
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

<?php /**PATH C:\xampp\htdocs\peoplepro\resources\views/calendarable/project.blade.php ENDPATH**/ ?>