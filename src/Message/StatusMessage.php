<?php
namespace App\Message;

use Symfony\Component\Messenger\Attribute\AsMessage;

#[AsMessage(
    transport: 'scheduler_default', // Transport to use
)]
class StatusMessage {
    public function __construct() {
        
    }

    public function getMessage(): string {
        return 'Status message';
    }
}
