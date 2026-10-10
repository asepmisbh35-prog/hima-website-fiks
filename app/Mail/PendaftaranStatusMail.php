<?php

namespace App\Mail;

use App\Models\PendaftaranPengurus;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PendaftaranStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public PendaftaranPengurus $pendaftaran
    ) {}

    public function envelope(): Envelope
    {
        $subject = match($this->pendaftaran->status) {
            'diterima' => '🎉 Selamat! Pendaftaran Pengurus HIMADIKTI Diterima',
            'ditolak'  => 'Informasi Hasil Pendaftaran Pengurus HIMADIKTI',
            default    => 'Update Status Pendaftaran HIMADIKTI',
        };

        return new Envelope(subject: $subject);
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.pendaftaran-status',
        );
    }
}