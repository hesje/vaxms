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

        switch ($user->conversation_status['step']) {
            case 0:
                $this->askCountryName();
                break;
            case 1:
                $this->tryToSetCountry();
                break;
        }
    }

    public function askCountryName()
    {
        $this->user->sendMessage('Hi ' . $this->update->getChat()->username . ', I\'m VaxMS Bot!');
        $this->user->sendMessage('In a bit you can tell me when your child was born and we\'ll send you reminders to get them vaccinated according to the immunisation schedule of your country.');
        $this->user->sendMessage('So, what country do you live in?');
        $this->user->conversation_status['step'] = 1;
        $this->user->save();
    }

    public function tryToSetCountry()
    {
        if ($country = $this->findCountry($this->update->getMessage()->text)) {
            $this->user->conversation_status = [];
            $this->user->country_id = $country->id;
            $this->user->save();
            $this->user->sendMessage('Found it!');
            $this->user->sendMessage('We set your country to \'' . $country->name . '\'');
            $this->user->sendMessage('If you need to change this at any point, just say \'change country\'.');
            $this->user->sendMessage('If at any point you want to stop receiving messages, say: \'unsubscribe\'');
            $this->user->sendMessage('Let\'s add your child if you want! Start by writing \'add child\'');
        } else {
            $this->user->sendMessage('We couldn\'t find that country, please try again.');
        }
    }

    public function findCountry(string $country): ?Country
    {
        return Country::where('name', 'like', '%' . $country . '%')->first();
    }
}
