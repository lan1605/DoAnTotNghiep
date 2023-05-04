<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BinhLuan extends Model
{
    use HasFactory;

    protected $table = 'binh_luan_bai_dangs';

    public function baidang(){
            return $this->belongsTo('App\Models\BaiDang','id_baidang','id');
    }
}
