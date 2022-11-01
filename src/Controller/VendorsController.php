<?php

namespace App\Controller;

use App\Entity\Vendors;
use App\Form\VendorsType;
use App\Repository\VendorsRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[IsGranted('ROLE_USER')]
#[Route('/vendors')]
class VendorsController extends AbstractController
{

    #[Route('/new-vendor', name: 'app_vendors_new', methods: ['GET', 'POST'])]
    public function new(Request $request, VendorsRepository $vendorsRepository): Response
    {
        $vendor = new Vendors();
        $form = $this->createForm(VendorsType::class, $vendor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $vendorsRepository->save($vendor, true);

            return $this->redirectToRoute('app_user_param', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('vendors/new.html.twig',  compact('vendor', 'form'));
    }

    #[Route('/{id}/edit-vendor', name: 'app_vendors_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Vendors $vendor, VendorsRepository $vendorsRepository): Response
    {
        $form = $this->createForm(VendorsType::class, $vendor);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $vendorsRepository->save($vendor, true);

            return $this->redirectToRoute('app_user_param', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('vendors/edit.html.twig', compact('vendor', 'form'));
    }


}
