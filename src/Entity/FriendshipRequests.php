<?php

namespace App\Entity;

use App\Repository\FriendshipRequestsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FriendshipRequestsRepository::class)]
class FriendshipRequests
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'friendshipRequests')]
    #[ORM\JoinColumn(nullable: false)]
    private ?user $giver = null;

    #[ORM\ManyToOne(inversedBy: 'requested')]
    #[ORM\JoinColumn(nullable: false)]
    private ?user $reciever = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column(length: 255)]
    private ?string $status = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGiver(): ?user
    {
        return $this->giver;
    }

    public function setGiver(?user $giver): static
    {
        $this->giver = $giver;

        return $this;
    }

    public function getReciever(): ?user
    {
        return $this->reciever;
    }

    public function setReciever(?user $reciever): static
    {
        $this->reciever = $reciever;

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

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }

}
