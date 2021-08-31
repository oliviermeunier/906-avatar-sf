<?php

namespace App\Controller;

use Twig\Environment;
use App\Avatar\AvatarSVGFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    const DEFAULT_COLOR_AMOUNT = 2;
    const DEFAULT_AVATAR_SIZE = 4;

    /**
     * @Route("/", name="home")
     */
    public function index(Request $request, AvatarSVGFactory $avatarSVGFactory)
    {
        // Initialisation des paramètres de l'avatar
        $colorAmount = $request->request->get('color-amount') ?? self::DEFAULT_COLOR_AMOUNT;
        $avatarSize = $request->request->get('avatar-size') ?? self::DEFAULT_AVATAR_SIZE;

        // Création d'un avatar SVG
        $svg = $avatarSVGFactory->createRandomAvatar($avatarSize, $colorAmount);

        return $this->render('home.html.twig', [
            'svg' => $svg,
            'colorAmount' => $colorAmount,
            'avatarSize' => $avatarSize
        ]);
    }
}
