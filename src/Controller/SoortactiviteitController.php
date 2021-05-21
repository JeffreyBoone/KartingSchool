<?php

namespace App\Controller;

use App\Entity\Soortactiviteit;
use App\Form\SoortactiviteitType;
use App\Repository\SoortactiviteitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/soortactiviteit")
 */
class SoortactiviteitController extends AbstractController
{
    /**
     * @Route("/", name="soortactiviteit_index", methods={"GET"})
     */
    public function index(SoortactiviteitRepository $soortactiviteitRepository): Response
    {
        return $this->render('soortactiviteit/index.html.twig', [
            'soortactiviteits' => $soortactiviteitRepository->findAll(),
        ]);
    }



    /**
     * @Route("/{id}", name="soortactiviteit_show", methods={"GET"})
     */
    public function show(Soortactiviteit $soortactiviteit): Response
    {
        return $this->render('soortactiviteit/show.html.twig', [
            'soortactiviteit' => $soortactiviteit,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="soortactiviteit_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Soortactiviteit $soortactiviteit): Response
    {
        $form = $this->createForm(SoortactiviteitType::class, $soortactiviteit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('soortactiviteit_index');
        }

        return $this->render('soortactiviteit/edit.html.twig', [
            'soortactiviteit' => $soortactiviteit,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="soortactiviteit_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Soortactiviteit $soortactiviteit): Response
    {
        if ($this->isCsrfTokenValid('delete'.$soortactiviteit->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($soortactiviteit);
            $entityManager->flush();
        }

        return $this->redirectToRoute('soortactiviteit_index');
    }
}
