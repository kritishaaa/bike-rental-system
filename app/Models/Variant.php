<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    use HasFactory;

    protected $guarded;

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function bikes()
    {
        return $this->hasMany(Bike::class);
    }
}
