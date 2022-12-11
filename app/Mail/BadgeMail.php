<?php

namespace App\Mail;

use App\Models\BadgeSettings;
use App\Models\Member;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BadgeMail extends Mailable
{
    use Queueable, SerializesModels;
    public $member;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Member $member)
    {
        $this->member = $member;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
//        return $this->view('pages.inc.badge-section');
        return $this->markdown('pages.inc.badge-section', [
            'member' => $this->member,
        ]);
    }
}
