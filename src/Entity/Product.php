<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
#[ApiResource()]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups("read", "product")]
    private $id;

    #[Groups("read", "product")]
    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\ManyToMany(targetEntity: SharedProduct::class)]
    private $sharedProduct;

    public function __construct()
    {
        $this->sharedProduct = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, sharedProduct>
     */
    public function getSharedProduct(): Collection
    {
        return $this->sharedProduct;
    }

    public function addSharedProduct(SharedProduct $sharedProduct): self
    {
        if (!$this->sharedProduct->contains($sharedProduct)) {
            $this->sharedProduct[] = $sharedProduct;
        }

        return $this;
    }

    public function removeSharedProduct(SharedProduct $sharedProduct): self
    {
        $this->sharedProduct->removeElement($sharedProduct);

        return $this;
    }
}
