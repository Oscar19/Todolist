<?php

class TareaController extends ApplicationController
{
    public function indexAction()
    {
        $tareaModel = new Tarea();
        $tareas = $tareaModel->getTareas();
        $this->view->tareas = $tareas;
    }

    public function addAction()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            error_log('Formulario enviado.');
            
            $titulo = $_POST['titulo'];
            $descripcion = $_POST['descripcion'];
            $usuario = $_POST['usuario'];
            $status = $_POST['status'];
            $fecha = $_POST['fecha'];
            $horaInicio = $_POST['horaInicio'];
            $horaFin = $_POST['horaFin'];

            error_log("Datos recibidos: Titulo: $titulo, Descripcion: $descripcion, Usuario: $usuario, Status: $status, Fecha: $fecha, HoraInicio: $horaInicio, HoraFin: $horaFin");

            $tareaModel = new Tarea();
            $tareas = $tareaModel->getTareas();
            $ultimoId = count($tareas) > 0 ? end($tareas)['Id'] : 0;
            $nuevoId = $ultimoId + 1;

           
            $tareaModel->addTarea($nuevoId, $titulo, $descripcion, $usuario, $status, $fecha, $horaInicio, $horaFin);
            

            header('Location: ' . $this->view->baseUrl() . '/tarea');
            exit();
        }
    }

    

    public function detalleAction()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : null;

        if ($id !== null) {
            $tareaModel = new Tarea();
            $tareas = $tareaModel->getTareas();

            $tareaSeleccionada = null;
            foreach ($tareas as $tarea) {
                if ($tarea['Id'] == $id) {
                    $tareaSeleccionada = $tarea;
                    break;
                }
            }
            
            if ($tareaSeleccionada) {
                $this->view->tarea = $tareaSeleccionada;
            } else {
                $this->view->tarea = null;
                $this->view->mensaje = 'Tarea no encontrada.';
            }
        } else {
            $this->view->tarea = null;
            $this->view->mensaje = 'No se proporcionó un ID válido.';
        }
    }
    public function editaAction()
    {
    $id = isset($_GET['id']) ? $_GET['id'] : null;
    error_log("ID recibido: " . $id); 

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $titulo = $_POST['titulo'];
        $descripcion = $_POST['descripcion'];
        $usuario = $_POST['usuario'];
        $status = $_POST['status'];
        $fecha = $_POST['fecha'];
        $horaInicio = $_POST['horaInicio'];
        $horaFin = $_POST['horaFin'];

        $tareaModel = new Tarea();
        if ($tareaModel->updateTarea($id, $titulo, $descripcion, $usuario, $status, $fecha, $horaInicio, $horaFin)) {
            header('Location: ' . $this->view->baseUrl() . '/tarea');
            exit();
        } else {
            $this->view->mensaje = 'Error al actualizar la tarea.';
        }
    } else {
        
        if ($id !== null) {
            $tareaModel = new Tarea();
            $tareas = $tareaModel->getTareas();
            error_log("Total de tareas: " . count($tareas)); 

            $tareaSeleccionada = null;
            foreach ($tareas as $tarea) {
                if ($tarea['Id'] == $id) {
                    $tareaSeleccionada = $tarea;
                    break;
                }
            }

                $this->view->tarea = $tareaSeleccionada;
            
        }
    }
}
public function deleteAction()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        $tareaModel = new Tarea();
        $tareaModel->deleteTarea($id);

        header('Location: ' . $this->view->baseUrl() . '/tarea');
        exit();
    }
}
}

