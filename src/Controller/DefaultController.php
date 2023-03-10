<?php

namespace App\Controller;

use App\Entity\Tweet;
use App\Entity\User;
use App\Repository\TweetRepository;
use App\Repository\UserRepository;
use Faker\Factory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

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
    public function home(UserRepository $userRepository, TweetRepository $tweetRepository, ValidatorInterface $validator): Response
    {
        // $faker = Factory::create();
        // $user = new User();
        // $user->setName($faker->name());
        // $user->setUsername(substr($faker->userName() ,0, 15));
        // $user->setPassword("0mrY17&12$");
        // $user->setCreatedAt($faker->dateTimeInInterval('-1 year'));
        // $user->setVerified(true);
        // $errors = $validator->validate($user);
        // dump($errors);
        // if (count($errors) > 0)
        // {
        //    return new Response($errors);
        //}
        //$userRepository->save($user, true);

        $tweets = $tweetRepository->findBy([], ["createdAt" => "DESC"]);

        // return new Response("Bienvenidos a la p??gina principal de Truiter");
        // return $this->render('default/index.html.twig', [
        //    'message' => "Bienvenidos a la p??gina principal de Truiter"
        // ]);

        // return $this->render('default/index.html.twig', [
        //    'users' => $users
        //]);

        return $this->render('default/index.html.twig', [
            'tweets' => $tweets
        ]);
    }
}
