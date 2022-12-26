<?php
$auth = new \Delight\Auth\Auth(App\Classes\Database::getInstance());
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title><?= $this->e($title) ?></title>
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        /* html,
        body {
            height: 100%;
        }

        body {
            display: flex;
            align-items: center;
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #f5f5f5;
        } */

        .form-signin {
            width: 100%;
            max-width: 330px;
            padding: 15px;
            margin: auto;
        }

        .form-signin .checkbox {
            font-weight: 400;
        }

        .form-signin .form-floating:focus-within {
            z-index: 2;
        }

        /* .form-signin input[name="email"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }

        .form-signin input[name="username"] {
            margin-bottom: -1px;
            border-radius: 0;
        }

        .form-signin input[name="password"] {
            margin-bottom: -1px;
            border-radius: 0;
        }

        .form-signin input[name="password_again"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        } */
        #sign-up-btn {
            margin-top: 10px;
        }

        #sing-in-btn {
            margin-top: 10px;
        }

        #remember-me {
            margin-top: 10px;
        }
    </style>
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
                        <a class="nav-link<?= ($_SERVER['REQUEST_URI'] == '/home') ? ' active" aria-current="page' : '' ?>" href="/home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link<?= ($_SERVER['REQUEST_URI'] == '/add') ? ' active" aria-current="page' : '' ?>" href="/add">Add post</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-md-auto">
                    <?php if (!$auth->isLoggedIn()): ?>
                    <li class="nav-item">
                        <a class="nav-link<?= ($_SERVER['REQUEST_URI'] == '/register') ? ' active" aria-current="page' : '' ?>" href="/register">Sing up</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link<?= ($_SERVER['REQUEST_URI'] == '/login') ? ' active" aria-current="page' : '' ?>" href="/login">Sign in</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/logout">Exit</a>
                    </li>
                    <?php else :?>
                    <li class="nav-item">
                        <p class="nav-link active"><?= $auth->getUsername()?></p>
                    </li>
                    <?php endif ?>
                </ul>
            </div>
        </div>
    </nav>
    <main>
        <?= flash()->display() ?>
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