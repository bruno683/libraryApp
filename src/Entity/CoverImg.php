<?php

namespace App\Entity;

use App\Repository\CoverImgRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CoverImgRepository::class)
 */
class CoverImg
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Books::class, mappedBy="img")
     */
    private $book;

    public function __construct()
    {
        $this->book = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Books[]
     */
    public function getBook(): Collection
    {
        return $this->book;
    }

    public function addBook(Books $book): self
    {
        if (!$this->book->contains($book)) {
            $this->book[] = $book;
            $book->setImg($this);
        }

        return $this;
    }

    public function removeBook(Books $book): self
    {
        if ($this->book->removeElement($book)) {
            // set the owning side to null (unless already changed)
            if ($book->getImg() === $this) {
                $book->setImg(null);
            }
        }

        return $this;
    }
}
