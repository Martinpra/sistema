<?php

namespace App\Controller;

use App\Entity\Materias;
use App\Form\MateriasType;
use App\Repository\MateriasRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/materias")
 */
class MateriasController extends AbstractController
{
    /**
     * @Route("/", name="app_materias_index", methods={"GET"})
     */
    public function index(MateriasRepository $materiasRepository): Response
    {
        return $this->render('materias/index.html.twig', [
            'materias' => $materiasRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_materias_new", methods={"GET", "POST"})
     */
    public function new(Request $request, MateriasRepository $materiasRepository): Response
    {
        $materia = new Materias();
        $form = $this->createForm(MateriasType::class, $materia);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $materiasRepository->add($materia, true);

            return $this->redirectToRoute('app_materias_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('materias/new.html.twig', [
            'materia' => $materia,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_materias_show", methods={"GET"})
     */
    public function show(Materias $materia): Response
    {
        return $this->render('materias/show.html.twig', [
            'materia' => $materia,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_materias_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Materias $materia, MateriasRepository $materiasRepository): Response
    {
        $form = $this->createForm(MateriasType::class, $materia);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $materiasRepository->add($materia, true);

            return $this->redirectToRoute('app_materias_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('materias/edit.html.twig', [
            'materia' => $materia,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_materias_delete", methods={"POST"})
     */
    public function delete(Request $request, Materias $materia, MateriasRepository $materiasRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$materia->getId(), $request->request->get('_token'))) {
            $materiasRepository->remove($materia, true);
        }

        return $this->redirectToRoute('app_materias_index', [], Response::HTTP_SEE_OTHER);
    }
}
