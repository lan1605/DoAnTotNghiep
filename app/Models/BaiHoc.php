<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaiHoc extends Model
{
    use HasFactory;
    protected $table = 'bai_hocs';
    
    protected $primaryKey = 'id_baihoc'; // or null

    public $incrementing = false;
    public function chude(){
        return $this->belongsTo('App\Models\ChuDe', 'id_chude', 'id_chude');
    }
    public function admin(){
        return $this->belongsTo('App\Models\Admin', 'id_admin', 'id_admin');
    }
    public function baitap(){
        return $this->hasMany('App\Models\BaiTap','id_baitap', 'id_baitap');
    }
}
