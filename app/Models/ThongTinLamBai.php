<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThongTinLamBai extends Model
{
    use HasFactory;
    protected $table = "thong_tin_lam_bai";
    const CREATED_AT = 'thoigian_lambai';
    const UPDATED_AT = 'thoigian_nopbai';

    protected $fillable
    = [
        'id_baitap',
        'id_hocvien',
        'thoigian_lambai',
        'thoigian_nopbai',
];
    

}
