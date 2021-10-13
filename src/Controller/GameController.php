<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Game;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\GameRepository;



class GameController extends AbstractController
{
    /**
     * @Route("/game/xbox", name="game_xbox")
     */
    public function xbox(GameRepository $gameRepository): Response
    {
        $games = $gameRepository->findPlateform('XBOX');
        return $this->render('game/index.html.twig', [
            'games' => $games,
        ]);
    }

    /**
     * @Route("/game/ps5", name="game_ps5")
     */
    public function ps5(GameRepository $gameRepository): Response
    {
       $games = $gameRepository->findPlateform('PS5');
        return $this->render('game/index.html.twig', [
            'games' => $games,
        ]);
    }
}
