<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ustadz extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'ustadz';
    protected $guarded = [];

    public function imam(): HasMany
    {
        return $this->hasMany(Kultum::class, 'imam_ustadz_id');
    }

    public function kultum(): HasMany
    {
        return $this->hasMany(Kultum::class, 'kultum_ustadz_id');
    }

    public function kulsub(): HasMany
    {
        return $this->hasMany(Kultum::class, 'kulsub_ustadz_id');
    }
}
