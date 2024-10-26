<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TanamanSubkriteria extends Model
{
    use HasFactory;
    protected $table = 'tanaman_subkriterias';
    protected $primarykey = 'id';
    protected $fillable = ['tanaman_id', 'subkriteria'];
    protected $guraded = [];

    public function tanaman()
    {
        return $this->belongsTo(Tanaman::class, 'tanaman_id');
    }

    public function subkriteria()
    {
        return $this->belongsTo(Subkriteria::class, 'subkriteria_id');
    }
}
