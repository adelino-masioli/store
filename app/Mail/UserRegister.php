<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserRegister extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data = [])
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.welcome')
            ->from('alfjuniobh.web@gmail.com', 'manažer')
            //->bcc('alfjuniobh.web@gmail.com')
            //->bcc('edson@loggia.com.br')
            ->subject('Novo cadastro')
            ->with(['user' => $this->data]);
    }
}
