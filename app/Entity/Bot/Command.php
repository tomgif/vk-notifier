<?php

namespace App\Entity\Bot;

interface Command
{
    public function execute(): void;
}
