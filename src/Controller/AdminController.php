<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'admin')]
    public function index(UserRepository $userRepository): Response
    {
        $users = $userRepository->findAll();
       
        return $this->render('admin/index.html.twig', [
            'users' => $users,
        ]);
    }
    /**
     * Valide les compte des noouveaux inscrits
     *@Route("/admin")
     */
    public function validAccount()
    {
        //code
    }
}
