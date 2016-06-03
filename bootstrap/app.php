<?php

use Cart\App;
use Slim\Views\Twig;

use Illuminate\Database\Capsule\Manager as Capsule;

session_start();

require __DIR__ . '/../vendor/autoload.php';

$app = new App;

$container = $app->getContainer();

$capsule = new Capsule;

$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => 'localhost',
    'database'  =>  'cart',
    'username'  =>  'root',
    'password'  =>  '',
    'charset'   =>  'utf8',
    'collation' =>  'utf8_unicode_ci',
    'prefix'    =>  ''
]);

$capsule->setAsGlobal();

$capsule->bootEloquent();

Braintree_Configuration::environment('sandbox');
Braintree_Configuration::merchantId('vr2rmsbvp3mm834r');
Braintree_Configuration::publicKey('55sxrbsncsvmjxkg');
Braintree_Configuration::privateKey('677ef33e507be59d7060b0e4f6ed8fa3');


require __DIR__ . '/../app/routes.php';

//register Middleware

$app->add(new \Cart\Middleware\ValidationErrorsMiddleware($container->get(Twig::class)));
$app->add(new \Cart\Middleware\OldInputMiddleware($container->get(Twig::class)));