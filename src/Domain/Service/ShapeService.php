<?php

namespace App\Domain\Service;

use App\Domain\Command\CreateShapeCommand;
use App\Domain\Command\UpdateShapeCommand;
use App\Domain\Command\DeleteShapeCommand;
use App\Domain\Exception\ShapeNotFoundException;
use App\Domain\Query\GetShapeListQuery;
use App\Domain\Query\GetShapeQuery;
use App\Repository\View\ShapeListView;
use App\Repository\View\ShapeView;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;

class ShapeService implements MessageServiceInterface
{
    /**
     * @var MessageBusInterface
     */
    private $messageBus;

    /**
     * @param MessageBusInterface $messageBus
     */
    public function __construct(MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
    }

    /**
     * @param string $shape_slug
     * @param int $id
     * @return ShapeView|null
     */
    public function get(string $shape_slug, int $id): ?ShapeView
    {
        $envelope = $this->messageBus->dispatch(new GetShapeQuery($shape_slug, $id));
        /** @var HandledStamp $handledStamp */
        $handledStamp = $envelope->last(HandledStamp::class);
        $shapeView = $handledStamp->getResult();

        if ($shapeView) {
            return $shapeView;
        }
        throw new ShapeNotFoundException();
    }

    /**
     * @param string $shape_slug
     * @return ShapeListView|null
     */
    public function getList(string $shape_slug)
    {
        $envelope = $this->messageBus->dispatch(new GetShapeListQuery($shape_slug));
        /** @var HandledStamp $handledStamp */
        $handledStamp = $envelope->last(HandledStamp::class);
        $shapeListView = $handledStamp->getResult();

        if (count($shapeListView) > 0) {
            return $shapeListView;
        }
        throw new ShapeNotFoundException();
    }

    /**
     * @param string $shape_slug
     * @param int $id
     */
    public function delete(string $shape_slug, int $id)
    {
        $this->messageBus->dispatch(
            new DeleteShapeCommand($shape_slug, $id)
        );
    }

    /**
     * @param array $data
     */
    public function create( array $data)
    {
        $this->messageBus->dispatch(
            new CreateShapeCommand($data)
        );
    }

    /**
     * @param int $id
     * @param array $data
     */
    public function update(int $id, array $data)
    {
        $this->messageBus->dispatch(
            new UpdateShapeCommand($id, $data)
        );
    }
}