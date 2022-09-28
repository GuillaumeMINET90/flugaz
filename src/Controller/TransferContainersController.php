<?php

namespace App\Controller;

use App\Entity\TransferContainers;
use App\Form\TransferContainersType;
use App\Form\TransferContainerUsedType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\TransferContainersRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/transfer/containers')]
#[IsGranted('ROLE_USER', statusCode: 403, message:('Accès non autorisé.'))]
class TransferContainersController extends AbstractController
{
    #[Route('/_{id<\d+>?1}', name: 'app_transfer_containers_index', methods: ['GET', 'POST'])]
    public function index(Request $request, TransferContainersRepository $transferContainersRepository): Response
    {
        $transferContainers = $transferContainersRepository->findAll();

        $form = $this->createForm(TransferContainerUsedType::class);
        $form->get('user')->setData($this->getUser());
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            dd($form->getViewData());


            return $this->redirectToRoute('app_transfer_containers_index', [], Response::HTTP_SEE_OTHER);
        }
        return $this->renderForm('transfer_containers/index.html.twig', compact('transferContainers', 'form'));
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
