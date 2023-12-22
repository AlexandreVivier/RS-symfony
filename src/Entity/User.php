<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $pseudo = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $last_connexion = null;

    #[ORM\Column]
    private array $roles = [];

    #[ORM\OneToMany(mappedBy: 'author', targetEntity: Post::class)]
    private Collection $posts;

    #[ORM\OneToMany(mappedBy: 'giver', targetEntity: FriendshipRequests::class, orphanRemoval: true)]
    private Collection $friendshipRequests;

    #[ORM\OneToMany(mappedBy: 'reciever', targetEntity: FriendshipRequests::class, orphanRemoval: true)]
    private Collection $requested;

    public function __construct()
    {
        $this->posts = new ArrayCollection();
        $this->friendshipRequests = new ArrayCollection();
        $this->requested = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): static
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

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

    public function getLastConnexion(): ?\DateTimeInterface
    {
        return $this->last_connexion;
    }

    public function setLastConnexion(\DateTimeInterface $last_connexion): static
    {
        $this->last_connexion = $last_connexion;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @return Collection<int, Post>
     */
    public function getPosts(): Collection
    {
        return $this->posts;
    }

    public function addPost(Post $post): static
    {
        if (!$this->posts->contains($post)) {
            $this->posts->add($post);
            $post->setAuthor($this);
        }

        return $this;
    }

    public function removePost(Post $post): static
    {
        if ($this->posts->removeElement($post)) {
            // set the owning side to null (unless already changed)
            if ($post->getAuthor() === $this) {
                $post->setAuthor(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, FriendshipRequests>
     */
    public function getFriendshipRequests(): Collection
    {
        return $this->friendshipRequests;
    }

    public function addFriendshipRequest(FriendshipRequests $friendshipRequest): static
    {
        if (!$this->friendshipRequests->contains($friendshipRequest)) {
            $this->friendshipRequests->add($friendshipRequest);
            $friendshipRequest->setGiver($this);
        }

        return $this;
    }

    public function removeFriendshipRequest(FriendshipRequests $friendshipRequest): static
    {
        if ($this->friendshipRequests->removeElement($friendshipRequest)) {
            // set the owning side to null (unless already changed)
            if ($friendshipRequest->getGiver() === $this) {
                $friendshipRequest->setGiver(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, FriendshipRequests>
     */
    public function getRequested(): Collection
    {
        return $this->requested;
    }

    public function addRequested(FriendshipRequests $requested): static
    {
        if (!$this->requested->contains($requested)) {
            $this->requested->add($requested);
            $requested->setReciever($this);
        }

        return $this;
    }

    public function removeRequested(FriendshipRequests $requested): static
    {
        if ($this->requested->removeElement($requested)) {
            // set the owning side to null (unless already changed)
            if ($requested->getReciever() === $this) {
                $requested->setReciever(null);
            }
        }

        return $this;
    }
}
