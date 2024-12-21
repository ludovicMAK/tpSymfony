<?php

namespace App\Controller;

use App\Entity\Testimony;
use App\Form\Testimony1Type;
use App\Repository\TestimonyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/testimony')]
final class TestimonyController extends AbstractController
{
    #[Route(name: 'app_testimony_index', methods: ['GET'])]
    public function index(TestimonyRepository $testimonyRepository): Response
    {
        return $this->render('testimony/index.html.twig', [
            'testimonies' => $testimonyRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_testimony_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $testimony = new Testimony();
        $form = $this->createForm(Testimony1Type::class, $testimony);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($testimony);
            $entityManager->flush();

            return $this->redirectToRoute('app_testimony_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('testimony/new.html.twig', [
            'testimony' => $testimony,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_testimony_show', methods: ['GET'])]
    public function show(Testimony $testimony): Response
    {
        return $this->render('testimony/show.html.twig', [
            'testimony' => $testimony,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_testimony_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Testimony $testimony, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Testimony1Type::class, $testimony);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_testimony_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('testimony/edit.html.twig', [
            'testimony' => $testimony,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_testimony_delete', methods: ['POST'])]
    public function delete(Request $request, Testimony $testimony, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$testimony->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($testimony);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_testimony_index', [], Response::HTTP_SEE_OTHER);
    }
}
