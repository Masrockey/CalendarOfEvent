<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;

    protected $table = 'event';

    protected $guarded = [];

    public function hasdept()
    {
        return $this->belongsTo(Hasdept::class);
    }
}
