<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JajaranDireksi extends Model
{
    use HasFactory;

    protected $table = 'jajaran_direksis';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'nama_panjang',
        'jabatan',
        'pendapat',
        'status_aktif',
        'created_by',
        'updated_by',
    ];

    protected static function booted(){
        static::creating(function($model){
            $model->created_by = Auth::id();
            $model->updated_by = Auth::id();
        });

        static::saving(function($model){
            $model->updated_by = Auth::id();
        });
    }
}
