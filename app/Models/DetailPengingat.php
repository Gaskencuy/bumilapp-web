<?php

namespace App\Models;


use App\Models\User;
use App\Models\Pengingat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailPengingat extends Model
{
    use HasFactory;

    protected $table = 'detail_pengingat';

    protected $fillable = [
        'status',
        'tanggal',
        'id_user',
        'id_pengingat',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function pengingat()
    {
        return $this->belongsTo(Pengingat::class, 'id_pengingat', 'id');
    }
}
