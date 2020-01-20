<?php

namespace App\Entity\Bot;

class Invoker
{
    public function submit(Command $command): void
    {
        $command->execute();
    }
}
