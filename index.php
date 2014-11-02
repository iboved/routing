<?php

require_once 'vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Iboved\Controller\ArticleController;
use Iboved\Controller\IndexController;
use Phroute\RouteCollector;

$request = Request::createFromGlobals();

$articleController = new ArticleController();
$indexController = new IndexController();

$router = new RouteCollector();

$router->get('/', [$indexController,'indexAction']);

$router->get('/articles/{id}', [$articleController,'getArticleAction']);
$router->put('/articles/{id}', [$articleController,'putArticleAction']);
$router->post('/articles/{id}', [$articleController,'postArticleAction']);
$router->delete('/articles/{id}', [$articleController,'deleteArticleAction']);
$router->get('/articles', [$articleController,'getArticlesAction']);

$dispatcher = new Phroute\Dispatcher($router);
$response = $dispatcher->dispatch($request->getMethod(), parse_url($request->getPathInfo(), PHP_URL_PATH));

$response->send();
