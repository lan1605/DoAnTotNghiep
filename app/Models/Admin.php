<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Notifications\customResetPasswordNotification as customResetPasswordNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Admin extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    protected $guard = "admin";
    protected $table = "admins";
    protected $fillable = [
        'name',
        'gioi_tinh',
        'email',
        'sdt',
        'dia_chi',
        'password',
        'truy_cap',
        'role_id'
    ];
    protected $primaryKey = 'id_admin'; // or null

    public $incrementing = false;
    
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new customResetPasswordNotification($token));
    }
   /**
    * Get the user that owns the Admin
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
   public function role()
   {
    return $this->belongsTo('App\Models\Role', 'role_id', 'id');
   }
   public function baihoc(){
    return $this->hasMany('App\Models\BaiHoc', 'id_admin', 'id_admin');
}
}