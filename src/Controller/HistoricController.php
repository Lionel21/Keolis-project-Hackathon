<?php

namespace App\Controller;

use App\Entity\User;
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
    public function index(User $user): Response
    {
        $travels = $user->getTravels();
        return $this->render('historic/index.html.twig', [
            'user' => $user,
            'travels' => $travels,
        ]);
    }
}
