<?php
/**
 * Invoice Ninja (https://invoiceninja.com)
 *
 * @link https://github.com/invoiceninja/invoiceninja source repository
 *
 * @copyright Copyright (c) 2020. Invoice Ninja LLC (https://invoiceninja.com)
 *
 * @license https://opensource.org/licenses/AAL
 */

namespace App\Mail\Admin;

use App\Models\User;
use Illuminate\Mail\Mailable;

class EntitySent extends Mailable
{

    public $mail_obj;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mail_obj)
    {
        $this->mail_obj = $mail_obj;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->mail_obj->from) //todo
                    ->subject($this->mail_obj->subject)
                    ->markdown($this->mail_obj->markdown, ['data' => $this->mail_obj->data])
                    ->withSwiftMessage(function ($message) {
                            $message->getHeaders()->addTextHeader('Tag', $this->mail_obj->tag);
                        });
    }
}
