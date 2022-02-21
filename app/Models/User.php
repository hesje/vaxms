<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use Telegram;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'access_token',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo|Country
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function children()
    {
        return $this->hasMany(Child::class);
    }

    public function sendMessage(string $msg)
    {
        Telegram::sendMessage([
            'chat_id' => $this->chat_id,
            'text' => $msg,
        ]);
    }

    public function sendAuthCode()
    {
        $code = random_int(0, 999999);
        $code = str($code)->padLeft('6', '0');
        $this->update(['access_token' => $code]);

        $this->sendMessage('Your verification code is: ' . $code);
    }

    public function login(string $code): bool
    {
        if (is_null($this->access_token)) {
            return false;
        }

        if ($this->access_token === $code) {
            $this->update([
                'access_token' => null,
            ]);
            Auth::login($this);
            return Auth::check();
        }

        return false;
    }
}
