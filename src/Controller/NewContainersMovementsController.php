<?php

namespace App\Controller;

use App\Entity\NewContainersMovements;
use App\Form\NewContainersMovementsType;
use App\Repository\NewContainersRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\NewContainersMovementsRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/new/containers/movements')]
#[IsGranted('ROLE_USER')]
class NewContainersMovementsController extends AbstractController
{
    #[Route('/table_{id<\d+>?1}', name: 'app_new_containers_movements_index', methods: ['GET'])]
    public function index(
        $id, 
        NewContainersRepository $newContainersRepository, 
        NewContainersMovementsRepository $newContainersMovementsRepository
        ): Response
    {
        $container = $newContainersRepository->find($id);
        $new_containers_movements = $newContainersMovementsRepository->findBy(['new_container' => $container]);
        $cont = 'newCont';
        return $this->render('new_containers_movements/index.html.twig', compact('container', 'new_containers_movements', 'cont'));
    }

    #[Route('/new_{id<\d+>?1}', name: 'app_new_containers_movements_new', methods: ['GET', 'POST'])]
    public function new(
        $id, 
        Request $request, 
        NewContainersRepository $newContainersRepository, 
        NewContainersMovementsRepository $newContainersMovementsRepository
        ): Response
    {
        $container = $newContainersRepository->find($id);
        $user = $this->getUser();

        $newContainersMovement = new NewContainersMovements();
        $form = $this->createForm(NewContainersMovementsType::class, $newContainersMovement);
        $form->get('new_container')->setData($container);
        $form->get('technicien')->setData($user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $newContainersMovementsRepository->save($newContainersMovement, true);

            return $this->redirectToRoute('app_new_containers_movements_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('new_containers_movements/new.html.twig', compact('container', 'newContainersMovement', 'form'));
    }

    #[Route('/{id}/edit', name: 'app_new_containers_movements_edit', methods: ['GET', 'POST'])]
    public function edit(
        $id,
        Request $request,
        NewContainersRepository $newContainersRepository,
        NewContainersMovements $newContainersMovement,
        NewContainersMovementsRepository $newContainersMovementsRepository
        ): Response 
    
    {
        $containerId = intval($newContainersMovementsRepository->find($id)->getNewContainer()->getId());
        $container = $newContainersRepository->find($containerId);

        $user = $this->getUser();
        $form = $this->createForm(NewContainersMovementsType::class, $newContainersMovement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $newContainersMovementsRepository->save($newContainersMovement, true);

            return $this->redirectToRoute('app_new_containers_movements_index', ['id' => $id], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('new_containers_movements/edit.html.twig', compact('container', 'newContainersMovement', 'form'));
    }
}