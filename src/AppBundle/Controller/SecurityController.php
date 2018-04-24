<?php
  namespace AppBundle\Controller;

  use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
  use Symfony\Bundle\FrameworkBundle\Controller\Controller;
  use Symfony\Component\HttpFoundation\Request;
  use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
  use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

  class SecurityController extends Controller{
    /**
      * @Route("/login", name ="login") 
    */
    public function loginAction(Request $request, AuthenticationUtils $authUtils){
	    // get the login error if there is one
	    $error = $authUtils->getLastAuthenticationError();
	
	    // last username entered by the user
	    $lastUsername = $authUtils->getLastUsername();
	
	    return $this->render('security/login.html.twig', array(
		    'last_username' => $lastUsername,
		    'error'=> $error,
	    ));
    }
    
    public function registerAction(UserPasswordEncoderInterface $encoder){
      $user = new AppBundle\Entity\User();
      $plainPassword = 'ryanpass';
      $encoded = $encoder->encodePassword($user, $plainPassword);
      //utilise l’encoder associé à User dans security.yml
      $user->setPassword($encoded);
    }
  }
