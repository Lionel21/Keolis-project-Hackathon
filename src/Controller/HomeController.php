<?php

namespace App\Controller;

use App\Entity\Travel;
use App\Form\TravelType;
use App\Repository\VoyageRepository;
use App\Service\CalorieService;
use App\Services\DistanceService;
use App\Services\StationsService;
use Doctrine\DBAL\Types\DateTimeType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home_index", methods={"GET","POST"})
     * @param Request $request
     * @param StationsService $stationsService
     * @return Response
     */
    public function index(Request $request, StationsService $stationsService, CalorieService $calorieService): Response
    {
        $stations = $stationsService->getStations();
        $travel = new Travel();

        $form = $this->createForm(TravelType::class, $travel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $date = new \DateTime();
            $data = $form->getData();
            $user = $this->getUser();
            $entityManager = $this->getDoctrine()->getManager();
            $travel->setDistance($_POST['distance']);
            $travel->setDuration($_POST['time']);
            $travel->setUser($this->getUser());
            $calory = $calorieService->calculCalories($travel->getUser()->getWeight(), $travel->getDuration());
            $travel->setCalory($calory);
            $travel->setDate($date);
            $entityManager->persist($travel);

            $entityManager->flush();
            return $this->redirectToRoute('home_road', [
                'start' => $_POST['travel']['start'],
                'finish' => $_POST['travel']['finish'],
                'distance' => $_POST['distance'],
                'duration' => $_POST['time'],
            ]);
        }

        return $this->render('/home/index.html.twig', [
            'stations' => $stations,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/road/", name="home_road", methods={"GET","POST"})
     * @param Request $request
     * @param StationsService $stationsService
     * @return Response
     */
    public function road(Request $request, StationsService $stationsService, CalorieService $calorieService, DistanceService $distanceService, VoyageRepository $voyageRepository): Response
    {
        $stations = $stationsService->getStations();
        $user = $this->getUser();
        $calories = round($calorieService->calculCalories($user->getWeight(), $_GET['duration']));
        $totalDistance = $distanceService->getDistanceTotal($voyageRepository, $user);

        $stepBefore = intval(($totalDistance-$_GET['distance'])/10000);
        $stepAfter = intval($totalDistance/10000);
        $missing = ($stepAfter+1)*10000 - $totalDistance;
        $step = $stepAfter - $stepBefore;

        return $this->render('/home/road.html.twig', [
            'stations' => $stations,
            'travel' => [$_GET['start'], $_GET['finish'], $_GET['distance'], $calories, $totalDistance],
            'step' => $step,
            'missing' => $missing,
        ]);
    }
}
