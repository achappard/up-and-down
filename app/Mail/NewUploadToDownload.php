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
    public $subject;
    public $downloadLink;
    public $downloadList;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Array $data)
    {
        $this->sender_name = $data['sender_name'];
        $this->downloadLink = $data['downloadLink'];
        $this->downloadList = $data['downloadList'];

        $this->subject = $this->sender_name .  " vous a envoyé des fichiers via UpAndDown";
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
