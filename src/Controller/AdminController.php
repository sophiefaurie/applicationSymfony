<?php 
namespace App\Controller; 
 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController; 
use Symfony\Component\HttpFoundation\Response; 
use Symfony\Component\Routing\Annotation\Route; 
use Symfony\Component\HttpFoundation\Request;  
 
use Symfony\Component\Form\Extension\Core\Type\SubmitType;  
use Symfony\Component\Form\Extension\Core\Type\TextType; 
use Symfony\Component\Form\Extension\Core\Type\DateType; 
use Symfony\Component\HttpFoundation\JsonResponse; 

use App\Entity\Produit; 
use App\Form\ProduitType; 
 
class AdminController extends AbstractController 
{   #[Route('/insert', name:'insert')] 
    function insert(Request $request) 
    { 
        $produit=new Produit; 
        $formProduit= $this->createForm(ProduitType::class,$produit); 
 
        $formProduit->add('creer', SubmitType::class, 
                      array('label'=>'Insertion d\'un produit' )); 
 
        if($request->isMethod('post')){ 
 
                return new JsonResponse($request->request->all()); 
            } 
 
            return $this->render('Admin/create.html.twig', 
                    array('my_form'=>$formProduit->createView())); 
    } 
}