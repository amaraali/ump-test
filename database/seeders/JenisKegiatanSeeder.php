<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JenisKegiatan;

class JenisKegiatanSeeder extends Seeder
{
    public function run(): void
    {
        $jenisKegiatans = [
            [
                'nama_jenis_kegiatan' => 'Pekerjaan',
                'keterangan' => 'Kegiatan yang berhubungan dengan pekerjaan atau tugas kantor'
            ],
            [
                'nama_jenis_kegiatan' => 'Pribadi',
                'keterangan' => 'Kegiatan yang bersifat pribadi atau personal'
            ],
            [
                'nama_jenis_kegiatan' => 'Keluarga',
                'keterangan' => 'Kegiatan yang berkaitan dengan keluarga'
            ],
            [
                'nama_jenis_kegiatan' => 'Pendidikan',
                'keterangan' => 'Kegiatan yang berhubungan dengan pembelajaran atau pendidikan'
            ],
            [
                'nama_jenis_kegiatan' => 'Kesehatan',
                'keterangan' => 'Kegiatan yang berkaitan dengan kesehatan dan kebugaran'
            ],
            [
                'nama_jenis_kegiatan' => 'Sosial',
                'keterangan' => 'Kegiatan yang berhubungan dengan interaksi sosial atau kemasyarakatan'
            ],
            [
                'nama_jenis_kegiatan' => 'Hobi',
                'keterangan' => 'Kegiatan yang berkaitan dengan hobi dan minat pribadi'
            ],
            [
                'nama_jenis_kegiatan' => 'Lainnya',
                'keterangan' => 'Kegiatan lain yang tidak termasuk dalam kategori di atas'
            ],
        ];

        foreach ($jenisKegiatans as $jenisKegiatan) {
            JenisKegiatan::create($jenisKegiatan);
        }
    }
}
