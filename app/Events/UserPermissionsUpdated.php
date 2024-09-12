<?php
namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Support\Facades\Log;

class UserPermissionsUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $userId;
    public $permissions;


    public function __construct($userId, $permissions)
    {
        $this->userId = $userId;
        $this->permissions = $permissions;

        // اضف سجل للتأكد من إرسال البيانات
        Log::info("Event fired for user: {$userId}, permissions: " . json_encode($permissions));
    }

    public function broadcastOn()
    {
        return new Channel('user.'.$this->userId);
    }
}
