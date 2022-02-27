<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    public function vaccinations()
    {
        return $this
            ->belongsToMany(Vaccination::class)
            ->withPivot(['age_at_administration', 'id']);
    }
}
