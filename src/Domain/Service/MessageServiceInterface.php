<?php

namespace App\Domain\Service;

use Symfony\Component\Messenger\MessageBusInterface;

interface MessageServiceInterface
{
    /**
     * @param MessageBusInterface $messageBus
     */
    public function __construct(MessageBusInterface $messageBus);
}