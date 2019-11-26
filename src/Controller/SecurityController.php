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
        
        // $userArr = $this->getDoctrine()->getRepository(User::class)->findByExampleField($lastUserName);
        // $user = var_dump($userArr);
        // $empolyee = $this->getDoctrine()->getRepository(Employee::class)->find('1');
        
        // $session = $this->get('session');
        // $session->set('Division', $empolyee->getDivision());
        // $session->set('Position', $empolyee->getPosition());
        
        //$_SESSION['lastUserName'] = $lastUserName;

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
