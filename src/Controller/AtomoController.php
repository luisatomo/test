<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Contact;
use App\Form\Type\ContactType;

class AtomoController extends Controller
{
    public function index(Request $request,$route='home')
    {
    	$entityManager = $this->getDoctrine()->getManager();
        $latposts=$entityManager->getRepository('App:Post')->findBy(
        		array('published' => true),
        		array('cdate' => 'DESC'),
        		3,
        		0
        		);
        $page=$entityManager
        		->getRepository('App:Page')
        		->findOneBy(
        				array(
        						'route'=>$route
        						
        				));
        if (!$page) {
        	throw $this->createNotFoundException('The page does not exist');
        }

        return $this->render('base.html.twig',array(
        		'page' => $page,
        		'latposts'=>$latposts
        ));

    }
    
    public function post(Request $request, $route)
    {
    	$entityManager = $this->getDoctrine()->getManager();
    	$latposts=$entityManager->getRepository('App:Post')->findBy(
    			array('published' => true),
    			array('cdate' => 'DESC'),
    			3,
    			0
    			);
    	$post=$entityManager
    	->getRepository('App:Post')
    	->findOneBy(
    			array(
    					'route'=>$route
    
    			));
    	if (!$post) {
    		throw $this->createNotFoundException('The post does not exist');
    	}
    
    	return $this->render('base.html.twig',array(
    			'page' => $post,
    			'latposts'=>$latposts
    	));
    
    }
    
    public function projects(Request $request){
    	$entityManager = $this->getDoctrine()->getManager();
    	$latposts=$entityManager->getRepository('App:Post')->findBy(
    			array('published' => true),
    			array('cdate' => 'DESC'),
    			3,
    			0
    			);
    	$projects=$entityManager->getRepository('App:Project')->findBy(
    			array(), array('id' => 'DESC')
    			);
    	$page=array(
    			'title'=>'My Projects',
    			'meta'=>'atomoweb, luisatomo, projects, project, symfony',
    			'description' => 'Projects completed by Luis Mendoza'
    	);
    	return $this->render('projects.html.twig',array(
    			'page'=>$page,
    			'projects' => $projects,
    			'latposts'=>$latposts
    	));
    }
    
    public function blog(Request $request){
    	$entityManager = $this->getDoctrine()->getManager();
    	$latposts=$entityManager->getRepository('App:Post')->findBy(
    			array('published' => true),
    			array('cdate' => 'DESC'),
    			3,
    			0
    			);
    	$projects=$entityManager->getRepository('App:Post')->findAll();
    	$page=array(
    			'title'=>'Blog',
    			'meta'=>'atomoweb, luisatomo, blog, post, symfony',
    			'description' => 'Blog'
    	);
    	return $this->render('blog.html.twig',array(
    			'page'=>$page,
    			'projects' => $projects,
    			'latposts'=>$latposts
    	));
    }
    
    public function project(Request $request, $route)
    {
    	$entityManager = $this->getDoctrine()->getManager();
    	$latposts=$entityManager->getRepository('App:Post')->findBy(
    			array('published' => true),
    			array('cdate' => 'DESC'),
    			3,
    			0
    			);
    	$post=$entityManager
    	->getRepository('App:Project')
    	->findOneBy(
    			array(
    					'route'=>$route
    
    			));
    	if (!$post) {
    		throw $this->createNotFoundException('The project does not exist');
    	}
    
    	return $this->render('project.html.twig',array(
    			'page' => $post,
    			'latposts'=>$latposts
    	));
    
    }
    
    public function Contact(Request $request){
    	$contact = new Contact();
    
    	$form = $this->createForm(ContactType::class, $contact);
    
    	$form->handleRequest($request);
    
    	if ($form->isSubmitted() && $form->isValid()) {
    		$em = $this->getDoctrine()->getManager();
    		$em->persist($contact);
    		$em->flush();
    		$request->getSession()->getFlashBag ()->set(
    				'success', 'Thank You! Your message has been submitted, I will contact you as soon as possible.'
    				);
    		return $this->redirect($this->generateUrl('contact'));
    	}
    	$entityManager = $this->getDoctrine()->getManager();
    	$latposts=$entityManager->getRepository('App:Post')->findBy(
    			array('published' => true),
    			array('cdate' => 'DESC'),
    			3,
    			0
    			);
    	return $this->render('contact.html.twig', array(
    			'form' => $form->createView(),
    			'title' => 'Contact Me',
    			'latposts'=>$latposts
    	));
    }
    
}
