<?php

require __DIR__ . '/Database.php';

$users = Database::getInstance()->query("SELECT * FROM users WHERE name IN (?, ?)", ['Nancy A', 'Jim Ketty']);
var_dump($users->count());
if ($users->error()) {
    echo 'We have error: <br>';
    echo $users->error();
} else {
    foreach($users->results() as $user) {
        echo $user->name . '<br>';
    }
}

// if ($users->conut() {

// }
