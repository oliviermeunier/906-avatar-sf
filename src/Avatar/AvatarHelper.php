<?php

namespace App\Avatar;

use Symfony\Component\Filesystem\Filesystem;

class AvatarHelper
{
    private $filesystem;
    private $directory;

    /**
     * Injection de services dans le constructeur de la classe
     */
    public function __construct(Filesystem $filesystem, string $directory)
    {
        $this->filesystem = $filesystem;
        $this->directory = $directory;
    }

    public function save(string $svg): string
    {
        // Générer un nom de fichier unique
        $filename = md5(uniqid(rand(), true)) . '.svg';

        // Créer le cas échéant un dossier 'avatars' dans le dossier 'public'
        $filePath = $this->directory . '/' . $filename;
        $this->filesystem->mkdir($this->directory);

        // Enregistrer le code source SVG dans le fichier
        $this->filesystem->touch($filePath);
        $this->filesystem->appendToFile($filePath, $svg);

        // On retourne le nom du fichier que l'on a créé
        return $filename;
    }
}
