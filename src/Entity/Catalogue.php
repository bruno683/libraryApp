<?php

namespace App\Entity;

use App\Repository\CatalogueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CatalogueRepository::class)
 */
class Catalogue
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity=Books::class, mappedBy="catalogue")
     */
    private $bookList;

    public function __construct()
    {
        $this->bookList = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Books[]
     */
    public function getBookList(): Collection
    {
        return $this->bookList;
    }

    public function addBookList(Books $bookList): self
    {
        if (!$this->bookList->contains($bookList)) {
            $this->bookList[] = $bookList;
            $bookList->setCatalogue($this);
        }

        return $this;
    }

    public function removeBookList(Books $bookList): self
    {
        if ($this->bookList->removeElement($bookList)) {
            // set the owning side to null (unless already changed)
            if ($bookList->getCatalogue() === $this) {
                $bookList->setCatalogue(null);
            }
        }

        return $this;
    }
}
