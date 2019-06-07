<?php

namespace App\Domain\Command;

class UpdateShapeCommand
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var array
     */
    private $data;

    /**
     * @param string $id
     * @param array $data
     */
    public function __construct(string $id, array $data)
    {
        $this->id = $id;
        $this->data = $data;
    }

    /**
     * @return string
     */
    public function getId() : string
    {
        return $this->id;
    }

    /**
     * @return array
     */
    public function getData() : array
    {
        return $this->data;
    }
}