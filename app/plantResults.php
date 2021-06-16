<?php
/**
 * Display scientific name, family name and common names of a plant
 *
 * @param [object] $plantResultObject
 * 
 */
function displayPlantResults($plantResultObject) {
    foreach ($plantResultObject->{'results'} as $result): ?>
        <h2>Nom scientifique</h2>
        <?= $result->species->scientificNameWithoutAuthor ?>

        <h2>Famille</h2>
        <?= $result->species->family->scientificNameWithoutAuthor ?>

        <h2>Noms courants</h2>
        <?php foreach ($result->species->commonNames as $plantCommonName): ?>
            <?= $plantCommonName ?>
        <?php endforeach;
   endforeach;
}
