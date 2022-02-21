<?php

namespace App\Http\TelegramCommands;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;

class AddChildCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = "addChild";

    /**
     * @var string Command Description
     */
    protected $description = "Add a child for who you want to receive notifications";

    /**
     * @var string Expected Command Pattern
     */
    protected $pattern = '{name} {dob}'; // Example: \addChild Pietje 1-1-2000

    /**
     * @inheritdoc
     */
    public function handle()
    {
        try {
            $user = User::firstOrCreate([
                'chat_id' => $this->update->getChat()->id,
            ], [
                'username' => $this->update->getChat()->username,
            ]);

            $user->children()->create([
                'name' => $this->getArguments()['name'],
                'dob' => $this->getArguments()['dob'],
            ]);

            $this->replyWithMessage(['text' => 'Done!']);

        } catch (\Throwable $e) {
            try {
                $this->replyWithMessage(['text' => 'Something went wrong :(']);
            } catch (\Throwable $e) {}

            Log::error($e->getMessage(), $e->getTrace());
        }
    }
}
