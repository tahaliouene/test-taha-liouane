<?php

namespace App\Entity;

use App\Repository\AuthorRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AuthorRepository::class)]
class Author
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $ida = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIda(): ?int
    {
        return $this->ida;
    }

    public function setIda(int $ida): static
    {
        $this->ida = $ida;

        return $this;
    }
}
