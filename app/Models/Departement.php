<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Departement extends Model
{
    use HasFactory;

    protected $table = 'departement';

    protected $guarded = [];

    protected $fillable = ['nama', 'deskripsi'];

    public function hasdepts()
    {
        return $this->hasMany(Hasdept::class);
    }
}