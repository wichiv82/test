<?php
  // src/AppBundle/Entity/User.php
  
  namespace AppBundle\Entity;
  use Doctrine\ORM\Mapping as ORM;
  use Symfony\Component\Validator\Constraints as Assert;
  use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
  use Symfony\Component\Security\Core\User\UserInterface;

  /**
  * @ORM\Table(name="app_users")
  * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
  */
  class User implements UserInterface, \Serializable {
    /**
      * @var int
      *
      * @ORM\Column(name="id", type="integer")
      * @ORM\Id
      * @ORM\GeneratedValue(strategy="AUTO")
    */
    private $id;
    
    /**
     * @ORM\Column(type="string", length=30, unique=true)
     * @Assert\NotBlank()
     */
    private $username;
    
    /**
     * @Assert\NotBlank()
     * @Assert\Length(max=4096)
     */
    private $password;
    
    /**
     * @ORM\Column(type="string", length=15)
     * @Assert\NotBlank()
     */
    private $roles;
    
    public function __construct($username, $password, array $roles){
      $this->username = $username;
      $this->password = $password;
      $this->roles = $roles;
    }
    
    
    public function getUserName(){
      return $this->username;
    }
    
    public function getPassWord(){
      return $this->password;
    }
    
    public function getSalt(){
      return null; // salt pas necessary avec encodage crypt
    }
    
    public function getRoles(){
      return $this->roles;
    }
    
    public function eraseCredentials(){
    }
    
    public function serialize(){
      return serialize(array(
        $this->id,
        $this->username,
        $this->password,
        // see section on salt below
        // $this->salt,
      ));
    }
    
    public function unserialize($serialized){
      list (
        $this->id,
        $this->username,
        $this->password,
        // see section on salt below
        // $this->salt
      ) = unserialize($serialized);
    }
  }
