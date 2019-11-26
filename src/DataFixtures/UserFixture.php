<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

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
        $user = new User();
        $user->setUsername('kate');
        $password = $this->encoder->encodePassword($user, '123456');
        $user->setPassword($password);
        
        $id = intval("8");
        $user->setEmployeeid($id);
        
        $manager->persist($user);
        $manager->flush();
    }
}
