<?php

namespace App\Controller;

use App\Entity\TodoList;
use PhpParser\Builder\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TodoController extends AbstractController
{
    private $todoList;

    #[Route('/todo', name: 'app_todo')]
    public function index(Request $request): Response
    {
        $this->initSession($request);
        $session = $request->getSession();

        return $this->render('todo/index.html.twig', [
            'name' => $session->get('name'),
            'todolist' => $this->todoList
        ]);
    }
    #[Route('/todo/add', name:'todo_add', methods:['POST'])]
    public function addTodo(Request $request) : Response {

        $this->initSession($request);

        $post = $request->request->all();
        
        //TODO : Validation
        $this->todoList->add($post['txtTodoName'], $post['cboTodoPriority'], $post['clpTodoColor']);

        return $this->redirectToRoute('app_todo');

    }

    #[Route('/todo/update', name:'todo_update', methods:['POST'])]
    public function updateTodo(Request $request) : Response {
        $post = $request->request->all();
        $this->initSession($request);

        $action = $request->request->get('action');

        if($action == "update") {
            $this->todoList->update($post);
        } else if($action == "empty") {
            $session = $request->getSession();
            $session->remove('todolist');
        }

        
        return $this->redirectToRoute('app_todo');
    }

    #[Route('/todo/delete/{index}', name:'todo_delete')]
    public function deleteTodo($index, Request $request) : Response {
        $this->initSession($request);

        $this->todoList->delete($index);

        return $this->redirectToRoute('app_todo');
    }

    private function initSession(Request $request) {

        $session = $request->getSession();
        // if(!$session->has('todolist')) {
        //     $session->set('todolist', new TodoList());
        // }
        //$this->todoList = $session->get('todolist');

        $session->set('name', 'Yannick');
        $this->todoList = $session->get('todolist', new TodoList());

        $session->set('todolist', $this->todoList);


    }

}
