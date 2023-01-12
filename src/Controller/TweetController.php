<?php

namespace App\Controller;

use App\Entity\Tweet;
use App\Form\TweetType;
use App\Repository\TweetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TweetController extends AbstractController
{
    #[Route('/compose/tweet', name: 'tweet_create')]
    public function create(Request $request, TweetRepository $tweetRepository): Response
    {
        $tweet = new Tweet();
        $tweet->setCreatedAt(new \DateTime());
        $tweet->setLikeCount(0);

        $form = $this->createForm(TweetType::class, $tweet);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $tweetRepository->save($tweet, true);

            $this->addFlash('info', 'El tuit se ha enviado');

            return $this->redirectToRoute('home');
        }

        return $this->renderForm('tweet/index.html.twig', [
            'form' => $form,
        ]);
    }
}
