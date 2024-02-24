<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class beli extends Model
{
    use HasFactory;
    protected $table ='beli';
    protected $primarykey = 'id_beli';
    protected $fillable =['tanggal_beli','jumlah_beli','harga_beli_satuan','total_harga_beli'];
}
