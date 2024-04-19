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

use Doctrine\ORM\EntityManagerInterface;
 
class AdminController extends AbstractController {

    #[Route('/insert', name:'insert')] 

    // INSERER UN PRODUIT
    function insert(Request $request, EntityManagerInterface $entityManager) { 
        
        $produit = new Produit; 
        $formProduit = $this->createForm(ProduitType::class, $produit); 
        $formProduit->add('creer', SubmitType::class, array('label' => 'Insertion d\'un produit')); 
        $formProduit->handleRequest($request); 
 
        if ($request->isMethod('post') && $formProduit->isValid()) { 
    
            $file = $formProduit['lienImage']->getData(); 
    
            if (!is_string($file)) { 
                $filename = $file->getClientOriginalName(); 
                $file->move($this->getParameter('images_directory'), $filename); 
                $produit->setLienImage($filename);
            } 

            else { 
                $session = $request->getSession(); 
                $session->getFlashBag()->add('message', 'Vous devez choisir une image pour le produit'); 
                $session->set('statut', 'danger'); 
    
                return $this->redirect($this->generateUrl('insert')); 
            } 

            $entityManager->persist($produit); 
 
            $entityManager->flush(); 

            $session=$request->getSession(); 
            $session->getFlashBag()->add('message','un nouveau produit a été ajouté'); 
            $session->set('statut','success'); 

            return $this->redirect($this->generateUrl('liste')); 
        }

        return $this->render('Admin/create.html.twig', array('my_form'=>$formProduit->createView())); 
    }
    
    #[Route('/update', name:'update')] 

    // METTRE A JOUR UN PRODUIT
    function update(Request $request, $id,EntityManagerInterface $entityManager) { 
    
        $produitRepository=$entityManager->getRepository(Produit::class); 
        $produit=$produitRepository->find($id); 
        $img=$produit->getLienImage(); 
        $formProduit= $this->createForm(ProduitType::class,$produit);
    
        $formProduit->add('creer', SubmitType::class,array('label'=>'Mise à jour d\'un produit')); 
        $formProduit->handleRequest($request); 
    
        if($request->isMethod('post') && $formProduit->isValid() ) {  

            $file = $formProduit['lienImage']->getData(); 
    
            if(!is_string($file)) { 
                $filename=$file->getClientOriginalName(); 
                $file->move($this->getParameter('images_directory'), $filename);  
                $produit->setLienImage($filename); 
            } 
                
            else { 
                $produit->setLienImage($img); 
            }

            $entityManager->persist($produit); 

            $entityManager->flush(); 

            $session=$request->getSession(); 
            $session->getFlashBag()->add('message', 'Le produit a été mis à jour'); 
            $session->set('statut','success'); 

            return $this->redirect($this->generateUrl('liste')); 
        }

        return $this->render('Admin/create.html.twig', array('my_form'=>$formProduit->createView())); 
    } 

    #[Route("/delete/{id}", name:"delete")] 
    public function delete(Request $request,$id) 
    { 
 
    } 

}