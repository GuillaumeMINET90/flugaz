<?php

namespace App\Controller;

use App\Entity\NewContainers;
use App\Form\NewContainersType;
use App\Form\NewContainersEditType;
use App\Repository\NewContainersRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\NewContainersMovementsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/new_containers_stocked')]
class NewContainersController extends AbstractController
{
    #[Route('/', name: 'app_new_containers_index', methods: ['GET'])]
    public function index(NewContainersRepository $newContainersRepository, NewContainersMovementsRepository $newContainersMovementsRepository): Response
    {
        $newContainers = $newContainersRepository->findBy(['return_date' => Null], ['gaz' => 'ASC']);
        $volumeRest = $newContainersMovementsRepository->containersVolumeRest();
        //dd($volumeRest);
        return $this->render('new_containers/index.html.twig', compact('newContainers', 'volumeRest'));
    }

    #[Route('/new', name: 'app_new_containers_new', methods: ['GET', 'POST'])]
    public function new(Request $request, NewContainersRepository $newContainersRepository): Response
    {
        $newContainer = new NewContainers();
        $form = $this->createForm(NewContainersType::class, $newContainer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $newContainersRepository->save($newContainer, true);

            return $this->redirectToRoute('app_new_containers_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('new_containers/new.html.twig', [
            'new_container' => $newContainer,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_new_containers_show', methods: ['GET'])]
    public function show(NewContainers $newContainer): Response
    {
        return $this->render('new_containers/show.html.twig', [
            'new_container' => $newContainer,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_new_containers_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, NewContainers $newContainer, NewContainersRepository $newContainersRepository): Response
    {
        $form = $this->createForm(NewContainersEditType::class, $newContainer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $newContainersRepository->save($newContainer, true);

            return $this->redirectToRoute('app_new_containers_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('new_containers/edit.html.twig', [
            'new_container' => $newContainer,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_new_containers_delete', methods: ['POST'])]
    public function delete(Request $request, NewContainers $newContainer, NewContainersRepository $newContainersRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$newContainer->getId(), $request->request->get('_token'))) {
            $newContainersRepository->remove($newContainer, true);
        }

        return $this->redirectToRoute('app_new_containers_index', [], Response::HTTP_SEE_OTHER);
    }
}