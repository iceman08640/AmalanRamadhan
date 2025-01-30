<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Identitas extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'identitas';

    protected $fillable = ['aset_id', 'nama', 'nama_sistem', 'alamat', 'no_telp', 'kab_kota', 'pemilik', 'email', 'sia', 'apa']; // aset_id as logo

    public function aset()
    {
        return $this->belongsTo(Aset::class, 'aset_id');
    }
}
