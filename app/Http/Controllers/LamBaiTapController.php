<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BaiTap;
use App\Models\CauHoi;
use App\Models\LamBaiTap;
// use App\Models\ThongTinLamBai;
use App\Models\KetQua;
use App\Models\BaiHoc;
use Auth;
use DB;
class LamBaiTapController extends Controller
{
    public function index($slug){
        $baitap = BaiTap::where('slug', $slug)->first();
        // Kiểm tra xem trong dữ liệu đã lưu thông tin làm bài của học viên hay chưa
        $lambaitap = LamBaiTap::where('id_baitap', $baitap->id_baitap)->where('id_hocvien',Auth::user()->id)->take($baitap->soluong_cauhoi)->get();
        //lấy ra danh sách các id câu hỏi đã lưu
        $arrLBT = [];
        foreach ($lambaitap as $item){
            $arrLBT[] = [$item->id_cauhoi];
        }
        //lấy ra id câu hỏi lưu trong bảng cau_hois
        $cauhoi = CauHoi::where('id_baihoc','=', $baitap->id_baihoc)->inRandomOrder()->limit($baitap->soluong_cauhoi)->get();
        $arrCH = [];
        $arr=[];
        foreach ($cauhoi as $item){
            // gán các giá trị phần tử vào mảng để lưu vào CSDL
            if (LamBaiTap::where('id_baitap', $baitap->id_baitap)->where('id_hocvien',Auth::user()->id)->where('id_cauhoi', $item->id)->count()>0)
                {
                    // $arr[] = $arr;
                }
            else {
                $arr[] = ['id_baitap'=>$baitap->id_baitap,'id_hocvien'=>Auth::user()->id,'id_cauhoi'=>$item->id,'created_at'=>date('Y-m-d G:i:s')];
            }
            $arrCH[] = [$item->id];
        }
        //điều kiện kiểm tra sử dụng array_diff để lấy ra các phần tử khác nhau
        $results = array_diff(array_map('serialize',$arrCH), array_map('serialize',$arrLBT));
        // dd($results);
        //Nếu có số lượng phần tử khác nhau bằng với số lượng câu hỏi mà mỗi bài tập quy định
        $luuthongtin = new KetQua;
        // $exist = LamBaiTap::all()->exists();
        if (count($results)==$baitap->soluong_cauhoi)
            {
                //Lưu thông tin vào bảng lam_bai_taps thông qua mảng $arr
                $taomoi = LamBaiTap::insert($arr);
                
                $luuthongtin->id_baitap = $baitap->id_baitap;
                $luuthongtin->id_hocvien = Auth::user()->id;
                $luuthongtin->created_at = date('Y-m-d G:i:s');
                $luuthongtin->updated_at = null;
                $luuthongtin->save();
            }
        //Lấy danh sách id câu hỏi đã lưu
        $danhsach = LamBaiTap::where('id_baitap', $baitap->id_baitap)->where('id_hocvien',Auth::user()->id)->take($baitap->soluong_cauhoi)->orderBy('created_at','DESC')->get();
        
        $arrIDcauhoi = [];
        foreach ($danhsach as $item){
            $arrIDcauhoi [] =[$item->id_cauhoi];
        }
        $dscauhoi = CauHoi::whereIn('id',$arrIDcauhoi)->get();
        $thoigian = $baitap->thoigian_lambai;
        
        $thoigianlambai = KetQua::where('id_baitap', $baitap->id_baitap)->where('id_hocvien', Auth::user()->id)->orderBy('created_at', 'DESC')->first();
        // dd($thoigianlambai);

        
        $baihoc = BaiHoc::find($baitap->id_baihoc);
        // dd($danhsach, $dscauhoi);
        return view('pages.baitap.exam',['dscauhoi'=>$dscauhoi,'thoigian'=>$thoigian,'baitap'=> $baitap,'danhsach'=>$danhsach, 
        'thoigian_lambai'=> $thoigianlambai->created_at,'thoigian_nopbai'=> $thoigianlambai->updated_at, 'page'=>'Bài tập', 'link'=>'baihoc/'.$baihoc->slug, 'title'=>$baitap->ten_baitap]);
    }

