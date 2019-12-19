<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/historique")
 */

class HistoricController extends AbstractController
{
    /**
     * @Route("/", name="historic_index", methods={"GET"})
     */
    public function index(): Response
    {
        return $this->render('historic/index.html.twig');
    }
}
