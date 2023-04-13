<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;

    protected $table = 'surveys';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'nama_panjang',
        'email',
        'nama_perusahaan',
        'pesan',
    ];
}
