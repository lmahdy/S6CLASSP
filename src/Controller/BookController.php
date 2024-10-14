<?php

namespace App\Controller;

use App\Entity\Book;
use App\Form\BookType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{
    #[Route('/book', name: 'app_book')]
    public function index(): Response
    {
        return $this->render('book/index.html.twig', [
            'controller_name' => 'BookController',
        ]);
    }

    #[Route('/book/add', name: 'app_book_add')]
    public function add(Request $request, EntityManagerInterface $entityManager): Response
    {
        $book = new Book();
        $form = $this->createForm(BookType::class, $book);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $book->setPublished(true);
            $entityManager->persist($book);
            $entityManager->flush();

            return $this->redirectToRoute('app_book');
        }

        return $this->render('book/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    // Add this in your BookController

    #[Route('/book/list', name: 'app_book_list')]
    public function list(EntityManagerInterface $entityManager): Response
    {
        // Fetch all published books
        $publishedBooks = $entityManager->getRepository(Book::class)->findBy(['published' => true]);

        // Fetch all unpublished books for the count
        $unpublishedBooks = $entityManager->getRepository(Book::class)->findBy(['published' => false]);

        return $this->render('book/list.html.twig', [
            'publishedBooks' => $publishedBooks,
            'unpublishedBooksCount' => count($unpublishedBooks),
            'publishedBooksCount' => count($publishedBooks),
        ]);
    }

}
