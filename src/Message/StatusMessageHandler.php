<?php
namespace App\Message;


use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler(
    bus: 'messenger.bus.default',
)]
class StatusMessageHandler{

    public function __invoke(StatusMessage $message): void {
        // Handle the message
        // For example, you can log it or perform some action
        echo $message->getMessage();
    }

}
