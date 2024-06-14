<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Kategori extends Model
{
    use HasFactory;
    protected $table = 'kategori';
    protected $fillable = ['deskripsi', 'kategori'];

    public static function infoKategori()
    {
        return DB::table('kategori')
            ->select('kategori.id', 'deskripsi', DB::raw('infoKategori(kategori) as Info'))
            ->get();
    }
    public function ketKategori()
    {
        switch ($this->kategori) {
            case 'M':
                return 'Modal';
            case 'A':
                return 'Alat';
            case 'BHP':
                return 'Bahan Habis Pakai';
            case 'BTHP':
                return 'Bahan Tidak Habis Pakai';
            default:
                return 'Unknown';
        }
    }

    public static function getKategoriAll()
    {
        return DB::table('kategori')->select('kategori.id','deskripsi',DB::raw('infoKategori(kategori) as info'));
    }
    public function barang()
    {
        return $this->hasMany(Barang::class, 'kategori_id', 'id');
    }
    public static function katShowAll()
    {
        return self::with('barang')
            ->select('kategori.id', 'deskripsi', DB::raw('ketKategori(kategori) as ketkategori'), 'barang.merk');
    }
    public static function showKategoriById($id)
    {
        return self::with(['barang' => function ($query) {
            $query->select('barang.id', 'barang.merk', 'barang.seri', 'barang.spesifikasi', 'barang.stok');
        }])
            ->select('kategori.id', 'deskripsi', DB::raw('ketKategori(kategori.kategori) as ketkategori'))
            ->where('kategori.id', $id)
            ->get();
    }
}