<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThoiGianHoc extends Model
{
    use HasFactory;
    protected $table = 'thoi_gian_hoc';
    
    protected $primaryKey = 'id'; // or null

}
