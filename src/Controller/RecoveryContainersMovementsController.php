<?php

namespace App\Controller;

use App\Entity\RecoveryContainersMovements;
use App\Form\RecoveryContainersMovementsType;
use App\Repository\RecoveryContainersMovementsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/recovery/containers/movements')]
class RecoveryContainersMovementsController extends AbstractController
{
    #[Route('/', name: 'app_recovery_containers_movements_index', methods: ['GET'])]
    public function index(RecoveryContainersMovementsRepository $recoveryContainersMovementsRepository): Response
    {
        return $this->render('recovery_containers_movements/index.html.twig', [
            'recovery_containers_movements' => $recoveryContainersMovementsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_recovery_containers_movements_new', methods: ['GET', 'POST'])]
    public function new(Request $request, RecoveryContainersMovementsRepository $recoveryContainersMovementsRepository): Response
    {
        $recoveryContainersMovement = new RecoveryContainersMovements();
        $form = $this->createForm(RecoveryContainersMovementsType::class, $recoveryContainersMovement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $recoveryContainersMovementsRepository->save($recoveryContainersMovement, true);

            return $this->redirectToRoute('app_recovery_containers_movements_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('recovery_containers_movements/new.html.twig', [
            'recovery_containers_movement' => $recoveryContainersMovement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_recovery_containers_movements_show', methods: ['GET'])]
    public function show(RecoveryContainersMovements $recoveryContainersMovement): Response
    {
        return $this->render('recovery_containers_movements/show.html.twig', [
            'recovery_containers_movement' => $recoveryContainersMovement,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_recovery_containers_movements_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, RecoveryContainersMovements $recoveryContainersMovement, RecoveryContainersMovementsRepository $recoveryContainersMovementsRepository): Response
    {
        $form = $this->createForm(RecoveryContainersMovementsType::class, $recoveryContainersMovement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $recoveryContainersMovementsRepository->save($recoveryContainersMovement, true);

            return $this->redirectToRoute('app_recovery_containers_movements_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('recovery_containers_movements/edit.html.twig', [
            'recovery_containers_movement' => $recoveryContainersMovement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_recovery_containers_movements_delete', methods: ['POST'])]
    public function delete(Request $request, RecoveryContainersMovements $recoveryContainersMovement, RecoveryContainersMovementsRepository $recoveryContainersMovementsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$recoveryContainersMovement->getId(), $request->request->get('_token'))) {
            $recoveryContainersMovementsRepository->remove($recoveryContainersMovement, true);
        }

        return $this->redirectToRoute('app_recovery_containers_movements_index', [], Response::HTTP_SEE_OTHER);
    }
}
