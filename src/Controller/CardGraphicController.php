<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CardGraphicController extends AbstractController
{
    /**
     * @Route("/card/graphic", name="card-graphic-home")
     */
    public function home(): Response
    {
        $die = new \App\Card\CardGraphic();
        $data = [
            'title' => 'Dice with graphic representation',
            'die_value' => $die->roll(),
            'die_as_string' => $die->getAsString(),
            'link_to_roll' => $this->generateUrl('card-graphic-roll', ['numRolls' => 5,]),
        ];
        return $this->render('card/home.html.twig', $data);
    }

    /**
     * @Route("/card/graphic/roll/{numRolls}", name="card-graphic-roll")
     */
    public function roll(int $numRolls): Response
    {
        $die = new \App\Card\CardGraphic();

        $rolls = [];
        for ($i = 1; $i <= $numRolls; $i++) {
            $die->roll();
            $rolls[] = $die->getAsString();
        }

        $data = [
            'title' => 'Graphic dice rolled many times',
            'numRolls' => $numRolls,
            'rolls' => $rolls,
        ];
        return $this->render('card/roll.html.twig', $data);
    }
}
