<?php

namespace App\Entity\Shape;

use App\Domain\Command\CreateShapeCommand;
use App\Domain\Exception\ShapeNotFoundException;

class ShapeFactory
{
    /**
     * @param CreateShapeCommand $createShapeCommand
     * @return Shape
     */
    public function create(CreateShapeCommand $createShapeCommand) : Shape
    {
        $shapeType = $createShapeCommand->getData()['type'];
        $shapeData = $createShapeCommand->getData()['data'];

        switch ($shapeType)
        {
            case 'triangle':
                return new Triangle($shapeData['a'], $shapeData['b'], $shapeData['c']);

            case 'disc':
                return new Disc($shapeData['r']);

            case 'rectangle':
                return new Rectangle($shapeData['a'], $shapeData['b']);

            default:
                throw new ShapeNotFoundException();
        }
    }
}