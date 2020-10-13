<?php

namespace App\Entity;

use App\Repository\CustomerNotesRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=CustomerNotesRepository::class)
 */
class CustomerNotes
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()\NotBlank()
     */
    private $customerListId;

    /**
     * @ORM\Column(type="text")
     */
    private $notes;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCustomerListId(): ?int
    {
        return $this->customerListId;
    }

    public function setCustomerListId(int $customerListId): self
    {
        $this->customerListId = $customerListId;

        return $this;
    }

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function setNotes(string $notes): self
    {
        $this->notes = $notes;

        return $this;
    }
}
