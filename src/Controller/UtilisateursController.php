<?php

namespace App\Controller;

use App\Entity\Utilisateurs;
use App\Form\UtilisateursType;
use App\Repository\UtilisateursRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @Route("/utilisateurs")
 */
class UtilisateursController extends AbstractController
{
    /**
     * @Route("/", name="utilisateurs_index", methods={"GET"})
     */
    public function index(Request $request, PaginatorInterface $paginator, UtilisateursRepository $utilisateursRepository): Response
    {
        $utilisateurs = $paginator->paginate(
            $utilisateursRepository->getAllUtilisateurs(),
            $request->query->getInt('page', 1),
            10
        );
        return $this->render('utilisateurs/index.html.twig', [
            'utilisateurs' => $utilisateurs,
        ]);
    }

    /**
     * @Route("/new", name="utilisateurs_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $utilisateur = new Utilisateurs();
        $form = $this->createForm(UtilisateursType::class, $utilisateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($utilisateur);
            $entityManager->flush();

            return $this->redirectToRoute('utilisateurs_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('utilisateurs/new.html.twig', [
            'utilisateur' => $utilisateur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="utilisateurs_show", methods={"GET"})
     */
    public function show(Utilisateurs $utilisateur): Response
    {
        return $this->render('utilisateurs/show.html.twig', [
            'utilisateur' => $utilisateur,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="utilisateurs_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Utilisateurs $utilisateur): Response
    {
        $form = $this->createForm(UtilisateursType::class, $utilisateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('utilisateurs_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('utilisateurs/edit.html.twig', [
            'utilisateur' => $utilisateur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="utilisateurs_delete", methods={"POST"})
     */
    public function delete(Request $request, Utilisateurs $utilisateur): Response
    {
        if ($this->isCsrfTokenValid('delete'.$utilisateur->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($utilisateur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('utilisateurs_index', [], Response::HTTP_SEE_OTHER);
    }
}
