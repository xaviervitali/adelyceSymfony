<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\BucketList;
use App\Entity\Category;
use App\Entity\Comment;
use App\Entity\Contact;
use App\Entity\Like;
use App\Entity\Product;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\String\Slugger\SluggerInterface;

class AppFixtures extends AbstractFixture
{
    protected  $encoder;
    protected  $slug;

    public function __construct(UserPasswordHasherInterface $encoder, SluggerInterface $slug)
    {
        $this->encoder = $encoder;
        $this->slug = $slug;
    }
    public function loadData(ObjectManager $manager)
    {
        $this->createMany(Product::class, 300, function (Product $product, $i) {
          $product->setName("Produit_". $i);
        });


        

        $this->createMany(User::class, 5, function (User $user) {
            $plainPassword = "0000";
            $encodedPassword = $this->encoder->hashPassword($user, $plainPassword);
            $user
            ->setEmail($this->faker->email())
            ->setPassword($encodedPassword)
            ->setFirstName($this->faker->firstname())
            ->setLastName($this->faker->lastname());
   
        });
    }

    public function getDependencies()
    {
        return [UserFixtures::class];
    }
}