<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPpks extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    public function Terminasi()
    {
        return $this->belongsTo(Terminasi::class, 'id_terminasi');
    }

    public function Jenis()
    {
        return $this->belongsTo(Jenis::class, 'id_kriteria');
    }
}
