<?php

namespace App\Controller;

use App\Entity\Author;
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

            // Increment the author's nb_books
            $author = $book->getAuthor();
            if ($author) {
                $author->setNbBooks($author->getNbBooks() + 1);
            }

            $entityManager->flush();

            return $this->redirectToRoute('app_book_list');
        }

        return $this->render('book/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/book/list', name: 'app_book_list')]
    public function list(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Get the search term from the query parameter
        $title = $request->query->get('title', '');

        // If a search term is provided, use the searchByTitle method
        if (!empty($title)) {
            $books = $entityManager->getRepository(Book::class)->searchByTitle($title);
        } else {
            // Otherwise, use the tri method to list all books
            $books = $entityManager->getRepository(Book::class)->tri();
        }

        // Fetch all unpublished books for the count
        $unpublishedBooks = $entityManager->getRepository(Book::class)->findBy(['published' => false]);

        return $this->render('book/list.html.twig', [
            'publishedBooks' => $books, // list of books (either searched or all)
            'unpublishedBooksCount' => count($unpublishedBooks),
            'publishedBooksCount' => count($books),
            'searchTerm' => $title, // Pass the search term to the view
        ]);
    }





    #[Route('/book/edit/{id}', name: 'app_book_edit')]
    public function edit(int $id, Request $request, EntityManagerInterface $entityManager): Response
    {
        // Fetch the book by id
        $book = $entityManager->getRepository(Book::class)->find($id);

        if (!$book) {
            throw $this->createNotFoundException('No book found for id ' . $id);
        }

        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_book_list');
        }

        return $this->render('book/edit.html.twig', [
            'form' => $form->createView(),
            'book' => $book, // Pass the book to display additional information like Ref number
        ]);
    }

    #[Route('/book/delete/{id}', name: 'app_book_delete')]
    public function delete(int $id, EntityManagerInterface $entityManager): Response
    {
        // Fetch the book by id
        $book = $entityManager->getRepository(Book::class)->find($id);

        if (!$book) {
            throw $this->createNotFoundException('No book found for id ' . $id);
        }

        // Decrement the author's nb_books
        $author = $book->getAuthor();
        if ($author) {
            $author->setNbBooks($author->getNbBooks() - 1);

            // If nb_books is zero, remove the author
            if ($author->getNbBooks() === 0) {
                $entityManager->remove($author);
            }
        }

        // Remove the book from the database
        $entityManager->remove($book);
        $entityManager->flush();

        // Redirect to the list of books after deletion
        return $this->redirectToRoute('app_book_list');
    }

    #[Route('/book/show/{id}', name: 'app_book_show')]
    public function show(int $id, EntityManagerInterface $entityManager): Response
    {
        // Fetch the book by id
        $book = $entityManager->getRepository(Book::class)->find($id);

        if (!$book) {
            throw $this->createNotFoundException('No book found for id ' . $id);
        }

        return $this->render('book/show.html.twig', [
            'book' => $book,
        ]);
    }
}
