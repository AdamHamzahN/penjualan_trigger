<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class logs extends Model
{
    use HasFactory;
    protected $table = 'stok';
    protected $primarykey = 'id_stok';
    protected $fillable =['pesan','tanggal'];
}
