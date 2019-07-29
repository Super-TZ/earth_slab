<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController
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
        return new Response(
            sprintf('J\'aime le %s. Et toi ?',
            $slug
            ));
    }
}