<?php
namespace App\Entity;

use Core\Entity\DefaultEntity;

class Article extends DefaultEntity {

    private readonly int $id;

    private string $title;

    private string $content;

    private int $categorie_id;

    private int $user_id;

    private string|null $picture;

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of title
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @param string $title
     *
     * @return self
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of content
     *
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * Set the value of content
     *
     * @param string $content
     *
     * @return self
     */
    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get the value of categorie_id
     *
     * @return int
     */
    public function getCategorieId(): int
    {
        return $this->categorie_id;
    }

    /**
     * Set the value of categorie_id
     *
     * @param int $categorie_id
     *
     * @return self
     */
    public function setCategorieId(int $categorie_id): self
    {
        $this->categorie_id = $categorie_id;

        return $this;
    }

    /**
     * Get the value of user_id
     *
     * @return int
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }

    /**
     * Set the value of user_id
     *
     * @param int $user_id
     *
     * @return self
     */
    public function setUserId(int $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    /**
     * Get the value of picture
     *
     * @return string|null
     */
    public function getPicture(): string
    {
        return $this->picture;
    }

    /**
     * Set the value of picture
     *
     * @param string $picture
     *
     * @return self
     */
    public function setPicture(string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function JsonSerialize(): array
    {
        return [
            "id" => $this->id,
            "title" => $this->title,
            "content" => $this->content,
            "categorieId" => $this->categorie_id,
            "userId" => $this->user_id,
            "picture" => $this->picture
        ];
    }
}