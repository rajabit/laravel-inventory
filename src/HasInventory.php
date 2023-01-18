<?php

namespace Rajabit\LaravelInventory;

use DateTimeInterface;
use Illuminate\Support\Str;

trait HasInventory
{
    public function inventory()
    {
        return $this->belongsTo();
    }
}
