<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexAdminController extends AbstractController
{
    /**
     * @Route("/index/admin", name="app_index_admin")
     */
    public function index(): Response
    {
        return $this->render('index_admin/indexadmin.html.twig', [
            'controller_name' => 'IndexAdminController',
        ]);
    }
}
