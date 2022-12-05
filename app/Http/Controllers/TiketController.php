<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tiket;
use App\Models\Kategori;

class TiketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tiket = tiket::all();

        return response()->json([
            "message" => "load data success",
            "data" => $tiket
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
    {
        $table = Tiket::create([
            "nama_tiket" => $request->nama_tiket,
            "deskripsi" => $request->deskripsi,
            "tanggal" => $request->tanggal,
            "lokasi" => $request->lokasi,
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
    {
        $tiket = tiket::with('kategori')->where('id', $id)->first();
        if ($tiket){
            return response()->json([
                'status' => 200,
                'data' => $tiket
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
    {
        $tiket = tiket::where('id', $id)->first();
        if($tiket){
            $tiket->nama_tiket = $request->nama_tiket ? $request->nama_tiket : $tiket->nama_tiket;
            $tiket->deskripsi = $request->deskripsi ? $request->deskripsi : $tiket->deskripsi;
            $tiket->tanggal = $request->tanggal ? $request->tanggal : $tiket->tanggal;
            $tiket->lokasi = $request->lokasi ? $request->lokasi : $tiket->lokasi;
            $tiket->save();
            return response()->json([
                'status' => 200,
                'message' => "Data tiket berhasil diubah", 
                'data' => $tiket
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
        $tiket = tiket::where('id', $id)->first();
        if($tiket){
            $tiket->delete();
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