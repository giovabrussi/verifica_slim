<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/controllers/SiteController.php';
require __DIR__ . '/controllers/ControllerUmidita.php';
require __DIR__ . '/controllers/ControllerTemperatura.php';

$app = AppFactory::create();

$app->get('/', 'SiteController:home');
$app->get('/impianto', 'SiteController:impianto');

$app->get('/rilevatori_di_umidita', 'ControllerUmidita:show');
$app->get('/rilevatori_di_umidita/{identificativo}', 'ControllerUmidita:rilevatore');
$app->get('/rilevatori_di_umidita/{identificativo}/misurazioni', 'ControllerUmidita:misurazioni');
$app->get('/rilevatori_di_umidita/{identificativo}/misurazioni/maggiore_di/{valore_minimo}', 'ControllerUmidita:misurazionimax');
$app->post('/rilevatori_di_umidita', 'ControllerUmidita:create');
$app->put('/rilevatori_di_umidita/{identificativo} ', 'ControllerUmidita:update');

$app->get('/rilevatori_di_temperatura', 'ControllerTemperatura:show');
$app->get('/rilevatori_di_temperatura/{identificativo}', 'ControllerTemperatura:rilevatore');
$app->get('/rilevatori_di_temperatura/{identificativo}/misurazioni', 'ControllerTemperatura:misurazioni');
$app->get('/rilevatori_di_temperatura/{identificativo}/misurazioni/maggiore_di/{valore_minimo}', 'ControllerTemperatura:misurazionimax');
$app->post('/rilevatori_di_temperatura', 'ControllerTemperatura:create');
$app->put('/rilevatori_di_temperatura/{identificativo} ', 'ControllerTemperatura:update');

$app->run();