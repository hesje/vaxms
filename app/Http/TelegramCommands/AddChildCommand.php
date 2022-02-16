<?php

namespace App\Http\TelegramCommands;

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
        $resp = 'bla ' . $this->getArguments()['dob'];

        Log::debug('Message stuff: ', [$this->update->getChat()->id, $this->update->getChat()->username]);

        // TODO: Insert logic to add Child to DB

        $this->replyWithMessage(['text' => $resp]);
    }
}
