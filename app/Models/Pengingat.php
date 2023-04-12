<?php

namespace App\Models;

use App\Models\DetailPengingat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengingat extends Model
{
    use HasFactory;

    protected $table = 'pengingat';

    protected $fillable = [
        'name',
        'time',
    ];

    public function datapoli()
    {
        return $this->hasMany(DetailPengingat::class, 'id_pengingat', 'id');
    }
}
