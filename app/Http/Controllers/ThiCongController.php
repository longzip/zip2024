<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\ThiCong;
use App\User;
use App\Order;
use App\Http\Controllers\Controller;

class ThiCongController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd($request->all());
        $query = $request->all();
        $query['thicong'] = \Auth::user()->hasRole('Thi Công') ? 1 : 0;
		$thicong = ThiCong::filter($query)->latest()->paginateFilter();

		$tc = $thicong->map(function ($value){
			return [
				'id' => $value->id,			
				'showroom' => $value->showroom,			
				'order' => $value->order_number,				
				'donhang' => Order::where('so_number',$value->order_number)->first(),
				'soluong' => $value->soluong,
				'date' => $value->dategiao,
				'product' => $value->product,
				'choiceproduct' => \DB::table('products')->select('id','code as name')->where('code',$value->product)->first(),
				'name' => $value->name,
				'phone' => $value->phone,
				'address' => $value->address,
				'note' => $value->note,
				'money' => $value->money,				
				'admin' => \Auth::user()->hasRole('BP Admin') ? 1 : 0,
				'thicong' => User::whereIn('id',json_decode($value['thicong']))->get(),
			];	
		});

		return $tc;

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $nv = array();
        foreach ($request->thicong as $key => $value) {
        	$nv[] = $value['id'];
        }
        $new = new ThiCong;
        $new->order_number = $request->donhang ? $request->donhang['so_number'] : null;        
        $new->address = $request->address;
        $new->phone = $request->phone;
		$new->product =  $request->choiceproduct['item'] ; 
        $new->money = $request->money;
        $new->thicong = json_encode($nv);
        $new->soluong = $request->soluong;
        $new->dategiao = $request->date;
        $new->datedat = $request->donhang ? $request->donhang['start_date'] : null;
        $new->note = $request->note;
        $new->showroom = $request->donhang ? $request->donhang['costcenter'] : null;
        $new->name = $request->name;
        $new->save(); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $nv = array();
        foreach ($request->thicong as $key => $value) {
        	$nv[] = $value['id'];
        }
        $new = ThiCong::find($id);
        $new->order_number = $request->donhang ? $request->donhang['so_number'] : null;        
        $new->address = $request->address;
        $new->phone = $request->phone;
		$new->product = !empty($request->choiceproduct['item']) ? $request->choiceproduct['item'] : $request->choiceproduct['name']; 
        $new->money = $request->money;
        $new->thicong = json_encode($nv);
        $new->soluong = $request->soluong;
        $new->dategiao = $request->date;
        $new->datedat = $request->donhang ? $request->donhang['start_date'] : null;
        $new->note = $request->note;
        $new->showroom = $request->donhang ? $request->donhang['costcenter'] : null;
        $new->name = $request->name;
        $new->save();         

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
