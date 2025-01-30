<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Masjid extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'masjid';
    protected $guarded = [];

    public function capAset(): BelongsTo
    {
        return $this->belongsTo(Aset::class, 'cap_aset_id');
    }

    public function ttdAset(): BelongsTo
    {
        return $this->belongsTo(Aset::class, 'ttd_aset_id');
    }

    public function catatanSurat(): HasMany
    {
        return $this->hasMany(CatatanSurat::class, 'masjid_id');
    }

    public function takjil(): HasMany
    {
        return $this->hasMany(Takjil::class, 'masjid_id');
    }

    public function kultum(): HasMany
    {
        return $this->hasMany(Kultum::class, 'masjid_id');
    }
}
