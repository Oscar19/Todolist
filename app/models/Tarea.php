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

        public function __construct($tareaJson)
        {
            // no añadimos los otros atributos por que las he hecho publicas
            // buscamos donde está el archivo
            $this->tareaJson = __DIR__ . "../../config/Tareas.json";
            if (!file_exists($this->tareaJson)){
                //si no existe lo creamos
                file_put_contents($this->tareaJson, json_encode([]));
            }

        }
        public function getTareas(){
            // accedemos a todas las tareas
            return json_decode(file_get_contents($this->tareaJson), true);
        }
        public function addTarea($id, $titulo, $descripcion, $usuario, $status, $fecha, $horaInicio, $horaFin){
            $tareas = $this->getTareas();

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

?>