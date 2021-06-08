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
     * @ORM\ManyToMany(targetEntity=Authors::class, inversedBy="books", cascade={"persist", "remove"})
     */
    private $author;


    private $loans;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="books")
     */
    private $category;


    public function __construct()
    {
        $this->author = new ArrayCollection();
        $this->category = new ArrayCollection();
        $this->loans = new ArrayCollection();
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
     * @return Collection|Loan[]
     */
    public function getLoans(): Collection
    {
        return $this->loans;
    }

    public function addLoan(Loan $loan): self
    {
        if (!$this->loans->contains($loan)) {
            $this->loans[] = $loan;
           
        }

        return $this;
    }

    public function removeLoan(Loan $loan): self
    {
        if ($this->loans->removeElement($loan)) {
            
        }

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }


}
