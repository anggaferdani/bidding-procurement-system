<?php

namespace App\Imports;

use App\Models\Berita;
use Maatwebsite\Excel\Concerns\ToModel;

class BeritaImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Berita([
            'judul_berita' => $row[1],
            'tanggal_published' => $row[2],
            'thumbnail' => $row[3],
            'isi_berita' => $row[4],
        ]);
    }
}
