<?php

namespace App\Actions;

use App\Models\User;
use Lorisleiva\Actions\Concerns\AsAction;
use Telegram\Bot\Objects\Update;

class ProcessUpdate
{
    use AsAction;

    public function handle(Update $update)
    {
        $chat_id = $update->getChat()->id;
        $u = User::firstOrCreate([
            'chat_id' => $chat_id,
        ], [
            'username' => $update->getChat()->username,
            'conversation_status' => [],
        ]);

        if ($u->wasRecentlyCreated) {
            $u->conversation_status['action'] = 'set_country';
        }

        $actions = [
            'add_child' => AddChild::make(),
            'set_country' => SetCountry::make(),
        ];

        if (isset($u->conversation_status['action'])) {
            $actions[$u->conversation_status['action']]->handle($update, $u);
        } else {
            $text = $update->getMessage()->text;

            if (str($text)->lower()->contains(['child', 'enfant'])) {
                $u->conversation_status['action'] = 'add_child';
                $u->conversation_status['step'] = 0;
//                $u->conversation_status = [];
                $u->save();

                AddChild::run($update, $u);
            }
        }
    }
}
