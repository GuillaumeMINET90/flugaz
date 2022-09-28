<?php

namespace App\Controller;

use App\Entity\TransferContainers;
use App\Form\TransferContainersType;
use App\Repository\TransferContainersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/transfer/containers')]
class TransferContainersController extends AbstractController
{
    #[Route('/', name: 'app_transfer_containers_index', methods: ['GET'])]
    public function index(TransferContainersRepository $transferContainersRepository): Response
    {
        return $this->render('transfer_containers/index.html.twig', [
            'transfer_containers' => $transferContainersRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_transfer_containers_new', methods: ['GET', 'POST'])]
    public function new(Request $request, TransferContainersRepository $transferContainersRepository): Response
    {
        $transferContainer = new TransferContainers();
        $form = $this->createForm(TransferContainersType::class, $transferContainer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $transferContainersRepository->save($transferContainer, true);

            return $this->redirectToRoute('app_transfer_containers_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('transfer_containers/new.html.twig', [
            'transfer_container' => $transferContainer,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_transfer_containers_show', methods: ['GET'])]
    public function show(TransferContainers $transferContainer): Response
    {
        return $this->render('transfer_containers/show.html.twig', [
            'transfer_container' => $transferContainer,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_transfer_containers_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, TransferContainers $transferContainer, TransferContainersRepository $transferContainersRepository): Response
    {
        $form = $this->createForm(TransferContainersType::class, $transferContainer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $transferContainersRepository->save($transferContainer, true);

            return $this->redirectToRoute('app_transfer_containers_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('transfer_containers/edit.html.twig', [
            'transfer_container' => $transferContainer,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_transfer_containers_delete', methods: ['POST'])]
    public function delete(Request $request, TransferContainers $transferContainer, TransferContainersRepository $transferContainersRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$transferContainer->getId(), $request->request->get('_token'))) {
            $transferContainersRepository->remove($transferContainer, true);
        }

        return $this->redirectToRoute('app_transfer_containers_index', [], Response::HTTP_SEE_OTHER);
    }
}
