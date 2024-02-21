<?php

namespace App\Models;

use App\Models\DetailPenjualan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class penjualan extends Model
{
    use HasFactory;
    protected $table = 'penjualan';
    protected $fillable = ['nama_pelanggan', 'id_user', 'total_harga'];

    public function user(){
        return $this->belongsTo(users::class, 'id_user'); 
    }

    public function details()
    {
        return $this->hasMany(DetailPenjualan::class, 'penjualan_id');
    }
    
    public function detailPenjualans()
    {
        return $this->hasMany(DetailPenjualan::class);
    }
}
