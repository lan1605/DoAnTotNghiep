<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoaiCauHoi extends Model
{
    use HasFactory;
    protected $table = "loai_cau_hois";

    protected $fillable = [
        'ten_loaicauhoi'
    ];

    public function cauhoi(){
        return $this->hasMany('App\Models\CauHoi', 'id_loaicauhoi', 'id');
    }
}
