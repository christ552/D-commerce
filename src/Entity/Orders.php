<?php

namespace App\Entity;

use App\Repository\OrdersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Unique;

#[ORM\Entity(repositoryClass: OrdersRepository::class)]
class Orders
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50, unique: true)] // made a modification by me  'unique: true'
    private ?string $reference = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\ManyToOne(inversedBy: 'orders')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\OneToMany(mappedBy: 'orders', targetEntity: OrdeersDetails::class, orphanRemoval: true)]
    private Collection $ordeersDetails;

    public function __construct()
    {
        $this->ordeersDetails = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): static
    {
        $this->reference = $reference;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, OrdeersDetails>
     */
    public function getOrdeersDetails(): Collection
    {
        return $this->ordeersDetails;
    }

    public function addOrdeersDetail(OrdeersDetails $ordeersDetail): static
    {
        if (!$this->ordeersDetails->contains($ordeersDetail)) {
            $this->ordeersDetails->add($ordeersDetail);
            $ordeersDetail->setOrders($this);
        }

        return $this;
    }

    public function removeOrdeersDetail(OrdeersDetails $ordeersDetail): static
    {
        if ($this->ordeersDetails->removeElement($ordeersDetail)) {
            // set the owning side to null (unless already changed)
            if ($ordeersDetail->getOrders() === $this) {
                $ordeersDetail->setOrders(null);
            }
        }

        return $this;
    }
}
