<?php 
namespace App\Validator; 
use Symfony\Component\Validator\Constraint; 
 
#[\Attribute] 
class Antispam extends Constraint 
{ 
    public $message="Votre champ est trop court"; 
}  
