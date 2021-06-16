<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>kezakoPlant</title>
</head>

<body>
    <div class="container">
        <header class="text-center">
            <nav class="navbar navbar-light bg-success">
                <div class="container-fluid d-flex justify-content-center">
                    <a class="navbar-brand" href="#">
                        <img src="./assets/images/leaf.png" alt="" width="30" height="24" class="d-inline-block align-text-top">
                        <span class="text-white">KezakoPlant</span>
                    </a>
                </div>
            </nav>
        </header>
        <main>
            <form action="upload.php" method="post" enctype="multipart/form-data" class="mt-3 text-center">
                <label for="formFile" class="form-label">Select image to upload:</label>
                <input class="form-control mb-3" type="file" id="fileToUpload" name="fileToUpload">
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </main>
    </div>

</body>

</html>