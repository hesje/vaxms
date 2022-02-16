<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Child extends Model
{
    use HasFactory;
    protected $table = "children";

    protected $casts = [
        'dob' => 'date'
    ];

    public function parent()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
