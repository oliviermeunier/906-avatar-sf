<svg id="avatar" viewBox="0 0 <?=$avatar->getSize()?> <?=$avatar->getSize()?>">
    <!-- On parcours les lignes de la matrice --> 
    <?php foreach ($avatar->getMatrix() as $rowIndex => $row): ?>
        <!-- Pour chaque ligne, on parcours les colonnes --> 
        <?php foreach ($row as $colIndex => $color):?>
            <!-- Pour chaque case on crée la balise SVG <rect> correspondant à la couleur récupérée -->
            <rect x="<?=$colIndex?>" y="<?=$rowIndex?>" width="1" height="1" fill="<?=$color?>" />
        <?php endforeach; ?>
    <?php endforeach; ?>
</svg>