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
        $this->modifyDate = time();
    }

    public function getName() {
        return $this->name;
    }

    public function getPriority() {
        return $this->priority;
    }

    public function getColor() {
        return $this->color;
    }


}