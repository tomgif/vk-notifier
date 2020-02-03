<?php

namespace App\Entity\Bot;

class SubscribeCommand extends SubscribingCommand implements Command
{
    /**
     * Executes command from invoker
     */
    public function execute(): void
    {
        $this->subscribing(true);
    }
}
