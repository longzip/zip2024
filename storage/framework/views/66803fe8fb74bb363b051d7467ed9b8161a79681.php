<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

  <title>ZIP | Reset Password</title>

  <link rel="stylesheet" href="<?php echo e(asset('css/app.css')); ?>">
</head>

<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="/"><b>Admin</b>ZIP</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg"><?php echo e(__('Reset Password')); ?></p>

      <?php if(session('status')): ?>
          <div class="alert alert-success" role="alert">
              <?php echo e(session('status')); ?>

          </div>
      <?php endif; ?>
      <form action="<?php echo e(route('password.email')); ?>" method="post">
        <?php echo csrf_field(); ?>
        <div class="input-group mb-3">
          <input type="text" class="form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" name="email" placeholder="Email" value="<?php echo e(old('email')); ?>" required autofocus>
          <div class="input-group-append">
              <span class="fa fa-envelope input-group-text"></span>
          </div>
          <?php if($errors->has('email')): ?>
                      <span class="invalid-feedback" role="alert">
                        <strong><?php echo e($errors->first('email')); ?></strong>
                    </span>
                    <?php endif; ?>
        </div>

        <div class="row">
          <div class="col-8">
             <button type="submit" class="btn btn-primary btn-block btn-flat">
            <?php echo e(__('Send Password Reset Link')); ?>

            </button>
          </div>
          <div class="col-4">
            <a class="btn btn-secondary" href="<?php echo e(route('login')); ?>" class="text-center">Back</a>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<script src="<?php echo e(asset('/js/app.js')); ?>"></script>
</body>

</html>
<?php /**PATH /home/noith733/zip/resources/views/auth/passwords/email.blade.php ENDPATH**/ ?>