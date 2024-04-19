<?php 
namespace App\Form\Type; 
 
use Symfony\Component\OptionsResolver\OptionsResolver; 
 
use Symfony\Component\Form\AbstractType; 
use Symfony\Component\Form\Extension\Core\Type\CheckboxType ; 
class MyCheckboxType extends AbstractType 
{ 
 
 
    public function configureOptions(OptionsResolver $resolver) 
    { 
        $resolver->setDefaults(array( 
            'attr' => array('class'=>'cPerso'), 
            'label_attr'=>array('class'=>'cEtiquette') 
        )); 
    } 
 
   public function getParent() 
    { 
        return CheckboxType::class; 
    } 
 
}  