<?php

namespace App\Mail;

use App\Models\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DocSignedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $pdf;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Pdf $pdf)
    {
        $this->pdf = $pdf;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $pdf = $this->pdf;
        $pdf_link = asset("storage/signed/$pdf->id.pdf");
        return $this->subject("SignApp - $pdf->client_name (Signed)")
            ->attach($pdf_link, [
                'as' => $this->pdf->doc_name.".pdf",
                'mime' => 'application/pdf',
            ])
            ->view('mails.doc_signed_mail');
    }
}
