<?php

namespace App\Mail;

use App\Models\Rapat;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RapatReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Rapat $rapat,
        public User  $peserta
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '🔔 Reminder Rapat Besok: ' . $this->rapat->judul_rapat,
        );
    }

    public function content(): Content
    {
        $logoPath   = public_path('images/himadikti.png');
        $logoBase64 = file_exists($logoPath)
            ? 'data:image/png;base64,' . base64_encode(file_get_contents($logoPath))
            : null;

        return new Content(
            view: 'emails.rapat-reminder',
            with: [
                'logoBase64' => $logoBase64,
            ]
        );
    }
}
