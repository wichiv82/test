<?php

namespace AppBundle\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\ChatMessage;
use AppBundle\Entity\Commentaire;
use AppBundle\Entity\Post;
use AppBundle\Entity\Event;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;


class DefaultController extends Controller{
    /**
     * @Route("/home", name="home")
     */
    public function goHome(Request $request){
        return $this->render('home.html.twig',
        array("liste"=>$this->getPost("all"),
        "form_nouveau_post"=> $this->formulaire_nouveau_post($request,"home")->createView()
        ));
    }
    
    /**
     * @Route("/images", name="images")
     */
    public function goImages(Request $request){
        return $this->render('images.html.twig',
        array("liste"=>$this->getPost("Images"),
		"form_nouveau_post"=> $this->formulaire_nouveau_post($request,"images")->createView()
        ));
    }
    
    /**
     * @Route("/musique", name="musique")
     */
    public function goMusique(Request $request){
        return $this->render('musique.html.twig',
        array("liste"=>$this->getPost("Musique"),
		"form_nouveau_post"=> $this->formulaire_nouveau_post($request,"musique")->createView()
        ));
    }
    
    /**
     * @Route("/chat", name="chat")
     */
    public function goChat(Request $request){
        return $this->render('chat.html.twig',
        array("messages"=> $this->readChat(),
        "form"=> $this->formulaire_chat($request)->createView()
        ));
    }
    
    /**
     * @Route("/calendrier", name="calendrier")
     */
    public function goCalendrier(Request $request){
        return $this->render('calendrier.html.twig',
        array("events"=> $this->readEvents(),
		"form"=> $this->formulaire_calendrier($request)->createView()));
    }

	/**
	 * Matches /post/*
	 * @Route("/post/{fichier}", name="page_post")
	 */
	public function goPost($fichier, Request $request){
		return $this->render('post.html.twig',
        array("fichier"=>$fichier,
		"note"=>$this->getNote($fichier),
		"commentaires"=>$this->getCommentaires($fichier),
		"form_commentaire"=>$this->formulaire_commentaire($request,$fichier)->createView()
		));
	}

	public function getNote($fichier){
		$repository = $this ->getDoctrine()->getRepository('AppBundle:Note');
		$query = $repository ->findByPost($fichier);
		$note = 0;
		if (count($query) > 0){
			foreach($query as $etoiles){
				$note = $note + $etoiles->getEtoiles();
			}
			$note = round($note/count($query));
		}else{
			$note = -1;
		}
		return $note;
	}
	
	public function getCommentaires($fichier){
		$repository = $this ->getDoctrine()->getRepository('AppBundle:Commentaire');
		$query = $repository ->findByPost($fichier);
		return $query;
	}
	
