<?php

namespace App\Modules\Invoices\Accept\Infrastructure\Events;

use Carbon\Carbon;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class InvoiceAccepted
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public Invoice $invoice;
    public Carbon $created_at;

    /**
     * Create a new event instance.
     */
    public function __construct(Invoice $invoice, Carbon $created_at = new Carbon())
    {
        $this->invoice = $invoice;
        $this->created_at = $created_at;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array|\Illuminate\Broadcasting\Channel
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
