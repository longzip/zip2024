<?php
echo '<?xml version="1.0" ?>';
$customer = App\Customer::find($order->deliver_to);
$user = App\User::find($order->user_id);
$resource = $user->resource;
?>
<eExact xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="eExact-Schema.xsd">
 <GLEntries>
 <GLEntry>
  <DocumentDate><?php echo e($order->created_at); ?></DocumentDate>
  <Journal code="600">
  </Journal>
  <FinEntryLine number="1" type="N" subtype="N">
   <GLAccount code="11301">
   </GLAccount>
    <Description>Đặt cọc cho đơn hàng <?php echo e($order->so_number); ?></Description>
   <Costcenter code="<?php echo e($resource->costcenter); ?>">
   </Costcenter>
   <Debtor code="<?php echo e($customer->id); ?>" number=" <?php echo e($customer->id); ?>" type="C">
   </Debtor>
   <Resource code="<?php echo e($user->username); ?>">
   </Resource>
   <Project code="<?php echo e($order->so_number); ?>">
   </Project>
   <Amount>
    <Currency code="VND"/>
    <Debit><?php echo e($order->pre_pay); ?></Debit>
    <Credit>0</Credit>
   </Amount>
   <FinReferences TransactionOrigin="N">
    <UniquePostingNumber>0</UniquePostingNumber>
    <YourRef>Đơn hàng <?php echo e($order->so_number); ?></YourRef>
    <DocumentDate><?php echo e($order->created_at); ?></DocumentDate>
   </FinReferences>
  </FinEntryLine>
  <FinEntryLine number="2" type="N" subtype="N">
   <Date><?php echo e($order->created_at); ?></Date>
   <GLAccount code="33605">
    <Description>Phải thu nội bộ (tiền cọc)</Description>
   </GLAccount>
    <Description>Đặt cọc cho đơn hàng <?php echo e($order->so_number); ?></Description>
   <Costcenter code="<?php echo e($resource->code); ?>">
   </Costcenter>
   <Debtor code="<?php echo e($customer->id); ?>" number=" <?php echo e($customer->id); ?>" type="C">
   </Debtor>
   <Resource number="1" code="Administrator">
   </Resource>
   <Project code="<?php echo e($order->so_number); ?>">
   </Project>
   <Amount>
    <Currency code="VND"/>
    <Debit>0</Debit>
    <Credit><?php echo e($order->pre_pay); ?></Credit>
   </Amount>
   <FinReferences TransactionOrigin="I">
    <UniquePostingNumber>0</UniquePostingNumber>
    <YourRef>Đơn hàng <?php echo e($order->so_number); ?></YourRef>
    <DocumentDate><?php echo e($order->created_at); ?></DocumentDate>
   </FinReferences>
  </FinEntryLine>
 </GLEntry>
</GLEntries>
</eExact>
<?php /**PATH /home/noith733/zip/resources/views/glentries/xml.blade.php ENDPATH**/ ?>