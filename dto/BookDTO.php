<?php

namespace app\dto;

class BookDTO
{
    private string $title;
    private string $description;
    /**
     * @var array<int>
     */
    private array $authors;
    /**
     * @var array<int>
     */
    private array $categories;
    private ?string $img;

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return BookDTO
     */
    public function setTitle(string $title): BookDTO
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return BookDTO
     */
    public function setDescription(string $description): BookDTO
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return array
     */
    public function getAuthors(): array
    {
        return $this->authors;
    }

    /**
     * @param array $authors
     * @return BookDTO
     */
    public function setAuthors(array $authors): BookDTO
    {
        $this->authors = $authors;
        return $this;
    }

    /**
     * @return array
     */
    public function getCategories(): array
    {
        return $this->categories;
    }

    /**
     * @param array $categories
     * @return BookDTO
     */
    public function setCategories(array $categories): BookDTO
    {
        $this->categories = $categories;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getImg(): ?string
    {
        return $this->img;
    }

    /**
     * @param string|null $img
     * @return BookDTO
     */
    public function setImg(?string $img): BookDTO
    {
        $this->img = $img;
        return $this;
    }

    /**
     * @return array{
     *     title: string,
     *     desctiption: string,
     *     authors: array<int>,
     *     categories: array<int>,
     *     img: ?string
     * }
     */
    public function toArray() : array
    {
        return [
            'title'         => $this->getTitle(),
            'description'   => $this->getDescription(),
            'authors'       => $this->getAuthors(),
            'categories'    => $this->getCategories(),
            'img'           => $this->getImg()
        ];
    }
}