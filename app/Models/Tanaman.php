<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tanaman extends Model
{
    use HasFactory;
    protected $table = 'tanamans';
    protected $primarykey = 'id';
    protected $fillable = ['nama', 'gambar'];
    protected $guraded = [];

    public function subkriteria()
    {
        return $this->belongsToMany(Subkriteria::class, 'tanaman_subkriterias', 'tanaman_id', 'subkriteria_id');
    }
}
