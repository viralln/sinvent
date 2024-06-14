<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BarangMasuk;
use App\Models\Kategori;
use App\Models\Barang;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class BarangMasukController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
    
        // Query untuk mencari barang masuk berdasarkan keyword
        $rsetBarang= BarangMasuk::with('barang')
            ->whereHas('barang', function ($query) use ($keyword) {
                $query->where('merk', 'LIKE', "%$keyword%")
                      ->orWhere('seri', 'LIKE', "%$keyword%")
                      ->orWhere('spesifikasi', 'LIKE', "%$keyword%");
            })
            ->orWhere('tgl_masuk', 'LIKE', "%$keyword%")
            ->orWhere('qty_masuk', 'LIKE', "%$keyword%")
            ->paginate(10);
    
        return view('barangmasuk.index', compact('rsetBarang'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     */
   public function create()
    {
        $abarang = Barang::all(); // Mengambil data barang
        $today = date('Y-m-d'); // Mendapatkan tanggal hari ini dalam format YYYY-MM-DD

        return view('barangmasuk.create', compact('abarang', 'today'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //return $request;
        //validate form
        $request->validate([
            'tgl_masuk'          => 'required',
            'qty_masuk'          => 'required',
            'barang_id'   => 'required',

        ]);

        //create post
        //BarangMasuk::create([
            //'tgl_masuk'             => $request->tgl_masuk,
            //'qty_masuk'             => $request->qty_masuk,
            //'barang_id'      => $request->barang_id,
        //]);

	try {
            DB::beginTransaction(); // Mulai transaksi

            // Create BarangMasuk record
            $barangMasuk = BarangMasuk::create([
                'tgl_masuk' => $request->tgl_masuk,
                'qty_masuk' => $request->qty_masuk,
                'barang_id' => $request->barang_id,
            ]);


            DB::commit(); // Commit perubahan

            // Redirect to index
            return redirect()->route('barangmasuk.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback jika terjadi kesalahan
            return redirect()->route('barangmasuk.index')->with(['error' => 'Gagal menyimpan data.']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $rsetBarang = BarangMasuk::find($id);

        //return $rsetBarang;

        //return view
        return view('barangmasuk.show', compact('rsetBarang'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
    $abarang = Barang::all();
    $rsetBarang = BarangMasuk::find($id);
    $selectedBarang = Barang::find($rsetBarang->barang_id);

    return view('barangmasuk.edit', compact('rsetBarang', 'abarang', 'selectedBarang'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'tgl_masuk'        => 'required',
            'qty_masuk'        => 'required',
            'barang_id' => 'required',
        ]);

        $rsetBarang = BarangMasuk::find($id);

            //update post without image
            $rsetBarang->update([
                'tgl_masuk'          => $request->tgl_masuk,
                'qty_masuk'          => $request->qty_masuk,
                'barang_id'   => $request->barang_id,
            ]);

        // Redirect to the index page with a success message
        return redirect()->route('barangmasuk.index')->with(['success' => 'Data Berhasil Diubah!']);
    }


    /**
     * Remove the specified resource from storage.
     */
        public function destroy(string $id)
    {
        // Temukan data barang masuk
        $barangMasuk = BarangMasuk::findOrFail($id);

        // Temukan data barang terkait
        $barang = Barang::findOrFail($barangMasuk->barang_id);

        // Hitung stok baru setelah penghapusan
        $newStock = $barang->stok - $barangMasuk->qty_masuk;

        // Lakukan pengecekan jika stok akan menjadi negatif
        if ($newStock < 0) {
            return redirect()->route('barangmasuk.index')->withErrors(['qty_masuk' => 'Penghapusan Data Barang Masuk Tidak Dapat Dilakukan']);
        }

        // Lanjutkan dengan penghapusan data barang masuk jika stok tidak menjadi negatif
        $barangMasuk->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('barangmasuk.index')->with(['success' => 'Data Barang Masuk Berhasil Dihapus!']);
    }
}
