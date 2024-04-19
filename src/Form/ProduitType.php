<?php 
namespace App\Form; 
 
use App\Entity\Produit; 
use Symfony\Component\Form\AbstractType; 
use Symfony\Component\Form\FormBuilderInterface; 
use Symfony\Component\OptionsResolver\OptionsResolver; 
 
use Symfony\Component\Form\Extension\Core\Type\TextType; 
use Symfony\Component\Form\Extension\Core\Type\NumberType;  
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;  
use Symfony\Component\Form\Extension\Core\Type\FileType; 
 
use Symfony\Component\Form\CallbackTransformer; 
 
class ProduitType extends AbstractType 
{ 
    public function buildForm(FormBuilderInterface $builder, 
array $options): void 
    { 
        $builder 
            ->add('nom', TextType::class, array('label' => 'Nom produit :')) 
            ->add('prix', NumberType::class, array('label' => 'Prix :')) 
 
            ->add('quantite', NumberType::class, 
                array('label' => 'Quantité :')) 
 
            ->add('rupture', CheckboxType::class, 
                array('label' => 'Rupture de stock ?', 'required' => false)) 
 
            ->add('lienImage', FileType::class, 
                array('label' => 'Image :', 'required' => false, 
'data_class' => null, 
                    'empty_data' => 'aucune image')) 
 
            // ->add('reference') 
            // ->add('distributeurs') 
        ; 
        $builder->get('rupture') 
    ->addModelTransformer(new CallbackTransformer( 
        function ($activeAsString) { 
            // transform the int to boolean 
            return (bool)(int)$activeAsString; 
        }, 
        function ($activeAsBoolean) { 
            // transform the boolean to string 
            return (int)(bool)$activeAsBoolean; 
        } 
    )); 
 
    } 
 
    public function configureOptions(OptionsResolver $resolver): void 
    { 
        $resolver->setDefaults([ 
            'data_class' => Produit::class, 
        ]); 
    } 
} 