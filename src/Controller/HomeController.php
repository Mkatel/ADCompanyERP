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
        $_SESSION['isAdmin'] = true;
        if ($this->getUser()){
            // get username 
            $username = $this->getUser()->getUsername();
            $_SESSION['username'] = $username;
            $users = $this->getDoctrine()->getRepository(User::class)->findOneBy(array('username' => $username));
            //$users->setEmployeeid(8);
            
            // get isAdmin 
            if ($users->getEmployeeid()){
                $employee = $this->getDoctrine()->getRepository(Employee::class)->find($users->getEmployeeid());
                if ($employee){
                    $division = $employee->getDivision();
                    $position = $employee->getPosition();
                    if ($division && $position){
                        if ($division == "HR" && $positio == "Director"){
                            $_SESSION['isAdmin'] = true;
                        }
                    }
                }
            }
        }
       
        return $this->render('home/index.html.twig');
    }
}