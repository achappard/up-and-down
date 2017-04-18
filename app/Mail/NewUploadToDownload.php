<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewUploadToDownload extends Mailable
{
    use Queueable, SerializesModels;


    public $sender_name;
    public $sender_message;
    public $sender_email;
    public $subject;
    public $download_link;


    public $file_name;
    public $file_size;
    public $file_expiration_date;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Array $data)
    {
        $this->sender_name = $data['sender_name'];
        $this->sender_email = $data['sender_email'];
        $this->sender_message = $data['sender_message'];
        $this->download_link = $data['download_link'];

        $this->file_name = $data['file_name'];
        $this->file_size = $data['file_size'];

        //setlocale (LC_ALL, "fr_FR");
        $this->file_expiration_date = strftime("%A %d %B %Y", strtotime( $data['expiration_date'] ));

        $this->subject = $this->sender_name .  " vous a envoyé des fichiers via UpAndDown";
        $this->replyTo($this->sender_email);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return
            $this->subject($this->subject)
                ->view('email.new_upload_available');
    }
}
