<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\TransferContainers;
use App\Repository\UserRepository;
use App\Form\TransferContainersType;
use App\Form\TransferContainerUsedType;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\TransferContainersReturnType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\TransferContainersRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/transfer/containers')]
#[IsGranted('ROLE_USER')]
class TransferContainersController extends AbstractController
{
    #[Route('/', name: 'app_transfer_containers_index', methods: ['GET', 'POST'])]
    public function index(Request $request, TransferContainersRepository $transferContainersRepository): Response
    {
        $transferContainers = $transferContainersRepository->findAll();
        $new = 'transferContainer';

        return $this->renderForm('transfer_containers/index.html.twig', compact('transferContainers','new'));
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


    #[Route('/{id}/return_transfer_container', name: 'app_transfer_containers_return', methods: ['GET', 'POST'])]
    public function edit($id, Request $request, TransferContainers $transferContainer, TransferContainersRepository $transferContainersRepository): Response
    {
        $container = $transferContainersRepository->find($id)->getNumber();
        $form = $this->createForm(TransferContainersReturnType::class, $transferContainer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $transferContainersRepository->save($transferContainer, true);

            return $this->redirectToRoute('app_transfer_containers_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('transfer_containers/edit.html.twig', compact('transferContainer', 'form', 'container'));
    }
    #[Route('/{id}/use_container', name: 'app_transfer_containers_use', methods: ['GET', 'POST'])]
    public function use($id, Request $request, TransferContainersRepository $transferContainersRepository, EntityManagerInterface $em): Response
    {
        $transferContainer = $transferContainersRepository->find($id);

        $form = $this->createForm(TransferContainerUsedType::class, $transferContainer);
        $form->get('user')->setData($this->getUser());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if (intval($form->get('used_container')->getViewData('used_container')) === 1) {

                $transferContainer->setUsedContainer(true);
                $transferContainer->setUser($this->getUser());
                $transferContainer->setGaz($form->get('gaz')->getViewData('gaz'));
                $transferContainer->setTotalWeight(floatval($form->get('total_weight')->getViewData('total_weight')));
                // dd($transferContainer);
                $em->flush($transferContainer);

            } else {

                $transferContainer->setUsedContainer(false);
                $transferContainer->setUser(NULL);
                $transferContainer->setGaz($form->get('gaz')->getViewData('gaz'));
                $transferContainer->setTotalWeight(floatval($form->get('total_weight')->getViewData('total_weight')));

                $em->flush($transferContainer);
            }

            return $this->redirectToRoute('app_transfer_containers_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('transfer_containers/use.html.twig', compact('form', 'transferContainer'));
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
