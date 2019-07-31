<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
     * @Route("/art/{slug}", name="article_show")
     */
    public function show($slug)
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

        return $this->render('art/show.html.twig', [
            'comments' => $comments,
            'title' => 'Le Nanana de l\'Elfe !',
        ]);
    }
}