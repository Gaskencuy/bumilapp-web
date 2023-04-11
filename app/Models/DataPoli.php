<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DataPoli extends Model
{
    use HasFactory;

    protected $table = 'datapoli';

    protected $fillable = [
        'nama_pemeriksa',
        'ttd_pemeriksa',
        'tempat',
        'tanggal',
        'id_user'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
