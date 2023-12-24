<?php 
	namespace App\Http\Controllers\API;

	use Illuminate\Http\Request;
	use Excel;	
	use Maatwebsite\Excel\Concerns\FromCollection;
	use Maatwebsite\Excel\Concerns\Exportable;
	use Maatwebsite\Excel\Concerns\WithHeadings;
	use NoiThatZip\Lead\Models\Lead;
	use Cmgmyr\Messenger\Models\Message;
	use Cmgmyr\Messenger\Models\Participant;
	use Cmgmyr\Messenger\Models\Thread;
	use Exportable;
	use DB;
	use App\Order;
	/**
	 * 
	 */
	class ExController extends Controller implements FromCollection, WithHeadings
	{	
		use Exportable;
		public function index(){
			return view('exel');
		}
			
			public function collection()
	    {
	        $orders = Order::all();
	        foreach ($orders as $row) {
	            $order[] = array(
	                '0' => $row->id,
	                '1' => $row->so_number,
	                '2' => $row->description,
	                '3' => $row->your_ref,
	                '4' => $row->resource,
	                
	            );
	        }

	        return (collect($order));
	    }
	    public function headings(): array
    {
        return [
            'id',
            'Tên',
            'Địa chỉ',
            'Email',
            'Ngày đặt hàng',
            
        ];
    }
  //   	public function export(){
  //    	return Excel::download(new ExcelController(), 'orders.xlsx');
		// }
		public function export() 
			{
   			 return Excel::download(new InvoicesExport, 'orders.xlsx');
			}
}