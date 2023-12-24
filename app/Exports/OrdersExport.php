<?php

namespace App\Exports;


use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use DB;

class OrdersExport implements FromCollection,WithHeadings,ShouldAutoSize,WithStrictNullComparison
{
    public function __construct($year){
        $this->year = $year;
    }

    public function collection()
    {
        // dd($this->year);
    // 	$customer_data = \DB::table('order_delivery')->select('order','item','quantity','price','amount','delivery','startorder','warehouse','costcenter')->wherebetween('delivery',$this->year)->OrderBy('delivery','desc')->get();
    	$customer_data = \DB::select(DB::raw("SELECT zip13_orders.so_number, zip13_contacts.last_name, zip13_contacts.address, zip13_contacts.city, zip13_contacts.phone, zip13_products.code , zip13_products.name, zip13_order_lines.price, zip13_order_lines.quantity, zip13_order_lines.discount, zip13_order_lines.amount, zip13_orders.fee_ld, zip13_orders.fee_kh, zip13_orders.fee_vc , zip13_orders.amount AS Tong_Don_Hang, zip13_orders.delivery_date FROM `zip13_order_lines` LEFT JOIN zip13_orders ON zip13_order_lines.order_id = zip13_orders.id LEFT JOIN zip13_contacts ON zip13_contacts.id = zip13_orders.ordered_by LEFT JOIN zip13_products on zip13_products.id = zip13_order_lines.product_id WHERE zip13_orders.delivery_date > 20180101 ORDER BY `zip13_orders`.`delivery_date` DESC"));
        // dd(collect($customer_data));
        return collect($customer_data);
        // return $customer_data;
    }

    //Thêm hàng tiêu đề cho bảng
    public function headings() :array {
    	return ['Số','Tên khách hàng','Địa chỉ','Tỉnh','Số điện thoại','Mã SP','Tên sản phẩm','Giá','Số Lượng','% Chiết khấu','Thành tiền','Phí LĐ','Phí khác','Phí VC','Đơn hàng','Ngày giao'];
    }

}
