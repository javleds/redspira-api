<?php

namespace Javleds\RedspiraApi\Entity;

class Area
{
    /** @var int */
    protected $id;

    /** @var string */
    protected $description;

    /** @var int|null */
    protected $parentId;

    public function __construct(int $id, string $description, int $parentId = null)
    {
        $this->id = $id;
        $this->description = $description;
        $this->parentId = $parentId;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getParentId(): ?int
    {
        return $this->parentId;
    }

    public function setParentId(?int $parentId): void
    {
        $this->parentId = $parentId;
    }
}