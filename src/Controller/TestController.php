<?php 
namespace App\Controller; 
 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController; 
use Symfony\Component\HttpFoundation\Response; 
use Symfony\Component\HttpFoundation\Request; 
use Symfony\Component\Routing\Annotation\Route; 
 
class TestController extends AbstractController 
{ 
    #[Route('/test', name: 'app_test',methods: ['GET', 'HEAD'] )] 
    public function index(Request $request): Response 
    { 
        return $this->render('test/index.html.twig');  
    } 
 
    #[Route('/hello/{age}/{nom}/{prenom}', name: 'hello', 
requirements: ["nom"=>"[a-z]{2,50}"])] 
    public function hello(Request $request, int $age, $nom, $prenom='') 
    { 
        return $this->render('test/hello.html.twig', [ 
            'nom' => $nom, 
            'prenom' => $prenom, 
            'age' => $age, 
        ]); 
    } 
} 