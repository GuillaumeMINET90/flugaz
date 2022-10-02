<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserParamController extends AbstractController
{
    #[Route('/user/param', name: 'app_user_param')]
    public function index(UserRepository $userRepository): Response
    {
        $user = $userRepository->find($this->getUser());
        
        return $this->render('user_param/index.html.twig', compact('user'));
    }
}
