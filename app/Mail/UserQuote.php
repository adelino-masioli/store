<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserQuote extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data = [], $items = [])
    {
        $this->data = $data;
        $this->items = $items;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.quote')
            ->from('alfjuniobh.web@gmail.com', 'manažer')
            //->bcc('alfjuniobh.web@gmail.com')
            //->bcc('edson@loggia.com.br')
            ->subject('Orçamento')
            ->with(['data' => $this->data, 'items' => $this->items]);
    }
}
