<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class barang extends Model
{
    use HasFactory;
    protected $table = 'barang';
    protected $primarykey = 'id_barang';
    protected $fillable =['nama_barang','kode_barang','harga'];
    public $timestamps = false;
    public function stok():HasOne
    {
        return $this->hasOne(stok::class,'id_barang','id_barang');
    }
}
