<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class CardHandController extends AbstractController
{
    /**
     * @Route(
     *      "/card/hand",
     *      name="card-hand-home",
     *      methods={"GET","HEAD"}
     * )
     */
    public function home(): Response
    {
        return $this->render('card/hand.html.twig');
    }

    #[Route("/card/hand", name: "card-hand-process", methods: ["POST"])]
    public function process(
        Request $request,
        SessionInterface $session
    ): Response {
        $hand = $session->get("card-hand") ?? new \App\Card\CardDeck();

        $roll  = $request->request->get('roll');
        $add  = $request->request->get('add');
        $clear = $request->request->get('clear');

        if ($roll) {
            $hand->roll();
        } elseif ($add) {
            $hand->add(new \App\Card\Card());
        //            $hand->add(new \App\Card\CardGraphic());
        } elseif ($clear) {
            $hand = new \App\Card\CardDeck();
        }

        $session->set("card-hand", $hand);

        $this->addFlash("info", "Your dice hand holds " . $hand->getNumberDices() . " dices.");
        $this->addFlash("info", "Current values: " . $hand->getAsString());

        return $this->redirectToRoute('card-hand-home');
    }
}
