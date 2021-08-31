<?php 

namespace App\Avatar;

class AvatarSVGRenderer {

    // Propriétés
    private $template; // Chemin vers le fichier de template SVG

    // Constructeur
    public function __construct(string $template)
    {
        // Initialisation de la propriété template avec le paramètre $template
        $this->template = $template;
    }

    // Méthodes
    public function render(Avatar $avatar)
    {
        // Démarrage de la tamporisation de sortie
        ob_start();

        require $this->template;

        // On retourne le contenu du tampon de sortie (et on vide le tampon)
        return ob_get_clean();
    }
}