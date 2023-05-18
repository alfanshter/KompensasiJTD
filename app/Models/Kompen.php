<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kompen extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class, 'kegiatan_id', 'id');
    }

    public function mahasiswa()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');

    }
}
