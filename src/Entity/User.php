<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[ApiResource(normalizationContext: ['groups' => ['read']])]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;
    #[Groups("read")]

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    private $email;
    #[Groups("read")]

    #[ORM\Column(type: 'json')]
    private $roles = [];

    #[ORM\Column(type: 'string')]
    private $password;


    #[Groups("read")]
    #[ORM\Column(type: 'string', length: 255)]
    private $firstName;

    #[Groups("read")]
    #[ORM\Column(type: 'string', length: 255)]
    private $lastName;

    #[Groups("read")]
    #[ORM\OneToMany(mappedBy: 'user', targetEntity: SharedProduct::class,  cascade: ["persist", "remove"])]
    private $bucketList;

    #[Groups("read")]
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $gender;


    #[ORM\OneToMany(mappedBy: 'sharedWith', targetEntity: SharedProduct::class)]
    private $sharedProducts;



    public function __construct()
    {
        $this->bucketList = new ArrayCollection();
        $this->sharedProducts = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
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
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    /**
     * @return Collection<int, SharedProduct>
     */
    public function getBucketList(): Collection
    {
        return $this->bucketList;
    }

    public function addBucketList(SharedProduct $bucketList): self
    {
        if (!$this->bucketList->contains($bucketList)) {
            $this->bucketList[] = $bucketList;
            $bucketList->setUser($this);
        }

        return $this;
    }

    public function removeBucketList(SharedProduct $bucketList): self
    {
        if ($this->bucketList->removeElement($bucketList)) {
            // set the owning side to null (unless already changed)
            if ($bucketList->getUser() === $this) {
                $bucketList->setUser(null);
            }
        }

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(?string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * @return Collection<int, SharedProduct>
     */
    public function getSharedProducts(): Collection
    {
        return $this->sharedProducts;
    }

    public function addSharedProduct(SharedProduct $sharedProduct): self
    {
        if (!$this->sharedProducts->contains($sharedProduct)) {
            $this->sharedProducts[] = $sharedProduct;
            $sharedProduct->setSharedWith($this);
        }

        return $this;
    }

    public function removeSharedProduct(SharedProduct $sharedProduct): self
    {
        if ($this->sharedProducts->removeElement($sharedProduct)) {
            // set the owning side to null (unless already changed)
            if ($sharedProduct->getSharedWith() === $this) {
                $sharedProduct->setSharedWith(null);
            }
        }

        return $this;
    }
}
