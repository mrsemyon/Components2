<?php
include $_SERVER['DOCUMENT_ROOT'] . '/src/core.php';

$post = $db->getOne('posts', $_GET['id']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Show</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">My blog</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <main>
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <form action="update.php?id=<?= $post['id'] ?>" method="POST">
                        <div class="form-group mt-5">
                            <label for="title">Enter new value</label>
                            <input type="text" name="title" id="title" class="form-control" placeholder="<?= $post['title'] ?>">
                        </div>
                        <div class="form-group mt-5">
                            <button class="btn btn-warning">Edit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</body>

</html>