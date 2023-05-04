<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChuDe extends Model
{
    use HasFactory;
    protected $table = "chu_des";

    protected $fillable = [
        'ten_chude','slug'
    ];
    protected $primaryKey = 'id_chude'; // or null

    public $incrementing = false;
    public function baihoc(){
        return $this->hasMany('App\Models\BaiHoc', 'id_chude', 'id_chude');
    }
    public function baidang(){
        return $this->hasMany('App\Models\BaiDang', 'id_chude','id_chude');
    }
}
