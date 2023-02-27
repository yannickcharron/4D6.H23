<?php

namespace App\Controller;

use App\Entity\TodoList;
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
            'name' => $session->get('name')
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
