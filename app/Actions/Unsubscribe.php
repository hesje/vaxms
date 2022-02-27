<?php

namespace App\Actions;

use App\Models\User;
use Lorisleiva\Actions\Concerns\AsAction;
use Telegram\Bot\Objects\Update;

class Unsubscribe
{
    use AsAction;

    public function handle(Update $update, User $user)
    {
        $user->sendMessage('We\'re sad to see you go, but we\'ve removed you from our databases. If you ever want to come back, just say \'start\'');

        $user->children()->delete();
        $user->delete();
    }
}
