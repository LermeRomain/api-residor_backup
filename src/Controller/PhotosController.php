<?php

namespace App\Controller;

use App\Entity\Photos;
use App\Form\PhotosType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/photos')]
class PhotosController extends AbstractController
{
    #[Route('/', name: 'app_photos_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $photos = $entityManager
            ->getRepository(Photos::class)
            ->findAll();

        return $this->render('photos/index.html.twig', [
            'photos' => $photos,
        ]);
    }

    #[Route('/new', name: 'app_photos_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $photo = new Photos();
        $photo->setCreatedAt(new \DateTimeImmutable()); // Définir la date de création
        $form = $this->createForm(PhotosType::class, $photo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($photo);
            $entityManager->flush();

            return $this->redirectToRoute('app_logements_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('photos/new.html.twig', [
            'photo' => $photo,
            'form' => $form,
        ]);
    }


    #[Route('/{id}', name: 'app_photos_show', methods: ['GET'])]
    public function show(Photos $photo): Response
    {
        return $this->render('photos/show.html.twig', [
            'photo' => $photo,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_photos_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Photos $photo, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PhotosType::class, $photo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_logements_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('photos/edit.html.twig', [
            'photo' => $photo,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_photos_delete', methods: ['POST'])]
    public function delete(Request $request, Photos $photo, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$photo->getId(), $request->request->get('_token'))) {
            $entityManager->remove($photo);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_logements_index', [], Response::HTTP_SEE_OTHER);
    }
}
