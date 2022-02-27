<?php

namespace App\Jobs;

use App\Models\Child;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

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
        try {
            $vaccinations = $this->child->vaccinations();

            $this->child->parent->sendMessage(
                'Hi, we just wanted to let you know that '
                . $this->child->name . ' needs to get the '
                . $vaccinations->first()->name . ' vaccination soon.',
            );
        } catch (\Throwable $e){
            Log::error($e->getMessage(), $e->getTrace());
        }
    }
}
