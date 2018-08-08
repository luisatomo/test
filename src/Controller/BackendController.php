<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Page;
use App\Form\Type\PageType;
use App\Entity\Post;
use App\Form\Type\PostType;
use App\Form\Type\ProjectType;
use App\Entity\Project;
use Symfony\Component\HttpFoundation\File\File;
use App\Form\Type\LoginType;
use App\Entity\User;
use App\Form\Type\UserType;

class BackendController extends Controller
{
    
    public function Pages(){
    	$entityManager = $this->getDoctrine()->getManager();
    	$pages=$entityManager->getRepository('App:Page')->findAll();
    	return $this->render('backend/pages.html.twig',
    			array(
    					'pages'=>$pages
    					
    			));
    }
    
    public function PageAdd(Request $request){
    	$page = new Page();
		
		$form = $this->createForm(PageType::class, $page);
		
		$form->handleRequest($request);
		
		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($page);
			$em->flush();
			 
			return $this->redirect($this->generateUrl('backend_pages'));
		}
		return $this->render('backend/page.html.twig', array(
				'form' => $form->createView(),
				'title' => 'New Page'
		));
    }
    
    public function PageEdit(Request $request,$uuid){
    	$em=$this->getDoctrine()->getManager();
    	$page = $em->getRepository('App:Page')->findOneBy(
    			array(
    			'uuid'=>$uuid		
    			));
    	
		
		$form = $this->createForm(PageType::class, $page);
		
		$form->handleRequest($request);
		
		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($page);
			$em->flush();
			 
			return $this->redirect($this->generateUrl('backend_pages'));
		}
		return $this->render('backend/page.html.twig', array(
				'form' => $form->createView(),
				'title' => 'Editing: '.$page->getPagetitle()
		));
    }
    
    public function Posts(){
    	$entityManager = $this->getDoctrine()->getManager();
    	$posts=$entityManager->getRepository('App:Post')->findAll();
    	return $this->render('backend/posts.html.twig',
    			array(
    					'posts'=>$posts
    						
    			));
    }
    
    public function Messages(){
    	$entityManager = $this->getDoctrine()->getManager();
    	$messages=$entityManager->getRepository('App:Contact')->findAll();
    	return $this->render('backend/contacts.html.twig',
    			array(
    					'messages'=>$messages
    
    			));
    }
    
    public function PostAdd(Request $request){
    	$post = new Post();
    
    	$form = $this->createForm(PostType::class, $post);
    
    	$form->handleRequest($request);
    
    	if ($form->isSubmitted() && $form->isValid()) {
    		$em = $this->getDoctrine()->getManager();
    		$em->persist($post);
    		$em->flush();
    
    		return $this->redirect($this->generateUrl('backend_posts'));
    	}
    	return $this->render('backend/post.html.twig', array(
    			'form' => $form->createView(),
    			'title' => 'New Post'
    	));
    }
    
    public function PostEdit(Request $request,$uuid){
    	$em=$this->getDoctrine()->getManager();
    	$post = $em->getRepository('App:Post')->findOneBy(
    			array(
    					'uuid'=>$uuid
    			));
    	 
    
    	$form = $this->createForm(PostType::class, $post);
    
    	$form->handleRequest($request);
    
    	if ($form->isSubmitted() && $form->isValid()) {
    		$em = $this->getDoctrine()->getManager();
    		$em->persist($post);
    		$em->flush();
    
    		return $this->redirect($this->generateUrl('backend_posts'));
    	}
    	return $this->render('backend/post.html.twig', array(
    			'form' => $form->createView(),
    			'title' => 'Editing '.$post->getTitle()
    	));
    }
    
    public function Projects(){
    	$entityManager = $this->getDoctrine()->getManager();
    	$projects=$entityManager->getRepository('App:Project')->findAll();
    	return $this->render('backend/projects.html.twig',
    			array(
    					'projects'=>$projects
    
    			));
    }
    
    public function ProjectAdd(Request $request){
    	$project = new Project();
    
    	$form = $this->createForm(ProjectType::class, $project);
    
    	$form->handleRequest($request);
    
    	if ($form->isSubmitted() && $form->isValid()) {
    		$em = $this->getDoctrine()->getManager();
    		$em->persist($project);
    		$em->flush();
    
    		return $this->redirect($this->generateUrl('backend_projects'));
    	}
    	return $this->render('backend/project.html.twig', array(
    			'form' => $form->createView(),
    			'title' => 'New Project'
    	));
    }
    
    public function ProjectEdit(Request $request,$uuid){
    	$em=$this->getDoctrine()->getManager();
    	$project = $em->getRepository('App:Project')->findOneBy(
    			array(
    					'uuid'=>$uuid
    			));
    
    
    	$form = $this->createForm(ProjectType::class, $project);
    
    	$form->handleRequest($request);
    	
    
    	if ($form->isSubmitted() && $form->isValid()) {
    		$em = $this->getDoctrine()->getManager();
    		$em->persist($project);
    		$em->flush();
    
    		return $this->redirect($this->generateUrl('backend_projects'));
    	}
    	return $this->render('backend/project.html.twig', array(
    			'form' => $form->createView(),
    			'title' => 'Editing '.$project->getTitle(),
    			'preview' => $project->getPreview()
    	));
    }
    
    public function Users(){
    	$entityManager = $this->getDoctrine()->getManager();
    	$users=$entityManager->getRepository('App:User')->findAll();
    	return $this->render('backend/users.html.twig',
    			array(
    					'users'=>$users
    
    			));
    }
    
    public function UserAdd(Request $request){
    	$user = new User();
    
    	$form = $this->createForm(UserType::class, $user);
    
    	$form->handleRequest($request);
    
    	if ($form->isSubmitted() && $form->isValid()) {
    		$em = $this->getDoctrine()->getManager();
    		$em->persist($user);
    		$em->flush();
    
    		return $this->redirect($this->generateUrl('backend_users'));
    	}
    	return $this->render('backend/user.html.twig', array(
    			'form' => $form->createView(),
    			'title' => 'New User'
    	));
    }
    
    public function UserEdit(Request $request,$uuid){
    	$em=$this->getDoctrine()->getManager();
    	$user = $em->getRepository('App:User')->findOneBy(
    			array(
    					'uuid'=>$uuid
    			));
    
    
    	$form = $this->createForm(UserType::class, $user);
    
    	$form->handleRequest($request);
    	 
    
    	if ($form->isSubmitted() && $form->isValid()) {
    		$em = $this->getDoctrine()->getManager();
    		$em->persist($user);
    		$em->flush();
    
    		return $this->redirect($this->generateUrl('backend_users'));
    	}
    	return $this->render('backend/user.html.twig', array(
    			'form' => $form->createView(),
    			'title' => 'Editing '.$user->getUsername()
    	));
    }
    
    public function index(){
    	
    	return $this->render(
    			'backend.html.twig'
    			);
    }
    
    public function login(){
    	$authenticationUtils = $this->get('security.authentication_utils');
    	// get the login error if there is one
    	$error = $authenticationUtils->getLastAuthenticationError();
    	// last username entered by the user
    	$lastUsername = $authenticationUtils->getLastUsername();
    	$form = $this->createForm(LoginType::class, [
    			'_username' => $lastUsername,
    	]);
    	return $this->render(
            'backend/login.html.twig',
            array(
                'form' => $form->createView(),
                'error' => $error,
            )
);
    }
    
    
    
    public function logout()
    {
    	throw new \Exception('this should not be reached!');
    }
}
