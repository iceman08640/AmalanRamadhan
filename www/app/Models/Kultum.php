<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kultum extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'kultum';
    protected $guarded = [];

    public function agenda(): BelongsTo
    {
        return $this->belongsTo(Agenda::class, 'agenda_id');
    }

    public function imam(): BelongsTo
    {
        return $this->belongsTo(Ustadz::class, 'imam_ustadz_id');
    }

    public function kultum(): BelongsTo
    {
        return $this->belongsTo(Ustadz::class, 'kultum_ustadz_id');
    }

    public function kulsub(): BelongsTo
    {
        return $this->belongsTo(Ustadz::class, 'kulsub_ustadz_id');
    }

    public function masjid(): BelongsTo
    {
        return $this->belongsTo(Masjid::class, 'masjid_id');
    }
}
