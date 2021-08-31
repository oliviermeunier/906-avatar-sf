<?php

namespace App\Controller;

use App\Avatar\AvatarSVGFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController
{
    /**
     * @Route("/", name="home")
     */
    public function index(Request $request)
    {
        // Initialisation des paramètres de l'avatar
        $colorAmount = 2;
        $avatarSize = 4;

        // Création d'un avatar SVG
        $svg = (new AvatarSVGFactory())->createRandomAvatar($avatarSize, $colorAmount);

        $html = '<!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Avatar</title>
            <link rel="stylesheet" href="/css/style.css">
        </head>
        <body>
            <header>
                <h1>Avatar SVG</h1>
            </header>
            <main>
                ' . $svg . '
            </main>
        </body>
        </html>';

        return new Response($html);
    }
}
