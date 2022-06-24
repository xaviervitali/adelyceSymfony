<?php

namespace App\Controller;

use App\Entity\SharedProduct;
use App\Entity\User;
use App\Repository\SharedProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
class ApiController extends AbstractController
{


    private SharedProductRepository $sharedProductRepository;

    public function __construct(SharedProductRepository $sharedProductRepository)
    {
        $this->sharedProductRepository = $sharedProductRepository;
    }

    public function __invoke(User $data)
    {
        $data = $this->sharedProductRepository->findBy(["sharedWith" => $data]);
        return $data;
    }
}
