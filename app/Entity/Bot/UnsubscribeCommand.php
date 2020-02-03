<?php

namespace App\Entity\Bot;

class UnsubscribeCommand extends SubscribingCommand implements Command
{
    /**
     * Executes command from invoker
     */
    public function execute(): void
    {
        $this->subscribing(false);
    }
}
