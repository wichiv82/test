<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\ChatMessage;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class DefaultController extends Controller{
    /**
     * @Route("/home", name="home")
     */
    public function goHome(Request $request){
        return $this->render('home.html.twig',
        array("messages"=> $this->readChat(),
        "form"=> $this->formulaire($request)->createView()));
    }
    
    /**
     * @Route("/images", name="images")
     */
    public function goImages(Request $request){
        return $this->render('images.html.twig',
        array("messages"=> $this->readChat(),
        "form"=> $this->formulaire($request)->createView()));
    }
    
    /**
     * @Route("/musique", name="musique")
     */
    public function goMusique(Request $request){
        return $this->render('musique.html.twig',
        array("messages"=> $this->readChat(),
        "form"=> $this->formulaire($request)->createView()));
    }
	
	public function postMessage($user, $contenu){
		$em = $this->getDoctrine()->getManager();
		
		$message = new ChatMessage();
		$message->setUserName($user);
		$message->setMessage($contenu);
		$message->setTime();
		
		$em->persist($message);
		$em->flush();
	}

	public function formulaire(Request $request){
		$cm = new ChatMessage();
		$form = $this->createFormBuilder($cm)
			->add('username', TextType::class)
			->add('message', TextType::class)
			->add('Envoyer', SubmitType::class)
			->getForm();
		
		$form->handleRequest($request);
		if ($form->isSubmitted () && $form->isValid()){
			$this->postMessage($form['username']->getData(),$form['message']->getData());
			header("Refresh:0");
		}
		return $form;
	}

	public function readChat(){
		$em = $this->getDoctrine()->getManager();
		$query = $em->createQuery(
			"SELECT p.username,p.message,p.time
			FROM AppBundle:ChatMessage p
			ORDER BY p.time");
		$query->setFirstResult(0);
		$query->setMaxResults(29);
		return $query->getResult();					
	}
	
}









































