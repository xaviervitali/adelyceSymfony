<?php

namespace App\Controller;

use ApiPlatform\Core\Serializer\Mapping\Factory\ClassMetadataFactory;
use App\Entity\User;
use App\Repository\SharedProductRepository;
use App\Serializer\Normalizer\ModelNormalizer;
use Doctrine\Common\Annotations\AnnotationReader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpClient\Response\ResponseStream;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\AbstractObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

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
}
