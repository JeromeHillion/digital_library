<?php

namespace App\Entity;

use App\Repository\LoanRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LoanRepository::class)
 */
class Loan
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity=Books::class, mappedBy="loan")
     */
    private $book_copy_id;

    /**
     * @ORM\Column(type="date")
     */
    private $date_loan;

    /**
     * @ORM\OneToOne(targetEntity=User::class, inversedBy="loan", cascade={"persist", "remove"})
     */
    private $user_id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $status;

    public function __construct()
    {
        $this->book_copy_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Books[]
     */
    public function getBookCopyId(): Collection
    {
        return $this->book_copy_id;
    }

    public function addBookCopyId(Books $bookCopyId): self
    {
        if (!$this->book_copy_id->contains($bookCopyId)) {
            $this->book_copy_id[] = $bookCopyId;
            $bookCopyId->setLoan($this);
        }

        return $this;
    }

    public function removeBookCopyId(Books $bookCopyId): self
    {
        if ($this->book_copy_id->removeElement($bookCopyId)) {
            // set the owning side to null (unless already changed)
            if ($bookCopyId->getLoan() === $this) {
                $bookCopyId->setLoan(null);
            }
        }

        return $this;
    }

    public function getDateLoan(): ?\DateTimeInterface
    {
        return $this->date_loan;
    }

    public function setDateLoan(\DateTimeInterface $date_loan): self
    {
        $this->date_loan = $date_loan;

        return $this;
    }

    public function getUserId(): ?User
    {
        return $this->user_id;
    }

    public function setUserId(?User $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }
}
