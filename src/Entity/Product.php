<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="value", type="string")
 * @ORM\DiscriminatorMap({ "product" = "Product", "book" = "Book", "cd" = "Cd"})
 */
class Product
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
    private $category;

    /**
     * @ORM\Column(type="integer")
     */
    private $stock;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\OneToMany(targetEntity=IsInvolvedIn::class, mappedBy="product")
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

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): self
    {
        $this->stock = $stock;

        return $this;
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
            $isInvolvedIn->setProduct($this);
        }

        return $this;
    }

    public function removeIsInvolvedIn(IsInvolvedIn $isInvolvedIn): self
    {
        if ($this->isInvolvedIns->contains($isInvolvedIn)) {
            $this->isInvolvedIns->removeElement($isInvolvedIn);
            // set the owning side to null (unless already changed)
            if ($isInvolvedIn->getProduct() === $this) {
                $isInvolvedIn->setProduct(null);
            }
        }

        return $this;
    }
}
