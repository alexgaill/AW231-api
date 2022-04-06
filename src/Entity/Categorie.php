<?php
namespace App\Entity;

use OpenApi\Attributes as OA;
use Core\Entity\DefaultEntity;

#[OA\Schema()]
final class Categorie extends DefaultEntity{

    // php@8.1
    // private readonly int $id;

    // php@8.0
    #[OA\Property(type:"int", property:"id", nullable:false)]
    private int $id;

    #[OA\Property(property:"name", type:"string", nullable:false, maximum:100, example:"Nom de la catégorie")]
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

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name
        ];
    }
}