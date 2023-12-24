<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Danh sách tài liệu</div>

                <div class="card-body">
                    <iframe src="https://drive.google.com/embeddedfolderview?id=<?php echo e($id); ?>" style="width:100%; height:600px; border:0;" />
                </div>
            </div>
        </div>
    </div>
</div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/noith733/zip/resources/views/docs/embeddedfolderview.blade.php ENDPATH**/ ?>