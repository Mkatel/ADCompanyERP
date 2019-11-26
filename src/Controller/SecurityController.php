<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Session\Session;

use App\Entity\User;
use App\Entity\Employee;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="login")
     */
    public function login(Request $request, AuthenticationUtils $utils)
    {   
        $error = $utils->getLastAuthenticationError();
        $lastUserName = $utils->getLastUserName();
        return $this->render('security/login.html.twig', [
            'error' => $error,
            'last_username' => $lastUserName
        ]);
    }
    /**
     * @Route("/logout", name="logout")
     */
    public function logout()
    {
        
    }
}
