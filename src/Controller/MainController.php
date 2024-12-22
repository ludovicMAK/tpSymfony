<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

final class MainController extends AbstractController
{

    #[Route('/', name: 'app_home', methods: ['GET', 'POST'])]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {

        return $this->render('index.html.twig', []);
    }
    #[Route('/dashboard', name: 'admin_dashboard', methods: ['GET'])]
    #[IsGranted('ROLE_ADMIN')]
    public function dashboard(): Response
    {

        return $this->render('dashboard.html.twig', []);
    }
    #[Route('/profil/{id}', name: 'user_profil', methods: ['GET'])]
    #[IsGranted('ROLE_USER')]
    public function profil(int $id, UserRepository $userRepository): Response
    {
        $user = $userRepository->find($id);
        return $this->render('profil.html.twig', ['user' => $user]);
    }
}
