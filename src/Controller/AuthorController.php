<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuthorController extends AbstractController
{
    #[Route('/author/{name}', name: 'author_show')]
    public function showAuthor(string $name): Response
    {
        return $this->render('author/show.html.twig', [
            'name' => $name,
        ]);
    }

    #[Route('/authors', name: 'author_list')]
    public function listAuthors(): Response
    {
        // List of authors as required
        $authors = [
            ['id' => 1, 'name' => 'Taha Hussein', 'image' => 'images/Taha-Hussein.jpg', 'email' => 'taha@example.com', 'books' => 5],
            ['id' => 2, 'name' => 'Victor Hugo', 'image' => 'images/Victor-Hugo.jpg', 'email' => 'victor@example.com', 'books' => 3],
            ['id' => 3, 'name' => 'William Shakespeare', 'image' => 'images/william.jpg', 'email' => 'william@example.com', 'books' => 10],
        ];

        return $this->render('author/list.html.twig', [
            'authors' => $authors,
        ]);
    }
}
