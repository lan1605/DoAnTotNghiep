<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mail;
use App\Mail\ContactMail;

class LienHe extends Model
{
    use HasFactory;

    protected $table = 'lien_hes';
    public static function boot() {
  
        parent::boot();
  
        static::created(function ($item) {
                
            $adminEmail = "ntutinhocdaicuonga@gmail.com";
            Mail::to($adminEmail)->send(new ContactMail($item));
        });
    }
}
