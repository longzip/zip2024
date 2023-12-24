<?php
echo '<?xml version="1.0" ?>';
$customer = App\Customer::find($order->deliver_to);
$user = App\User::find($order->user_id);
$resource = 9001;
switch ($order->warehouse)
{
    case 'A_MB' :
        $resource = 9001;
        break;
    case 'A_MT':
        $resource = 9002;
        break;
    case 'A_MN':
        $resource = 9003;
        break;
    case 'A_TA':
        $resource = 9004;
        break;
    default:
        $resource = 9001;
        break;
}
?>
<!--  -->

<eExact xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="eExact-Schema.xsd">
  <Orders>
    <Order type="V" number="<?php echo e($order->so_number); ?>" partialdelivery="1" confirm="0" invoicemethod="H">
      <Description><?php echo e($order->description); ?></Description>
      <YourRef><?php echo e($order->your_ref); ?></YourRef>
      <Currency code="VND" />
      <CalcIncludeVAT></CalcIncludeVAT>
      <Resource number="<?php echo e($resource); ?>" code="<?php echo e($resource); ?>" />
      <OrderedBy>
        <Debtor code="<?php echo e($order->deliver_to); ?>" number="<?php echo e($order->deliver_to); ?>" type="C">
          <Name><?php echo e($customer->name); ?></Name>
        </Debtor>
        <Address>
          <Addressee>
            <Name></Name>
            <Title code="MR" />
            <JobDescription>--</JobDescription>
          </Addressee>
          <AddressLine1><?php echo e($customer->address_line1); ?></AddressLine1>
          <AddressLine2 />
          <AddressLine3 />
          <PostalCode />
          <City />
          <Country code="VN" />
          <Phone><?php echo e($customer->phone); ?></Phone>
        </Address>
        <Date><?php echo e($customer->created_at); ?></Date>           
      </OrderedBy>
      <DeliverTo>
        <Debtor code="<?php echo e($order->deliver_to); ?>" number="<?php echo e($order->deliver_to); ?>" type="C">
          <Name><?php echo e($customer->name); ?></Name>
        </Debtor>
        <Address>
          <Addressee>
            <Name></Name>
            <Title code="MR" />
            <JobDescription>--</JobDescription>
          </Addressee>
          <AddressLine1><?php echo e($customer->address_line1); ?></AddressLine1>
          <AddressLine2 />
          <AddressLine3 />
          <PostalCode />
          <City />
          <Country code="VN" />
          <Phone><?php echo e($customer->phone); ?></Phone>
        </Address>
        <Date><?php echo e($customer->created_at); ?></Date>
      </DeliverTo>
      <InvoiceTo>
        <Debtor code="<?php echo e($order->deliver_to); ?>" number="<?php echo e($order->deliver_to); ?>" type="C">
          <Name><?php echo e($customer->name); ?></Name>
        </Debtor>
        <Address>
          <Addressee>
            <Name></Name>
            <Title code="MR" />
            <JobDescription>--</JobDescription>
          </Addressee>
          <AddressLine1><?php echo e($customer->address_line1); ?></AddressLine1>
          <AddressLine2 />
          <AddressLine3 />
          <PostalCode />
          <City />
          <Country code="VN" />
          <Phone><?php echo e($customer->phone); ?></Phone>
        </Address>
        <Date><?php echo e($customer->created_at); ?></Date>
      </InvoiceTo>
      <Warehouse code = "<?php echo e($order->warehouse); ?>">
      </Warehouse>
      <Costcenter code="<?php echo e($order->costcenter); ?>">
      </Costcenter>
      <?php
        $lineNo=0;
        if ($order->vat > 0){
            $vat = 'V10';
        }else{
            $vat = '0';
        }
        $recipe = 0;
        switch ($order->warehouse)
        {
            case 'A_MB' :
                $recipe = 2;
                break;
            case 'A_MT':
                $recipe = 3;
                break;
            case 'A_MN':
                $recipe = 4;
                break;
            case 'A_TA':
                $recipe = 5;
                break;
            default:
                $recipe = 1;
                break;
        }
      ?>
      <?php $__currentLoopData = $order->orderlines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $orderline): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <OrderLine lineNo="<?php echo e(++$lineNo); ?>">
        <Item code="<?php echo e($orderline->item); ?>" type="S" />
        <Quantity><?php echo e($orderline->quantity); ?></Quantity>
        <Price type="S">
          <Currency code="VND" />
          <Value><?php echo e($orderline->price); ?></Value>
          <VAT code="<?php echo e($vat); ?>" />    
        </Price>
        <Discount>
          <Percentage><?php echo e($orderline->discount); ?></Percentage>
        </Discount>
        <Delivery>
         <Date><?php echo e($order->delivery_date); ?></Date>
        </Delivery>
        <Recipe version="<?php echo e($recipe); ?>" />
      </OrderLine>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <?php if($order->fee_kh > 0): ?>
      <OrderLine lineNo="<?php echo e(++$lineNo); ?>">
        <Item code="FEE_KH" type="P" />
        <Quantity>1</Quantity>
        <Price type="S">
          <Currency code="VND" />
          <Value><?php echo e($order->fee_kh); ?></Value>
          <VAT code="<?php echo e($vat); ?>" />    
        </Price>
        <Discount>
          <Percentage>0</Percentage>
        </Discount>
      </OrderLine>
      <?php endif; ?>
      <?php if($order->fee_vc > 0): ?>
      <OrderLine lineNo="<?php echo e(++$lineNo); ?>">
        <Item code="FEE_VC" type="P" />
        <Quantity>1</Quantity>
        <Price type="S">
          <Currency code="VND" />
          <Value><?php echo e($order->fee_vc); ?></Value>
          <VAT code="<?php echo e($vat); ?>" />    
        </Price>
        <Discount>
          <Percentage>0</Percentage>
        </Discount>
      </OrderLine>
      <?php endif; ?>
      <?php if($order->fee_ld > 0): ?>
      <OrderLine lineNo="<?php echo e(++$lineNo); ?>">
        <Item code="FEE_LD" type="P" />
        <Quantity>1</Quantity>
        <Price type="S">
          <Currency code="VND" />
          <Value><?php echo e($order->fee_ld); ?></Value>
          <VAT code="<?php echo e($vat); ?>" />    
        </Price>
        <Discount>
          <Percentage>0</Percentage>
        </Discount>
      </OrderLine>
      <?php endif; ?>
      <?php if($order->qgg > 0): ?>
      <OrderLine lineNo="<?php echo e(++$lineNo); ?>">
        <Item code="QGG" type="P" />
        <Quantity>1</Quantity>
        <Price type="S">
          <Currency code="VND" />
          <Value>-<?php echo e($order->qgg); ?></Value>
          <VAT code="<?php echo e($vat); ?>" />    
        </Price>
        <Discount>
          <Percentage>0</Percentage>
        </Discount>
      </OrderLine>
      <?php endif; ?>
    </Order>
  </Orders>
</eExact>
<?php /**PATH /home/noith733/zip/resources/views/orders/xml2.blade.php ENDPATH**/ ?>