<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\MedicalRequest;

class MedicalRequestUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $medicalRequest;

    public function __construct(MedicalRequest $medicalRequest)
    {
        $this->medicalRequest = $medicalRequest;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('medical-request.' . $this->medicalRequest->patient_id);
    }
}