	public function getPost($categorie){
		$em = $this->getDoctrine()->getManager();
		$query;
		if ($categorie != "all"){
			$query = $em->createQuery(
				"SELECT p.user_id,p.nom,p.categorie,p.description,p.time
				FROM AppBundle:Post p
				WHERE p.categorie = :c
				ORDER BY p.time DESC"
				)->setParameter("c",$categorie);
		}else{
			$query = $em->createQuery(
				"SELECT p.user_id,p.nom,p.categorie,p.description,p.time
				FROM AppBundle:Post p
				ORDER BY p.time DESC"
				);
			$query->setFirstResult(0);
			$query->setMaxResults(6);
		}
		return $query->getResult();
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
	
	public function formulaire_chat(Request $request){
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
	
	public function postEvent($nom, $description, $username){
		$em = $this->getDoctrine()->getManager();
		
		$event = new Event();
		$event->setUsername($username);
		$event->setDescritpion($description);
		$event->setNom($nom);
		$event->setTime();
		
		$em->persist($event);
		$em->flush();
	}
	
	public function formulaire_calendrier(Request $request){
		$cm = new Event();
		$form = $this->createFormBuilder($cm)
			->add('nom', TextType::class)
			->add('description', TextType::class)
			->add('username', TextType::class)
			->add('Envoyer', SubmitType::class)
			->getForm();
		
		$form->handleRequest($request);
		if ($form->isSubmitted () && $form->isValid()){
			$this->postEvent($form['nom']->getData(),$form['description']->getData(),$form['username']->getData());
			header("Refresh:0");
		}
		return $form;
	}

	public function postCommentaire($post, $user_id, $contenu){
		$em = $this->getDoctrine()->getManager();
		
		$comm = new Commentaire();
		$comm->setPost($post);
		$comm->setUserID($user_id);
		$comm->setContenu($contenu);
		$comm->setTime();
		
		$em->persist($comm);
		$em->flush();
	}
	
	public function formulaire_commentaire(Request $request,$fichier){
		$cm = new Commentaire();
		$form = $this->createFormBuilder($cm)
			->add('user_id', TextType::class)
			->add('contenu', TextType::class)
			->add('Envoyer', SubmitType::class)
			->getForm();
		
		$form->handleRequest($request);
		if ($form->isSubmitted () && $form->isValid()){
			$this->postCommentaire($fichier, $form['user_id']->getData(), $form['contenu']->getData());
			header("Refresh:0");
		}
		return $form;
	}
	
	public function postNouveauPost($user_id, $nom, $categorie,$description){
		$em = $this->getDoctrine()->getManager();
		
		$p = new Post();
		$p->setNom($nom);
		$p->setUserID($user_id);
		$p->setDescription($description);
		$p->setCategorie($categorie);
		$p->setTime();
		
		$em->persist($p);
		$em->flush();
	}
	
	public function formulaire_nouveau_post(Request $request, $pageCategorie){
		$p = new Post();
		$form;
		if ($pageCategorie == "home"){
		$form = $this->createFormBuilder($p)
			->add('user_id', TextType::class)
			->add('nom', FileType::class)
			->add('categorie', ChoiceType::class, array(
    			'choices'  => array(
        		'Images' => 'Images',
        		'Musique' => 'Musique')))
			->add('description',TextType::class)
			->add('Poster', SubmitType::class)
			->getForm();
		}else{
			$form = $this->createFormBuilder($p)
			->add('user_id', TextType::class)
			->add('nom', FileType::class)
			->add('description',TextType::class)
			->add('Poster', SubmitType::class)
			->getForm();
		}

		$form->handleRequest($request);
		if ($form->isSubmitted () && $form->isValid()){
			$extension = explode(".",$form['nom']->getData()->getClientOriginalName())[1];
			
			if ($pageCategorie == "home"){
				$this->postNouveauPost($form['user_id']->getData(), $form['nom']->getData()->getClientOriginalName(),
				$form['categorie']->getData(),$form['description']->getData());
				$form['nom']->getData()->move('./../web',$form['nom']->getData()->getClientOriginalName());
			}else if($pageCategorie == "images" && ($extension == "png" || $extension == "jpg" || $extension == "jpeg")){
				$this->postNouveauPost($form['user_id']->getData(), $form['nom']->getData()->getClientOriginalName(),
				"Images",$form['description']->getData());
				$form['nom']->getData()->move('./../web',$form['nom']->getData()->getClientOriginalName());
			}else if($pageCategorie == "musique" && $extension == "mp3"){
				$this->postNouveauPost($form['user_id']->getData(), $form['nom']->getData()->getClientOriginalName(),
				"Musique",$form['description']->getData());
				$form['nom']->getData()->move('./../web',$form['nom']->getData()->getClientOriginalName());
			}
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
	
	public function readEvents(){
		$em = $this->getDoctrine()->getManager();
		$query = $em->createQuery(
			"SELECT e.nom,e.description,e.time,e.username
			FROM AppBundle:Event e
			ORDER BY e.time");
		$query->setFirstResult(0);
		$query->setMaxResults(29);
		return $query->getResult();					
	}
}









































