<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Psr\Log\LoggerInterface;

use App\Entity\Employee;
use App\Entity\User;

class HomeController extends AbstractController
{   
    /**
     * @Route("/", name="home")
     */
    public function index(LoggerInterface $logger)
    {   
        $_SESSION['username'] = "";
        $_SESSION['isAdmin'] = false;
        if ($this->getUser()){
            // get username 
            $username = $this->getUser()->getUsername();
            $_SESSION['username'] = $username;
            $sth = $this->getDoctrine()->getConnection()->prepare("SELECT employeeid FROM user WHERE username = (?)");
            $sth->execute(array($username));
            $result = $sth->fetchAll();
            //var_dump($result[0]["employeeid"]);

            // get isAdmin 
            if ($result){
                $employeeid = $result[0]["employeeid"];
                $employee = $this->getDoctrine()->getRepository(Employee::class)->find($employeeid);
                if ($employee){
                    $division = $employee->getDivision();
                    $position = $employee->getPosition();
                    if ($division && $position){
                        if ($division == "HR" && $position == "Director"){
                            $_SESSION['isAdmin'] = true;
                            //$logger->debug('User in:'.$_SESSION['isAdmin']);
                        }
                    }
                }
            }
        }
        
        return $this->render('home/index.html.twig');
    }
}