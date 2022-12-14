<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\kategori;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    //index untuk menampilkan semua data
    {
        $alamat = kategori::all();

        return response()->json([
            "message" => "load data success",
            "data" => $alamat
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    //function store utk menambahkan data ketegori
    {
        $table = kategori::create([
            "id_tiket" => $request->id_tiket,
            "nama_kategori" => $request->nama_kategori,
            "harga" => $request->harga,
            "jumlah" => $request->jumlah,
        ]);

        return response()->json([
            'success' => 201,
            'message' => "Data tiket berhasil disimpan", 
            'data' => $table
        ],
          201  
            );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    // show menampilkan data berdasarkan id, data yg bisa ditampilkan 1
    {
        $kategori = kategori::where('id', $id)->first();
        if ($kategori){
            return response()->json([
                'status' => 200,
                'data' => $kategori
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'data' => 'Data tiket dengan id ' . $id . ' tidak ditemukan '
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    //memperbarui data kategori jika ada kesalahan
    {
        $kategori = kategori::where('id', $id)->first();
        if($kategori){
            $kategori->id_tiket = $request->id_tiket ? $request->id_tiket : $kategori->id_tiket;
            $kategori->nama_kategori = $request->nama_kategori ? $request->nama_kategori : $kategori->nama_kategori;
            $kategori->harga = $request->harga ? $request->harga : $kategori->harga;
            $kategori->jumlah = $request->jumlah ? $request->jumlah : $kategori->jumlah;
            $kategori->save();
            return response()->json([
                'status' => 200,
                'message' => "Data kategori berhasil diubah", 
                'data' => $kategori
            ], 200);
            
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Data dengan id ' . $id . ' tidak ditemukan'
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    // destory untuk menghapus data dengan id
    {
        $kategori = kategori::where('id', $id)->first();
        if($kategori){
            $kategori->delete();
            return response()->json([
                'status' => 200,
                'message' => "Data kategori berhasil dihapus", 
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Data dengan Id ' . $id . ' tidak ditemukan' 
            ], 404);
        }
    }
}