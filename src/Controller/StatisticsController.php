<?php

namespace App\Controller;

use App\Repository\ProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class StatisticsController extends AbstractController
{
    #[Route('/statistics', name: 'app_statistics')]
    #[IsGranted('ROLE_ADMIN')]
    public function index(ProjectRepository $projectRepository): Response
    {
        $projectStats = $projectRepository->getProjectStatistics();
        $statusStats = $projectRepository->getProjectStatusStatistics();

        return $this->render('statistics/index.html.twig', [
            'projectStats' => $projectStats,
            'statusStats' => $statusStats,
        ]);
    }
}
