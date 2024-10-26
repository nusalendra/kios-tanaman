<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subkriteria extends Model
{
    use HasFactory;
    protected $table = 'subkriterias';
    protected $primarykey = 'id';
    protected $fillable = ['kriteria_id', 'nama', 'skor'];
    protected $guraded = [];

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class, 'kriteria_id');
    }

    public function tanaman()
    {
        return $this->belongsToMany(Tanaman::class, 'tanaman_subkriterias', 'subkriteria_id', 'tanaman_id');
    }
}
