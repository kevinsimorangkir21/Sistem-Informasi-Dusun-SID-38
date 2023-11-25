<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tanah extends Model
{
    use HasFactory;
    protected $guarded;

    public function geolocation()
    {
        return $this->hasMany(Geolocation::class, 'tanah_id', 'id');
    }
}
