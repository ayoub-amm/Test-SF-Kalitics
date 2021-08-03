<?php

namespace App\Controller;

use App\Entity\Chantiers;
use App\Form\ChantiersType;
use App\Repository\ChantiersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @Route("/chantiers")
 */
class ChantiersController extends AbstractController
{
    /**
     * @Route("/", name="chantiers_index", methods={"GET"})
     */
    public function index(Request $request, PaginatorInterface $paginator, ChantiersRepository $chantiersRepository): Response
    {
        $chantiers = $paginator->paginate(
            $chantiersRepository->getAllChantiers(),
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('chantiers/index.html.twig', [
            'chantiers' => $chantiers,
        ]);
    }

    /**
     * @Route("/new", name="chantiers_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $chantier = new Chantiers();
        $form = $this->createForm(ChantiersType::class, $chantier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($chantier);
            $entityManager->flush();

            return $this->redirectToRoute('chantiers_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('chantiers/new.html.twig', [
            'chantier' => $chantier,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="chantiers_show", methods={"GET"})
     */
    public function show(Chantiers $chantier): Response
    {
        return $this->render('chantiers/show.html.twig', [
            'chantier' => $chantier,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="chantiers_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Chantiers $chantier): Response
    {
        $form = $this->createForm(ChantiersType::class, $chantier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('chantiers_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('chantiers/edit.html.twig', [
            'chantier' => $chantier,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="chantiers_delete", methods={"POST"})
     */
    public function delete(Request $request, Chantiers $chantier): Response
    {
        if ($this->isCsrfTokenValid('delete'.$chantier->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($chantier);
            $entityManager->flush();
        }

        return $this->redirectToRoute('chantiers_index', [], Response::HTTP_SEE_OTHER);
    }
}
