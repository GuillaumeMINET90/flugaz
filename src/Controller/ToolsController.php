<?php

namespace App\Controller;

use App\Entity\Tools;
use App\Form\ToolsType;
use App\Repository\ToolsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/tools')]
#[IsGranted('ROLE_USER')]
class ToolsController extends AbstractController
{
    #[Route('/', name: 'app_tools_index', methods: ['GET'])]
    public function index(ToolsRepository $toolsRepository): Response
    {
        $user = $this->getUser();
        $today = date('d-m-Y');
        $allTools = $toolsRepository->findAll();
        $tools = $toolsRepository->findBy(['technicien' => $user]);
        
        return $this->render('tools/index.html.twig', compact('tools', 'today'));
    }

    #[Route('/new', name: 'app_tools_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ToolsRepository $toolsRepository): Response
    {
        $tool = new Tools();
        $form = $this->createForm(ToolsType::class, $tool);
        $form->get('technicien')->setData($this->getUser());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $toolsRepository->save($tool, true);

            return $this->redirectToRoute('app_tools_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('tools/new.html.twig', compact('tool', 'form'));
    }

    #[Route('/{id}/edit', name: 'app_tools_edit', methods: ['GET', 'POST'])]
    public function edit($id, Request $request, Tools $tool, ToolsRepository $toolsRepository): Response
    {
        $form = $this->createForm(ToolsType::class, $tool);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $toolsRepository->save($tool, true);

            return $this->redirectToRoute('app_tools_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('tools/edit.html.twig', compact('tool', 'form', 'id'));
    }

    #[Route('/delete_tool_{id}', name: 'app_tools_delete', methods: ['GET', 'POST'])]
    public function delete($id, EntityManagerInterface $em, ToolsRepository $toolsRepository): Response
    {
        $tool = $toolsRepository->find($id);
        $em->remove($tool);
        $em->flush();


        return $this->redirectToRoute('app_tools_index', [], Response::HTTP_SEE_OTHER);
    }
}
