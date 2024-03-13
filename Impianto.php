<?php

require_once("./Rilevatore.php");

class Impianto implements JsonSerializable{

    protected $nome;
    protected $latitudine;
    protected $longitudine;
    protected $listaRilevatori = array();

    function __construct($nome, $latitudine, $longitudine) {
        $this->nome = $nome;
        $this->latitudine = $latitudine;
        $this->longitudine = $longitudine;
        $r1 = new RilevatoreDiTemperatura(01, "rt01");
        $r2 = new RilevatoreDiUmidita(02, "ru04");
        $this->listaRilevatori = array($r1, $r2);
    }

    function trovaUmidita($id){
        $rilevatore = null;
        foreach ($this->listaRilevatori as $r) {
            if($r->get_id() == $id){
                $rilevatore = $r;
            }
        }
        return $rilevatore;
    }

    public function jsonSerialize(){
        $a = [
            "nome"=>$this->nome,
            "latitudine"=>$this->latitudine,
            "longitudine"=>$this->longitudine
        ];
        return $a;
    }

}

?>