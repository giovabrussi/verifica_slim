<?php

require_once("./Misurazione.php");

class Rilevatore implements JsonSerializable{
    
    protected $id;
    protected $codiceSeriale;
    protected $unitaDiMisura;
    protected $listaMisurazione = array();

    function __construct($id, $codiceSeriale) {
        $this->set_id($id);
        $this->set_codiceSeriale($codiceSeriale);
        $this->set_unitaDiMisura("");
    }

    function set_id($id) {
        $this->id = $id;
    }

    function get_id() {
        return $this->id;
    }

    function set_unitaDiMisura($id) {
        $this->unitaDiMisura = $id;
    }

    function get_unitaDiMisura() {
        return $this->unitaDiMisura;
    }

    function set_codiceSeriale($id) {
        $this->codiceSeriale = $id;
    }

    function get_codiceSeriale() {
        return $this->codiceSeriale;
    }

    function get_listaMisurazione() {
        return $this->listaMisurazione;
    }
    
    function get_misurazioniMax($min){
        $a = array();

        foreach ($this->listaMisurazione as $m) {
            if($m->get_valore() >= $min){
                array_push($a, $m);
            }
        }

        return $a;
    }

    public function jsonSerialize(){
        $a = [
            "id"=>$this->id,
            "codiceSeriale"=>$this->codiceSeriale,
            "unitaDiMisura"=>$this->unitaDiMisura,
            "listaMisurazione"=>$this->listaMisurazione,
        ];
        return $a;
    }

}

class RilevatoreDiUmidita extends Rilevatore{   

    function __construct($id, $codiceSeriale) {
        $this->set_id($id);
        $this->set_unitaDiMisura("%");
        $this->set_codiceSeriale($codiceSeriale);
        $m1 = new Misurazione("03/02/2024", 20 . $this->get_unitaDiMisura);
        $m2 = new Misurazione("03/06/2024", 40 . $this->get_unitaDiMisura);
        $m3 = new Misurazione("03/04/2024", 50 . $this->get_unitaDiMisura);
        $this->listaMisurazione = array($m1, $m2, $m3);
    }

    public function jsonSerialize(){
        $a = [
            "id"=>$this->id,
            "codiceSeriale"=>$this->codiceSeriale,
            "unitaDiMisura"=>$this->unitaDiMisura,
            "listaMisurazione"=>$this->listaMisurazione,
        ];
        return $a;
    }

}

class RilevatoreDiTemperatura extends Rilevatore{

    function __construct($id, $codiceSeriale) {
        $this->set_id($id);
        $this->set_unitaDiMisura("°");
        $this->set_codiceSeriale($codiceSeriale);
        $m1 = new Misurazione("13/03/2024", 40 . $this->get_unitaDiMisura);
        $m2 = new Misurazione("14/02/2024", 20 . $this->get_unitaDiMisura);
        $m3 = new Misurazione("03/06/2024", 10 . $this->get_unitaDiMisura);
        $this->listaMisurazione = array($m1, $m2, $m3);
    }

    public function jsonSerialize(){
        $a = [
            "id"=>$this->id,
            "codiceSeriale"=>$this->codiceSeriale,
            "unitaDiMisura"=>$this->unitaDiMisura,
            "listaMisurazione"=>$this->listaMisurazione,
        ];
        return $a;
    }
    

}