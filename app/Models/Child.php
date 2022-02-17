<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Telegram;

class Child extends Model
{
    use HasFactory;
    protected $table = "children";

    protected $guarded = [];

    protected $with = ['parent'];

    protected $casts = [
        'dob' => 'date'
    ];

    public function sendMessage(string $msg)
    {
        $this->parent->sendMessage($msg);
    }

    public function parent()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getAgeInMonthsAttribute(): int
    {
        return $this->dob->monthsUntil(now())->count();
    }

    public function getAgeInWeeksAttribute(): int
    {
        return $this->dob->weeksUntil(now())->count();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|Vaccination[]|Vaccination
     */
    public function vaccinations(): \Illuminate\Database\Eloquent\Collection
    {
        $country = $this->parent()->sole()->country()->sole();
        return $country
            ->vaccinations()
            ->where('age_at_administration', '>', $this->ageInMonths)
            ->orderBy('age_at_administration', 'asc')
            ->get();
    }
}
