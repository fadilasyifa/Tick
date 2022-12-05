<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kategori;

class tiket extends Model
{
    protected $guarded = [
        'id'
    ];

    public function kategori ()
    {
        return $this->hasMany(kategori::class, 'id_tiket', 'id');
    }
}
