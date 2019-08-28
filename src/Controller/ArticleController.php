<?php

namespace App\Controller;

use Michelf\Markdown;
use Michelf\MarkdownInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Cache\Adapter\AdapterInterface;
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
    public function show($slug, MarkdownInterface $markdown, Environment $twigEnvironment, AdapterInterface $cache)
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

        $articleContent = <<<EOF
Spicy **jalapeno bacon** ipsum dolor amet veniam shank in dolore. Ham hock nisi landjaeger cow,
lorem proident [beef ribs](https://baconipsum.com/) aute enim veniam ut cillum pork chuck picanha. Dolore reprehenderit
labore minim pork belly spare ribs cupim short loin in. Elit exercitation eiusmod dolore cow
**turkey** shank eu pork belly meatball non cupim.
Laboris beef ribs fatback fugiat eiusmod jowl kielbasa alcatra dolore velit ea ball tip. Pariatur
laboris sunt venison, et laborum dolore minim non meatball. Shankle eu flank aliqua shoulder,
capicola biltong frankfurter boudin cupim officia. Exercitation fugiat consectetur ham. Adipisicing
picanha shank et filet mignon pork belly ut ullamco. Irure velit turducken ground round doner incididunt
occaecat lorem meatball prosciutto quis strip steak.
Meatball adipisicing ribeye bacon strip steak eu. Consectetur ham hock pork hamburger enim strip steak
mollit quis officia meatloaf tri-tip swine. Cow ut reprehenderit, buffalo incididunt in filet mignon
strip steak pork belly aliquip capicola officia. Labore deserunt esse chicken lorem shoulder tail consectetur
cow est ribeye adipisicing. Pig hamburger pork belly enim. Do porchetta minim capicola irure pancetta chuck
fugiat.
EOF;
        $item = $cache->getItem('markdown_'.md5($articleContent));
        if (!$item->isHit()) {
            $item->set($markdown->transform($articleContent));
            $cache->save($item);
        }
        $articleContent = $item->get();

        //$articleContent = $markdown->transform($articleContent);

        $html = $twigEnvironment->render('art/show.html.twig', [
            'comments' => $comments,
            'title' => 'Le Nanana de l\'Elfe !',
            'slug' => $slug,
            'articleContent' => $articleContent,
        ]);

        return new Response($html);
    }
}