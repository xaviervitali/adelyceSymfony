<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\SharedProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: SharedProductRepository::class)]
#[ApiResource()]
class SharedProduct
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups("read")]
    private $id;


    // #[Groups("read")]


    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'bucketList')]
    private $user;

    #[Groups("read")]
    #[ORM\ManyToOne(targetEntity: Product::class, inversedBy: 'sharedProduct')]
    private $product;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'sharedProducts')]
    private $sharedWith;



    public function getId(): ?int
    {
        return $this->id;
    }





    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }

    public function getSharedWith(): ?User
    {
        return $this->sharedWith;
    }

    public function setSharedWith(?User $sharedWith): self
    {
        $this->sharedWith = $sharedWith;

        return $this;
    }
}
