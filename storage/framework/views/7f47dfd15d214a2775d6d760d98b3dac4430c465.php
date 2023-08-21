<?php $__env->startSection('content'); ?>

    <?php echo $__env->make('shared.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <section class="forms">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header d-flex align-items-center">
                            <h4><?php echo e(__('Update User Profile')); ?></h4>
                        </div>

                        <div class="card-body">
                            <?php if($user->profile_photo): ?>
                                <img src="<?php echo e(url('uploads/profile_photos',$user->profile_photo)); ?>" height="120" width="120">
                            <?php else: ?>
                                <img src="<?php echo e(url('logo/avatar.jpg')); ?>" height="120" width="120" >
                            <?php endif; ?>
                            <p class="italic"><small><?php echo e(__('The field labels marked with * are required input fields')); ?>.</small></p>
                            <form method="POST" action="<?php echo e(route('profile_update',$user->id)); ?>" enctype="multipart/form-data">
                                <?php echo e(method_field('PUT')); ?>

                                <?php echo csrf_field(); ?>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label><?php echo e(__('Image')); ?></label>
                                            <input type="file" name="profile_photo" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label><?php echo e(__('First Name')); ?> *</label>
                                            <input type="text" name="first_name" value="<?php echo e($user->first_name); ?>" required class="form-control" />
                                            <?php if($errors->has('first_name')): ?>
                                                <span>
                                                    <strong><?php echo e($errors->first('first_name')); ?></strong>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="form-group">
                                            <label><?php echo e(__('Last Name')); ?> *</label>
                                            <input type="text" name="last_name" value="<?php echo e($user->last_name); ?>" required class="form-control" />
                                            <?php if($errors->has('last_name')): ?>
                                                <span>
                                                    <strong><?php echo e($errors->first('last_name')); ?></strong>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="form-group">
                                            <label><?php echo e(trans('file.Username')); ?> *</label>
                                            <input type="text" name="username" value="<?php echo e($user->username); ?>" required class="form-control" />
                                            <?php if($errors->has('username')): ?>
                                                <span>
                                                    <strong><?php echo e($errors->first('username')); ?></strong>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="form-group">
                                            <label><?php echo e(trans('file.Email')); ?> *</label>
                                            <input type="email" name="email" value="<?php echo e($user->email); ?>" required class="form-control">
                                            <?php if($errors->has('email')): ?>
                                                <span>
                                                    <strong><?php echo e($errors->first('email')); ?></strong>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="form-group">
                                            <label><?php echo e(trans('file.Phone')); ?> *</label>
                                            <input type="text" name="contact_no" value="<?php echo e($user->contact_no); ?>" required class="form-control" />
                                        </div>

                                        <div class="form-group">
                                            <input type="submit" value="<?php echo e(trans('file.submit')); ?>" class="btn btn-primary">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>




                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header d-flex align-items-center">
                            <h4><?php echo e(__('Change Password')); ?> (<?php echo e(trans('file.Optional')); ?>)</h4>
                        </div>

                        <div class="card-body">
                            <p class="italic"><small><?php echo e(__('The field labels marked with * are required input fields')); ?>.</small></p>
                            <form method="POST" action="<?php echo e(route('change_password',$user->id)); ?>" >
                                <?php echo csrf_field(); ?>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label><?php echo e(__('New Password')); ?> *</label>
                                            <input type="password" name="password" required class="form-control" placeholder="<?php echo e(__('min:4 characters')); ?>">
                                        </div>

                                        <div class="form-group">
                                            <label><?php echo e(__('Confirm Password')); ?> *</label>
                                            <input type="password" name="password_confirmation" id="confirm_pass" required class="form-control" placeholder="<?php echo e(trans('file.Re-Type')); ?> <?php echo e(trans('file.Password')); ?>">
                                        </div>
                                        <div class="form-group">
                                            <div class="registrationFormAlert" id="divCheckPasswordMatch">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" value="<?php echo e(trans('file.submit')); ?>" class="btn btn-primary">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script type="text/javascript">
        (function($) {
            "use strict";

            $("ul#setting").siblings('a').attr('aria-expanded','true');
            $("ul#setting").addClass("show");
            $("ul#setting #user-menu").addClass("active");


            $(document).ready(function(){
                $(".alert").slideDown(300).delay(5000).slideUp(300);
            });

            $('.selectpicker').selectpicker({
                style: 'btn-link',
            });

            $('#confirm_pass').on('input', function(){

                if($('input[name="password"]').val() != $('input[name="password_confirmation"]').val())
                    $("#divCheckPasswordMatch").html('<?php echo e(__('Password does not match! Please type again')); ?>');
                else
                    $("#divCheckPasswordMatch").html('<?php echo e(__('Password matches')); ?>');

            });
        })(jQuery);
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH H:\SHRS(project copied to xammp server)\peoplepro\resources\views/profile/user_profile.blade.php ENDPATH**/ ?>