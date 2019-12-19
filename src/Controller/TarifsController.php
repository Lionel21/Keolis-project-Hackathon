<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/tarifs")
 */

class TarifsController extends AbstractController
{
    /**
     * @Route("/", name="tarifs_index", methods={"GET"})
     */
    public function index(): Response
    {
        return $this->render('tarifs/index.html.twig');
    }
}
