<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $guarded;

    public function user()
    {
        return $this->hasOne(User::class)->where('role', '=', 'admin');
    }
}
