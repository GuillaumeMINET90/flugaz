<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Repository\VendorsRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[IsGranted('ROLE_USER')]
class UserParamController extends AbstractController
{
    #[Route('/user/param', name: 'app_user_param')]
    public function index(UserRepository $userRepository, VendorsRepository $vendorsRepository): Response
    {
        $user = $userRepository->find($this->getUser());
        $vendors = $vendorsRepository->findBy([],['name' => 'ASC']);
        
        return $this->render('user_param/index.html.twig', compact('user','vendors'));
    }
}
