<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProfilePerusahaan extends Model
{
    use HasFactory;

    protected $table = 'profile_perusahaans';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'sejarah_perusahaan',
        'visi',
        'misi',
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
