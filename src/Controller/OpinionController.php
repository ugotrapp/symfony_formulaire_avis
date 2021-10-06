<?php

namespace App\Controller;

use App\Entity\Opinion;
use App\Form\OpinionType;
use App\Repository\OpinionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/avis")
 */
class OpinionController extends AbstractController
{
    /**
     * @Route("/", name="opinion_index", methods={"GET"})
     */
    public function index(OpinionRepository $opinionRepository): Response
    {


        return $this->render('opinion/index.html.twig', [
            'opinion' => $opinionRepository->findByNote(),
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
