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

            error_log("Nuevo ID: $nuevoId");

            try {
                $tareaModel->addTarea($nuevoId, $titulo, $descripcion, $usuario, $status, $fecha, $horaInicio, $horaFin);
                error_log('Tarea añadida exitosamente.');
            } catch (Exception $e) {
                error_log('Error al añadir la tarea: ' . $e->getMessage());
            }

            header('Location: ' . $this->view->baseUrl() . '/tarea');
            exit();
        }
    }

    public function editaAction()
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
}

