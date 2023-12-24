<?php $__env->startSection('content'); ?>
<div class="container1">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="row"> 
        <div class="col-md-3">
          
        </div>
        <div class="search-date col-md-3">
          <label>Lọc ngày</label>
          <?php echo e(csrf_field()); ?>

          <input type="text" class="daterange" value="" name="datetimes" />
        </div>
        <div class="col-md-3">
          <label>Xuất file</label><br>
          <a class="btn btn-success" id="Export">Export to Excel</a>
        </div>
      </div>
      <div class="card">
        <div class="card-header">Xuất file Excell</div>
        <div class="card-body">
                    
                    
                      <?php echo e(csrf_field()); ?>

                      <div class="form-group">
                        <table class="table table-bordered" id="table2excel">
                          <thead>
                            
                            <tr class="noExl" style="display: none;">
                              <td>id</td>
                              <td>Sản Phẩm</td>
                              <td>Số Lượng</td>
                              <td>Gía/sp</td>
                              <td>Gía sau Ck/sp</td>
                              <td>Đơn hàng</td>
                              <td>Kho</td>
                              <td>Ngày giao</td>
                              <td>SR</td>
                              <td>Ngày kí</td>
                              <td>Cọc</td>
                              <td>Gía sau Ck</td>
                              <td>Vat</td>
                              <td>lđ</td>
                              <td>vc</td>
                              <td>ck</td>
                              <td>Giá trước ck/sp</td>
                              <td>Nhân Viên</td>
                              <td>điểm thưởng</td>
                            </tr>
                            <tr>
                              <td>id</td>
                              <td>Sản Phẩm</td>
                              <td>Số Lượng</td>
                              <td>Gía/sp</td>
                              <td>Gía sau Ck/sp</td>
                              <td>Đơn hàng</td>
                              <td>Kho</td>
                              <td>Ngày giao</td>
                              <td>SR</td>
                              <td>Ngày kí</td>
                              <td>Cọc</td>
                              <td>Gía sau Ck</td>
                              <td>Vat</td>
                              <td>lđ</td>
                              <td>vc</td>
                              <td>ck</td>
                              <td>Giá trước ck/sp</td>
                              <td>Nhân Viên</td>
                              <td>điểm thưởng</td>
                            </tr>
                          </thead>
                          <tbody id="fillod">
                            <?php if($a): ?>
                            <?php $__currentLoopData = $a; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $orders): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                              <td><?php echo e($orders['ORDER_ID']); ?></td>
                              <td class="size_new"><?php echo e($orders['ITEM']); ?></td>
                              <td><?php echo e($orders['QUANTITY']); ?></td>
                              <td><?php echo e($orders['PRICE']); ?></td>
                              <td><?php echo e($orders['AMOUNT']); ?></td>
                              <td><?php echo e($orders['so_number']); ?></td>
                              <td><?php echo e($orders['warehouse']); ?></td>
                              <td><?php echo e($orders['delivery_date']); ?></td>
                              <td><?php echo e($orders['costcenter']); ?></td>
                              <td><?php echo e($orders['start_date']); ?></td>
                              <td><?php echo e($orders['pre_pay']); ?></td>
                              <td><?php echo e($orders['amount']); ?></td>
                              <td><?php echo e($orders['vat']); ?></td>
                              <td><?php echo e($orders['fee_ld']); ?></td>
                              <td><?php echo e($orders['fee_vc']); ?></td>
                              <td><?php echo e($orders['qgg']); ?></td>
                              <td><?php echo e($orders['PRICE']*$orders['QUANTITY']); ?></td>
                              <td><?php echo e($orders['name']); ?></td>
                              <td><?php echo e($orders['POINT']*$orders['QUANTITY']); ?> </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                          </tbody>
                        </table>
                      </div>


                      <!-- <a class="btn btn-success" id="Export">Export to Excel</a>
                      
                      <button type="reset" class="btn btn btn-danger btn-mleft">Hủy</button>
                     -->
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
          .container1{
            margin: 0px 10px 0px 75px;
          }
          .size_new{
            font-size: 12px;
          }
        </style>
        <script type="text/javascript">
          $('.daterange').daterangepicker();


          $('input[name="datetimes"]').on('apply.daterangepicker', function(ev, picker) {
            var time    = $('input[name="datetimes"]').val();
            var fillter = '<?php echo e(route("export_excel.fillOrderDoanhThu")); ?>';
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


  var  myfunction = function(){
  $("#table2excel").table2excel({
    // exclude CSS class
    exclude: ".noExl",
    name: "Worksheet Name",
    filename: "SomeFile", //do not include extension
    fileext: ".xls" // file extension
  });
}

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
$("#Export").on('click',myfunction);
// $('input[name="datetimes"]').on('apply.daterangepicker', function(ev, picker) {
//   $("#Export").on('click', function() {
//     var start    = picker.startDate.format('YYYY-MM-DD');
//     var end    = picker.endDate.format('YYYY-MM-DD');
//     //   console.log(picker.startDate.format('DD-MM-YYYY'));
//     window.location ='/orders2/export_excel2?start='+start+'&end='+end;
//   });
// });
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/noith733/zip/resources/views/exportDoanhThu.blade.php ENDPATH**/ ?>