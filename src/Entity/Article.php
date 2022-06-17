<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
#[ApiResource(  normalizationContext: ['groups' => ['read']],
denormalizationContext: ['groups' => ['write']],)]
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups("read")]

    private $name;

    #[ORM\ManyToMany(targetEntity: BucketList::class, mappedBy: 'articles')]
    private $bucketLists;

    public function __construct()
    {
        $this->bucketLists = new ArrayCollection();
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
     * @return Collection<int, BucketList>
     */
    public function getBucketLists(): Collection
    {
        return $this->bucketLists;
    }

    public function addBucketList(BucketList $bucketList): self
    {
        if (!$this->bucketLists->contains($bucketList)) {
            $this->bucketLists[] = $bucketList;
            $bucketList->addArticle($this);
        }

        return $this;
    }

    public function removeBucketList(BucketList $bucketList): self
    {
        if ($this->bucketLists->removeElement($bucketList)) {
            $bucketList->removeArticle($this);
        }

        return $this;
    }
}
