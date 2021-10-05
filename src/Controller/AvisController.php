<?php

namespace App\Controller;

use App\Entity\Avis;
use App\Form\AvisType;
use App\Repository\AvisRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/avis")
 */
class AvisController extends AbstractController
{
    /**
     * @Route("/", name="avis_index", methods={"GET"})
     */
    public function index(AvisRepository $avisRepository): Response
    {


        return $this->render('avis/index.html.twig', [
            'avis' => $avisRepository->findByNote(),
        ]);
    }

    /**
     * @Route("/new", name="avis_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $avis = new Avis();
        $form = $this->createForm(AvisType::class, $avis);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($avis);
            $entityManager->flush();

            return $this->redirectToRoute('avis_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('avis/new.html.twig', [
            'avis' => $avis,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="avis_show", methods={"GET"})
     */
    public function show(Avis $avis): Response
    {
        return $this->render('avis/show.html.twig', [
            'avis' => $avis,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="avis_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Avis $avis): Response
    {
        $form = $this->createForm(AvisType::class, $avis);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('avis_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('avis/edit.html.twig', [
            'avis' => $avis,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="avis_delete", methods={"POST"})
     */
    public function delete(Request $request, Avis $avis): Response
    {
        if ($this->isCsrfTokenValid('delete'.$avis->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($avis);
            $entityManager->flush();
        }

        return $this->redirectToRoute('avis_index', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/{id}/masquer", name="masquer", methods={"POST"})
     */
    public function masquer(Request $request, Avis $avis, AvisRepository $avisRepository): Response
    {
        if ($this->isCsrfTokenValid('masquer'.$avis->getId(), $request->request->get('_token'))) {

            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($avis->setActive(0));
            $entityManager->flush();
        }

        return $this->redirectToRoute('avis_index', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/{id}/afficher", name="afficher", methods={"POST"})
     */
    public function afficher(Request $request, Avis $avis, AvisRepository $avisRepository): Response
    {
        if ($this->isCsrfTokenValid('afficher'.$avis->getId(), $request->request->get('_token'))) {

            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($avis->setActive(1));
            $entityManager->flush();
        }

        return $this->redirectToRoute('avis_index', [], Response::HTTP_SEE_OTHER);
    }
}
