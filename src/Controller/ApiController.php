<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class ApiController extends AbstractController
{

    private Security $security;
    private $user;

    
    public function __construct(Security $security)
    {
     $this->security = $security;   
    }

    public function __invoke()
    {
        $this->user = $this->security->getUser();
    }

    #[Route('/api/login', name: 'api_login')]
    public function index(): Response
    {
        
        return  new JsonResponse([$this->user]);
    }
}
