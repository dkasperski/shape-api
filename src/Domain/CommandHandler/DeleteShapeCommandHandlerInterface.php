<?php

namespace App\Domain\CommandHandler;

use App\Domain\Command\DeleteShapeCommand;

interface DeleteShapeCommandHandlerInterface
{
    public function __invoke(DeleteShapeCommand $deleteShapeCommand);
}