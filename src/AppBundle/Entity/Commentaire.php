<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="commentaire")
 */
class Commentaire{
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
     * @ORM\Column(type="string", length=250)
     */
    private $contenu;

	/**
     * @ORM\Column(type="datetime")
     */
    private $time;

	public function getPost(){
      return $this->post;
    }

	public function getUserID(){
      return $this->user_id;
    }

	public function getContenu(){
      return $this->contenu;
    }
	
	public function getTime(){
      return $this->time;
    }
    
	public function setPost($post){
		$this->post = $post;
	}

	public function setUserID($id){
		$this->user_id = $id;
	}

	public function setContenu($contenu){
		$this->contenu = $contenu;
	}

	public function setTime(){
		$this->time = new \DateTime('now');
	}	
}
