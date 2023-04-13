<?php

namespace App\Exports;

use App\Models\Artikel;
use Maatwebsite\Excel\Concerns\FromCollection;

class ArtikelExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Artikel::all();
    }
}
