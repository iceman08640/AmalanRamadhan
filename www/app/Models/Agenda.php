<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Agenda extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'agenda';
    protected $guarded = [];

    public function kultum(): HasMany
    {
        return $this->hasMany(Kultum::class, 'agenda_id');
    }

    public function takjil(): HasMany
    {
        return $this->hasMany(Takjil::class, 'agenda_id');
    }
}
