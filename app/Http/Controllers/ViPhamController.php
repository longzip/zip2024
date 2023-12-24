<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\ViPham;
use App\DecisionPunishment;
use App\CheTai;
use App\User;
use App\Http\Resources\ViPham as ViPhamResource;
use DB;
use DateTime;
use Mail;
use Response;
use Illuminate\Support\Facades\Storage;

class ViPhamController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
 
    public function index(Request $request)
    {
        $user = auth('api')->user();
        $userid = $user->id;
        // $vipham = ViPham::filter($request->all())->latest()->paginateFilter();
        $groupbypheduyet = \DB::table('vi_pham')->pluck('approver', 'id');
        // dd($groupbypheduyet);
        $idfiltered = $groupbypheduyet->map(function ($values, $item) use ($userid) {

            // dd(json_decode($values));
            if(json_decode($values) != null) {
                for($i = 0; $i < sizeof(json_decode($values)); ++$i) {
                    $itemvalue = json_decode($values);
                    // dd($itemvalue);
                    for ($j = 0; $j < sizeof($itemvalue); ++$j) {
                        if($itemvalue[$j] == $userid) {
                            return $item;
                        }
                    }
                    
                }
            }
        });
        $idpheduyet = array_filter(array_values($idfiltered->toArray()));
        $getviphampheduyet = [];
        // dd($idpheduyet);

        foreach ($idpheduyet as $value){
            $temp = ViPham::where('id', $value)->first();
            $temp->isapprove = true;
            $temp->isbreaker = false;
            $temp->p = null;
            $temp->stt = null;
            $temp->year = null;
            array_push($getviphampheduyet, $temp);
        }
        // dd($getviphampheduyet);
        $groupbyvipham = ViPham::where('user_id', $userid)->get();
        
        foreach($groupbyvipham as $key => $val){
            $val->isapprove = false;
            $val->isbreaker = true;
            $val->p = null;
            $val->stt = null;
            $val->year = null;
        }
        $groupbyviphamarray = $groupbyvipham->toArray(); 

        $groupbycreator = ViPham::where('creator_id', $userid)->get();

        foreach($groupbycreator as $key => $val){
            $val->isapprove = false;
            $val->isbreaker = false;
            $val->p = null;
            $val->stt = null;
            $val->year = null;
        }

        $groupbycreatorarray = $groupbycreator->toArray();

        $result = array_merge($groupbyviphamarray, $getviphampheduyet, $groupbycreatorarray);
        // dd(ViPhamResource::collection(collect($result)));
        return ViPhamResource::collection(collect($result));
    } 
     
    public function store(Request $request)
    {

        $user = auth('api')->user();
        $request->validate([
            'decisionid' => 'required',
            'ngayvipham' => 'required',
            'solan' => 'required',
            'roleid' => 'required',
        ],
        [
            'decisionid.required' => 'Bạn chưa chọn quy định',
            'ngayvipham.required' => 'Bạn chưa chọn ngày vi phạm',
            'solan.required' => 'Bạn chưa chọn số lần vi phạm',
            'roleid.required' => 'Bạn chưa chọn bộ phận',
        ]); 
        // dd(date('d/m/Y',strtotime($request['ngayvipham'])));
        // dd(json_encode($request['nvpheduyet'])); 
        // dd(gettype($request['images']));
        // dd($request->all());
        $dp = DecisionPunishment::where('id', $request['decisionid'])->first();
        $chetai1 = CheTai::where('id', $dp['chetai_id1'])->first();
        $chetai2 = CheTai::where('id', $dp['chetai_id2'])->first();
        $chetai3 = CheTai::where('id', $dp['chetai_id3'])->first();
        $chetai4 = CheTai::where('id', $dp['chetai_id4'])->first();
        $chetai5 = CheTai::where('id', $dp['chetai_id5'])->first();

        $chetai = new CheTai; 
        switch ($request['solan']) {
            case 1:
                $chetai = $chetai1;
                break;
            case 2:
                $chetai = $chetai2;
                break;
            case 3:
                $chetai = $chetai3;
                break;
            case 4:
                $chetai = $chetai4;
                break;
            case 5:
                $chetai = $chetai5;
                break;
            
        }

        $vipham = new ViPham;

        $vipham->decision_id = $request['decisionid'];
        $vipham->so_lan = $request['solan'];
        $vipham->che_tai = $chetai['name'];
        $vipham->user_id = $request['userid'] == "null" ? null : $request['userid'];
        $vipham->role_id = $request['roleid'];
        $vipham->creator_id = $user->id;
        $vipham->money = $request['tienphat'];
        $vipham->ten_vi_pham = $request['tenvipham'];
        $vipham->ngay_vi_pham = $request['ngayvipham'];
        $vipham->time_apply = $request['timeapply'];
        $vipham->danh_gia = $request['danhgia'];
        $vipham->created_at = now()->timestamp;
        $vipham->updated_at = now()->timestamp;
        $vipham->tuong_trinh = $request['detail'];

        $approver = [];

        if($request['nvpheduyet'] != null) {
            for($i = 0; $i < sizeof($request['nvpheduyet']); ++$i) {
                array_push($approver,(integer) $request['nvpheduyet'][$i]);
            }
            $vipham->approver = json_encode($approver);
        }

        if($request['videos'][0] != null) {
            $vipham->video = json_encode($request['videos']);
        } else {
            $vipham->video="";
        }
        
        $imageNameArray = array();

        if($request['images'] != null)
        {   
            for ($i = 0; $i < count($request['images']); $i++) { 
                $file = $request['images'][$i];
                $name = $request['images'][$i]->getClientOriginalName();
                $fileName = str_random(2)."_".$name;
                while (file_exists("uploads/vipham/".$fileName)) {
                    $fileName = str_random(2)."_".$name;
                }
                $file->move("uploads/vipham", $fileName);
                array_push($imageNameArray, $fileName);
            }
            $vipham->file = json_encode($imageNameArray);
        }
        else
        {
            $vipham->file="";
        }

        // dd($vipham);

        $vipham->save();

        activity()
        ->performedOn($vipham)
        ->causedBy($user)
        ->withProperties(['zip' => 'vipham','id' => $vipham->id])
        ->log('Đã tạo Vi phạm :subject.name, bởi :causer.name');

        return $vipham;
    }

    public function show($id)
    {
        $vipham = ViPham::findOrFail($id);
        $viphamwithoutbienban = \DB::table('vi_pham')->whereNotNull('bien_ban')->get();
        $stt = 1;

        foreach ($viphamwithoutbienban as $value) {
            $temp = strtotime($value->created_at);
            $date = date('Y', $temp);
            $now = date('Y');
            if($date == $now) {
                $stt++;
            }
        }
        // dd($count);

        if($stt < 10) {
            $sttstring = '000'.$stt;
        } else if ($stt >= 10 && $stt < 100) {
            $sttstring = '00'.$stt;
        } else if ($stt >= 100 && $stt < 1000) {
            $sttstring = '0'.$stt;
        }
        
        $date_expire = '2018-12-31 00:00:00';
        $date = new DateTime($date_expire);
        $now = new DateTime();

        $datediff = date_diff($date, $now)->format('%a');
        
        $p = $datediff / 28;
        $year = 13;
        while($p - 13 >= 0) {
            $year++;
            if($p - 13 == 0) {
                $p = 1;
            } else {
                $p -= 13;
            }
        }
        if(ceil($p) < 10) {
            $pformated = '0'.ceil($p);
        } else {
            $pformated = ceil($p);
        }
        // dd(collect($vipham));
        // $vp = collect($vipham)->map(function ($values, $item) use ($p, $sttstring, $year) {
        //     dd($item);
        //     $values->p = 8;
        //     $values->stt = $sttstring;
        //     $values->year = $year;
        // });
        // dd($vp);
        $vipham->p = $pformated;
        $vipham->stt = $sttstring;
        $vipham->year = $year;
        // dd($vipham);

        return new ViPhamResource($vipham);
    }

    public function update(Request $request)
    {
        $user = auth('api')->user();
         $request->validate([
            'decisionid' => 'required',
            'ngayvipham' => 'required',
            'solan' => 'required',
            'roleid' => 'required',
        ],
        [
            'decisionid.required' => 'Bạn chưa chọn quy định',
            'ngayvipham.required' => 'Bạn chưa chọn ngày vi phạm',
            'solan.required' => 'Bạn chưa chọn số lần vi phạm',
            'roleid.required' => 'Bạn chưa chọn bộ phận',
         ]);
         // dd($request['nvpheduyet']);
        $dp = DecisionPunishment::where('id', $request['decisionid'])->first();
        $chetai1 = CheTai::where('id', $dp['chetai_id1'])->first();
        $chetai2 = CheTai::where('id', $dp['chetai_id2'])->first();
        $chetai3 = CheTai::where('id', $dp['chetai_id3'])->first();
        $chetai4 = CheTai::where('id', $dp['chetai_id4'])->first();
        $chetai5 = CheTai::where('id', $dp['chetai_id5'])->first();

        $chetai = new CheTai; 
        switch ($request['solan']) {
            case 1:
                $chetai = $chetai1;
                break;
            case 2:
                $chetai = $chetai2;
                break;
            case 3:
                $chetai = $chetai3;
                break;
            case 4:
                $chetai = $chetai4;
                break;
            case 5:
                $chetai = $chetai5;
                break;
            
        }
        // dd($request->all());
        $vipham = ViPham::findOrFail($request['id']);
        $vipham->decision_id = $request['decisionid'];
        $vipham->so_lan = $request['solan'];
        $vipham->che_tai = $chetai['name'];
        // $vipham->user_id = $request['userid'];
        $vipham->user_id = $request['userid'] == "null" ? null : $request['userid'];
        $vipham->role_id = $request['roleid'];
        $vipham->creator_id = $user->id;
        
        $vipham->ten_vi_pham = $request['tenvipham'] == "null" ? null : $request['tenvipham'];
        $vipham->ngay_vi_pham = $request['ngayvipham'];
        $vipham->time_apply = $request['timeapply'] == "null" ? null :  $request['timeapply'];
        $vipham->danh_gia = $request['danhgia'];
        $vipham->updated_at = now()->timestamp;
        $vipham->tuong_trinh = $request['detail'];

        $request['tienphat'] == "null" ?  $vipham->money = null : $vipham->money = $request['tienphat'];
        

        $approver = [];

        if($request['nvpheduyet'] != null) {
            for($i = 0; $i < sizeof($request['nvpheduyet']); ++$i) {
                array_push($approver,(integer) $request['nvpheduyet'][$i]);
            }
            $vipham->approver = json_encode($approver);
        } else {
            $vipham->approver = null;
        }

        if($request['videos'][0] != null) {
            $vipham->video = json_encode($request['videos']);
        } else {
            $vipham->video="";
        }

        
        $imageNameArray = array();

        if($request['images'] != null)
        {   
            for ($i = 0; $i < count($request['images']); $i++) { 
                $file = $request['images'][$i];
                $name = $request['images'][$i]->getClientOriginalName();
                $fileName = str_random(2)."_".$name;
                while (file_exists("uploads/vipham/".$fileName)) {
                    $fileName = str_random(2)."_".$name;
                }
                $file->move("uploads/vipham", $fileName);
                array_push($imageNameArray, $fileName);
            }
            $vipham->file = json_encode($imageNameArray);
        }
        else
        {
            $vipham->file="";
        }

        // dd($vipham);

        $vipham->save();
        
        activity()
        ->performedOn($vipham)
        ->causedBy($user)
        ->withProperties(['zip' => 'vipham','id' => $vipham->id])
        ->log('Đã sửa Vi phạm :subject.name, bởi :causer.name');

        return $vipham;
    }

    public function sendMail(Request $request, $id) {
        $vipham = \DB::table('vi_pham')->where('id', $id)->first();
        // dd($vipham);
        $user = \DB::table('users')->where('id', $vipham->user_id)->first();
        $creator = \DB::table('users')->where('id', $vipham->creator_id)->first();

        $approveridarray = json_decode($vipham->approver);
        $approver = [];
        foreach ($approveridarray as $value) {
            $temp = \DB::table('users')->where('id', $value)->first();
            array_push($approver, $temp->email);
        }
        // dd($user);
        $dataBinding = array('name'=>'name','email'=>'email', 'content'=>'content');
        // dd($vipham->bien_ban);
        $data = array(
            'email'   => 'email',
            'id' => 'id',
            'price' => 'price',
            'name'  => 'name',
            'reason' => 'reason',
            'user_id' =>  'userPhat',
            'ngayvipham' =>  'ngayvipham',
            'created_at' =>  'created_at',
         );
        Mail::send('FormForSendMail', array('price'=>$data['price'],'email'=>$data['email'],'name'=>$data['name'],'reason'=>$data['reason'],'user_id'=>$data['user_id'],'ngayvipham'=>$data['ngayvipham'],'created_at'=>$data['created_at']), function ($message) use ($vipham, $approver, $user, $creator) {
            
            // $message->cc('duythachson@gmail.com');
            $message->cc('nhansu.z1218@gmail.com');
            $message->cc($user->email);
            $message->cc($creator->email);
            for($i = 0; $i < sizeof($approver); ++$i) {
                $message->cc($approver[$i]);
            }
            
            $message->subject('[Biên bản nội thất ZIP]');
            $message->attach('uploads/bienban/'.$vipham->bien_ban);
        });
        $viphamToUpdate = ViPham::findOrFail($id);
        $viphamToUpdate->emailed = 1;
        $viphamToUpdate->save();
    }

    public function getViPhambyID($id) {
        return ViPham::findOrFail($id);
    }

    public function downloadPdf($fileName) {
        $file= "uploads/bienban/". $fileName;
        // dd($file);

        $headers = [
              'Content-Type' => 'application/pdf',
           ];

        return response()->download($file);
           // return Storage::download($file, 'bienban.pdf', $headers);
    }      

    public function duyet($id) {
        $viphamToUpdate = ViPham::findOrFail($id);
        $viphamToUpdate->phe_duyet = 1;
        $viphamToUpdate->save();
    }   

    public function khongduyet($id) {
        $viphamToUpdate = ViPham::findOrFail($id);
        $viphamToUpdate->phe_duyet = 0;
        $viphamToUpdate->bien_ban = null;
        $viphamToUpdate->save();
    }

    public function destroy($id)
    {
        $user = auth('api')->user();
        // if (!$user->can('edit users')) {
        //     return response()->json([
        //         'message' => 'Bạn không có quyền xóa',
        //     ]);
        // }
        $vipham = ViPham::findOrFail($id)->delete();
        return ['message' => 'Xóa Quyết Định Thành Công'];
    }
    
}