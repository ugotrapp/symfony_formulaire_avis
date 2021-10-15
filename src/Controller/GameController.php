<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Game;
use App\Entity\Opinion;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\GameRepository;


 /**
 * @Route("/game")
 */   
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

    /**
     * @Route("/{id}", name="game_show", methods={"GET"})
     */
    public function show(Game $game, GameRepository $gameRepository): Response
    {
        return $this->render('game/show.html.twig', [    
            'game' => $game,
        ]);
    }

    /**
     * @Route("/{id}/avis", name="game_show_avis")
     */
    public function gameAvis(GameRepository $gameRepository, int $id): Response
    {
       $gameId =  $this->getDoctrine()->getRepository(Game::class)->find($id);
       
     $opinionGame = $gameId->getOpinion();
        

        return $this->render('opinion/opinionGame.html.twig', [
            'opinionGame' => $opinionGame,
        ]);
    }
}
