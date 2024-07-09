<?php
declare(strict_types=1);

require_once('autoload.php');

use App\UserTableWrapper;

$userTableWrapper = new UserTableWrapper();

$userTableWrapper->insert(['id' => 1, 'name' => 'Андрей', 'age' => 20]);
$userTableWrapper->insert(['id' => 2, 'name' => 'Иван', 'age' => 22]);
$userTableWrapper->insert(['id' => 3, 'name' => 'Аркадий', 'age' => 55]);

var_dump($userTableWrapper->update(2, ['name' => 'Сергей', 'age' => 28]));

$userTableWrapper->delete(1);

var_dump($userTableWrapper->get());
