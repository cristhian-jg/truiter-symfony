<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        //return $this->render('default/index.html.twig', ['controller_name' => 'DefaultController',]);
        return $this->redirectToRoute("home");
    }

    #[Route('/{id}', name: 'tweets_id', requirements: ["id" => "\d+"])]
    public function tweetsById(int $id): Response
    {
        $text = "Tuits del usuario con ID {$id}";
        return $this->render('default/index.html.twig', [
            'message' => $text
        ]);
    }

    #[Route('/{username}', name: 'tweets_username')]
    public function tweetsByUsername(string $username): Response
    {
        $text = "Tuits del usuario {$username}";
        return $this->render('default/index.html.twig', [
            'message' => $text
        ]);
    }

    #[Route('/home', name: 'home', priority: 10, methods: ["GET"])]
    public function home(): Response
    {
        // return new Response("Bienvenidos a la página principal de Truiter");
        return $this->render('default/index.html.twig', [
            'message' => "Bienvenidos a la página principal de Truiter"
        ]);
    }
}
