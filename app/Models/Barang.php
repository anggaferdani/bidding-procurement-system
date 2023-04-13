<?php

namespace App\Models;

use App\Models\Pengadaan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barangs';

    protected $primaryKey = 'id';
    protected $guarded = ['id'];

    protected static function booted(){
        static::creating(function($model){
            $model->created_by = Auth::id();
            $model->updated_by = Auth::id();
        });

        static::saving(function($model){
            $model->updated_by = Auth::id();
        });
    }

    public function pengadaans(){
        return $this->hasMany(Pengadaan::class);
    }
}
