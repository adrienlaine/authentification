<?php

namespace App\Entity;

use App\Repository\CreatorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CreatorRepository::class)
 */
class Creator
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastName;

    /**
     * @ORM\Column(type="datetime")
     */
    private $birthDate;

    /**
     * @ORM\Column(type="date")
     */
    private $deathDate;

    /**
     * @ORM\OneToMany(targetEntity=IsInvolvedIn::class, mappedBy="creator")
     */
    private $isInvolvedIns;

    public function __construct()
    {
        $this->isInvolvedIns = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->birthDate;
    }

    public function setBirthDate(\DateTimeInterface $birthDate): self
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    public function getDeathDate(): ?\DateTimeInterface
    {
        return $this->deathDate;
    }

    public function setDeathDate(\DateTimeInterface $deathDate): self
    {
        $this->deathDate = $deathDate;

        return $this;
    }
    
    public function __toString()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * @return Collection|IsInvolvedIn[]
     */
    public function getIsInvolvedIns(): Collection
    {
        return $this->isInvolvedIns;
    }

    public function addIsInvolvedIn(IsInvolvedIn $isInvolvedIn): self
    {
        if (!$this->isInvolvedIns->contains($isInvolvedIn)) {
            $this->isInvolvedIns[] = $isInvolvedIn;
            $isInvolvedIn->setCreator($this);
        }

        return $this;
    }

    public function removeIsInvolvedIn(IsInvolvedIn $isInvolvedIn): self
    {
        if ($this->isInvolvedIns->contains($isInvolvedIn)) {
            $this->isInvolvedIns->removeElement($isInvolvedIn);
            // set the owning side to null (unless already changed)
            if ($isInvolvedIn->getCreator() === $this) {
                $isInvolvedIn->setCreator(null);
            }
        }

        return $this;
    }
}
