<?php

namespace App\Controller;

use App\Entity\Vol;
use App\Form\VolType; // Import your VolType form class here
use App\Repository\VolRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class VolController extends AbstractController
{
    #[Route('/vol', name: 'app_vol')]
    public function index(VolRepository $volRepository): Response
    {
        // Fetch all flights from the repository
        $vols = $volRepository->findAll();

        return $this->render('vol/index.html.twig', [
            'controller_name' => 'VolController',
            'vols' => $vols, // Pass the flights to the template
        ]);
    }

    #[Route('/vol/add', name: 'app_vol_add')]
    public function add(Request $request, EntityManagerInterface $entityManager): Response
    {
        $vol = new Vol();
        $form = $this->createForm(VolType::class, $vol); // Ensure VolType form class is created

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($vol);
            $entityManager->flush();

            return $this->redirectToRoute('app_vol'); // Redirect to the list of flights
        }

        return $this->render('vol/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
