<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

// #[IsGranted('ROLE_USER', statusCode: 403, message:('Accès non autorisé.'))]
class ContainersController extends AbstractController
{
    #[Route('/new_containers', name: 'app_new_containers')]
    public function new(): Response
    {
        $containerType = 'neuves';
        $path = 'app_new_containers_index';
        return $this->render('containers/index.html.twig', compact('containerType', 'path'));
    }
    #[Route('/transfer_containers', name: 'app_transfer_containers')]
    public function transfer(): Response
    {
        $containerType = 'de transfert';
        $path = '';
        return $this->render('containers/index.html.twig', compact('containerType', 'path'));
    }
    #[Route('/recovery_containers', name: 'app_recovery_containers')]
    public function recovery(): Response
    {
        $containerType = 'de récup';
        $path = '';
        return $this->render('containers/index.html.twig', compact('containerType', 'path'));
    }
}
