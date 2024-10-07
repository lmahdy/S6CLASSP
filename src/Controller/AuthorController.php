<?php

namespace App\Controller;

use App\Entity\Author;
use App\Form\AuthorType;
use App\Repository\AuthorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class AuthorController extends AbstractController
{
    // This route displays the form to add a new author
    #[Route('/author/add', name: 'author_add')]
    public function addAuthor(Request $request, EntityManagerInterface $entityManager): Response
    {
        $author = new Author();
        $form = $this->createForm(AuthorType::class, $author);

        // Handle form submission
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Persist the new author to the database
            $entityManager->persist($author);
            $entityManager->flush();

            // Redirect to the author list or show a success message
            return $this->redirectToRoute('author_list'); // Adjust this to your desired route
        }

        // Render the form
        return $this->render('author/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    // This route shows the author details based on their name
    #[Route('/author/{name}', name: 'author_show')]
    public function showAuthor(string $name): Response
    {
        // Simulating an author lookup
        $authors = [
            ['id' => 1, 'name' => 'Taha Hussein', 'image' => 'images/Taha-Hussein.jpg', 'email' => 'taha@example.com', 'books' => 5],
            ['id' => 2, 'name' => 'Victor Hugo', 'image' => 'images/Victor-Hugo.jpg', 'email' => 'victor@example.com', 'books' => 3],
            ['id' => 3, 'name' => 'William Shakespeare', 'image' => 'images/william.jpg', 'email' => 'william@example.com', 'books' => 10],
        ];

        // Find the author based on the name passed in the URL
        $author = null;
        foreach ($authors as $a) {
            if (strtolower($a['name']) === strtolower($name)) {
                $author = $a;
                break;
            }
        }

        // Check if the author was found
        if ($author === null) {
            throw $this->createNotFoundException("Author not found.");
        }

        // Pass the author data to the view
        return $this->render('author/showAuthor.html.twig', [
            'author' => $author,
        ]);
    }

    // This route lists all authors
    #[Route('/authors', name: 'author_list')]
    public function listAuthors(): Response
    {
        // List of authors
        $authors = [
            ['id' => 1, 'name' => 'Taha Hussein', 'image' => 'images/Taha-Hussein.jpg', 'email' => 'taha@example.com', 'books' => 5],
            ['id' => 2, 'name' => 'Victor Hugo', 'image' => 'images/Victor-Hugo.jpg', 'email' => 'victor@example.com', 'books' => 3],
            ['id' => 3, 'name' => 'William Shakespeare', 'image' => 'images/william.jpg', 'email' => 'william@example.com', 'books' => 10],
        ];

        // Render the 'list.html.twig' template with authors
        return $this->render('author/list.html.twig', [
            'authors' => $authors,
        ]);
    }

    // This route reads all authors from the database
    #[Route('/authors/read', name: 'author_read')]
    public function read(AuthorRepository $repoAuthor): Response
    {
        $list = $repoAuthor->findAll();

        // Render the template to display the authors
        return $this->render('author/read.html.twig', [
            'authors' => $list,
        ]);
    }
}
