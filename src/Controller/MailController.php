<?php 
namespace App\Controller; 
 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController; 
use Symfony\Component\HttpFoundation\Response; 
use Symfony\Component\Mailer\MailerInterface; 
use Symfony\Bridge\Twig\Mime\TemplatedEmail; 
use Symfony\Component\Routing\Annotation\Route; 
 
class MailController extends AbstractController {

    #[Route('/email',name:'email')] 
    public function sendEmail(MailerInterface $mailer): Response { 
        
        $email = (new TemplatedEmail()) 
        ->from('applicationSymfony@symfony.com') 
        ->to('maildestination@gmail.com') 
        ->subject('Hello e-mail de notre Symfony ! ') 
        ->htmlTemplate('mail/email.html.twig'); 
 
        $mailer->send($email); 
        return new Response('Message envoyé'); 
    } 
} 