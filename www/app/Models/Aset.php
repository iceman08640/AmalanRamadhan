<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Aset extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'aset';

    protected $fillable = ['file', 'judul', 'extension'];

    public function identitas(): HasOne
    {
        return $this->hasOne(Identitas::class, 'aset_id');
    }

    public function masjidCap(): HasMany
    {
        return $this->hasMany(Masjid::class, 'cap_aset_id');
    }

    public function masjidTtd(): HasMany
    {
        return $this->hasMany(Masjid::class, 'ttd_aset_id');
    }
}
