<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Element;
use App\Form\ElementType;
use App\Form\SearchType;
use Symfony\Component\HttpFoundation\Request;

class ElementController extends AbstractController
{
    /**
     * @Route("/element", name="element")
     */
    public function index()
    {

        $savedElements = $this->getDoctrine()
        ->getRepository(Element::class)
        ->findAll();
     
        $form = $this->createForm(SearchType::class);
        return $this->render('element/index.html.twig',
             [
                 'saved_elements'=> $savedElements,
                 'search_form' => $form->createView(),
             ]);
    }


    /**
     * @Route("/element/create", name="create_element")
     */
    public function createProduct(): Response
    {
        // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to the action: createProduct(EntityManagerInterface $entityManager)
        $entityManager = $this->getDoctrine()->getManager();

        $element = new Element();
        $element->setName('Demo_Element');
        $element->setValue('TOTO');
        $element->setPower(10);

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($element);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Saved new element with id '.$element->getId());
    }

    /**
     * @Route("/element/new", name="new_element")
     */
    public function new(Request $request)
    {
        // creates a element object
        $element = new Element();
        $form = $this->createForm(ElementType::class, $element);


        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $task = $form->getData();
    
            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
             $entityManager = $this->getDoctrine()->getManager();
             $entityManager->persist($element);
             $entityManager->flush();
    
            return $this->redirectToRoute('new_element');
        }

        return $this->render('element/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /** 
     * @Route("/element/search", name="search_element")
     */
    public function search(Request $request)
    {

        $searchResult = $this->getDoctrine()
        ->getRepository(Element::class)
        ->findByName($request->get('search'));

        $jsonResult = $this->json($searchResult);

        return $jsonResult;
        
    }
}
