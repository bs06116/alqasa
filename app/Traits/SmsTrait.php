<?php

namespace App\Traits;

use Plivo\RestClient;

trait SmsTrait
{
    public function sendSMS($phone, $message)
    {
        $fromnum = '+201062501779';
        $client = new RestClient("MAZGY3ZJC0OTQXNTJMYJ", "NjljOWU1ODk4NTgzNzRiYmJjYzU3MWVjNmVjNjZm");
        $message_created = $client->messages->create(
            $fromnum,
            [$phone],
            $message
        );
    }
}
