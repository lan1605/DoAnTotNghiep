<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CauHoi extends Model
{
    use HasFactory;
    protected $table = 'cau_hois';

    protected $fillable = ['ten_cauhoi, noi_dung, dap_an_1, dap_an_2, dap_an_3, dap_an_dung, id_admin, id_loaicauhoi, id_baihoc'];
    public function loaicauhoi(){
        return $this->beLongsTo('App\Models\LoaiCauHoi', 'id_loaicauhoi', 'id');
    }
    public function baitap(){
        return $this->beLongsTo('App\Models\BaiTap', 'id_baitap', 'id_baitap');
    }
}
