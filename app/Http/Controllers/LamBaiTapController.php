<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BaiTap;
use App\Models\CauHoi;
use App\Models\LamBaiTap;
use App\Models\ThongTinLamBai;
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
            $arr[] = ['id_baitap'=>$baitap->id_baitap,'id_hocvien'=>Auth::user()->id,'id_cauhoi'=>$item->id,'created_at'=>date('Y-m-d G:i:s')];
            $arrCH[] = [$item->id];
        }
        //điều kiện kiểm tra sử dụng array_diff để lấy ra các phần tử khác nhau
        $results = array_diff(array_map('serialize',$arrCH), array_map('serialize',$arrLBT));
        // dd($results);
        //Nếu có số lượng phần tử khác nhau bằng với số lượng câu hỏi mà mỗi bài tập quy định
        $luuthongtin = new ThongTinLamBai;
        if (count($results)==$baitap->soluong_cauhoi)
            {
                //Lưu thông tin vào bảng lam_bai_taps thông qua mảng $arr
                $taomoi = LamBaiTap::insert($arr);
                
                $luuthongtin->id_baitap = $baitap->id_baitap;
                $luuthongtin->id_hocvien = Auth::user()->id;
                $luuthongtin->thoigian_lambai = date('Y-m-d G:i:s');
                $luuthongtin->thoigian_nopbai = null;
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

        $thoigianlambai = ThongTinLamBai::where('id_baitap', $baitap->id_baitap)->where('id_hocvien', Auth::user()->id)->orderBy('thoigian_lambai', 'DESC')->first();
        
        // dd($danhsach, $dscauhoi);
        return view('pages.baitap.exam',['dscauhoi'=>$dscauhoi,'thoigian'=>$thoigian,'baitap'=> $baitap,'danhsach'=>$danhsach, 'thoigian_lambai'=> $thoigianlambai->thoigian_lambai]);
    }
    public function luubailam(Request $req, $slug){
        $baitap = BaiTap::where('slug',$slug)->first();

        $danop = ThongTinLamBai::where('id_baitap', $baitap->id_baitap)->where('id_hocvien', Auth::user()->id)->orderBy('thoigian_lambai', 'DESC')->first();

        $lambaitap = LamBaiTap::where('id_baitap', $baitap->id_baitap)->where('id_hocvien',Auth::user()->id)->get();
            // dd($req->post('dapan_hocvien'));
            $arrLBT =[];
            foreach ($lambaitap as $lbt){
                $arrLBT[] = $lbt->id_cauhoi;
            }
            // dd($arrLBT);
            $arrKey = [];
            $arrKey = $req->post('dapan_hocvien');
        
            $result = [];
            $luuthongtin = LamBaiTap::where('id_baitap', $baitap->id_baitap)->where('id_hocvien', Auth::user()->id)->get();
            foreach ($luuthongtin as $item){
                foreach ($arrKey as $key=>$value){
                    if ($item->id_cauhoi === $key){
                        DB::table('lam_bai_taps')->where('id_baitap', $baitap->id_baitap)->where('id_hocvien', Auth::user()->id)->where('id_cauhoi', $item->id_cauhoi)
                        ->update(['dapan_hocvien'=>$value,'updated_at'=>date('Y-m-d G:i:s')]);
                    }
                    else if (!$item->id_cauhoi === $key){
                        DB::table('lam_bai_taps')->where('id_baitap', $baitap->id_baitap)->where('id_hocvien', Auth::user()->id)->where('id_cauhoi', $item->id_cauhoi)
                        ->update(['dapan_hocvien'=>null,'updated_at'=>date('Y-m-d G:i:s')]);
                    }
                }
            $danop->thoigian_nopbai = date('Y-m-d G:i:s');
            $danop->save();
            }
            return view('pages.baitap.finish');
        
        
    }
}