    public function luubailam(Request $req, $slug){
        $baitap = BaiTap::where('slug',$slug)->first();

        
        $lambaitap = LamBaiTap::where('id_baitap', $baitap->id_baitap)->where('id_hocvien',Auth::user()->id)->get();
            // dd($req->post('dapan_hocvien'));
            $arrLBT =[];
            foreach ($lambaitap as $lbt){
                $arrLBT[] = $lbt->id_cauhoi;
            }
            // dd($arrLBT);
            $arrKey = [];
            $dem= 0;
            $arrKey = $req->post('dapan_hocvien');
            
            $luuthongtin = LamBaiTap::where('id_baitap', $baitap->id_baitap)->where('id_hocvien', Auth::user()->id)->orderBy('created_at','DESC')->take($baitap->soluong_cauhoi)->get();
            
            $result = [];
            foreach ($luuthongtin as  $item){
                $result[]= $item->id_cauhoi; 
            }
            $resultKey=[];
            if ($arrKey==null){
                $resultKey[] = null;
            }
            else {
                foreach ($arrKey as  $item=>$value){
                    $resultKey[]= $item; 
                }
            }

            // foreach ($results as )
            // dd($luuthongtin, $arrKey, $results);
            if ($arrKey==null){
                foreach ($luuthongtin as $item){
                    DB::table('lam_bai_taps')->where('id_baitap', $baitap->id_baitap)->where('id_hocvien', Auth::user()->id)->where('id_cauhoi', $item->id_cauhoi)
                    ->update([ 'updated_at'=>date('Y-m-d G:i:s')]);
                }
            }  
            else {
                
                foreach ($luuthongtin as $item){
                if (in_array($item->id_cauhoi, $resultKey)){
                    DB::table('lam_bai_taps')->where('id_baitap', $baitap->id_baitap)->where('id_hocvien', Auth::user()->id)->where('id_cauhoi', $item->id_cauhoi)
                    ->update(['dapan_hocvien'=>$arrKey[$item->id_cauhoi],'updated_at'=>date('Y-m-d G:i:s')]);
                    $dem = $dem +1;
                }
                else {
                    DB::table('lam_bai_taps')->where('id_baitap', $baitap->id_baitap)->where('id_hocvien', Auth::user()->id)->where('id_cauhoi', $item->id_cauhoi)
                    ->update([ 'updated_at'=>date('Y-m-d G:i:s')]);
                }
            } 
            }
            // dd($reD, $reS);
            $danop = KetQua::where('id_baitap', $baitap->id_baitap)->where('id_hocvien', Auth::user()->id)->orderBy('created_at', 'DESC')->first();
            $danop->socau_dalam = $dem;
            $danop->updated_at = date('Y-m-d G:i:s');
            $danop->update();
            
            

            
            return redirect('bai-tap/'.$slug.'/nop');
        
        
    }
    public function NopBaiLam(Request $req, $slug){
        $baitap = BaiTap::where('slug',$slug)->first();
        $danhsach = LamBaiTap::where('id_baitap', $baitap->id_baitap)->where('id_hocvien',Auth::user()->id)->take($baitap->soluong_cauhoi)->orderBy('updated_at', 'DESC')->orderBy('id_cauhoi', 'ASC')->get();
        // dd($danhsach);
        // $luu = ThongTinLamBai::where('id_baitap', $baitap->id_baitap)->where('id_hocvien',Auth::user()->id)->orderBy('thoigian_nopbai', 'DESC')->first();
        $arrIdCauhoi = [];

        foreach ($danhsach as $ds){
            $arrIDcauhoi[] = $ds->id_cauhoi;
        }

        $danhsachcauhoi = CauHoi::whereIn('id', $arrIDcauhoi)->get();
        
        $diem = 10/$baitap->soluong_cauhoi;
        $socaudung = 0;
        foreach ($danhsach as $ds){
            foreach ($danhsachcauhoi as $dsch){
                if ($ds->id_cauhoi===$dsch->id){
                    if (trim($ds->dapan_hocvien)===trim($dsch->dap_an_dung)){
                        $socaudung = $socaudung +1;
                    }
                }
            }
        }
        
        $tongdiem = round($diem * $socaudung, 2);
        

        // $thoigianlambai = ThongTinLamBai::where('id_baitap', $baitap->id_baitap)->where('id_hocvien', Auth::user()->id)->orderBy('thoigian_lambai', 'DESC')->first();

        // if ($luu->thoigian_nopbai!=null){
        //     $ketqua = new KetQua;
        //     $ketqua->id_baitap = $baitap->id_baitap;
        //     $ketqua->id_hocvien = Auth::user()->id;
        //     $ketqua->tong_diem = $tongdiem;
        //     $ketqua->soluong_caudung = $socaudung;
        //     $ketqua->created_at = date('Y-m-d G:i:s');
        //     $ketqua->updated_at = date('Y-m-d G:i:s');
        //     $ketqua->save();
        // }
        
            $ketqua =KetQua::where('id_baitap', $baitap->id_baitap)->where('id_hocvien', Auth::user()->id)->orderBy('updated_at', 'DESC')->first();
            $ketqua->tong_diem = $tongdiem;
            $ketqua->soluong_caudung = $socaudung;
            // $ketqua->updated_at = date('Y-m-d G:i:s');
            $ketqua->update();
        return view('pages.baitap.finish', ['danhsach'=>$danhsach, 'baitap'=>$baitap]);
         // dd($danhsach);
        

    }
    public function KetQua(Request $req, $slug){
        $baitap = BaiTap::where('slug',$slug)->first();
        $danhsach = LamBaiTap::where('id_baitap', $baitap->id_baitap)->where('id_hocvien',Auth::user()->id)->take($baitap->soluong_cauhoi)->orderBy('updated_at', 'DESC')->orderBy('id_cauhoi', 'ASC')->get();

        $arrIDcauhoi = [];

        foreach ($danhsach as $ds){
            $arrIDcauhoi[] = $ds->id_cauhoi;
        }
        $cauhoi = CauHoi::whereIn('id', $arrIDcauhoi)->get();
        
        $ketqua = KetQua::where('id_baitap', $baitap->id_baitap)->where('id_hocvien', Auth::user()->id)->orderBy('created_at', 'DESC')->first();

        $solanlambai = KetQua::where('id_baitap', $baitap->id_baitap)->where('id_hocvien', Auth::user()->id)->orderBy('created_at', 'DESC')->get();


        return view('pages.baitap.result', ['danhsach'=>$danhsach, 'baitap'=>$baitap,'cauhoi'=>$cauhoi, 'ketqua'=>$ketqua, 'solanlambai'=>count($solanlambai)]);
    }
    
}
