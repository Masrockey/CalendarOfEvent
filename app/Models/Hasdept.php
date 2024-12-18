<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Hasdept extends Model
{
    use HasFactory;

    protected $table = 'hasdept';

    protected $guarded = [];

    protected $fillable = ['user_id', 'departement_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function departement()
    {
        return $this->belongsTo(Departement::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
