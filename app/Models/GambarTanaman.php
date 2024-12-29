<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GambarTanaman extends Model
{
    use HasFactory;
    protected $table = 'gambar_tanamans';
    protected $primarykey = 'id';
    protected $fillable = ['tanaman_id', 'nama'];
    protected $guraded = [];

    public function tanaman()
    {
        return $this->belongsTo(Tanaman::class);
    }
}
