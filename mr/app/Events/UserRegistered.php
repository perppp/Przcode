<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;

class UserRegistered
{
    use SerializesModels;

    public $user;

    public function __construct($user)
    {
        $this->user = $user;
    }
}
