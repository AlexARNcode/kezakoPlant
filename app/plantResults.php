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
/* HEADER / NAV */
include('./parts/_nav.html');

/**
 * Display scientific name, family name and common names of a plant
 *
 * @param [object] $plantResultObject
 * 
 */
function displayPlantResults($plantResultObject, $targetFile)
{
    /* Display image uploaded by the user */
    $filePath = '/' . $targetFile;
?>
    <div class="text-center">
        <img src="<?= $filePath ?>" class="w-25 mt-3" />
    </div>

    <h2 class="text-center mt-3">Résultats :</h2>

    <?php

    /* Display Results */
    foreach ($plantResultObject->{'results'} as $result) : ?>
        <div class="row">
            <section class="bg-success bg-gradient mb-3 mt-3 p-3 text-white col-sm-12 col-lg-6 mx-auto">

                <h2><?= $result->species->scientificNameWithoutAuthor ?>
                    <span class="badge bg-success" alt="test">
                        Score : <?= round($result->score, 2) * 100 ?> %
                    </span>
                </h2>

                <h3>Famille</h3>
                <?= $result->species->family->scientificNameWithoutAuthor ?>

                <h3>Noms courants</h3>
                <ul>
                    <?php foreach ($result->species->commonNames as $plantCommonName) : ?>
                        <li><?= $plantCommonName ?></li>
                    <?php endforeach; ?>
                </ul>
            </section>
        </div>

    <?php endforeach; ?>
    <p class="text-center">
        <a href="index.php">Retour à la page d'accueil</a>
    </p>
<?php
}
