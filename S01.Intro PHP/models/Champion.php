<?php
class Champion {

    private $idChampion;
    private $name;

    public function __construct($array)
    {
        $this->idChampion = $array["idChampion"]; // idChampion (champs de la table) provient de la base de données
        $this->name = $array["name"];
    }

    public function getName() { return $this->name; }

}