<?php $__env->startSection('content'); ?>
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="search-date col-md-3">
        <label>Lọc ngày</label>
        <?php echo e(csrf_field()); ?>

        <input type="text" class="daterange" value="" name="datetimes" />
      </div>
      <div class="card">
        <div class="card-header">Xuất file Excell</div>
        <div class="card-body">
                    
                    
                      <?php echo e(csrf_field()); ?>

                      <div class="form-group">
                        <table class="table table-bordered" id="table2excel">
                          <thead>
                            <tr class="noExl" style="display: none;">
                              <td>Đơn Hàng</td>
                              <td>Sản Phẩm</td>
                              <td>Số Lượng</td>
                              <td>Gía Trước</td>
                              <td>Gía sau Ck</td>
                              <td>Ngày Giao</td>
                              <td>Ngày Ký Đơn</td>
                              <td>Kho</td>
                              <td>SR</td>
                            </tr>
                            <tr>
                              <td>Đơn Hàng</td>
                              <td>Sản Phẩm</td>
                              <td>Số Lượng</td>
                              <td>Gía Trước</td>
                              <td>Gía sau Ck</td>
                              <td>Ngày Giao</td>
                              <td>Ngày Ký Đơn</td>
                              <td>Kho</td>
                              <td>SR</td>
                            </tr>
                          </thead>
                          <tbody id="fillod">
                           <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                           <tr>
                            <td><?php echo e($order->order); ?></td>
                            <td><?php echo e($order->item); ?></td>
                            <td><?php echo e($order->quantity); ?></td>
                            <td><?php echo e($order->price); ?></td>
                            <td><?php echo e($order->amount); ?></td>
                            <td><?php echo e($order->delivery); ?></td>
                            <td><?php echo e($order->startorder); ?></td>
                            <td><?php echo e($order->warehouse); ?></td>
                            <td><?php echo e($order->costcenter); ?></td>
                          </tr>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                      </table>
                    </div>


                    <a class="btn btn-success" id="Export">Export to Excel</a>
                    
                    <button type="reset" class="btn btn btn-danger btn-mleft">Hủy</button>
                  
                </div>
              </div>
            </div>
          </div>
        </div>
        <style type="text/css">
        .search-date{
          display: flex;
          padding: 10px;
          flex-direction: column;
        }
        .search-date input{
          border-radius: 5px;
          border: 1px solid #a99898d6;
          padding: 5px;
        }
        .daterangepicker .calendar {
          max-width: 350px;
      }
      </style>
      <script type="text/javascript">
        $('.daterange').daterangepicker();


        $('input[name="datetimes"]').on('apply.daterangepicker', function(ev, picker) {
          var time    = $('input[name="datetimes"]').val();
          var fillter = '<?php echo e(route("export_excel.fillOrder")); ?>';
          $.ajax({
            data: {
              range : time,
            },
            url: fillter,
            type: 'GET',
            success: function(data) {
              if(data.status === true) {
                $.bootstrapGrowl(data.message, { type: 'success' });
                setTimeout(function(){
                 window.location.reload();
               }, 200);
              }
              $("#fillod").html(data);
            },
          });
        });

        
//         var  myfunction = function(){
//   $("#table2excel").table2excel({
//     // exclude CSS class
//     exclude: ".noExl",
//     name: "Worksheet Name",
//     filename: "SomeFile", //do not include extension
//     fileext: ".xls" // file extension
//   }); 

//   // $("#table2excel").table2excel({
//   //   exclude: ".noExl",
//   //   name: "Worksheet Name",
//   //   filename: "SomeFile",
//   //   fileext: ".xls",
//   //   preserveColors: true
//   // });
//   // $("#table2excel").table2excel({
//   //   exclude: ".noExl",
//   //   name: "Worksheet Name",
//   //   filename: "SomeFile",
//   //   fileext: ".xls",
//   //   exclude_img: true,
//   //   exclude_links: true,
//   //   exclude_inputs: true
//   // }); 
//   console.log('q')
// };
// $("#Export").on('click',myfunction);
$('input[name="datetimes"]').on('apply.daterangepicker', function(ev, picker) {
$("#Export").on('click', function() {

        // console.log();
      
    
// })
      var start    = picker.startDate.format('YYYY-MM-DD');
      var end    = picker.endDate.format('YYYY-MM-DD');
    //   console.log(picker.startDate.format('DD-MM-YYYY'));
      window.location ='/orders/export_excel?start='+start+'&end='+end;
    });});
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/noith733/zip/resources/views/exportOrder.blade.php ENDPATH**/ ?>