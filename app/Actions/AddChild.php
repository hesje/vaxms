<?php

namespace App\Actions;

use App\Models\User;
use Illuminate\Support\Carbon;
use Lorisleiva\Actions\Concerns\AsAction;
use Telegram\Bot\Objects\Update;

class AddChild
{
    use AsAction;

    public User $user;
    public Update $update;

    public function handle(Update $update, User $u)
    {
        $this->user = $u;
        $this->update = $update;

        switch ($u->conversation_status['step']) {
            case 0:
                $this->askName();
                break;
            case 1:
                $this->askDoB();
                break;
            case 2:
                $this->finish();
                break;
        }
    }

    public function askName()
    {
        $this->user->sendMessage('what is your child\'s name?');
        $this->user->conversation_status['step'] = 1;
        $this->user->save();
    }

    public function askDoB()
    {
        $this->user->conversation_status['name'] = $this->update->getMessage()->text;

        $this->user->sendMessage('Beautiful Name!');
        $this->user->sendMessage(__('And what is your child\'s date of birth?'));
        $this->user->conversation_status['step'] = 2;
        $this->user->save();
    }

    public function finish()
    {
        $dob =  $this->update->getMessage()->text;
        $name = $this->user->conversation_status['name'];

        $this->user->children()->create([
            'name' => $name,
            'dob' => Carbon::parse($dob),
        ]);

        $this->user->conversation_status = [];

        $this->user->save();

        $this->user->sendMessage($name . ' was added as your child.');
    }
}
