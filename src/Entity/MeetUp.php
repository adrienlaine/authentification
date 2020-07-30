<?php

namespace App\Entity;

use App\Repository\MeetUpRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MeetUpRepository::class)
 */
class MeetUp
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="integer")
     */
    private $p_available;

    /**
     * @ORM\OneToMany(targetEntity=Employee::class, mappedBy="organizes")
     */
    private $MeetUp;

    public function __construct()
    {
        $this->MeetUp = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getPAvailable(): ?int
    {
        return $this->p_available;
    }

    public function setPAvailable(int $p_available): self
    {
        $this->p_available = $p_available;

        return $this;
    }

    /**
     * @return Collection|Employee[]
     */
    public function getMeetUp(): Collection
    {
        return $this->MeetUp;
    }

    public function addMeetUp(Employee $meetUp): self
    {
        if (!$this->MeetUp->contains($meetUp)) {
            $this->MeetUp[] = $meetUp;
            $meetUp->setOrganizes($this);
        }

        return $this;
    }

    public function removeMeetUp(Employee $meetUp): self
    {
        if ($this->MeetUp->contains($meetUp)) {
            $this->MeetUp->removeElement($meetUp);
            // set the owning side to null (unless already changed)
            if ($meetUp->getOrganizes() === $this) {
                $meetUp->setOrganizes(null);
            }
        }

        return $this;
    }
}
