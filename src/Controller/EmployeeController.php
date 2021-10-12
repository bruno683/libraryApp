<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ValidUserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/employee')]
class EmployeeController extends AbstractController
{

    #[Route('/', name: 'app_employee', methods: ['GET'])]
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('employee/index.html.twig', [

            'users' => $userRepository->findAll(),
        ]);
    }

    
    #[Route('/{id}/valid', name: 'app_valid', methods: ['GET','POST'])]
    public function validAccount(Request $request, User $user ): Response
    {
        $form = $this->createForm(ValidUserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setRoles(['ROLE_REGISTERED']);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('app_employee', [], Response::HTTP_SEE_OTHER);
        }

        
        
        return $this->render('employee/accountValidation.html.twig', [
                'form' => $form->createView(),
                'user' => $user
        ]);

    }

}