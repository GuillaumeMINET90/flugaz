<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserParamController extends AbstractController
{
    #[Route('/user/param', name: 'app_user_param')]
    public function index(): Response
    {
        return $this->render('user_param/index.html.twig');
    }
}
