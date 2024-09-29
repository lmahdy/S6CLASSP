<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuthorController extends AbstractController
{
    // This route shows the author details based on their name (This was already present in your code)
    #[Route('/author/{name}', name: 'author_show')]
    public function showAuthor(string $name): Response
    {
        // Simulating an author lookup. Ideally, you should fetch the author based on their name from the database or array.
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

    // This route lists all authors (as per the exercise)
    #[Route('/authors', name: 'author_list')]
    public function listAuthors(): Response
    {
        // List of authors as per the exercise
        $authors = [
            ['id' => 1, 'name' => 'Taha Hussein', 'image' => 'images/Taha-Hussein.jpg', 'email' => 'taha@example.com', 'books' => 5],
            ['id' => 2, 'name' => 'Victor Hugo', 'image' => 'images/Victor-Hugo.jpg', 'email' => 'victor@example.com', 'books' => 3],
            ['id' => 3, 'name' => 'William Shakespeare', 'image' => 'images/william.jpg', 'email' => 'william@example.com', 'books' => 10],
        ];

        // Rendering the 'list.html.twig' template with authors
        return $this->render('author/list.html.twig', [
            'authors' => $authors,
        ]);
    }
}
