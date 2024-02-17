<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class penjualan extends Model
{
    use HasFactory;
    protected $table = 'penjualan';

    public function user(){
        return $this->belongsTo(user::class, 'id'); 
    }
}
