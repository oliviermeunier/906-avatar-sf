<?php

namespace App\Controller;

use Twig\Environment;
use App\Avatar\AvatarHelper;
use App\Avatar\AvatarSVGFactory;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    const DEFAULT_COLOR_AMOUNT = 2;
    const DEFAULT_AVATAR_SIZE = 4;

    /**
     * @Route("/", name="home")
     * @Route("/avatar/saved/{avatar}", name="avatar_saved")
     */
    public function index(Request $request, AvatarSVGFactory $avatarSVGFactory, $avatar = null)
    {
        // Initialisation des paramètres de l'avatar
        $colorAmount = $request->request->get('color-amount') ?? self::DEFAULT_COLOR_AMOUNT;
        $avatarSize = $request->request->get('avatar-size') ?? self::DEFAULT_AVATAR_SIZE;

        // Création d'un avatar SVG
        $svg = $avatarSVGFactory->createRandomAvatar($avatarSize, $colorAmount);

        return $this->render('home.html.twig', [
            'svg' => $svg,
            'colorAmount' => $colorAmount,
            'avatarSize' => $avatarSize,
            'avatar' => $avatar
        ]);
    }

    /**
     * @Route("/avatar/save", name="avatar_save")
     */
    public function save(Request $request, AvatarHelper $helper)
    {
        // Récupérer le code source SVG de l'avatar (transmis dans le champ caché)
        $svg = $request->request->get('svg');

        // Enregistrer ce code source dans un fichier .svg
        $filename = $helper->save($svg);

        // Retourner une réponse au client pour que l'internaute retombe sur l'accueil
        return $this->redirectToRoute('avatar_saved', [
            'avatar' => $filename
        ]);
    }
}
