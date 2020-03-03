<?php

namespace Javleds\RedspiraApi\Entity;

class Device
{
    /** @var string */
    private $id;

    /** @var string */
    private $description;

    /** @var float */
    private $x;

    /** @var float */
    private $y;

    /** @var string */
    private $sponsor;

    /** @var string */
    private $logo;

    /** @var string */
    private $link;

    /** @var string */
    private $type;

    public function __construct(string $id, string $description, string $x, string $y, string $sponsor, string $logo, string $link, string $type)
    {
        $this->id          = $id;
        $this->description = $description;
        $this->x           = $x;
        $this->y           = $y;
        $this->sponsor     = $sponsor;
        $this->logo        = $logo;
        $this->link        = $link;
        $this->type        = $type;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
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

    public function getX(): float
    {
        return $this->x;
    }

    public function setX(float $x): void
    {
        $this->x = $x;
    }

    public function getY(): float
    {
        return $this->y;
    }

    public function setY(float $y): void
    {
        $this->y = $y;
    }

    public function getSponsor(): string
    {
        return $this->sponsor;
    }

    public function setSponsor(string $sponsor): void
    {
        $this->sponsor = $sponsor;
    }

    public function getLogo(): string
    {
        return $this->logo;
    }

    public function setLogo(string $logo): void
    {
        $this->logo = $logo;
    }

    public function getLink(): string
    {
        return $this->link;
    }

    public function setLink(string $link): void
    {
        $this->link = $link;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }
}
