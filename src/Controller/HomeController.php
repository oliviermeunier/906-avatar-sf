<?php

namespace App\Controller;

use App\Form\AvatarType;
use App\Avatar\AvatarHelper;
use App\Avatar\AvatarSVGFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\HeaderUtils;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    const DEFAULT_COLOR_AMOUNT = 2;
    const DEFAULT_AVATAR_SIZE = 4;

    /**
     * @Route("/", name="home")
     * @Route("/avatar/saved/{avatar}", name="avatar_saved")
     */
    public function index(
        Request $request,
        AvatarSVGFactory $avatarSVGFactory,
        $avatar = null
    ) {
        // Construction du formulaire 
        $form = $this->createForm(AvatarType::class);

        // Intégration des données de la requêtes dans l'objet Form
        $form->handleRequest($request);

        // Construction de l'objet FormView
        $formView = $form->createView();

        // Initialisation des paramètres de l'avatar
        $colorAmount = self::DEFAULT_COLOR_AMOUNT;
        $avatarSize = self::DEFAULT_AVATAR_SIZE;

        // Si le formulaire est soumis...
        if ($form->isSubmitted()) {

            // ... on récupère les données du formulaire
            $data = $form->getData();
            $colorAmount = $data['colorAmount'];
            $avatarSize = $data['avatarSize'];
        }

        // Création d'un avatar SVG
        $svg = $avatarSVGFactory->createRandomAvatar($avatarSize, $colorAmount);

        return $this->render('home.html.twig', [
            'svg' => $svg,
            'colorAmount' => $colorAmount,
            'avatarSize' => $avatarSize,
            'avatar' => $avatar,
            'formView' => $formView
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

    /**
     * @Route("/avatar/download", name="avatar_download")
     */
    public function download(Request $request)
    {
        // Récupérer le code source SVG de l'avatar (transmis dans le champ caché)
        $svg = $request->request->get('svg');

        // On construit l'objet Response
        $response = new Response($svg);

        // Modification des en-têtes pour que le navigateur télécharge le fichier SVG
        $response->headers->set('Content-Type', 'image/svg+xml');
        $disposition = HeaderUtils::makeDisposition(HeaderUtils::DISPOSITION_ATTACHMENT, 'avatar.svg');

        $response->headers->set('Content-Disposition', $disposition);

        // On retourne la réponse
        return $response;
    }
}
