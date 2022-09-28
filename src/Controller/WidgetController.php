<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[IsGranted('ROLE_USER', statusCode: 403, message:('Accès non autorisé.'))]
class WidgetController extends AbstractController
{
    #[Route('/main_menu', name: 'app_menu')]
    public function menuPrincipal(): Response
    {
        return $this->render('widget/menu.html.twig');
    }
    #[Route('/conteneurs', name: 'app_container')]
    public function container(): Response
    {
        return $this->render('widget/containers.html.twig');
    }
}
