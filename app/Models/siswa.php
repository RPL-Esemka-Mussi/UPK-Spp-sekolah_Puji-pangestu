<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class siswa extends Model
{
    use HasFactory;
    protected $table = 'siswa';
    protected $fillable = [
        'user_id',
        'nis',
        'kelas_id',
        'alamat',
        'no_hp',
    ];

    public function user()
    {
       return $this->belongsTo(user::class);
    }

    public function kelas()
    {
       return $this->belongsTo(kelas::class);
    }

    public function pembayaran()
    {
       return $this->hasMany(pembayaran::class);
    }
}
