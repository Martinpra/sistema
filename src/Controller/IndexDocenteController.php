<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexDocenteController extends AbstractController
{
    /**
     * @Route("/index/docente", name="app_index_docente")
     */
    public function index(): Response
    {
        return $this->render('index_docente/index.html.twig', [
            'controller_name' => 'IndexDocenteController',
        ]);
    }
}
