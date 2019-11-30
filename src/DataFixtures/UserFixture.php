<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

use Doctrine\DBAL\DBALException;

use App\Entity\Employee;
use App\Entity\User;

class UserFixture extends Fixture
{   
    private $encoder;
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {   
        // seed data
        try {
            // 1) employee: Jimmy
            $insert = $manager->getConnection()->prepare("INSERT INTO employee(first_name, middle_name, last_name, division, position) VALUES (?, ?, ?, ?, ?)");
            $insert->execute(array('Jimmy', '', 'Butler', 'HR', 'Director'));
            $sth = $manager->getConnection()->prepare("SELECT id FROM employee WHERE first_name ='Jimmy'");
            $sth->execute();
            $result = $sth->fetchAll();
            if ($result){
                $employeeid = $result[0]["id"];
                
                // user for Jimmy
                $insert = $manager->getConnection()->prepare("INSERT INTO user(username, `password`, employeeid) VALUES (?, ?, ?)");
                $user = new User();
                $user->setUsername('system');
                $password = $this->encoder->encodePassword($user, '123456');
                $insert->execute(array('test1', $password, $employeeid));
                
                $sth = $manager->getConnection()->prepare("SELECT username, `password`, employeeid FROM user");
                $sth->execute();

                /* Group values by the first column */
                $result = $sth->fetchAll();
            }
            
            // 2) employee: Mary
            $insert = $manager->getConnection()->prepare("INSERT INTO employee(first_name, middle_name, last_name, division, position) VALUES (?, ?, ?, ?, ?)");
            $insert->execute(array('Mary', 'Kate', 'Olsen', 'Fiscal', 'Director'));
            $sth = $manager->getConnection()->prepare("SELECT id FROM employee WHERE first_name ='Mary'");
            $sth->execute();
            $result = $sth->fetchAll();
            if ($result){
                $employeeid = $result[0]["id"];
        
                // user for Mary
                $insert = $manager->getConnection()->prepare("INSERT INTO user(username, `password`, employeeid) VALUES (?, ?, ?)");
                $user = new User();
                $user->setUsername('system');
                $password = $this->encoder->encodePassword($user, '123456');
                $insert->execute(array('test2', $password, $employeeid));
                
                $sth = $manager->getConnection()->prepare("SELECT username, `password`, employeeid FROM user");
                $sth->execute();

                /* Group values by the first column */
                $result = $sth->fetchAll();
                //var_dump($result[0]["employeeid"]);
            }
            
        }
        catch(Exception $e){
            var_dump('error');
        }
    }
}
