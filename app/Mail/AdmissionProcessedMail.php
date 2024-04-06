<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdmissionProcessedMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $Admission;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($Admission,$email)
    {
        $this->Admission = $Admission;
        $this->Email = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject('JL Ramos - Admissão.');
        $this->to($this->Email);
        return $this->markdown('emails.admission.admission',['admission' => $this->Admission]);
    }
}
