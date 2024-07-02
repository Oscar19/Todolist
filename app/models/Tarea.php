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

    public function __construct()
    {
        $this->tareaJson = "/opt/lampp/htdocs/Todolist/config/Tareas.json";
        if (!file_exists($this->tareaJson)){
            file_put_contents($this->tareaJson, json_encode([]));
        }
    }

    public function getTareas(){
        return json_decode(file_get_contents($this->tareaJson), true);
    }

    public function addTarea($id, $titulo, $descripcion, $usuario, $status, $fecha, $horaInicio, $horaFin)
    {
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
    public function updateTarea($id, $titulo, $descripcion, $usuario, $status, $fecha, $horaInicio, $horaFin) {
        $tareas = $this->getTareas();
        foreach ($tareas as &$tarea) {
            if ($tarea['Id'] == $id) {
                $tarea['Titulo'] = $titulo;
                $tarea['Descripcion'] = $descripcion;
                $tarea['Usuario'] = $usuario;
                $tarea['Status'] = $status;
                $tarea['Fecha'] = $fecha;
                $tarea['Hora_inicio'] = $horaInicio;
                $tarea['Hora_final'] = $horaFin;
                break;
            }
        }
        file_put_contents($this->tareaJson, json_encode($tareas));
    }
}

