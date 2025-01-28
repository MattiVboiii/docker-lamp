<?php
require('db.inc.php');

$items = getDbImages();

$messages = [];

// Check if the form has been submitted
if (isset($_POST["formSubmit"])) {
    if (empty($_FILES["imgupload"]["name"])) {
        $messages[] = "No file uploaded.";
    } else {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["imgupload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is an actual image or fake image
        $check = getimagesize($_FILES["imgupload"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $messages[] = "File is not an image.";
            $uploadOk = 0;
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            $messages[] = "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["imgupload"]["size"] > 500000) {
            $messages[] = "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png") {
            $messages[] = "Sorry, only JPG, JPEG and PNG files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $messages[] = "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["imgupload"]["tmp_name"], $target_file)) {
                $dbResult = insertDbImage($target_file);
                if ($dbResult === false) {
                    $messages[] = "Error: " . $db->error;
                } else {
                    $messages[] = "The file " . htmlspecialchars(basename($_FILES["imgupload"]["name"])) . " has been successfully uploaded.";
                }
            } else {
                $messages[] = "Sorry, there was an error uploading your file.";
            }
        }
    }
}

// print '<pre>';
// print_r($_FILES);
// print '</pre>';
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DB Images</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" integrity="sha384-tViUnnbYAV00FLIhhi3v/dWt3Jxw4gZQcNoSCxCIFNJVCx7/D55/wXsrNIRANwdD" crossorigin="anonymous">
    <style>
        img.thumb {
            height: 50px;
        }
    </style>
</head>

<body>

    <div class="container">
        <section>
            <h2>Upload Image</h2>
            <hr />

            <?php if (!empty($messages)) : ?>
                <?php $alertType = in_array("The file " . htmlspecialchars(basename($_FILES["imgupload"]["name"])) . " has been successfully uploaded.", $messages) ? 'alert-success' : 'alert-danger'; ?>
                <div class="alert <?= $alertType ?>" role="alert">
                    <ul>
                        <?php foreach ($messages as $message) : ?>
                            <li><?= htmlspecialchars($message, ENT_QUOTES); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form method="post" action="index.php" enctype="multipart/form-data">
                <div class="form-group mt-3">
                    <label for="imgupload" class="col-sm-2 col-form-label">Image: *</label>
                    <div>
                        <input type="file" name="imgupload" id="imgupload" accept=".jpeg,.png">
                    </div>
                </div>

                <div class="form-group mt-5">
                    <div>
                        <button type="submit" class="btn btn-primary" name="formSubmit" style="width: 100%">Add</button>
                    </div>
                </div>
            </form>

        </section>
        <main>

            <h2>Images</h2>
            <div class="table-responsive small">
                <table class="table table-hover table-striped table-sm">
                    <thead>
                        <tr>
                            <th scope="col">#ID</th>
                            <th scope="col">Image</th>
                            <th scope="col">Date</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php foreach ($items as $item): ?>
                            <tr>
                                <td><?= $item['id']; ?></td>
                                <td><?php echo '<img src="' . $item['path'] . '" class="thumb"/>'; ?></td>
                                <td><?= $item['created_date']; ?></td>
                            </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>

            </div>
        </main>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>