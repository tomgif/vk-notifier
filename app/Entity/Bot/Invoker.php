<?php

namespace App\Entity\Bot;

class Invoker
{
    /**
     * Command executor
     * @param Command $command
     */
    public function submit(Command $command): void
    {
        $command->execute();
    }
}
