<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends AbstractController
{
/**
     * @Route("/api/login_token", name="login_token", methods={"POST"})
     */
    public function login_token()
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
