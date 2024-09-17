<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bike extends Model
{
    use HasFactory;
    protected $guarded;

    public function variant()
    {
        return $this->belongsTo(Variant::class);
    }

    public function rents()
    {
        return $this->belongsToMany(Rent::class);
    }
}
