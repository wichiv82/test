<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="post")
 */
class Post{
	/**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
	 */
    private $id;

	/**
     * @ORM\Column(type="integer")
     */
    private $user_id;

	/**
	 * @ORM\Column(type="string", length=100, unique=true)
	 */
	private $nom;

	/**
     * @ORM\Column(type="string", length=30)
     */
    private $categorie;

	/**
     * @ORM\Column(type="string", length=250)
     */
    private $description;

	/**
     * @ORM\Column(type="datetime")
     */
    private $time;


	public function getUserID(){
      return $this->user_id;
    }

	public function getNom(){
    	return $this->nom;
    }

	public function getCategorie(){
		return $this->categorie;
	}

	public function getDescription(){
      return $this->description;
    }

	public function getPost(){
      return $this->post;
    }
	
	public function getTime(){
      return $this->time;
    }
    
	public function setUserID($id){
		$this->user_id = $id;
	}

	public function setNom($nom){
		$this->nom = $nom;
	}

	public function setDescription($description){
		$this->description = $description;
	}

	public function setCategorie($categorie){
		$this->categorie = $categorie;
	}

	public function setTime(){
		$this->time = new \DateTime('now');
	}
}
