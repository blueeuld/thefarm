<?php

class MessageApi {

    public function save_message($messageData) {
        $message = new \TheFarm\Models\Message();
        $message->fromArray($messageData);
        $message->save();
        return $message->toArray();
    }

    public function sendMessage($message, $to) {
        return $this->save_message([
            'Message' => $message,
            'Receiver' => $to,
            'DateSent' => date('c', now()),
            'Sender' => get_current_user_id(),
        ]);
    }

}