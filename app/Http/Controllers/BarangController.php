<?php

namespace App\Http\Controllers;

use App\Http\Requests\barangStoreRequest;
use App\Models\barang;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class BarangController extends Controller
{
    //
    protected $id_barang;
    protected $nama_barang;
    protected $kode_barang;
    protected $harga;
    protected $barangModel;

    public function __construct()
    {
        $this->barangModel = new Barang();
    }

    public function index()
    {
        /**
         * menampilkan data barang yang ada pada tabel barang dan menampilkan halaman barang
         */
        // $data = [
        //     'barangList' => $this->barangModel::all()
        // ];
        return view('barang.index');
    }

    public function tambah()
    {
        /**
         * menampilkan form untuk input data barang
         * data form akan dikiramkan ke function simpan
         */

        return view('barang.tambah');
    }

    public function simpan(barangStoreRequest $request)
    {
        /**
         * meniympan data yang di input dari function tambah
         */

        $validated = $request->validated();

        if ($validated) {
            if (isset($validated)) :
                //update
                $perintah = barang::where('id_barang', $request->id_barang)->update($validated);
                if ($perintah) {
                    $pesan = [
                        'status' => 'success',
                        'pesan' => 'Data Berhasil Diupdate'
                    ];
                } else {
                    $pesan = [
                        'status' => 'failed',
                        'pesan' => 'Data Gagal Diupdate'
                    ];
                }
            else :
                //buat data baru
                $perintah = barang::create($validated);
                if ($perintah) {
                    $pesan = [
                        'status' => 'success',
                        'pesan' => 'Data Berhasil Ditambahkan'
                    ];
                } else {
                    $pesan = [
                        'status' => 'failed',
                        'pesan' => 'Data Gagal Ditambahkan'
                    ];
                }
            endif;
        } else {
            $pesan = [
                'status' => 'success',
                'pesan' => 'Data Gagal Ditambahkan,periksa kembali isian form nya'
            ];
        }


        return response()->json($pesan);
    }




    public function update(Request $request)
    {
        /**
         * method ini hanya bisa diakses dengan http request GET
         */
        $data = [
            'barangDetil' => barang::where('id_barang', $request->id_barang)->first()
        ];

        return view('barang.edit', $data);
    }
    public function delete(Request $request)
    {
        /**
         * method ini hanya bisa diakses dengan http request POST
         * 
         */
    }

    public function dataBarang(Request $request)
    {
        /**
         * method ini sbg endpoint API untuk 
         * Datatable serverside
         */

        if ($request->ajax()) :
            $data = $this->barangModel->with('stok')->get();
            return DataTables::of($data)->toJson();
        endif;
    }
}
