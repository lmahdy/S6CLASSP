<?php

namespace App\Controller;

use App\Entity\Aeroport;
use App\Form\AeroportType; // Add this line to import the AeroportType form class
use App\Repository\AeroportRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AeroportController extends AbstractController
{
    #[Route('/aeroport', name: 'app_aeroport')]
    public function index(AeroportRepository $aeroportRepository): Response
    {
        // Fetch all airports from the repository
        $aeroports = $aeroportRepository->findAll();

        // Render the template with the list of airports
        return $this->render('aeroport/index.html.twig', [
            'controller_name' => 'AeroportController',
            'aeroports' => $aeroports, // Pass the airports to the template
        ]);
    }

    #[Route('/aeroport/add', name: 'app_aeroport_add')]
    public function add(Request $request, EntityManagerInterface $entityManager): Response
    {
        $aeroport = new Aeroport();
        $form = $this->createForm(AeroportType::class, $aeroport); // This should be correct now

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($aeroport);
            $entityManager->flush();

            return $this->redirectToRoute('app_aeroport'); // Redirect to the list of airports
        }

        return $this->render('aeroport/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
