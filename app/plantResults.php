<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>kezakoPlant - Résultats</title>
</head>

<?php

/**
 * Display scientific name, family name and common names of a plant
 *
 * @param [object] $plantResultObject
 * 
 */
function displayPlantResults($plantResultObject)
{
    foreach ($plantResultObject->{'results'} as $result) : ?>
        <section class="bg-success bg-gradient mb-3 text-white">

            <h2><?= $result->species->scientificNameWithoutAuthor ?><span class="badge bg-secondary" alt="test">Score : <?= round($result->score, 2) ?> %</span></h2>
           
            <h3>Famille</h3>
            <?= $result->species->family->scientificNameWithoutAuthor ?>

            <h3>Noms courants</h3>
            <ul>
                <?php foreach ($result->species->commonNames as $plantCommonName) : ?>
                    <li><?= $plantCommonName ?></li>
                <?php endforeach; ?>
            </ul>
        </section>

<?php endforeach; ?>
 <a href="index.php">Retour à la page d'accueil</a>
 <?php
}
