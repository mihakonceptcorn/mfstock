<?php

namespace App\Jobs;

use App\Mail\OrderCompletedMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Mockery\Exception;

class SendOrderEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $details;

    /**
     * @param $details
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        logs()->info('email email email email');
        $email = new OrderCompletedMail($this->details);

        try {
            Mail::to($this->details['email'])->send($email);
        } catch (Exception $exception) {
            logs()->error('Send Email Failed', compact($exception));
        }
    }
}
