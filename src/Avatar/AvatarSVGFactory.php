<?php

namespace App\Avatar;

// Import des classes
use Twig\Environment;
use App\Avatar\Avatar;
use App\Avatar\AvatarSVGRenderer;

class AvatarSVGFactory
{
    private $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    public function createRandomAvatar(int $size = 4, int $nbColors = 2)
    {
        // Générer le tableau de couleurs aléatoires
        $colors = [];

        for ($i = 0; $i < $nbColors; $i++) {
            $colors[] = $this->getRandomColor();
        }

        // Création de l'avatar et du code SVG
        $avatar = new Avatar($size, $colors);

        // $renderer = new AvatarSVGRenderer('../templates/avatar.svg.php');
        // return $renderer->render($avatar);

        return $this->twig->render('avatar.svg.twig', [
            'avatar' => $avatar
        ]);
    }

    /**
     * Génère une couleur aléatoire 
     */
    public function getRandomColor()
    {
        $red = rand(0, 255);
        $green = rand(0, 255);
        $blue = rand(0, 255);

        return "rgb($red,$green,$blue)";
    }
}
