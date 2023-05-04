<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CauHoi extends Model
{
    use HasFactory;
    protected $table = 'cau_hois';

    public function loaicauhoi(){
        return $this->beLongsTo('App\Models\LoaiCauHoi', 'id_loaicauhoi', 'id');
    }
    public function baitap(){
        return $this->beLongsTo('App\Models\BaiTap', 'id_baitap', 'id_baitap');
    }
}
