<?php

namespace App\Avatar;

class Avatar {

    // Ici je suis à l'intérieur de la classe


    // Constantes de classes


    // Propriétés (caractéristiques)
    private $size;
    private $colors;
    private $matrix;

    // Méthodes (fonctions)


    // Constructeur
    public function __construct(int $size, array $colors)
    {
        $this->size = $size;
        $this->colors = $colors;

        $this->genRandomMatrix();
    }

    // Génération aléatoire d'une matrice
    public function genRandomMatrix()
    {
        $matrix = [];

        // Création de la matrice aléatoire
        for ($row = 0; $row < $this->size; $row++) {

            $colorTab = [];

            // Pour la symétrie, on ne parcours que la moitié de la ligne
            for ($column = 0; $column < $this->size/2; $column++) {
                $randomIndex = rand(0, count($this->colors) - 1);
                $colorTab[$column] = $this->colors[$randomIndex];

                // On remplit la case "miroir" avec la même couleur
                $colorTab[$this->size-1-$column] = $this->colors[$randomIndex]; 
            }

            $matrix[$row] = $colorTab;
        }

        $this->matrix = $matrix;
    }

    // Getters & setters
    public function getSize(): int
    {
        return $this->size;
    }

    public function setSize(int $size)
    {
        $this->size = $size;
    }

    public function getColors(): array
    {
        return $this->colors;
    }

    public function setColors(array $colors)
    {
        $this->colors = $colors;
    }

    public function getMatrix(): array
    {
        return $this->matrix;
    }
}


// Ici je suis à l'extérieur 





