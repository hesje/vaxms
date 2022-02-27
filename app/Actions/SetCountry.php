<?php

namespace App\Actions;

use App\Models\Country;
use App\Models\User;
use Lorisleiva\Actions\Concerns\AsAction;
use Telegram\Bot\Objects\Update;

class SetCountry
{
    use AsAction;

    public Update $update;
    public User $user;

    public function handle(Update $update, User $user)
    {
        $this->update = $update;
        $this->user = $user;

        if ($country = $this->findCountry($update->getMessage()->text)) {
            $user->sendMessage('We set your country to ' . $country->name);
        } else {
            
        }
    }

    public function findCountry(string $country): ?Country
    {
        return Country::where('name', 'like', '%' . $country . '%')->first();
    }
}
