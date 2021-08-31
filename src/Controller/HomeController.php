<?php

namespace App\Controller;

use Twig\Environment;
use App\Avatar\AvatarSVGFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController
{
    /**
     * @Route("/", name="home")
     */
    public function index(Request $request, Environment $twig, AvatarSVGFactory $avatarSVGFactory)
    {
        // Initialisation des paramètres de l'avatar
        $colorAmount = 2;
        $avatarSize = 4;

        // Création d'un avatar SVG
        $svg = $avatarSVGFactory->createRandomAvatar($avatarSize, $colorAmount);

        $html = $twig->render('home.html.twig', [
            'svg' => $svg
        ]);

        return new Response($html);
    }
}
