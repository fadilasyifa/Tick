<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tiket;
use App\Models\Pesanan;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PesananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pesanan = Pesanan::all();

        return response()->json([
            "message" => "load data success",
            "data" => $pesanan
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
    //menambahkan data pesanan, fungsi validator saat mengisi data tidak boleh kosong
    {
        $message = [
            "id_user" => "Masukan Id User",
            "id_kategori" => "Masukan Id Kategori",
            "tanggal" => "Masukan Tanggal",
            "kode" => "Masukan Kode Tiket",
            "status" => "Masukan Status"
        
        ];
        $validasi = Validator::make($request->all(), [
            "id_user" => "required",
            "id_kategori" => "required",
            "tanggal" => "required",
            "kode" => "required",
            "status" => "required"

        ], $message);
        if ($validasi->fails()) {
            return $validasi->errors();
        }
        $mobil1 = Pesanan::create($validasi->validate());
        $mobil1->save();

        return response()->json([
            "message" => "load data success",
            "data" => $mobil1
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pesanan = Pesanan::find($id);
        if ($pesanan) {
            return $pesanan;
        } else {
            return ["message" => "Data tidak ditemukan"];
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
    {
        $pesanan = pesanan::where('id', $id)->first();
        if($pesanan){
            $pesanan->id_kategori = $request->id_kategori ? $request->id_kategori : $pesanan->id_kategori;
            $pesanan->save();
            return response()->json([
                'status' => 200,
                'message' => "Data tiket berhasil diubah", 
                'data' => $pesanan
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
    {
        $pesanan = pesanan::where('id', $id)->first();
        if($pesanan){
            $pesanan->delete();
            return response()->json([
                'status' => 200,
                'message' => "Data tiket berhasil dihapus", 
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Data dengan Id ' . $id . ' tidak ditemukan' 
            ], 404);
        }
    
    }
}