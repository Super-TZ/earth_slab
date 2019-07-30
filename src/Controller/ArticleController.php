<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function homepage()
    {
        return new Response("Coucou-coucou ! C'est Peepoo-Doo !");
    }

    /**
     * @Route("/art/{slug}")
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