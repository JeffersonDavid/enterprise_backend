<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\EmailTransaction;

class EmailSent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct( \App\Models\MailNotifications $mailNotification )
    {
        
        $customer_data = $mailNotification->customer_data;

        $customer_transaction = $mailNotification->customer_transaction_data ;


        EmailTransaction::create([
            'mail_to' => $customer_data->email,
            'data' => json_encode(['params' => $customer_transaction->transaction_paramss]),
            'transaction_id' => $customer_transaction->transaction_id
        ]);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
