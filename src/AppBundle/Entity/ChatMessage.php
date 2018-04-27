<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="chat")
 */
class ChatMessage{
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
    private $username;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $message;

    /**
     * @ORM\Column(type="datetime")
     */
    private $time;
	
    public function getUserName(){
      return $this->username;
    }
    
    public function getMessage(){
      return $this->message;
    }
    
   	public function getTime(){
      return $this->time;
    }

	public function setUserName($username){
		$this->username = $username;
	}

	public function setMessage($message){
		$this->message = $message;
	}

	public function setTime(){
		$this->time = new \DateTime('now');
	}
}
