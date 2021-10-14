<?php

namespace App\Controller;

use App\Entity\Books;
use App\Entity\Images;
use App\Form\BooksType;
use App\Form\RentBookType;
use App\Form\ReturnBookType;
use App\Form\TakeBookType;
use App\Repository\BooksRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/books')]
class BooksController extends AbstractController
{
    #[Route('/', name: 'books_index', methods: ['GET'])]
    public function index(BooksRepository $booksRepository): Response
    {
        
        return $this->render('books/index.html.twig', [
            'books' => $booksRepository->findAll(),
        ]);
    }

    #[Route('/rentedbooks', name: 'books_rented', methods: ['GET'])]
    public function rentedBooksList(BooksRepository $booksRepo): Response
    {
        $rentedBooks = $booksRepo->findBy(
            [
                'isAvailable' => false,
                'takeBook' => false
            ]
            );
            return $this->render('books/rented.html.twig', [
               'rentedBooks' => $rentedBooks
            ]);
    }

    #[Route('/new', name: 'books_new', methods: ['GET','POST'])]
    public function new(Request $request): Response
    {
        $book = new Books();
        $form = $this->createForm(BooksType::class, $book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $images = $form->get('img')->getData();

            foreach ($images as $image) {
                $fichier = md5(uniqid()) . '.' . $image->guessExtension();

                $image->move( 
                    $this->getParameter('images_directory'), 
                    $fichier
                );
                $img = new Images();
                $img->setName($fichier);
                $book->addImg($img);
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($book);
            $entityManager->flush();

            return $this->redirectToRoute('books_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('books/new.html.twig', [
            'book' => $book,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'books_show', methods: ['GET'])]
    public function show(Books $book): Response
    {
        return $this->render('books/show.html.twig', [
            'book' => $book,
        ]);
    }

    #[Route('/{id}/edit', name: 'books_edit', methods: ['GET','POST'])]
    public function edit(Request $request, Books $book): Response
    {
        $form = $this->createForm(BooksType::class, $book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $images = $form->get('img')->getData();

            foreach ($images as $image) {
                $fichier = md5(uniqid()) . '.' . $image->guessExtension();

                $image->move( 
                    $this->getParameter('images_directory'), 
                    $fichier
                );
                $img = new Images();
                $img->setName($fichier);
                $book->addImg($img);
            }


            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('books_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('books/edit.html.twig', [
            'book' => $book,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'books_delete', methods: ['POST'])]
    public function delete(Request $request, Books $book): Response
    {
        if ($this->isCsrfTokenValid('delete'.$book->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($book);
            $entityManager->flush();
        }

        return $this->redirectToRoute('books_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{id}/rent', name: 'books_rent', methods: ['GET','POST'])]
    public function rentABook(Request $request, Books $books )
    {
        
        $form = $this->createForm(RentBookType::class, $books);
        $form->handleRequest($request);
        $user = $this->getUser();

        if ($form->isSubmitted() && $form->isValid()) {
            $books->setIsAvailable(false)
                ->setGetAt(new DateTime())
                ->setGetBackLimit( new DateTime('3 days'))
                ->setUser($user);
               
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('home_page', [], Response::HTTP_SEE_OTHER);
        }
        if ($books->setTakeBook(false) && $books->getGetBackLimit()){
            $books->setIsAvailable(true);
        }

        return $this->render('rent/rentBooks.html.twig', [
            'books'=> $books,
            'form' => $form->createView()
        ]);
    }


    #[Route('/{id}/returnback', name: 'books_return', methods: ['GET','POST'])]
    public function returnBook(Request $request, Books $books): Response
    {
        $form = $this->createForm(ReturnBookType::class, $books);
        $form->handleRequest($request);
        $user = $this->getUser();

        if ($form->isSubmitted() && $form->isValid()){
            $books->setIsAvailable(true)
                ->setGetBackAt(new DateTime())
                ->setGetBackLimit(new DateTime(null))
                ->setUser($user);

            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('home_page', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render('rent/returnBack.html.twig', [
            'form'=> $form->createView(),
            'books'=> $books
        ]);
    }

    #[Route('/{id}/confirmTake', name: 'books_confirm', methods: ['GET','POST'])]
    public function confirmTakeBook(Request $request, Books $books): Response 
    {        
         $form = $this->createForm(TakeBookType::class, $books);
         $form->handleRequest($request);
         $user = $this->getUser();

         if ($form->isSubmitted() && $form->isValid()) {
             if ( $books->getTakeBook()) {
                 $books->setGetBackAt(new DateTime())
                 ->setGetBackLimit(new DateTime('3 weeks'))
                 ->setUser($user);
             }

             $this->getDoctrine()->getManager()->flush();
             return $this->redirectToRoute('home_page', [], Response::HTTP_SEE_OTHER);
         }
         
         return $this->render('confirmTake/confirmTake.html.twig', [
             'form'=> $form->createView(),
             'books'=> $books
         ]);

         
    }
}
