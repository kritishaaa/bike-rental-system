<?php

namespace App\Jobs;

use App\Mail\TicketMail;
use App\Models\Rent;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class RentJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    protected $rent;
    public function __construct($id)
    {
        //
        $this->rent = Rent::find($id);
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //


        Mail::to($this->rent->user->email)->send(new TicketMail($this->rent->id));
    }
}
