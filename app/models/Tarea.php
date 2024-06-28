<?php 
    class Tarea extends Model{
        public $id;
        public $titulo;
        public $descripcion;
        public $usuario;
        public $status;
        public $fecha;
        public $horaInicio;
        public $horaFin;

        private $tareaJson;

        public function __construct($tareaJson = null)
        {
           
            $this->tareaJson = "/opt/lampp/htdocs/Todolist/config/Tareas.json";
            if (!file_exists($this->tareaJson)){
               
                file_put_contents($this->tareaJson, json_encode([]));
            }

        }
       public function getTareas(){
            // accedemos a todas las tareas
            return json_decode(file_get_contents($this->tareaJson), true);
        }
     

        public function addTarea($id, $titulo, $descripcion, $usuario, $status, $fecha, $horaInicio, $horaFin){
            $tareas = $this->getTareas();
            $newId = count($tareas) > 0 ? max(array_column($tareas, 'Id')) + 1 : 1;

            $newTarea = [
                "Id" => $id,
                "Titulo" => $titulo,
                "Descripcion" => $descripcion,
                "Usuario" => $usuario,
                "Status" => $status,
                "Fecha" => $fecha,
                "Hora_inicio" => $horaInicio,
                "Hora_final" => $horaFin,
            ];
            $tareas[] = $newTarea;
            file_put_contents($this->tareaJson, json_encode($tareas));
        }
    }

