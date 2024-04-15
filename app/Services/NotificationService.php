<?php

namespace App\Services;

use App\Models\Message;
use App\Models\Notification;

class NotificationService
{
    public static function store($message, $id = null, $title)
    {
        $id = $id ? $id : $message->user_id;
        Notification::firstOrCreate([
            'title' => $title,
            'user_id' => $id,
            'url' => route('themes.show', $message->theme_id . '#' . $message->id)
        ]);
    }
}
