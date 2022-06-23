<?php

require 'Database.php';
require 'Config.php';
require 'Input.php';
require 'Validate.php';

$GLOBALS['config'] = [
    'mysql' => [
        'host'     => 'localhost',
        'username' => 'root',
        'password' => 'root',
        'database' => 'dive',
    ],
];

if (Input::exists()) {
    $validate = new Validate();

    $validation = $validate->check(
        $_POST,
        [
            'email' => [
                'required' => true,
                'min' => 2,
                'max' => 15,
                'unique' => 'users',
            ],
            'password' => [
                'required' => true,
                'min' => 3,
            ],
            'password_again' => [
                'required' => true,
                'matches' => 'password',
            ],
        ]

    );

    if ($validation->passed()) {
        echo 'passed';
    } else {
        foreach ($validation->errors() as $error) {
            echo $error . '<br>';
        }
    }
}

// $users = Database::getInstance()->query("SELECT * FROM users WHERE id > ?", [4]);
// $users = Database::getInstance()->action('SELECT *', 'users', ['id', '>', '4']);
// $users = Database::getInstance()->get('users', ['id', '>', '4']);
// Database::getInstance()->delete('users', ['id', '=', '10']);
// Database::getInstance()->insert('users', [
//     'email' => 'lol',
//     'password' => 'kek',
//     'role' => 'princess',
// ]);
// Database::getInstance()->update('users', 11, [
//     'email' => 'lol2',
//     'password' => 'kek2',
//     'role' => 'princess2',
// ]);

//echo $users->first()->email;

// if ($users->error()) {
//     echo 'We have error: <br>';
//     echo $users->error();
// } else {
//     foreach($users->results() as $user) {
//         echo $user->name . '<br>';
//     }
// }
echo '<pre>';
var_dump($_POST);
echo '</pre>';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
    <div class="container-xxl">
        <div class="col-6">
            <form action="" method="POST">
                <div class="mb-3">
                    <label for="exampleInputUsername1" class="form-label">Email address</label>
                    <input name="email" type="text" class="form-control" id="exampleInputUsername1" aria-describedby="emailHelp" value="<?= Input::get('username') ?>">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input name="password" type="password" class="form-control" id="exampleInputPassword1">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword2" class="form-label">Password again</label>
                    <input name="password_again" type="password" class="form-control" id="exampleInputPassword2">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

</body>

</html>