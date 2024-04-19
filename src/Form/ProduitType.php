<?php 
namespace App\Form; 
 
use App\Entity\Produit; 
use App\Form\ReferenceType ; 

use Symfony\Component\Form\AbstractType; 
use Symfony\Component\Form\FormBuilderInterface; 
use Symfony\Component\OptionsResolver\OptionsResolver; 
 
use Symfony\Component\Form\Extension\Core\Type\TextType; 
use Symfony\Component\Form\Extension\Core\Type\NumberType;  
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;  
use Symfony\Component\Form\Extension\Core\Type\FileType; 
use Symfony\Component\Form\Extension\Core\Type\CollectionType; 

use App\Form\Type\MyCheckboxType;
 
use Symfony\Component\Form\CallbackTransformer; 
 
class ProduitType extends AbstractType 
{ 
    public function buildForm(FormBuilderInterface $builder, 
array $options) 
    { 
        $builder 
           ->add('nom',TextType::class, 
                 array('label' => 'Nom produit :')) 
           ->add('prix',NumberType::class, 
                 array('label' => 'Prix :')) 
 
            ->add('quantite',NumberType::class, 
                 array('label' =>     'Quantité :')) 
 
            ->add('rupture',MyCheckboxType::class,  
            array('label'=> 'Rupture de stock ?', 
                  'required' => false)) 
 
            ->add('lienImage',FileType::class, 
            array('label' => 'Image :', 
                  'required' => false, 'data_class'=>null, 
                  'empty_data' => 'aucune image'   )) 
 
            ->add('reference',ReferenceType::class,  
                 array('label' =>'Référence du produit', 
                "required"  => false 
            )) 
            ->add('distributeurs',CollectionType::Class, 
                 array('entry_type' => DistributeurType::class, 
                'allow_add' => true, 
                'allow_delete' =>true 
            )); 
 
    } 
    public function configureOptions(OptionsResolver $resolver) 
    { 
        $resolver->setDefaults([ 
            'data_class' => Produit::class, 
        ]); 
    } 
} 