<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="event")
 */
class Event{
	/**
      * @var int
      *
      * @ORM\Column(name="id", type="integer")
      * @ORM\Id
      * @ORM\GeneratedValue(strategy="AUTO")
    */
    private $id;
	
    /**
     * @ORM\Column(type="string", length=30)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $description;

    /**
     * @ORM\Column(type="datetime")
     */
    private $time;
	
    /**
     * @ORM\Column(type="string", length=30)
     */
    private $username;
	
	public function getNom(){
		return $this->nom;
	}	

    public function getUsername(){
      return $this->username;
    }
    
    public function getDescription(){
      return $this->description;
    }
    
   	public function getTime(){
      return $this->time;
    }

    public function setUsername($username){
      $this->username = $username;
    }

    public function setDescription($description){
      $this->description = $description;
    }
    
    public function setNom($nom){
      $this->nom = $nom;
    }

    public function setTime(){
      $this->time = new \DateTime('now');
    }
}
