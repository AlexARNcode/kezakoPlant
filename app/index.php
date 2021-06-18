<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>kezakoPlant</title>
</head>

<body>
    <!-- NAV / HEADER -->
    <?php include('./parts/_nav.html') ?>

    <!-- MAIN CONTENT -->
    <div style="background: url(/assets/images/jasmine-brown.jpg)" class="page-holder bg-cover no-repeat">
        <div class="container py-5">
            <header class="text-center text-white py-5">
                <h1 class="display-4 font-weight-bold mb-4">Envoyez votre image</h1>
                <p class="lead mb-0">Et KeazkoPlant se charge du reste.</p>
                </p>
            </header>

            <main>
                <form action="upload.php" method="post" enctype="multipart/form-data" class="mt-3 text-center">
                    <input class="form-control mb-3 w-75 mx-auto" type="file" id="fileToUpload" name="fileToUpload">
                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
            </main>
        </div>
    </div>
</body>

</html>