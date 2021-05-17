<?php

namespace App\Entity;

use App\Entity\Authors;
use App\Entity\Category;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\BooksRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * @ORM\Entity(repositoryClass=BooksRepository::class)
 * @ApiResource
 */
class Books
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("book:read")
     */
    public $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("book:read")
     */
    private $name;

   

    /**
     * @ORM\Column(type="date")
     * @Groups("book:read")
     */
    private $publication;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cover;

    /**
     * @ORM\Column(type="text")
     * @Groups("book:read")
     */
    private $summary;

    /**
     * @ORM\ManyToMany(targetEntity=Authors::class, inversedBy="books", cascade={"persist"})
     */
    private $author;

    /**
     * @ORM\ManyToMany(targetEntity=Category::class, inversedBy="books", cascade={"persist"})
     */
    private $category;

    /**
     * @ORM\ManyToOne(targetEntity=Loan::class, inversedBy="book_copy_id")
     */
    private $loan;

    public function __construct()
    {
        $this->author = new ArrayCollection();
        $this->category = new ArrayCollection();
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

    

    public function getPublication(): ?\DateTimeInterface
    {
        return $this->publication;
    }

    public function setPublication(\DateTimeInterface $publication): self
    {
        $this->publication = $publication;

        return $this;
    }

    public function getCover(): ?string
    {
        return $this->cover;
    }

    public function setCover(string $cover): self
    {
        $this->cover = $cover;

        return $this;
    }

    public function getSummary(): ?string
    {
        return $this->summary;
    }

    public function setSummary(string $summary): self
    {
        $this->summary = $summary;

        return $this;
    }

    /**
     * @return Collection|Authors[]
     */
    public function getAuthor(): Collection
    {
        return $this->author;
    }

    public function addAuthor(Authors $author): self
    {
        if (!$this->author->contains($author)) {
            $this->author[] = $author;
        }

        return $this;
    }

    public function removeAuthor(Authors $author): self
    {
        $this->author->removeElement($author);

        return $this;
    }

    /**
     * @return Collection|Category[]
     */
    public function getCategory(): Collection
    {
        return $this->category;
    }

    public function addCategory(Category $category): self
    {
        if (!$this->category->contains($category)) {
            $this->category[] = $category;
        }

        return $this;
    }

    public function removeCategory(Category $category): self
    {
        $this->category->removeElement($category);

        return $this;
    }

    public function getLoan(): ?Loan
    {
        return $this->loan;
    }

    public function setLoan(?Loan $loan): self
    {
        $this->loan = $loan;

        return $this;
    }
}
