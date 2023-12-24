<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Order;
use App\Product;
use App\OrderLine;
use App\Http\Controllers\Controller;
use DateTime;
use DatePeriod;
use DateInterval;

class SPGiaoController extends Controller
{
    public function listspgiao(Request $request)
    {
        // dd($request->all());
        $kho = array('A_MB','A_MN','A_MT');
        if($request->kho){
            $kho = array($request->kho);
        }
        $start = $request->sdates[0];
        $newdate = $request->sdates[1];
        $end = strtotime ( '+1 day' , strtotime ( $newdate ) );
        $end = date ( 'Y-m-d' , $end );
        $period = new DatePeriod(
             new DateTime($start),
             new DateInterval('P1D'),
             new DateTime($end)
        );
        // $id_so = Order::whereBetween('delivery_date',$request->sdates)->pluck('id');
        // for
        // $range = range(1,500);
        // $ar = array_merge([29,10,4,2,55,32,40,46,43,45],$range);
        
        // $productfillter = Product::whereIn('groups',array_unique($ar))->pluck('id');
        foreach ($period as $key => $value) {
            
            $id_so = Order::whereDate('delivery_date',$value)->whereIn('warehouse',$kho)->pluck('id');
            $orderline = OrderLine::whereIn('order_id',$id_so)->leftJoin('products', 'order_lines.product_id', '=', 'products.id')->select('quantity','check_name','order_lines.id')->get()->groupBy('check_name');
            $result = $orderline->map(function ($item, $key) {
                return  $item->sum('quantity');
            });
            $day = (int) $value->format('w');
            if($day > 0){
                $ten = $day + 1;
                $thu = 'Thứ '.$ten;
            }
            if($day == 0){
                $thu = 'CN';
            }
            $sttweek = (int) $value->format('W');
            $ct = $sttweek / 4;
            $ptamtinh = (int) $ct;
            $layt = $ct - $ptamtinh;
            
            if($layt == 0.25) {
                $p = $ptamtinh + 1;
                $t = 2;
            }
            if($layt == 0.5) {
                $p = $ptamtinh + 1;
                $t = 3;
            }
            if($layt == 0.75) {
                $p = $ptamtinh + 1;
                $t = 4;
            }
            if($layt == 0) {
                $p = $ptamtinh;
                $t = 1;
            }
           
            $list[$thu.' /T'.$t.'/P'.$p] = $result;
            // $a[] = $value;
        }
        // dd($a);
        foreach($list as  $v) {
            foreach($v as $k => $sp){
                $b[$k][] = $sp; 
            }
            foreach($v as $k => $sp){
                $ds[$k] = array_sum($b[$k]); 
            }
        }
        ksort($ds);
        $datanew = [];
        $chuoi = ['IVY','TULIP','PANSY','IRIS','OLIVE','LYCHEE','MELON','MANGO','BERRY'];
        foreach($chuoi as $koc){
            foreach($ds as $kloc => $l){
                $pos = strpos($kloc, $koc); 
                if($pos === false){
                  
                }else{
                   $datanew[$kloc] = $l;
                }
            } 
        }
        // return($datanew);
        $locxong = array_merge($datanew,$ds);
        // return $locxong;
        return ['danhsach' => $locxong,'ngay' => $list];
        // dd($a);
    }
 
    public function loadtongspgiao(Request $request){
        // dd($request->all());
        $kho = array('A_MB','A_MN','A_MT');
        if($request->kho){
            $kho = array($request->kho);
        }
        $spold = ['Camelia','đệm thanh lý','nham','Double','GIASACH','Single','Sky','Sunflower','Thảm','Sunny','APPLE','học di động','vỏ gối','LADER','tranh cuc','tranh ca','Đèn','Futon','KTV','Ga','Đệm','Windy','Tab','Kiwi'];
        $product = Product::whereNotIn('name_groups',$spold)->get()->groupBy('name_groups');
        
        // foreach($product as $group => $pr){
        //     foreach($pr as $namesp){
        //         $listidname[$group][$namesp->check_name][] = $namesp->id;
        //     }
        // }
            // dd($proaduct);
        if ($request->p > 0) {
            $calendar = \DB::table('calendar')->where('p',$request->p)->where('z',$request->z)->first();
            $calendar_t = \DB::table('calendar_t')->where('id_p',$calendar->id)->get();
            foreach($calendar_t as $or){
                $id_so[] = Order::whereBetween('delivery_date',[$or->start_t,$or->end_t])->whereIn('warehouse',$kho)->pluck('id');
            }
            foreach($id_so as  $t => $sp){
                foreach($product as $group => $pr){
                    
                    foreach($pr as $khoa => $namesp){
                        $listidname[$namesp->check_name][] = $namesp->id;
                        $listprname[$khoa]['nhom'] = $namesp->check_name;
                        $listprname[$khoa]['dong'] = $namesp->name_groups;
                    }
                    
                    foreach($listprname as $nsp){
                        // dd($nsp);
                        $removetext = preg_replace("/[^0-9]/", "", $nsp['nhom']);
                        $orderline[$nsp['dong']][$removetext][$t+1] = (int) OrderLine::whereIn('order_id',$sp)->whereIn('product_id',$listidname[$nsp['nhom']])->sum('quantity');
                    }
                }
               
            }
        }else{
            $calendar = \DB::table('calendar')->where('z',$request->z)->get();
            foreach($calendar as $or){
                $id_so[] = Order::whereBetween('delivery_date',[$or->start,$or->end])->whereIn('warehouse',$kho)->pluck('id');
            }
            foreach($id_so as  $t => $sp){
                foreach($product as $group => $pr){
                    
                    foreach($pr as $khoa => $namesp){
                        $listidname[$namesp->check_name][] = $namesp->id;
                        $listprname[$khoa]['nhom'] = $namesp->check_name;
                        $listprname[$khoa]['dong'] = $namesp->name_groups;
                    }
                    
                    foreach($listprname as $nsp){
                        // dd($nsp);
                        $removetext = preg_replace("/[^0-9]/", "", $nsp['nhom']);
                        $orderline[$nsp['dong']][$removetext][$t+1] = (int) OrderLine::whereIn('order_id',$sp)->whereIn('product_id',$listidname[$nsp['nhom']])->sum('quantity');
                    }
                }
               
            }
        }
        
        // $order
        return $orderline;
        
        
    }   
}
