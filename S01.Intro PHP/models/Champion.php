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
    public function setName($value) { $this->name = $value; return $this;}

    //Magic Method

    public function __get($name)
    {
        switch($name) {
            case 'name':
                return $this->name;
                break;
            default:
                return null;
        }
    }

    public function __set($name, $value)
    {
        switch($name)  {
            case 'name':
                $this->name = $value;
                return $this;
            default:
                return null;
        }
    }

}