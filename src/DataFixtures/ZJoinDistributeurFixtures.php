<?php 
 
namespace App\DataFixtures; 
 
use App\Entity\Distributeur; 
use App\Entity\Produit; 
use Doctrine\Bundle\FixturesBundle\Fixture; 
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface; 
use Doctrine\Persistence\ObjectManager; 
 
class ZJoinDistributeurFixtures extends Fixture implements 
FixtureGroupInterface 
{ 
 
    public function load(ObjectManager $manager) 
    { 
 
        $repProduit = $manager->getRepository(Produit::class); 
 
            $logitech = new Distributeur; 
            $logitech->setNom('Logitech'); 
 
            $hp = new Distributeur; 
            $hp->setNom('HP'); 
 
 
            $epson = new Distributeur; 
            $epson->setNom('Epson'); 
 
 
            $dell = new Distributeur; 
            $dell->setNom('Dell'); 
 
 
            $acer = new Distributeur; 
            $acer->setNom('Acer'); 
 
 
            // création des jointures 
            $produit = $repProduit->findOneBy(array('nom' => 'souris')); 
            $produit->addDistributeur($hp); 
            $produit->addDistributeur($logitech); 
 
 
            $produit = $repProduit->findOneBy(array('nom' => 'ecran')); 
            $produit->addDistributeur($hp); 
            $produit->addDistributeur($dell); 
 
 
            $produit = $repProduit->findOneBy(array('nom' => 'claviers')); 
            $produit->addDistributeur($hp); 
            $produit->addDistributeur($logitech); 
 
 
            $produit = $repProduit->findOneBy(array('nom' => 'ordinateurs')); 
            $produit->addDistributeur($hp); 
            $produit->addDistributeur($dell); 
            $produit->addDistributeur($acer); 
 
            $produit = $repProduit->findOneBy(array('nom' => 'cartouches')); 
            $produit->addDistributeur($epson); 
 
 
            $produit=$repProduit->findOneBy(array('nom' => 'imprimantes')); 
            $produit->addDistributeur($epson);  
            $produit->addDistributeur($hp); 
 
            $manager->persist($produit); 
 
    // pas besoin du persist($distributeur)grâce au cascade= ‘persist'] 
 
 
        $manager->flush(); 
    } 
 
    public static function getGroups(): array 
    { 
        return ['group3']; 
    } 
} 