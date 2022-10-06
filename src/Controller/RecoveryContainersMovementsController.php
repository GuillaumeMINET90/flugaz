<?php

namespace App\Controller;

use App\Entity\RecoveryContainersMovements;
use App\Form\RecoveryContainersMovementsType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\RecoveryContainersRepository;
use App\Repository\RecoveryContainersMovementsRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/recovery/containers/movements')]
#[IsGranted('ROLE_USER', statusCode: 403, message:('Accès non autorisé.'))]
class RecoveryContainersMovementsController extends AbstractController
{
    #[Route('/table_{id<\d+>?1}', name: 'app_recovery_containers_movements_index', methods: ['GET'])]
    public function index($id, RecoveryContainersRepository $recoveryContainersRepository, RecoveryContainersMovementsRepository $recoveryContainersMovementsRepository): Response
    {
        $container = $recoveryContainersRepository->find($id);
        $recovery_containers_movements = $recoveryContainersMovementsRepository->findBy(['recovery_container' => $container]);
        $cont = 'recoveryCont';
        return $this->render('recovery_containers_movements/index.html.twig', compact('container', 'recovery_containers_movements','cont'));
    }

    #[Route('/new_{id<\d+>?1}', name: 'app_recovery_containers_movements_new', methods: ['GET', 'POST'])]
    public function new($id, Request $request, RecoveryContainersRepository $recoveryContainersRepository, RecoveryContainersMovementsRepository $recoveryContainersMovementsRepository): Response
    {
        $container = $recoveryContainersRepository->find($id);
        $user = $this->getUser();

        $recoveryContainersMovement = new RecoveryContainersMovements();
        $form = $this->createForm(RecoveryContainersMovementsType::class, $recoveryContainersMovement);
        $form->get('recovery_container')->setData($container);
        $form->get('technicien')->setData($user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $recoveryContainersMovementsRepository->save($recoveryContainersMovement, true);

            return $this->redirectToRoute('app_recovery_containers_movements_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('recovery_containers_movements/new.html.twig', compact('container', 'recoveryContainersMovement', 'form'));
    }

    #[Route('/{id}', name: 'app_recovery_containers_movements_show', methods: ['GET'])]
    public function show(RecoveryContainersMovements $recoveryContainersMovement): Response
    {
        return $this->render('recovery_containers_movements/show.html.twig', [
            'recovery_containers_movement' => $recoveryContainersMovement,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_recovery_containers_movements_edit', methods: ['GET', 'POST'])]
    public function edit($id, Request $request, RecoveryContainersRepository $recoveryContainersRepository, RecoveryContainersMovements $recoveryContainersMovement, RecoveryContainersMovementsRepository $recoveryContainersMovementsRepository): Response
    {   
        $containerId = intval($recoveryContainersMovementsRepository->find($id)->getRecoveryContainer()->getId());
        $container = $recoveryContainersRepository->find($containerId);
        //dd($container);
        $user = $this->getUser();
        $form = $this->createForm(RecoveryContainersMovementsType::class, $recoveryContainersMovement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $recoveryContainersMovementsRepository->save($recoveryContainersMovement, true);

            return $this->redirectToRoute('app_recovery_containers_movements_index', ['id' => $id], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('recovery_containers_movements/edit.html.twig', compact('recoveryContainersMovement', 'form', 'container'));
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
