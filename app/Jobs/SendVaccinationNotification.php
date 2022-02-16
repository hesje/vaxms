<?php

namespace App\Jobs;

use App\Models\Child;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Telegram;

class SendVaccinationNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private Child $child;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Child $child)
    {
        $this->child = $child;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $chat_id = $this->child->parent()->sole()->chat_id;
        $country = $this->child->parent()->sole()->country()->sole();

        $vaccinations = $country
            ->vaccinations()
            ->where('age_at_administration', '>', $this->child->dob->monthsUntil(now())->count())
            ->orderBy('age_at_administration', 'asc')
            ->get();

        $response = Telegram::sendMessage([
            'chat_id' => $chat_id,
            'text' => $vaccinations->first()->name,
        ]);
    }
}
