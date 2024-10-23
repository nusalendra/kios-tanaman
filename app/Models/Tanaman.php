<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tanaman extends Model
{
    use HasFactory;
    protected $table = 'tanamans';
    protected $primarykey = 'id';
    protected $fillable = ['nama', 'harga', 'gambar'];
    protected $guraded = [];

    public function kriteria()
    {
        return $this->hasMany(Kriteria::class, 'tanaman_id');
    }
}
