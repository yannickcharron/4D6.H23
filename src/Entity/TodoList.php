<?php
namespace App\Entity;

//Pour le TP02 équivalent à la classe Panier - AM
class TodoList {

    private $todos = [];

    public function add($name, $priority, $color) {
        $todo = new Todo($name, $priority, $color);
        $this->todos[] = $todo;
    }


    public function delete($index) {
        if(array_key_exists($index, $this->todos)) {
            unset($this->todos[$index]);
        }
    }


    public function update($newTodos) {
        if(count($this->todos) > 0) {
            $todoNames = $newTodos["txtTodo"];
            $todoPriorities = $newTodos["cboPriority"];
            $todoColors = $newTodos["clpColor"];
    
            foreach($this->todos as $key => $todo) {
                $newName = $todoNames[$key];
                $newPriority = $todoPriorities[$key];
                $newColor = $todoColors[$key];
                $todo->update($newName, $newPriority, $newColor);
            }

            
        }

    }


    public function getTodos() {
        return $this->todos;
    }

}
