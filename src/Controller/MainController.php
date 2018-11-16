<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Libro;
use App\Entity\Autor;
use App\Form\Type\LibroType;
use App\Form\Type\AutorType;

class MainController extends Controller
{
	
	public function index(Request $request)
	{
		//$entityManager = $this->getDoctrine()->getManager();
	$result='OK';		
	//$search=$entityManager->getRepository('App:EBayItem')->findBy();
	
		return $this->render('base.html.twig',array(
				'result' => $result
		));
	
	}
	public function new(Request $request)
    {
		$em=$this->getDoctrine()->getManager();
        $libro = new Libro();

        $form = $this->createForm(LibroType::class, $libro);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
$em->persist($libro);
$em->flush();
		}

        return $this->render('new.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    
}
