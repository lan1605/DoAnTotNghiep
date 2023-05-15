<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LamBaiTap extends Model
{
    use HasFactory;

    protected $table = "lam_bai_taps";

    protected $fillable
    = [
        'id_baitap',
        'id_hocvien',
        'id_cauhoi',
        'dapan_hocvien',
        'created_at',
        'updated_at',
];


protected $primaryKey = null;
public $incrementing = false;
    public $timestamp = true;
}
