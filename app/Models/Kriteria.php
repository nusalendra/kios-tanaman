<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory;
    protected $table = 'kriterias';
    protected $primarykey = 'id';
    protected $fillable = ['nama', 'tipe', 'bobot'];
    protected $guraded = [];

    public function subkriteria()
    {
        return $this->hasMany(Subkriteria::class, 'kriteria_id');
    }
}
