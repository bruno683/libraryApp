<?php

namespace App\Entity;

use App\Repository\BooksRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BooksRepository::class)
 */
class Books
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
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $author;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isAvailable;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $getAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $getBackAt;

    /**
     * @ORM\ManyToOne(targetEntity=Categories::class, inversedBy="books")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categorie;


    

    /**
     * @ORM\Column(type="datetime")
     */
    private $getBackLimit;

    /**
     * @ORM\OneToMany(targetEntity=Images::class, mappedBy="books", cascade={"persist"})
     */
    private $img;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="books")
     */
    private $user;

    

    public function __construct()
    {
        $this->img = new ArrayCollection();
        $this->rentBy = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(string $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getIsAvailable(): ?bool
    {
        return $this->isAvailable;
    }

    public function setIsAvailable(bool $isAvailable): self
    {
        $this->isAvailable = $isAvailable;

        return $this;
    }

    public function getGetAt(): ?\DateTimeInterface
    {
        return $this->getAt;
    }

    public function setGetAt(?\DateTimeInterface $getAt): self
    {
        $this->getAt = $getAt;

        return $this;
    }

    public function getGetBackAt(): ?\DateTimeInterface
    {
        return $this->getBackAt;
    }

    public function setGetBackAt(?\DateTimeInterface $getBackAt): self
    {
        $this->getBackAt = $getBackAt;

        return $this;
    }

    public function getCategorie(): ?Categories
    {
        return $this->categorie;
    }

    public function setCategorie(?Categories $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }


    public function getGetBackLimit(): ?\DateTimeInterface
    {
        return $this->getBackLimit;
    }

    public function setGetBackLimit(\DateTimeInterface $getBackLimit): self
    {
        $this->getBackLimit = $getBackLimit;

        return $this;
    }

    /**
     * @return Collection|Images[]
     */
    public function getImg(): Collection
    {
        return $this->img;
    }

    public function addImg(Images $img): self
    {
        if (!$this->img->contains($img)) {
            $this->img[] = $img;
            $img->setBooks($this);
        }

        return $this;
    }

    public function removeImg(Images $img): self
    {
        if ($this->img->removeElement($img)) {
            // set the owning side to null (unless already changed)
            if ($img->getBooks() === $this) {
                $img->setBooks(null);
            }
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
  
}
