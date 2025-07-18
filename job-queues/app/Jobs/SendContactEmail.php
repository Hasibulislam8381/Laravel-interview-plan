<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendContactEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $data; // <== add this

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function handle(): void
    {
        Mail::raw($this->data['message'], function ($mail) {
            $mail->to('admin@example.com')
                 ->subject('New Contact from ' . $this->data['name']);
        });
    }
}

