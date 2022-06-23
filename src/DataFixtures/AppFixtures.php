<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\BucketList;
use App\Entity\Category;
use App\Entity\Comment;
use App\Entity\Contact;
use App\Entity\Like;
use App\Entity\Product;
use App\Entity\SharedProduct;
use App\Entity\User;
use App\Repository\SharedProductRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Shmop;
use Symfony\Component\Config\Definition\Exception\DuplicateKeyException;
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
            $product->setName("Produit_" . $i);
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


        $this->createMany(SharedProduct::class, 50, function (SharedProduct $sharedProduct) {
            /**
             * @var User $user
             */
            $user = $this->getRandomreference(User::class);
            $product = $this->getRandomreference(Product::class);
            if (!array_filter($user->getBucketList()->toArray(), function ($e) use ($product) {
                return $e->getProduct == $product;
            })) {
                $sharedProduct
                    ->setProduct($product)
                    ->setUser($user);

                if ($this->faker->boolean() && !(array_filter($user->getBucketList()->toArray(), function ($bucket) use ($product) {
                    /**
                     * @var SharedProduct $bucket 
                     */
                    return $bucket->getProduct() == $product;
                }))) {
                    $sharedWith = $this->getRandomreference(User::class);
                    while ($sharedWith === $user) {
                        $sharedWith = $this->getRandomreference(User::class);
                    }
                    if (!(array_filter($sharedWith->getBucketList()->toArray(), function ($bucket) use ($product) {
                        /**
                         * @var SharedProduct $bucket 
                         */
                        return $bucket->getProduct() == $product;
                    }))) {
                        /**
                         * @var User $sharedWith
                         */
                        $sharedProduct->setSharedWith($sharedWith);
                    }
                }
            }
        });
    }

    public function getDependencies()
    {
        return [UserFixtures::class];
    }
}
