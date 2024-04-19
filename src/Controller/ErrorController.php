<?php 
namespace App\Controller; 
 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController; 
use Symfony\Component\HttpFoundation\Response; 
use Symfony\Component\Routing\Annotation\Route; 
use Symfony\Component\ErrorHandler\Exception\FlattenException; 

class ErrorController extends AbstractController {
     
    #[Route('/error', name: 'error')] 
    public function show(FlattenException $exception) 
    { 
        $message=$exception->getMessage(); 
        return $this->render('Exception/index.html.twig', ['message'=>$message]); 
    } 
} 