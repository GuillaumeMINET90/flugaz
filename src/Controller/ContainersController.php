<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[IsGranted('ROLE_USER', statusCode: 403, message:('Accès non autorisé.'))]
class ContainersController extends AbstractController
{
    #[Route('/new_containers', name: 'app_new_containers')]
    public function new(): Response
    {
        $containerType = 'neuves';
        $new = 'newContainer';
  
        return $this->render('containers_selection/new_container.html.twig', compact('containerType','new'));
    }
    #[Route('/transfer_containers', name: 'app_transfer_containers')]
    public function transfer(): Response
    {
        $containerType = 'de transfert';
        $new = 'tansferContainer';
        return $this->render('containers_selection/transfer_container.html.twig', compact('containerType', 'new'));
    }
    #[Route('/recovery_containers', name: 'app_recovery_containers')]
    public function recovery(): Response
    {
        $containerType = 'de récup';
        $new = 'recoveryContainer';
        return $this->render('containers_selection/recovery_container.html.twig', compact('containerType', 'new'));
    }
}
