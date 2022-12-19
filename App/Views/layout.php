<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title><?= $this->e($title)?></title>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link<?= ($_SERVER['REQUEST_URI'] == '/home') ? ' active" aria-current="page' : ''?>" href="/home">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link<?= ($_SERVER['REQUEST_URI'] == '/add') ? ' active" aria-current="page' : ''?>" href="/add">Add post</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
    <main>
        <div class="container">
            <div class="row">
                <div class="col-md-12 mt-5">
                    <?= $this->section('content') ?>
                </div>
            </div>
        </div>
    </main>
</body>
</html>