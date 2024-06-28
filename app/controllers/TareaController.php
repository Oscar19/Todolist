<?php

class TareaController extends ApplicationController
{
    public function indexAction()
    {
       $tareaModel = new Tarea();
        $tareas = $tareaModel->getTareas();
        $this->view->tareas = $tareas;
    }

    public function addAction() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Obtener los datos del formulario
            $titulo = $_POST['titulo'];
            $descripcion = $_POST['descripcion'];
            $usuario = $_POST['usuario'];
            $status = $_POST['status'];
            $fecha = $_POST['fecha'];
            $horaInicio = $_POST['horaInicio'];
            $horaFin = $_POST['horaFin'];
    
            // Crear una instancia del modelo Tarea
            $tareaModel = new Tarea();
    
            // Añadir la nueva tarea
            $tareaModel->addTarea(null, $titulo, $descripcion, $usuario, $status, $fecha, $horaInicio, $horaFin);
    
            // Redirigir a la lista de tareas
            header('Location: ' . $this->view->baseUrl() . '/tarea/index');
            exit();
        } else {
            // Renderizar el formulario para añadir tareas
            $this->view->render('tarea/add');
        }
    }
    
}
