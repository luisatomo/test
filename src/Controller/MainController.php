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
		$em = $this->getDoctrine()->getManager();
	//$result='OK';		
	$libros=$em->getRepository('App:Libro')->findAll();
	
		return $this->render('base.html.twig',array(
				'libros' => $libros
		));
	
	}

	public function autores(Request $request)
	{
		$em = $this->getDoctrine()->getManager();
	//$result='OK';		
	$autores=$em->getRepository('App:Autor')->findAll();
	
		return $this->render('autores.html.twig',array(
				'autores' => $autores
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
$this->addFlash(
	'notice',
	'El libro ha sido creado'
);
return $this->redirectToRoute('front');

		}

        return $this->render('new.html.twig', array(
            'form' => $form->createView(),
        ));
	}

	public function edit(Request $request, $id)
    {
		$em=$this->getDoctrine()->getManager();
        $libro = $em->getRepository('App:Libro')
		->findOneBy(array('id'=>$id));

        $form = $this->createForm(LibroType::class, $libro);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
$em->persist($libro);
$em->flush();
$this->addFlash(
	'notice',
	'El libro ha sido guardado'
);
return $this->redirectToRoute('front');

		}

        return $this->render('new.html.twig', array(
            'form' => $form->createView(),
        ));
	}

	public function editAutor(Request $request, $id)
    {
		$em=$this->getDoctrine()->getManager();
        $autor = $em->getRepository('App:Autor')
		->findOneBy(array('id'=>$id));

        $form = $this->createForm(AutorType::class, $autor);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
$em->persist($autor);
$em->flush();
$this->addFlash(
	'notice',
	'El autor ha sido guardado'
);
return $this->redirectToRoute('front');

		}

        return $this->render('newAutor.html.twig', array(
            'form' => $form->createView(),
        ));
	}
	
	public function newAutor(Request $request)
    {
		$em=$this->getDoctrine()->getManager();
        $autor = new Autor();

        $form = $this->createForm(AutorType::class, $autor);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
$em->persist($autor);
$em->flush();
$this->addFlash(
	'notice',
	'El autor ha sido creado'
);
return $this->redirectToRoute('front');
		}

        return $this->render('newAutor.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    
}
