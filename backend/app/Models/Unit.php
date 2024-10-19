<?php

namespace App\Models;

use EloquentFilter\Filterable;

class Unit extends Model
{
    use Filterable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [];
}