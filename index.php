<?php

require 'Database.php';

//$users = Database::getInstance()->query("SELECT * FROM users WHERE id > ?", [4]);
//$users = Database::getInstance()->action('SELECT *', 'users', ['id', '>', '4']);
//$users = Database::getInstance()->get('users', ['id', '>', '4']);
//$users = Database::getInstance()->delete('users', ['id', '=', '10']);
Database::getInstance()->insert('users', [
    'email' => 'lol',
    'password' => 'kek',
    'role' => 'princess',
]);

// if ($users->error()) {
//     echo 'We have error: <br>';
//     echo $users->error();
// } else {
//     foreach($users->results() as $user) {
//         echo $user->name . '<br>';
//     }
// }
