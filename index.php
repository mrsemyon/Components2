<?php

require 'Database.php';
require 'Config.php';

$GLOBALS['config'] = [
    'mysql' => [
        'host'     => 'localhost',
        'username' => 'root',
        'password' => 'root',
        'database' => 'dive',
    ],
];

// $users = Database::getInstance()->query("SELECT * FROM users WHERE id > ?", [4]);
// $users = Database::getInstance()->action('SELECT *', 'users', ['id', '>', '4']);
$users = Database::getInstance()->get('users', ['id', '>', '4']);
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

if ($users->error()) {
    echo 'We have error: <br>';
    echo $users->error();
} else {
    foreach($users->results() as $user) {
        echo $user->name . '<br>';
    }
}
