<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require('db.inc.php');

$items = getOgLinks();
session_start();
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>OG Links</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" integrity="sha384-tViUnnbYAV00FLIhhi3v/dWt3Jxw4gZQcNoSCxCIFNJVCx7/D55/wXsrNIRANwdD" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <main>
            <h2>OG Links</h2>
            <?php if (isset($_SESSION['added_oglink'])): ?>
                <div id="#custom-message" class="p-3 text-success-emphasis bg-success-subtle border border-success-subtle rounded-3 mt-3">
                    New link <strong><i><?= $_SESSION['added_geocache']; ?></i></strong> successfully added!
                </div>
                <?php unset($_SESSION['added_oglink']); ?>
            <?php endif; ?>
            <div class="mt-3 mb-3 text-end">
                <a href="add.php">
                    <button type="button" class="btn btn-outline-primary"><i class="bi bi-plus-circle"></i> Add new link</button>
                </a>
            </div>
            <div class="table-responsive small">
                <table class="table table-hover table-striped table-sm">
                    <thead>
                        <tr>
                            <th scope="col">#ID</th>
                            <th scope="col">Image</th>
                            <th scope="col">URL</th>
                            <th scope="col">Title</th>
                            <th scope="col">Description</th>
                            <th scope="col">Weight</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($items as $item): ?>
                            <tr>
                                <td><?= $item['id']; ?></td>
                                <td><?= strlen($item['ogimage']) > 0 ? '<img src="' . $item['ogimage'] . '" height="50px;">' : ''; ?></td>
                                <td><a href="<?= $item['url']; ?>" target="_blank"><?= mb_strimwidth($item['url'], 0, 50, "..."); ?></a></td>
                                <td><?= mb_strimwidth($item['ogtitle'], 0, 50, "..."); ?></td>
                                <td><?= mb_strimwidth($item['ogdescription'], 0, 50, "..."); ?></td>
                                <td><?= $item['weight']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <nav aria-label="Overview navigation">
                    <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">Previous</span>
                            </a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                                <span class="sr-only">Next</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>