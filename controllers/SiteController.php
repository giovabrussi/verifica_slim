<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

require_once("./Impianto.php");

class SiteController{

    function home(Request $request, Response $response, $args) {
        $response->getBody()->write("Hello world!");
        return $response;
    }

    function impianto(Request $request, Response $response, $args) {
        $Impianto = new Impianto("Impianto1", 43.7695604, 11.2558136);
        $response->getBody()->write(json_encode($Impianto));
        return $response->withHeader("Content-Type", "application/json")->withStatus(200);
    }

}