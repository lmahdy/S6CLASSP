<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ServiceController extends AbstractController
{
    #[Route('/service', name: 'app_service')]
    public function index(): Response
    {
        // Return a simple response or render a template
        return new Response('Bonjour mes amis');
    }

    #[Route('/service/{name}', name: 'app_show_service')]
    public function showService(string $name): Response
    {
        // Render the Twig template and pass the 'name' parameter
        return $this->render('service/showService.html.twig', [
            'name' => $name,
        ]);
    }
}
