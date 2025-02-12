<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\JenisKegiatan;

class Todo extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'jenis_kegiatan_id', 'completed'];

    protected $casts = [
        'completed' => 'boolean',
    ];

    public function jenisKegiatan()
    {
        return $this->belongsTo(JenisKegiatan::class);
    }
}
