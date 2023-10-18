<?php

namespace App\Controller;

use App\Entity\Logements;
use App\Form\LogementsType;
use App\Repository\LogementsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Vich\UploaderBundle\Templating\Helper\UploaderHelper;
use Knp\Component\Pager\PaginatorInterface;

#[Route('/logements')]
class LogementsController extends AbstractController
{
    #[Route('/', name: 'app_logements_index', methods: ['GET'])]
    public function index(LogementsRepository $logementsRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $logements = $logementsRepository->findBy([], ['id' => 'DESC']);

        // Paginez les résultats
        $pagination = $paginator->paginate(
            $logements, // Requête contenant les données à paginer
            $request->query->getInt('page', 1), // Page par défaut
            8 // Nombre d'éléments par page
        );

        return $this->render('logements/index.html.twig', [
            'logements' => $pagination,
        ]);
    }
    #[Route('/misenavant', name: 'app_logements_mis_en_avant', methods: ['GET'])]
    public function logementsMisEnAvant(EntityManagerInterface $entityManager): Response
    {
        $logementsMisEnAvant = $entityManager->getRepository(Logements::class)
            ->findBy(['misenavant' => 1]);

        return $this->render('logements/mis_en_avant.html.twig', [
            'logements' => $logementsMisEnAvant,
        ]);
    }

    #[Route('/new', name: 'app_logements_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $logement = new Logements();
        $form = $this->createForm(LogementsType::class, $logement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($logement);
            $entityManager->flush();

            return $this->redirectToRoute('app_logements_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('logements/new.html.twig', [
            'logement' => $logement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_logements_show', methods: ['GET'])]
    public function show(Logements $logement): Response
    {
        return $this->render('logements/show.html.twig', [
            'logement' => $logement,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_logements_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Logements $logement, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(LogementsType::class, $logement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_logements_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('logements/edit.html.twig', [
            'logement' => $logement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_logements_delete', methods: ['POST'])]
    public function delete(Request $request, Logements $logement, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$logement->getId(), $request->request->get('_token'))) {
            $entityManager->remove($logement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_logements_index', [], Response::HTTP_SEE_OTHER);
    }
}
