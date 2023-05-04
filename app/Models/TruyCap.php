<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TruyCap extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['diachi_ip','thoigian_truycap'];

    protected $table = 'truy_caps';
    protected $primaryKey = 'id';
}
