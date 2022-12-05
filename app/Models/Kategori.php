<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use App\Models\tiket;
use App\Models\Pesanan;

class Kategori extends Model
{
    protected $guarded = [
        'id'
    ];

    public function tiket()
    {
        return $this->belongsTo(tiket::class, 'id_tiket', 'id_tiket' );
    }

    public function kategori()
    {
        return $this->hasMany(pesanan::class, 'id_kategori', 'id' );
    }
}
