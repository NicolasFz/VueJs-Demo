<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class DemoController extends Controller
{
    
    /**
     * @Route("/home", name="home")
     */
    public function home()
    {      
        return $this->render('demo/demo.html.twig',[]);
    }
    
}