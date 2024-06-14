<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kategori;
use App\Models\Barang;

class BarangKeluar extends Model
{
    use HasFactory;

    protected $table = 'barangkeluar';

    protected $fillable = ['tgl_keluar','qty_keluar','barang_id'];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }
}