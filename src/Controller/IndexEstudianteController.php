<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexEstudianteController extends AbstractController
{
    /**
     * @Route("/index/estudiante", name="app_index_estudiante")
     */
    public function index(): Response
    {
        return $this->render('index_estudiante/index.html.twig', [
            'controller_name' => 'IndexEstudianteController',
        ]);
    }
}
