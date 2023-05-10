<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LuuBaiHoc extends Model
{
    use HasFactory;

    protected $table = 'luu_bai_hoc';
    
    protected $primaryKey = 'id'; // or null
}
