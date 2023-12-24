<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <base href="<?php echo e(asset('')); ?>">

        <title>ZIP</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
            .links-bottom{
                text-align: right;
                margin-bottom: 10px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <?php if(Route::has('login')): ?>
                <div class="top-right links">
                    <?php if(auth()->guard()->check()): ?>
                        <a href="<?php echo e(url('import')); ?>">Import</a>
                    <?php else: ?>
                        <a href="<?php echo e(route('login')); ?>">Login</a>

                        <?php if(Route::has('register')): ?>
                            <a href="<?php echo e(route('register')); ?>">Register</a>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <div class="content">
                <div class="title m-b-md">
                    ZIP
                </div>

                <div class="links">
                    

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('import')): ?>
                    <a href="products">Import Product</a>
                    <a href="order-line">Import OrderLine</a>
                    <a href="resources">Import Resource</a>
                    <a href="khachhang">Import Khách Hàng</a>
                    <?php endif; ?>
                    <a href="orders/xml">Export XML Orders</a>

                    <a href="customers/xml">Export XML Customers</a>
                    <a href="gl-entries/xml">Export XML GLEntries</a>

                </div>
                <div class="links links-bottom">
                    <a href="orders2/excel">Export Bán Hàng CSV</a>
                    <a href="orders/excel">Export Giao Hàng CSV</a>
                    <a href="exports/contacts">Export Contacts</a>
                    <a href="exports/lead">Export Lead</a>
                </div>
            </div>
        </div>
    </body>
</html>
<?php /**PATH /home/noith733/zip/resources/views/welcome.blade.php ENDPATH**/ ?>