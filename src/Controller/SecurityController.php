<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\SharedProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpClient\Response\ResponseStream;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\Transport\Serialization\SerializerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Context\Normalizer\ObjectNormalizerContextBuilder;

class SecurityController extends AbstractController


{

    public function __construct()
    {
    }
    /**
     * @Route("/api/login", name="login_token", methods={"POST"})
     */
    public function login()
    {
    }

    /**
     * @Route("/logout", name="security_logout")
     *
     */
    public function logout()
    {
    }
    /**
     * @Route("/sharedWithMe/{id}", name="shareWithMe")
     */
    public function shareWithMe(User $user, SharedProductRepository $sharedProductRepository, SerializerInterface $serializer)
    {

        $models = json_encode($sharedProductRepository->findBy(["sharedWith" => $user]));
        return  new JsonResponse($models);
    }
}
