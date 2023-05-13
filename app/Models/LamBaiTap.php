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
        'id',
        'id_baitap',
        'id_hocvien',
        'id_cauhoi',
        'created_at',
        'updated_at',
];
    public $timestamp = true;
}
