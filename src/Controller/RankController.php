<?php

namespace App\Controller;

use App\Entity\Travel;
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
        $voyageRepository = $this->getDoctrine()
            ->getRepository(Travel::class)
            ->findBy(
                [],
        ['distance' => 'DESC'],
        10
            );

        return $this->render('rank/index.html.twig', [
            'travels' => $voyageRepository,
        ]);
    }
}
