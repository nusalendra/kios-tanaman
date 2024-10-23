<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory;
    protected $table = 'kriterias';
    protected $primarykey = 'id';
    protected $fillable = ['tanaman_id', 'nama', 'tipe', 'bobot'];
    protected $guraded = [];

    public function tanaman()
    {
        return $this->belongsTo(Tanaman::class, 'tanaman_id');
    }

    public function subkriteria()
    {
        return $this->hasMany(Subkriteria::class, 'kriteria_id');
    }
}
