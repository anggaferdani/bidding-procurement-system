<?php

namespace App\Imports;

use App\Models\Artikel;
use Maatwebsite\Excel\Concerns\ToModel;

class ArtikelImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Artikel([
            'judul_artikel' => $row[1],
            'tanggal_published' => $row[2],
            'thumbnail' => $row[3],
            'isi_artikel' => $row[4],
        ]);
    }
}
