<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['name', 'icon', 'route', 'status', 'permission_name', 'menu_id', 'index'];

    protected $casts = ['status' => 'boolean'];
}
