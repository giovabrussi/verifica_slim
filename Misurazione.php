<?php

class Misurazione implements JsonSerializable{
    
    private $data;
    private $valore;

    function __construct($data, $valore) {
        $this->set_data($data);
        $this->set_valore($valore);
    }

    function set_data($data) {
        $this->data = $data;
    }

    function get_data() {
        return $this->data;
    }

    function set_valore($valore) {
        $this->valore = $valore;
    }

    function get_valore() {
        return $this->valore;
    }

    public function jsonSerialize(){
        $a = [
            "data"=>$this->data,
            "valore"=>$this->valore
        ];
        return $a;
    }

}
