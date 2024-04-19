<?php 
 
namespace App\Controller; 
 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController; 
use Symfony\Component\HttpFoundation\Request; 
use Symfony\Component\HttpFoundation\Response; 
use Symfony\Component\HttpFoundation\JsonResponse; 
use Symfony\Component\Routing\Annotation\Route; 
 
use Doctrine\ORM\EntityManagerInterface; 
use App\Entity\Produit; 
use App\Entity\Distributeur;
 
class ListeProduitsController extends AbstractController 
{ 
    #[Route('/liste', name: 'liste')] 
    public function liste(EntityManagerInterface $entityManager) 
    { 
      $produitsrepository=$entityManager->getRepository(Produit::class); 
      $listeproduits=$produitsrepository->findAll(); 
      $lastProduit=$produitsrepository->getLastProduit();
 
        return $this->render('liste_produits/index.html.twig', [ 
            'listeproduits' => $listeproduits, 
            'lastproduit' => $lastProduit 
        ]); 
 
    } 

    #[Route("/distrib",name: "distributeurs")] 
    public function listedistributeur(EntityManagerInterface $entityManager) 
    { 
      $repositoryDistributeurs=$entityManager->getRepository(Distributeur::class); 
      $distributeurs = $repositoryDistributeurs->findAll(); 
   
    return $this->render('liste_produits/distributeurs.html.twig', array( 
           'distributeurs' => $distributeurs)); 
    }

    #[Route("/eager",name: "eager")] 
    public function eager(EntityManagerInterface $entityManager) 
    { 
    $produitsRepository=$entityManager->getRepository(Produit::class); 
    $listeProduits=$produitsRepository->findAll(); 
        return $this->render('liste_produits/eager.html.twig', [ 
            'listeproduits' => $listeProduits, 
 
        ]); 
    } 

} 