<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
#[IsGranted('ROLE_USER', statusCode: 403, message:('Accès non autorisé.'))]
class UserParamController extends AbstractController
{
    #[Route('/user/param', name: 'app_user_param')]
    public function index(UserRepository $userRepository): Response
    {
        $user = $userRepository->find($this->getUser());
        
        return $this->render('user_param/index.html.twig', compact('user'));
    }
}
