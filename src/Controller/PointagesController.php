<?php

namespace App\Controller;

use App\Entity\Pointages;
use App\Form\PointagesType;
use App\Repository\PointagesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @Route("/pointages")
 */
class PointagesController extends AbstractController
{
    /**
     * @Route("/", name="pointages_index", methods={"GET"})
     */
    public function index(Request $request, PaginatorInterface $paginator, PointagesRepository $pointagesRepository): Response
    {
        $pointages = $paginator->paginate(
            $pointagesRepository->getAllPointages(),
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('pointages/index.html.twig', [
            'pointages' => $pointages,
        ]);
    }

    /**
     * @Route("/new", name="pointages_new", methods={"GET","POST"})
     */
    public function new(Request $request,ValidatorInterface $validator): Response
    {
        $pointage = new Pointages();
        $form = $this->createForm(PointagesType::class, $pointage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($pointage);
            $entityManager->flush();

            return $this->redirectToRoute('pointages_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('pointages/new.html.twig', [
            'pointage' => $pointage,
            'form' => $form->createView(),
        ]);
    }

}
