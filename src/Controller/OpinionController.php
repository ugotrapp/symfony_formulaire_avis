<?php

namespace App\Controller;

use App\Entity\Opinion;
use App\Form\OpinionType;
use App\Repository\OpinionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @Route("/avis")
 */
class OpinionController extends AbstractController
{
    /**
     * @Route("/", name="opinion_index", methods={"GET","POST"})
     */
    public function index(OpinionRepository $opinionRepository, Request $request, PaginatorInterface $paginator): Response
    {
        $opinion = new Opinion();
        $opinion->setDateDeCreation(new \DateTime('now'));
        $opinion->setActive(1);
        $form = $this->createForm(OpinionType::class, $opinion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($opinion);
            $entityManager->flush();

            return $this->redirectToRoute('opinion_index', [], Response::HTTP_SEE_OTHER);
        }

        $donnees = $opinionRepository->findAll();
        $opinion = $paginator->paginate(
            $donnees,
            $request->query->getInt('page', 1),
            6
        );
        
        $fiveStarsRating = count($opinionRepository->getRatingStars(5));
        $fourStarsRating = count($opinionRepository->getRatingStars(4));
        $threeStarsRating = count($opinionRepository->getRatingStars(3));
        $twoStarsRating = count($opinionRepository->getRatingStars(2));
        $oneStarRating = count($opinionRepository->getRatingStars(1));
        
            return $this->render('opinion/index.html.twig', [
            'opinion' => $opinion,
            'fiveStarsRating' => $fiveStarsRating,
            'fourStarsRating' => $fourStarsRating,
            'threeStarsRating' => $threeStarsRating,
            'twoStarsRating' => $twoStarsRating,
            'oneStarRating' => $oneStarRating,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/tri_par_date", name="opinion_sort_by_date", methods={"GET","POST"})
     */
    public function sortByDate(Request $request, OpinionRepository $opinionRepository,PaginatorInterface $paginator)
    {   
        $donnees = $opinionRepository->findByDate();
        $opinion = $paginator->paginate(
            $donnees,
            $request->query->getInt('page', 1),
            6
        );

        return $this->render('opinion/sortBy.html.twig', [
            'opinion' => $opinion,
        ]);
    }

    /**
     * @Route("/tri_par_note", name="opinion_sort_by_note", methods={"GET","POST"})
     */
    public function sortByNote(Request $request, OpinionRepository $opinionRepository ,PaginatorInterface $paginator)
    {
        $donnees = $opinionRepository->findByDate();
        $opinion = $paginator->paginate(
            $donnees,
            $request->query->getInt('page', 1),
            6
        );
        return $this->render('opinion/sortBy.html.twig', [
            'opinion' => $opinion,
        ]);
    }

    /**
     * @Route("/notes_une_etoile", name="opinion_one_star", methods={"GET","POST"})
     */
    public function oneStar(Request $request, OpinionRepository $opinionRepository): Response
    {
        
        $opinion =$opinionRepository->getRatingStars(1);

        return $this->render('opinion/opinionStar.html.twig', [
            'opinion' => $opinion
            ]);
    }

    /**
     * @Route("/notes_deux_etoiles", name="opinion_two_star", methods={"GET","POST"})
     */
    public function twoStar(Request $request, OpinionRepository $opinionRepository): Response
    {
        $opinion =$opinionRepository->getRatingStars(2);

        return $this->render('opinion/opinionStar.html.twig', [
            'opinion' => $opinion
            ]);
    }

    /**
     * @Route("/notes_trois_etoiles", name="opinion_three_star", methods={"GET","POST"})
     */
    public function threeStar(Request $request, OpinionRepository $opinionRepository): Response
    {
        $opinion =$opinionRepository->getRatingStars(3);

        return $this->render('opinion/opinionStar.html.twig', [
            'opinion' => $opinion
            ]);
    }

    /**
     * @Route("/notes_quatre_etoiles", name="opinion_four_star", methods={"GET","POST"})
     */
    public function fourStar(Request $request, OpinionRepository $opinionRepository): Response
    {
        $opinion =$opinionRepository->getRatingStars(4);

        return $this->render('opinion/opinionStar.html.twig', [
            'opinion' => $opinion
            ]);
    }

    /**
     * @Route("/notes_cinq_etoiles", name="opinion_five_star", methods={"GET","POST"})
     */
    public function fiveStar(Request $request, OpinionRepository $opinionRepository): Response
    {
        $opinion =$opinionRepository->getRatingStars(5);

        return $this->render('opinion/opinionStar.html.twig', [
            'opinion' => $opinion
            ]);
    }

    /**
     * @Route("/new", name="opinion_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $opinion = new Opinion();
        $form = $this->createForm(OpinionType::class, $opinion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($opinion);
            $entityManager->flush();

            return $this->redirectToRoute('opinion_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('opinion/new.html.twig', [
            'opinion' => $opinion,
            'form' => $form->createView(),
        ]);
    }

    //     /**
    //     * @Route("/search", name="app_search", methods={"GET","POST"})
    //     */
    //     public function search(Request $request, OpinionRepository $opinionRepository): Response
    //     {
        
    //     $studentSearchForm = $this->createForm(OpinionSearchType::class);
    //     $studentSearchForm->handleRequest($request);

    //     if ($formFactory->isSubmitted() && $formFactory->isValid()) {
    //         $keyword = $formFactory->getData()['q'];
    //         $opinions = $opinionRepository->findByGame($keyword);
    //     }
    //         return $this->render('opinion/sortBy.html.twig', [
    //         'opinion' => $opinion,
    //         'formFactory' => $formFactory->createView(),
    //     ]);
    // }
    

    /**
     * @Route("/{id}", name="opinion_show", methods={"GET"})
     */
    public function show(Opinion $opinion): Response
    {
        return $this->render('opinion/show.html.twig', [
            'opinion' => $opinion,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="opinion_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Opinion $opinion): Response
    {
        $form = $this->createForm(OpinionType::class, $opinion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('opinion_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('opinion/edit.html.twig', [
            'opinion' => $opinion,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="opinion_delete", methods={"POST"})
     */
    public function delete(Request $request, Opinion $opinion): Response
    {
        if ($this->isCsrfTokenValid('delete'.$opinion->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($opinion);
            $entityManager->flush();
        }

        return $this->redirectToRoute('opinion_index', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/{id}/hide_content", name="hide_content", methods={"POST"})
     */
    public function hide(Request $request, Opinion $opinion, OpinionRepository $opinionRepository): Response
    {
        if ($this->isCsrfTokenValid('hide_content'.$opinion->getId(), $request->request->get('_token'))) {

            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($opinion->setActive(0));
            $entityManager->flush();
        }

        return $this->redirectToRoute('opinion_index', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/{id}/display_content", name="display_content", methods={"POST"})
     */
    public function display(Request $request, Opinion $opinion, OpinionRepository $opinionRepository): Response
    {
        if ($this->isCsrfTokenValid('display_content'.$opinion->getId(), $request->request->get('_token'))) {

            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($opinion->setActive(1));
            $entityManager->flush();
        }

        return $this->redirectToRoute('opinion_index', [], Response::HTTP_SEE_OTHER);
    }
}
