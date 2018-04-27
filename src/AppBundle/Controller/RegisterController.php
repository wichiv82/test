<?php
namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegisterController extends Controller{
    /**
     * @Route("/register", name="register")
     */
    public function registerAction(Request $request, UserPasswordEncoderInterface $passwordEncoder){
        $user = new User();
        $form = $this->createFormBuilder($user)
			->add('username', TextType::class)
            ->add('plainPassword', RepeatedType::class, array(
                'type' => PasswordType::class,
                'first_options'  => array('label' => 'Password'),
                'second_options' => array('label' => 'Repeat Password'),
            ))
			->add("S'inscire", SubmitType::class)
			->getForm();
        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
        	try{
		        $user->setUsername($form['username']->getData());
				$user->setplainPassword($form['plainPassword']->getData());
				
				$password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            	$user->setPassword($password);

		        $entityManager = $this->getDoctrine()->getManager();
		        $entityManager->persist($user);
		        $entityManager->flush();     
		        
            }catch(\Doctrine\DBAL\DBALException $e) {
        		$this->get('session')->getFlashBag()->add('error', 'Username déjà pris');
        		return $this->render(
            		'security/register.html.twig',array(
           			 'form' => $form->createView()));
    		}  
    		
    		return $this->redirectToRoute('login');
        }

        return $this->render(
            'security/register.html.twig',array(
            'form' => $form->createView()));
    }
}
