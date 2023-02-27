<?php
namespace App\Entity;

class Todo {

    private $name;
    private $priority;
    private $color;
    private $createdDate;
    private $modifyDate;

    public function __construct($name, $priority, $color) {
        $this->name = $name;
        $this->priority = $priority;
        $this->color = $color;
        $this->createdDate = time();
    }

    public function update($name, $priority, $color) {
        $this->name = $name;
        $this->priority = $priority;
        $this->color = $color;
    }


}