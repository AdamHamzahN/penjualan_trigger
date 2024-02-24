<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jual extends Model
{
    use HasFactory;
    protected $table ='jual';
    protected $primarykey = 'id_jual';
    protected $fillable =['tanggal_jual','jumlah_jual','harga_jual_satuan','total_harga_jual'];
}
