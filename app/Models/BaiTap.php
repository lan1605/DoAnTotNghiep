<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaiTap extends Model
{
    use HasFactory;
    protected $table = 'bai_taps';

    protected $primaryKey = 'id_baitap'; // or null

    public $incrementing = false;

    public function baihoc(){
        return $this->belongsTo('App\Models\BaiHoc', 'id_baihoc', 'id_baihoc');
    }
    public function cauhoi(){
        return $this->hasMany('App\Models\CauHoi', 'id_baitap', 'id_baitap');
    }
}
