<?php

namespace App\Mail;

use App\Models\Aspirasi;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AspirasiTanggapanMail extends Mailable
{
    use Queueable, SerializesModels;

    public $aspirasi;

    /**
     * Create a new message instance.
     */
    public function __construct(Aspirasi $aspirasi)
    {
        $this->aspirasi = $aspirasi;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        // Subjek email dinamis berdasarkan status
        $statusText = ucfirst($this->aspirasi->status);
        
        return new Envelope(
            subject: "Aspirasi Anda Telah {$statusText} - HIMADIKTI IPI",
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.aspirasi-tanggapan',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}