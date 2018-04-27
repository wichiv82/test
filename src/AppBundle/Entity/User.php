<?php 
  namespace AppBundle\Entity;
  use Doctrine\ORM\Mapping as ORM;
  use Symfony\Component\Validator\Constraints as Assert;
  use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
  use Symfony\Component\Security\Core\User\UserInterface;

  /**
  * @ORM\Table(name="app_users")
  * @ORM\Entity()
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
     */
    private $username;
    
    /**
     * @Assert\Length(max=4096)
	 * @Assert\NotBlank()
     */
    private $plainPassword;
    
    /**
    * @ORM\Column(name="password", type="string", length=255)
    */
    private $password;

    public function getUsername(){
      return $this->username;
    }
    
    public function getPlainPassword(){
        return $this->plainPassword;
    }
    
    public function getPassword(){
      return $this->password;
    }
    
    public function getRoles(){
      return array("ROLE_USER");
    }
    
    public function getSalt(){
      return null; // salt pas necessary avec encodage crypt
    }
    
    public function setPlainPassword($password){
        $this->plainPassword = $password;
    }
    
    public function setPassword($password){
        $this->password = $password;
    }
    
    public function setUsername($username){
        $this->username = $username;
    }
    
    public function eraseCredentials(){
    }
    
    public function serialize(){
      return serialize(array(
        $this->id,
        $this->username,
        $this->plainPassword,
        // see section on salt below
        // $this->salt,
      ));
    }
    
    public function unserialize($serialized){
      list (
        $this->id,
        $this->username,
        $this->plainPassword,
        // see section on salt below
        // $this->salt
      ) = unserialize($serialized);
    }
  }
