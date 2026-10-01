<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BahanPembersih extends Model
{
    protected $fillable = [
        'nama_bahan',
        'merek',
        'stok',
        'satuan',
    ];
}
