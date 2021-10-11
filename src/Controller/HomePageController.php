<?php

namespace App\Controller;

use App\Entity\Books;
use App\Repository\BooksRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomePageController extends AbstractController
{
    #[Route('/', name: 'home_page')]
    public function index(BooksRepository $booksRepository): Response
    {

        $books = $booksRepository->findAll();
       

        return $this->render('home_page/index.html.twig', [
            'title' => 'Catalogue',
            'books' => $books,
            
            
        ]);
    }
}
