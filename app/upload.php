
<?php
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Allow certain file formats
if (
    $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif"
) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded in " . $target_file;

        /* API CALL */
        // make PHP / CURL compliant with multidimensional arrays
       function curl_setopt_custom_postfields($ch, $postfields, $headers = null)
        {
            $algos = hash_algos();
            $hashAlgo = null;

            foreach (array('sha1', 'md5') as $preferred) {
                if (in_array($preferred, $algos)) {
                    $hashAlgo = $preferred;
                    break;
                }
            }

            if ($hashAlgo === null) {
                list($hashAlgo) = $algos;
            }

            $boundary = '----------------------------' . substr(hash(
                $hashAlgo,
                'cURL-php-multiple-value-same-key-support' . microtime()
            ), 0, 12);

            $body = array();
            $crlf = "\r\n";
            $fields = array();

            foreach ($postfields as $key => $value) {
                if (is_array($value)) {
                    foreach ($value as $v) {
                        $fields[] = array($key, $v);
                    }
                } else {
                    $fields[] = array($key, $value);
                }
            }

            foreach ($fields as $field) {
                list($key, $value) = $field;

                if (strpos($value, '@') === 0) {
                    preg_match('/^@(.*?)$/', $value, $matches);
                    list($dummy, $filename) = $matches;

                    $body[] = '--' . $boundary;
                    $body[] = 'Content-Disposition: form-data; name="' . $key . '"; filename="' . basename($filename) . '"';
                    $body[] = 'Content-Type: application/octet-stream';
                    $body[] = '';
                    $body[] = file_get_contents($filename);
                } else {
                    $body[] = '--' . $boundary;
                    $body[] = 'Content-Disposition: form-data; name="' . $key . '"';
                    $body[] = '';
                    $body[] = $value;
                }
            }

            $body[] = '--' . $boundary . '--';
            $body[] = '';

            $contentType = 'multipart/form-data; boundary=' . $boundary;
            $content = join($crlf, $body);

            $contentLength = strlen($content);

            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Length: ' . $contentLength,
                'Expect: 100-continue',
                'Content-Type: ' . $contentType
            ));

            curl_setopt($ch, CURLOPT_POSTFIELDS, $content);
        }

        $url = 'https://my-api.plantnet.org/v2/identify/all?api-key=2b101KupCBLezl8pN3AH8oUg';

        $data = array(
            'organs' => array(
                'flower',
            ),
            'images' => array(
                '@' . $target_file,
            )
        );

        $ch = curl_init(); // init cURL session

        curl_setopt($ch, CURLOPT_URL, $url); // set the required URL
        curl_setopt($ch, CURLOPT_POST, true); // set the HTTP method to POST
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // get a response, rather than print it
        // curl_setopt($ch, CURLOPT_SAFE_UPLOAD, false); // allow "@" files management
        curl_setopt_custom_postfields($ch, $data); // set the multidimensional array param
        $response = curl_exec($ch); // execute the cURL session

        curl_close($ch); // close the cURL session

        /* Display Results */
        $plantResultObject = json_decode($response);

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
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
