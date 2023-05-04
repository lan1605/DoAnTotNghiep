<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaiDang extends Model
{
    use HasFactory;
    protected $table = 'bai_dangs';
    
    protected $primaryKey = 'id';

    public function chude(){
        return $this->beLongsTo('App\Models\ChuDe','id_chude', 'id_chude');
    }

    public function binhluan(){
        return $this->hasMany('App\Models\BinhLuan','id_baidang','id');
    }
}
