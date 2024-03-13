<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

require_once("./Impianto.php");

class ControllerUmidita{

    function show(Request $request, Response $response, $args) {
        $Impianto = new Impianto("Impianto1", 43.7695604, 11.2558136);
        $response->getBody()->write(json_encode($Impianto->listaUmidita()));
        return $response->withHeader("Content-Type", "application/json")->withStatus(200);
    }

    function rilevatore(Request $request, Response $response, $args) {
        $id = $args["identificativo"];

        $Impianto = new Impianto("Impianto1", 43.7695604, 11.2558136);

        $r = $Impianto->trovaUmidita($id);
        
        if ($r != null) {
            $response->getBody()->write(json_encode($r));
            return $response->withHeader("Content-Type", "application/json")->withStatus(200);
        }
        else{
            $response->getBody()->write("Rilevatore non presente");
            return $response ->withHeader('Content-Type', 'text/html')->withStatus(404);
        }
        
    }
    
    function misurazioni(Request $request, Response $response, $args) {
        $id = $args["identificativo"];

        $Impianto = new Impianto("Impianto1", 43.7695604, 11.2558136);

        $r = $Impianto->trovaUmidita($id);

        if ($r != null) {
            $response->getBody()->write(json_encode($r->get_listaMisurazione()));
            return $response->withHeader("Content-Type", "application/json")->withStatus(200);
        }else{
            $response->getBody()->write("Rilevatore non presente");
            return $response ->withHeader('Content-Type', 'text/html')->withStatus(404);
        }
        
    }

    function misurazionimax(Request $request, Response $response, $args) {
        $id = $args["identificativo"];
        $min = $args["valore_minimo"];

        $Impianto = new Impianto("Impianto1", 43.7695604, 11.2558136);

        $r = $Impianto->trovaUmidita($id);

        if ($r != null) {
            $lista = $r->get_misurazioniMax($min);
            $response->getBody()->write(json_encode($lista));
            return $response->withHeader("Content-Type", "application/json")->withStatus(200);
        }else{
            $response->getBody()->write("Rilevatore non presente");
            return $response ->withHeader('Content-Type', 'text/html')->withStatus(404);
        }

    }

    function create(Request $request, Response $response, $args) {

        $body = $request->getBody()-> getContents();
        $parseBody = json_decode($body,true);

        $id = $parseBody['id'];
        $codiceSeriale = $parseBody['codiceSeriale']; 

        $r = new RilevatoreDiTemperatura($id, $codiceSeriale);
        $Impianto = new Impianto("Impianto1", 43.7695604, 11.2558136);
        
        $response->getBody()->write($Impianto->aggiungiRilevazione($r));

        return $response ->withHeader('Content-Type', 'application/json')->withStatus(201);
    }

    function update(Request $request, Response $response, $args)
    {
        $body = $request->getBody()-> getContents();
        $parseBody = json_decode($body,true);

        $id = $parseBody['id'];
        $codiceSeriale = $parseBody['codiceSeriale']; 
        $identificativo = $args["identificativo"];

        $Impianto = new Impianto("Impianto1", 43.7695604, 11.2558136);

        $r = $Impianto->trovaUmidita($identificativo);

        if($r != null)
        {
            $r->set_id($id);
            $r->set_codiceSeriale($codiceSeriale);
            $response->getBody()->write($r);
            return $response ->withHeader('Content-Type', 'application/json')->withStatus(200);
        }
        else
        {
            $response->getBody()->write("Rilevazione non presente");
            return $response ->withHeader('Content-Type', 'application/json')->withStatus(404);
        }
    }




}