<?php
require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

\Stripe\Stripe::setApiKey($_ENV['PRIVATE_STRIPE']);
define('PUBLIC_STRIPE', $_ENV['PUBLIC_STRIPE']);
