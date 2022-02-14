<?php

namespace App\Http\TelegramCommands;

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

    protected $pattern = '{name} {dob}';

    /**
     * @inheritdoc
     */
    public function handle()
    {
        $resp = 'bla ' . $this->getArguments()['dob'];

        $this->replyWithMessage(['text' => $resp]);
    }
}
