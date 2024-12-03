<?php

namespace App\Jobs;

use App\Notifications\RentalConfirmationNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;

class BikeStatusJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $user;
    public $to_date;

    /**
     * Create a new job instance.
     */
    public function __construct($user, $to_date)
    {
        $this->user = $user;
        $this->to_date = $to_date;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Notification::send($this->user, new RentalConfirmationNotification($this->user->name, $this->to_date));
    }
}
