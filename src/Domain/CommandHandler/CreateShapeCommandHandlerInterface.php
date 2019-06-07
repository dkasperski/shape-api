<?php

namespace App\Domain\CommandHandler;

use App\Domain\Command\CreateShapeCommand;

interface CreateShapeCommandHandlerInterface
{
    public function __invoke(CreateShapeCommand $createShapeCommand);
}