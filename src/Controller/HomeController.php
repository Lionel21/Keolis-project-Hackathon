<?php

namespace App\Controller;

use App\Services\StationsService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home_index")
     */
    public function index(StationsService $stationsService): Response
    {

        $stations = $stationsService->getStations();

        return $this->render('/home/index.html.twig', [
            'stations' => $stations,
        ]);
    }

    /**
     * @Route("/road", name="road_index")
     */
    public function road(Request $request): Response
    {

    }

}
