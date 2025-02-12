<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Todo;

class JenisKegiatan extends Model
{
    protected $table = 'jenis_kegiatan';
    protected $fillable = ['nama_jenis_kegiatan', 'keterangan'];

    public function todos()
    {
        return $this->hasMany(Todo::class);
    }
}
