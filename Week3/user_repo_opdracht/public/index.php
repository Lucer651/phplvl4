<?php
declare(strict_types=1);
require_once __DIR__ . '/../vendor/autoload.php';

use App\Repositories\UserRepository;
use App\Repositories\ProductRepository;
use App\Domain\Product;

$pdo = new PDO('mysql:host=localhost;dbname=user_repo_opdracht', 'root', '');
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$userRepo = new UserRepository($pdo);


$newUser = $userRepo->register(
    username:     'phpeter',
    email:        'phpeter@yahoo.com',
    passwordHash: password_hash('phpiscool', PASSWORD_DEFAULT),
);
echo "Registered user:";
var_dump($newUser);
echo "<br>";

$result = $userRepo->findByUsername('phpeter');
echo "findByUsername result:";
var_dump($result);
echo "<br>";



$result2 = $userRepo->findByEmail('phpeter@yahoo.com');
echo "findByEmail result:";
var_dump($result2);
echo "<br>";

$userById = $userRepo->findById($newUser->id);
echo "findById result:";
var_dump($userById);
echo "<br>";


//products
$productRepo = new ProductRepository($pdo);


$p1 = $productRepo->insert(new Product(0, 'Laptop', 999.99, 10));
$p2 = $productRepo->insert(new Product(0, 'Mouse',  19.95,  50));
echo "Inserted products:";
var_dump($p1, $p2);
echo "<br>";


echo "All products:";
var_dump($productRepo->findAll());
echo "<br>";


echo "findById product 1:";
var_dump($productRepo->findById($p1->id));
echo "<br>";


$updated = new Product($p1->id, 'Laptop Pro', 1199.99, 8);
$productRepo->update($updated);
echo "After update:";
var_dump($productRepo->findById($p1->id));
echo "<br>";


$productRepo->delete($p2->id);
echo "After delete, all products:";
var_dump($productRepo->findAll());