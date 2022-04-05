<?php
namespace App\Entity;

use Core\Entity\DefaultEntity;
use JsonSerializable;

final class Categorie extends DefaultEntity implements JsonSerializable{

    // php@8.1
    // private readonly int $id;

    // php@8.0
    private int $id;

    private string $name;

    // public function __invoke()
    // {
    //     return [
    //         'id' => $this->id,
    //         'name' => $this->name
    //     ];
    // }

    /**
     * Get the value of id
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Get the value of name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @param string $name
     *
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->id,
            'name' => $this->name
        ];
    }


}