<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

require_once("./Impianto.php");

class ControllerUmidita{

    function show(Request $request, Response $response, $args) {
        $r = new RilevatoreDiUmidita("Umidita1", 101);
        $response->getBody()->write(json_encode($r));
        return $response->withHeader("Content-Type", "application/json")->withStatus(200);
    }

    function rilevatore(Request $request, Response $response, $args) {
        $id = $args["identificativo"];

        $Impianto = new Impianto("Impianto1", 43.7695604, 11.2558136);

        $r = $Impianto->trovaUmidita($id);
        /*
        if ($r == null) {
            $response->getBody("Rilevatore non esistente");
            return $response->withHeader("Content-Type", "text/html")->withStatus(404);
        }*/
        $response->getBody()->write(json_encode($r));

        return $response->withHeader("Content-Type", "application/json")->withStatus(200);
    }
    
    function misurazioni(Request $request, Response $response, $args) {
        $id = $args["identificativo"];

        $Impianto = new Impianto("Impianto1", 43.7695604, 11.2558136);

        $r = $Impianto->trovaUmidita($id);
        $response->getBody()->write(json_encode($r->get_listaMisurazione()));

        return $response->withHeader("Content-Type", "application/json")->withStatus(200);
    }

    function misurazionimax(Request $request, Response $response, $args) {
        $id = $args["identificativo"];
        $min = $args["valore_minimo"];

        $Impianto = new Impianto("Impianto1", 43.7695604, 11.2558136);

        $r = $Impianto->trovaUmidita($id);
        $lista = $r->get_misurazioniMax($min);
        $response->getBody()->write(json_encode($lista));

        return $response->withHeader("Content-Type", "application/json")->withStatus(200);
    }



}