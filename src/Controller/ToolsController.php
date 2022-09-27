<?php

namespace App\Controller;

use App\Entity\Tools;
use App\Form\ToolsType;
use App\Repository\ToolsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/tools')]
class ToolsController extends AbstractController
{
    #[Route('/', name: 'app_tools_index', methods: ['GET'])]
    public function index(ToolsRepository $toolsRepository): Response
    {
            $user = $this->getUser();
            $today = date('d-m-Y');
            $tools = $toolsRepository->findAll();
            $myTools = $toolsRepository->findBy(['technicien' => $user]);
        return $this->render('tools/index.html.twig', compact('tools', 'today'));
    }

    #[Route('/new', name: 'app_tools_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ToolsRepository $toolsRepository): Response
    {
        $tool = new Tools();
        $form = $this->createForm(ToolsType::class, $tool);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $toolsRepository->save($tool, true);

            return $this->redirectToRoute('app_tools_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('tools/new.html.twig', [
            'tool' => $tool,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_tools_show', methods: ['GET'])]
    public function show(Tools $tool): Response
    {
        return $this->render('tools/show.html.twig', [
            'tool' => $tool,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_tools_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Tools $tool, ToolsRepository $toolsRepository): Response
    {
        $form = $this->createForm(ToolsType::class, $tool);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $toolsRepository->save($tool, true);

            return $this->redirectToRoute('app_tools_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('tools/edit.html.twig', [
            'tool' => $tool,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_tools_delete', methods: ['POST'])]
    public function delete(Request $request, Tools $tool, ToolsRepository $toolsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tool->getId(), $request->request->get('_token'))) {
            $toolsRepository->remove($tool, true);
        }

        return $this->redirectToRoute('app_tools_index', [], Response::HTTP_SEE_OTHER);
    }
}
