<?php if(session()->has('msg')): ?>
    <div class="alert alert-<?php echo e(session('type')); ?> alert-dismissible text-center">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
        </button><?php echo e(session('msg')); ?></div>
<?php endif; ?><?php /**PATH H:\SHRS(project copied to xammp server)\peoplepro\resources\views/shared/flash_message.blade.php ENDPATH**/ ?>