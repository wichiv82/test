<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="note")
 */
class Note{
	/**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
	 */
    private $id;

	/**
	 * @ORM\Column(type="string", length=100)
	 */
	private $post;

	/**
     * @ORM\Column(type="integer")
     */
    private $user_id;

	/**
     * @ORM\Column(type="integer")
     */
    private $etoiles;

	public function getPost(){
      return $this->post;
    }

	public function getUserID(){
      return $this->user_id;
    }

	public function getEtoiles(){
      return $this->etoiles;
    }

	public function setPost($post){
		$this->post = $post;
	}

	public function setUserID($id){
		$this->user_id = $id;
	}

	public function setEtoiles($etoiles){
		$this->etoiles = $etoiles;
	}
}
