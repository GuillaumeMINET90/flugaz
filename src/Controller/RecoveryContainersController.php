<?php

namespace App\Controller;

use App\Entity\RecoveryContainers;
use App\Form\RecoveryContainersType;
use App\Form\RecoveryContainersEditType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\RecoveryContainersRepository;
use App\Repository\RecoveryContainersMovementsRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/recovery/containers')]
#[IsGranted('ROLE_USER')]
class RecoveryContainersController extends AbstractController
{
    #[Route('/', name: 'app_recovery_containers_index', methods: ['GET'])]
    public function index(
        RecoveryContainersRepository $recoveryContainersRepository, 
        RecoveryContainersMovementsRepository $recoveryContainersMovementsRepository
        ): Response
    {
        $recoveryContainers = $recoveryContainersRepository->findBy(['return_date' => Null], ['gaz' => 'ASC']);
        $volumeRecovered = $recoveryContainersMovementsRepository->containersVolumeRecover();
        $new = 'recoveryContainer';
        return $this->render('recovery_containers/index.html.twig', compact('recoveryContainers','volumeRecovered','new'));
    }

    #[Route('/new', name: 'app_recovery_containers_new', methods: ['GET', 'POST'])]
    public function new(Request $request, RecoveryContainersRepository $recoveryContainersRepository): Response
    {
        $recoveryContainer = new RecoveryContainers();
        $form = $this->createForm(RecoveryContainersType::class, $recoveryContainer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $recoveryContainersRepository->save($recoveryContainer, true);

            return $this->redirectToRoute('app_recovery_containers_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('recovery_containers/new.html.twig',compact('recoveryContainer', 'form'));
    }

    #[Route('/{id}/edit', name: 'app_recovery_containers_edit', methods: ['GET', 'POST'])]
    public function edit(
        Request $request, 
        RecoveryContainers $recoveryContainer, 
        RecoveryContainersRepository $recoveryContainersRepository): Response
    {
        $form = $this->createForm(RecoveryContainersEditType::class, $recoveryContainer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $recoveryContainersRepository->save($recoveryContainer, true);

            return $this->redirectToRoute('app_recovery_containers_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('recovery_containers/edit.html.twig',compact('recoveryContainer', 'form') );
    }

}
