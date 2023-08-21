<div id="travelModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title"><?php echo e(__('Add Travel')); ?></h5>
                <button type="button" data-dismiss="modal"  aria-label="Close" class="close"><span
                            aria-hidden="true">×</span></button>
            </div>

            <div class="modal-body">
                <span id="travel_form_result"></span>
                <form method="post" id="travel_sample_form" class="form-horizontal" >

                    <?php echo csrf_field(); ?>
                    <div class="row">


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><?php echo e(trans('file.Company')); ?></label>
                                    <select name="company_id" id="travel_company_id" class="form-control selectpicker get_employee"
                                            data-live-search="true" data-live-search-style="contains"  data-first_name="first_name" data-last_name="last_name"
                                            title='<?php echo e(__('Selecting',['key'=>trans('file.Company')])); ?>...'>
                                        <?php $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($company->id); ?>"><?php echo e($company->company_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><?php echo e(trans('file.Employee')); ?></label>
                                    <select name="employee_id"   class="selectpicker form-control employee"
                                            data-live-search="true" data-live-search-style="contains"
                                            title='<?php echo e(__('Selecting',['key'=>trans('file.Employee')])); ?>...'>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6 form-group">
                                <label><?php echo e(__('Arrangement Type')); ?></label>
                                <select name="travel_type_id" id="travel_type_id" class="form-control selectpicker "
                                        data-live-search="true" data-live-search-style="contains"
                                        title='<?php echo e(__('Selecting',['key'=>trans('file.Arrangement')])); ?>...'>
                                    <?php $__currentLoopData = $travel_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $travel_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($travel_type->id); ?>"><?php echo e($travel_type->arrangement_type); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>


                            <div class="col-md-6 form-group">
                                <label><?php echo e(__('Purpose Of Visit')); ?> *</label>
                                <input type="text" name="purpose_of_visit" id="purpose_of_visit"  class="form-control"
                                       placeholder="<?php echo e(__('Purpose Of Visit')); ?>">
                            </div>

                            <div class="col-md-6 form-group">
                                <label><?php echo e(__('Place Of Visit')); ?> *</label>
                                <input type="text" name="place_of_visit" id="place_of_visit"  class="form-control"
                                       placeholder="<?php echo e(__('Place Of Visit')); ?>">
                            </div>



                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><?php echo e(trans('file.Description')); ?></label>
                                    <textarea class="form-control" id="travel_description" name="description" rows="3"></textarea>
                                </div>
                            </div>

                            <div class="col-md-6 form-group">
                                <label><?php echo e(__('Start Date')); ?> *</label>
                                <input type="text" name="start_date" id="travel_start_date" class="form-control date" autocomplete="off" value="" >
                            </div>

                            <div class="col-md-6 form-group">
                                <label><?php echo e(__('End Date')); ?> *</label>
                                <input type="text" name="end_date" id="travel_end_date" class="form-control date" autocomplete="off" value="" >
                            </div>

                            <div class="col-md-6 form-group">
                                <label><?php echo e(__('Expected Budget')); ?></label>
                                <input type="text" name="expected_budget" id="expected_budget" class="form-control" >
                            </div>

                            <div class="col-md-6 form-group">
                                <label><?php echo e(__('Actual Budget')); ?></label>
                                <input type="text" name="actual_budget" id="actual_budget" class="form-control" >
                            </div>


                            <div class="col-md-6 form-group">
                                <label><?php echo e(__('Travel Mode')); ?></label>
                                <select name="travel_mode" id="travel_mode" class="form-control selectpicker "
                                        data-live-search="true" data-live-search-style="contains"
                                        title='<?php echo e(__('Travel Mode')); ?>'>
                                    <option value="By Bus"><?php echo e(__('By Bus')); ?></option>>
                                    <option value="By Train"><?php echo e(__('By Train')); ?></option>
                                    <option value="By Plane"><?php echo e(__('By Plane')); ?></option>
                                    <option value="By Taxi"><?php echo e(__('By Taxi')); ?></option>
                                    <option value="By Rental Car"><?php echo e(__('By Rental Car')); ?></option>
                                    <option value="By Other"><?php echo e(__('By Other')); ?></option>
                                </select>
                            </div>


                            <div class="col-md-6 form-group">
                                <label><?php echo e(trans('file.Status')); ?></label>
                                <select name="status" id="travel_status" class="form-control selectpicker "
                                        data-live-search="true" data-live-search-style="contains"
                                        title='<?php echo e(__('Selecting',['key'=>trans('file.Status')])); ?>...'>
                                    <option value="pending"><?php echo e(trans('file.Pending')); ?></option>
                                    <option value="first level approval"><?php echo e(__('First Level Approval')); ?></option>
                                    <option value="approved"><?php echo e(trans('file.Approved')); ?></option>
                                    <option value="rejected"><?php echo e(trans('file.Rejected')); ?></option>
                                </select>
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

<?php /**PATH H:\SHRS(project copied to xammp server)\peoplepro\resources\views/calendarable/travel.blade.php ENDPATH**/ ?>