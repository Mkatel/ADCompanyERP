<?php

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface, \Serializable
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    
    /**
     * @ORM\Column(type="integer")
     */
    private $employeeid;


    /**
     * @ORM\Column(type="string", length=100, unique=true)
     */
    private $username;
   
    /**
     * @ORM\Column(type="string", length=100)
     */
    private $password;

    
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmployeeid(): ?int
    {
        return $this->employeeid;
    }
    
    public function setEmployeeid(integer $employeeid): self
    {
        $this->employeeid = $employeeid;
        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;
        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    
    

    public function getRoles(){
        return [ 'ROLE_USER'];
    }

    public function getSalt(){}
    public function eraseCredentials(){}

    public function serialize(){
        return serialize([
            $this->id,
            $this->username,
            $this->password
        ]);
    }    

    public function unserialize($string){
        list(
            $this->id,
            $this->username,
            $this->password
        ) = unserialize($string, ['allowed_classes' => false]);
    }
}
