<?php
namespace App\Entity;

//Pour le TP02 équivalent à la classe Panier - AM
class TodoList {

    private $todos = [];

    public function add($name, $priority, $color) {
        $todo = new Todo($name, $priority, $color);
        $this->todos[] = $todo;
    }

    public function getTodos() {
        return $this->todos;
    }

}
