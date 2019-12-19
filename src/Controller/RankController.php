<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/rank")
 */

class RankController extends AbstractController
{
    /**
     * @Route("/", name="rank_index")
     */
    public function index(): Response
    {
        return $this->render('rank/index.html.twig', [
        ]);
    }
}
