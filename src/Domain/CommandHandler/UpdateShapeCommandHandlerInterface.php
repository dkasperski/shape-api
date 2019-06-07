<?php

namespace App\Domain\CommandHandler;

use App\Domain\Command\UpdateShapeCommand;

interface UpdateShapeCommandHandlerInterface
{
    public function __invoke(UpdateShapeCommand $updateShapeCommand);
}