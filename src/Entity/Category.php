<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: post::class, inversedBy: 'categories')]
    private Collection $post;

    public function __construct()
    {
        $this->post = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, post>
     */
    public function getPost(): Collection
    {
        return $this->post;
    }

    public function addPost(post $post): static
    {
        if (!$this->post->contains($post)) {
            $this->post->add($post);
        }

        return $this;
    }

    public function removePost(post $post): static
    {
        $this->post->removeElement($post);

        return $this;
    }
}
