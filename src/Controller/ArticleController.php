<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class ArticleController extends AbstractController
{
    /**
     * @Route("/", name="app_homepage")
     */
    public function homepage()
    {
        return $this->render('art/homepage.html.twig');
    }

    /**
     * @Route("/news/{slug}/heart", name="article_toggle_heart", methods={"POST"})
     * @param $slug
     * @param LoggerInterface $logger
     * @return JsonResponse
     */
    public function toggleArticleHeart($slug, LoggerInterface $logger)
    {
        $logger->info('Article bla-bla-coeur, ça marche pas.');
        return $this->json(['hearts' => rand(5,100)]);
        // TODO : un truc qui marche.
    }

    /**
     * @Route("/art/{slug}", name="article_show")
     */
    public function show($slug, Environment $twigEnvironment)
    {
        $comments = [
            [
                'name' => 'durdil_du_67',
                'text' => 'Les elfes ils sont tous bêtes, na !',
            ],[
                'name' => '*~Lessivariel~*',
                'text' => 'wé bin toi t moche!!!!'
            ],
        ];

        $html = $twigEnvironment->render('art/show.html.twig', [
            'comments' => $comments,
            'title' => 'Le Nanana de l\'Elfe !',
            'slug' => $slug,
        ]);

        return new Response($html);
    }
}