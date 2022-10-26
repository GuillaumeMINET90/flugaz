<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[IsGranted('ROLE_USER')]
class WidgetController extends AbstractController
{
    #[Route('/main_menu', name: 'app_menu')]
    public function menuPrincipal(): Response
    {
        //dd($_COOKIE);
        $param = true;
        $returnIcon = true; 
        return $this->render('widget/menu.html.twig', compact('param','returnIcon'));
    }
    #[Route('/conteneurs', name: 'app_container')]
    public function container(): Response
    {
        return $this->render('widget/containers.html.twig');
    }
}
